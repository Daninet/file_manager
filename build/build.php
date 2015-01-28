<?php


namespace QCFileManager;

class Builder {

	private $output = '';
	
	function __construct() {


	}

	private function loadClass($name) {


	}

	private function loadJS() {

	}


	public function make($out) {
		$this->loadClass('App');

		$this->loadClass('URLHandler');
		
		$this->loadClass('FSObject');
		$this->loadClass('File');
		$this->loadClass('Directory');

		$this->loadClass('FileHandler');

		$this->loadClass('UI');
		$this->loadClass('UIElement');
		$this->loadClass('UIIcon');
		$this->loadClass('UIImage');
		$this->loadClass('UILink');
		$this->loadClass('UITable');

		$this->loadClass('ImageResizer');
	}

}
