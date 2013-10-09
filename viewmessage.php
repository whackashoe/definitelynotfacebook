<?php
require_once("includes.php");

$errors = [];

if(isset($_GET['id'])) {
	$sql = 'SELECT message
			FROM messages
			WHERE id=?';

	$stmt = $db->prepare($sql);
	$stmt->execute(array($_GET['id']));
	$result = $stmt->fetchAll();

	if(count($result) == 0) $errors[] = "Message id not in database.";
	else			$message = $result[0]["message"];
} else {
	$errors[] = "<a href=\"index.php\">Go to homepage</a>";
}

if(count($errors) > 0) {
	foreach($errors as $e) {
		echo '<p class="error">'.$e.'</p><a href="index.php">Go Back</a>';
	} 
} else if(isset($message)) {
	echo $message;
}
?>
