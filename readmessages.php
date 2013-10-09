<?php
require_once("includes.php");

$errors = [];

if(isset($_POST['your_key'])) {
	$id = lookup_id_from_key($_POST['your_key']);

	if(!$id) 	$errors[] = "Key not in database, you need to send or receive a message first.";
	else 		$user_id = $id;
} else if(isset($_GET['id'])) {
	$sql = 'SELECT id
			FROM users
			WHERE id=?';

	$stmt = $db->prepare($sql);
	$stmt->execute(array($_GET['id']));
	$result = $stmt->fetchAll();

	if(count($result) == 0) $errors[] = "Id not in database, you need to send or receive a message first.";
	else					$user_id = $result[0]["id"];
} else {
	$errors[] = "Please <a href=\"index.php\">Go to homepage</a> and enter a public key";
}

if(isset($user_id) && count($errors) == 0) {
	$sql = 'SELECT users.public_key, messages.message, messages.id
			FROM messages
			INNER JOIN users ON (users.id = messages.from)
			WHERE messages.to=?
			ORDER BY messages.id DESC';

	$stmt = $db->prepare($sql);
	$stmt->execute(array($user_id));
	$messages = $stmt->fetchAll();
}

if(isset($_GET['json'])) {
	$m_messages = [];
	foreach ($messages as $m)
		$m_messages[] = array("key"=>$m['public_key'], "message"=>$m['message']);

	echo json_encode(new ReceivedResults($errors, $m_messages));
} else {
	echo $pagetop;

	if(count($errors) > 0) {
		foreach($errors as $e) {
			echo '<p class="error">'.$e.'</p><a href="index.php">Go Back</a>';
	 	} 
	} else if(isset($messages) && count($messages) > 0) {
		echo '<table class="pure-table">
			<thead>
		        <tr>
		            <th>Sender\'s Public Key</th>
		            <th>Message</th>
			    <th>Plain Message</th>
		        </tr>
		    </thead>
		    <tbody>';
		foreach($messages as $i) {
			echo '<tr>
					<td><pre>'.htmlspecialchars($i['public_key']).'</pre></td>
					<td><pre>'.htmlspecialchars($i['message']).'</pre></td>
					<td><a href="viewmessage.php?id=' . $i['id'] . '">View Message Plaintext</a>
				</tr>';
		}

		echo '</tbody></table>';
	} else {
		echo 'No messages hombre';
	}

	echo $pagebottom;
}
?>
