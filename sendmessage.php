<?php
require_once("includes.php");

if(!isset($_POST['send_key'])) 
	$errors[] = "send_key not received";
if(!isset($_POST['receive_key']) || empty($_POST['receive_key']))
	$errors[] = "receive_key not received";
if(!isset($_POST['message']) || empty($_POST['message']))
	$errors[] = "message not received";


if(count($errors) == 0) {
	$send_id 	= lookup_id_from_key($_POST['send_key']);
	$receive_id 	= lookup_id_from_key($_POST['receive_key']);

	if(!$send_id) 		$send_id 	= insert_key_grab_id($_POST['send_key']);
	if(!$receive_id) 	$receive_id 	= insert_key_grab_id($_POST['receive_key']);

	$sql = 'INSERT INTO messages (`to`, `from`, `message`)
			VALUES (?, ?, ?)';

	$stmt = $db->prepare($sql);
	$stmt->execute(array($receive_id, $send_id, $_POST['message']));
}

if(isset($_GET['json'])) {
	echo json_encode(new SentResults($errors));
} else {
	echo $pagetop;

	if(isset($errors)) {
		foreach($errors as $e) {
			echo '<p class="error">'.$e.'</p>';
		}
		echo '<a href="index.php">Go Back</a>';	
	} else {
		echo 'Message sent. Confirm that <a href="readmessages.php?id='.$receive_id.'">here</a>';
	}

	echo $pagebottom;
}
?>
