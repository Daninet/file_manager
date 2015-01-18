<?php

namespace QCFileManager;

class UIIcon extends UIElement
{
	protected $href = '';
	protected $icon = '';

	public function __construct($icon, $href = '') {
		$this->icon = $icon;
		$this->href = $href;

		return $this;
	}

	public function renderHTML() {
		
		$this->html .= '<span href="'.$this->href.'" class="icon '.$this->icon.$this->getHTMLClass(true).'"'.$this->getHTMLID().'></span>';

		return $this->html;

	}
}