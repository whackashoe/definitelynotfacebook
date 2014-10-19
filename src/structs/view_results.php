<?php

class ViewResults {
	public $errors;
	public $message;

	public function __construct($errors, $message) {
		$this->errors  = $errors;
		$this->message = $message;
	}
}
