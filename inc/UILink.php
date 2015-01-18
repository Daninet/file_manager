<?php

namespace QCFileManager;

class UILink extends UIElement
{

	protected $href = '';
	protected $text = '';

	public function __construct($href, $text) {
		$this->href = $href;
		$this->text = $text;
		return $this;
	}

	public function renderHTML() {

		$this->html .= '<a href="'.$this->href.'"'.$this->getHTMLClass().$this->getHTMLID().'>'.$this->text.'</a>';

		return $this->html;
	}

}