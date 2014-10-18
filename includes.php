<?php
header('Content-type: text/html; charset=utf-8');

$dbuser = 'root';
$dbpass = '';

if(empty($dbuser) || empty($dbpass)) {
    echo "edit includes.php to include your database creds";
    die();
}
$db = new PDO('mysql:host=localhost;dbname=torpgp;charset=utf8', $dbuser, $dbpass);


class ReceivedResults {
	public $errors;
	public $messages;

	public function __construct($errors, $messages) {
		$this->errors 	= $errors;
		$this->messages = $messages;
	}
}

class SentResults {
	public $errors;

	public function __construct($errors) {
		$this->errors 	= $errors;
	}
}

function lookup_id_from_key($key) {
	global $db;
	
	$s_key = $key;	//rip off armor junk for keys
	preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $s_key);
	
	$pre = explode("\n", $s_key);
	$post = [];
	foreach($pre as $p) {
		if(	!preg_match("-----BEGIN", $p)
		   && 	!preg_match("-----END", $p)
		   && 	!preg_match("Version:", $p)) {
			
			$post[] = $p;
		}
	}
	$s_key = implode("\n", $post);

	$sql = 'SELECT id
			FROM users
			WHERE public_key LIKE ?';

	$stmt = $db->prepare($sql);
	$stmt->execute(array("%".$s_key."%"));
	$result = $stmt->fetchAll();

	if(count($result) == 0)	return false;
	else 					return $result[0]["id"];
}

function insert_key_grab_id($key) {
	global $db;

	$sql = 'INSERT INTO users (public_key)
			VALUES (?)';

	$stmt = $db->prepare($sql);
	$stmt->execute(array($key));

	return $db->lastInsertId();
}

$pagetop = '<!DOCTYPE html>
<html>
	<head>
		<title>Definitely not Facebook</title>
		<link rel="stylesheet" href="/pure-min.css" />
		<link rel="stylesheet" href="/style.css" />
		<meta charset="UTF-8">
	</head>
	<body>
		<header>
			<div class="pure-menu pure-menu-open pure-menu-horizontal">
				<div class="pure-u-1-6"></div>
				<div class="pure-u-3-4">
					<span class="pure-menu-heading">Definitely not facebook</span>
				</div>
				<div class="pure-u-1-6"></div>
			</div>
		</header>
		 <div class="pure-g">
	        <div class="pure-u-1-6"></div>
	        <div class="pure-u-3-4">';

$pagebottom = '</div><div class="pure-u-1-6"></div></div><footer><a class="pure-button pure-button-primary" href="https://github.com/whackashoe/definitelynotfacebook">Get Source</footer></body></html>'

?>
