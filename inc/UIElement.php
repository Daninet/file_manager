<?php

namespace QCFileManager;

abstract class UIElement 
{
	protected $html = '';

	protected $css_class = '';
	protected $css_id = '';

	public abstract function renderHTML();

	public function setClass($class) {
		$this->css_class = $class;
		return $this;
	} 

	public function setID($id) {
		$this->$css_id = $id;
		return $this;
	}

	public function getHTMLClass($no_attr = false) {
		
		if($this->css_class == '')
			return '';

		$html = ' '; //leading space
		if(!$no_attr)
			$html .= 'class="';

		$html .= $this->css_class;

		if(!$no_attr)
			$html .= '"';

		return $html;
	}

	public function getHTMLID() {

		if($this->css_id == '')
			return '';

		return ' id="'.$this->css_id.'"';

	}

}