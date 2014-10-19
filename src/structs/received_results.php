<?php

class ReceivedResults {
	public $errors;
	public $messages;

	public function __construct($errors, $messages) {
		$this->errors 	= $errors;
		$this->messages = $messages;
	}
}
