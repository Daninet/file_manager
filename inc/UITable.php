<?php

namespace QCFileManager;

class UITable extends UIElement
{
	private $columns = array();
	private $rows = array();

	public function __construct($columns, $class = '', $id = '') {
		$this->columns = $columns;
		$this->css_class = $class;
		$this->id = $id;

		return $this;
    }

	public function addColumn($column) {
		$this->columns[] = $column;

		return $this;
	}

	public function addRow($row) {
		$this->rows[] = $row;

		return $this;
	}

	public function renderHead() {
		$this->html .= '<thead><tr>';
		foreach($this->columns as $column) {
			$this->html .= '<th>'.$column.'</th>';
		}
		$this->html .= '</tr></thead>';
	}

	public function renderBody() {
		$this->html .= '<tbody>';
		foreach($this->rows as $row) {

			$this->html .= '<tr>';

			foreach($row as $column) {
				$this->html .= '<td>'.$column.'</td>';
			}

			$this->html .= '</tr>';

		}
		$this->html .= '</tbody>';
	}

	public function renderHTML() {
		//if($this->css_class) !=
		$this->html .= '<table'.$this->getHTMLID().$this->getHTMLClass().'>';
			$this->renderHead();
			$this->renderBody();
		$this->html .= '</table>';

		return $this->html;
	}

}