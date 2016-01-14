<?php

class Responce {

	private $status;
	private $content;

	function __construct($status, $content) {
		$this->status = $status;
		$this->content = $content;
	}

	public function returnPage() {
		echo $this->content;
	}
}