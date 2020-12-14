<?php

class AdoWindow{
	private $x;
	private $y;
	private $width;
	private $height;
	private $title;
	private $content;
	static private $counter;

	public function __construct($title){
		self::$counter++;
		$this->title = $title;
	}

	public function setPosition($x, $y){
		$this->x = $x;
		$this->y = $y;
	}

	public function setSize($width, $height){
		$this->width = $width;
		$this->height = $height;
	}

	public function add($content){
		$this->content = $content;
	}

	public function show(){
		$window_id = 'adowindow' . self::$counter;
		$style = new AdoStyle($window_id);
		$style->position = 'absolute';
		$style->left = $this->x;
		$style->top = $this->y;
		$style->width = $this->width;
		$style->height = $this->height;
		$style->background = '#e0e0e0';
		$style->border = '1px solid #000000';
		$style->z_index = '10000';

		$style->show();

		$painel = new AdoElement('div');
		$painel->id = $window_id;
		$painel->class = $window_id;

		$table = new AdoTable;

		$table->style = "width:100%;height:100%;border-collapse:collapse";

		$row1 = $table->addRow();
		$row1->style = 'background-color:#707070;height:20px;';

		$width = $this->width - 20;

		$titulo = $row1->addCell("<p style=font-family:Arial;size=2px;color=white;width={$width}><b>{$this->title}</b></p>");
		$link = new AdoElement('a');

		$img = new AdoImage("../../app.images/close.png");
		$img->style = 'width:20px;height:20px;padding:5px;float:right';

		$link->add($img);
		$link->onclick = "document.getElementById('{$window_id}').style.display='none'";

		$cell = $row1->addCell($link);

		$row2 = $table->addRow();
		$row2->style = 'vertical-align:top';

		$cell = $row2->addCell($this->content);
		$cell->colspan = 2;

		$painel->add($table);
		$painel->show();
	}
}
?>