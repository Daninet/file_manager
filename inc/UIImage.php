<?php

namespace QCFileManager;

class UIImage extends UIElement
{
	protected $href = '';
	protected $image = '';

	public function __construct($image, $href = '') {
		$this->image = $image;
		$this->href = $href;

		return $this;
	}

	public function renderHTML() {
		if($this->href != '') 
			$this->html .= '<a href="'.$this->href.'">';

		$this->html .= '<img src="'.$this->image.'"'.$this->getHTMLClass().$this->getHTMLID().' />';

		
		if($this->href != '') 
			$this->html .= '</a>';

		return $this->html;

	}
}