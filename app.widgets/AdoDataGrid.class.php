<?php
class AdoDataGrid extends AdoTable{

	private $columns;
	private $actions;
	private $rowcount;

	public function __construct(){
		parent::__construct();
		$this->class = 'adodatagrid_table';

		$style1 = new AdoStyle('adodatagrid_table');
		$style1->border_collapse = 'separate';
		$style1->font_family = 'arial,verdana,sans-serif';
		$style1->font_size = '10pt';
		$style1->border_spacing = '0pt';

		$style2 = new AdoStyle('adodatagrid_col');
		$style2->font_size = '10pt';
		$style2->font_weight = 'bold';
		$style2->border_left = '1px solid white';
		$style2->border_top = '1px solid white';
		$style2->border_right = '1px solid gray';
		$style2->border_bottom = '1px solid gray';
		$style2->padding_top = '1px';
		$style2->background_color = '#CCCCCC';

		$style3 = new AdoStyle('adodatagrid_col_over');
		$style3->font_size = '10pt';
		$style3->font_weight = 'bold';
		$style3->border_left = '1px solid white';
		$style3->border_top = '2px solid orange';
		$style3->border_right = '1px solid gray';
		$style3->border_bottom = '1px solid gray';
		$style3->padding_top = '0px';
		$style3->background_color = '#dcdcdc';

		$style1->show();
		$style2->show();
		$style3->show();
	}

	public function addColumn(AdoDataGridColumn $object){
		$this->columns[] = $object;
	}


	public function addAction(AdoDataGridAction $object){
		$this->actions[] = $object;
	}

	public function clear(){
		$copy = $this->children[0];
		$this->children = array();
		$this->children[] = $copy;
		$this->rowcount = 0;
	} 

	public function createModel(){
		$row = parent::addRow();
		if($this->actions){
			foreach ($this->actions as $actions) {
				$celula = $row->addCell('');
				$celula->class = 'adodatagrid_col';
			}
		}
		if ($this->columns){
			foreach ($this->columns as $column) {
				$name = $column->getName();
				$label = $column->getLabel();
				$align = $column->getAlign();
				$width = $column->getWidth();

				$celula = $row->addCell($label);
				$celula->class = 'adodatagrid_col';
				$celula->style = "text-align:$align;width:$width";
				if($column->getAction()){
					$url = $column->getAction();
					$celula->onmouseover = "this.className='adodatagrid_col_over';";
					$celula->onmouseout = "this.className='adodatagrid_col'";
					$celula->onclick = "document.location='{$url}'";
				}
			}
		}
	}

	public function addItem($object){
		$bgcolor = ($this->rowcount % 2) == 0 ? '#ffffff' : '#e0e0e0';

		$row = parent::addRow();
		$row->style = "background-color:{$bgcolor}";

		if($this->actions){
			foreach ($this->actions as $action) {
				$url = $action->serialize();
				$label = $action->getLabel();
				$image = $action->getImage();
				$field = $action->getField();
				$key = $object->$field;

				$link = new AdoElement('a');
				$link->href = "{$url}&key={$key}";

				if($image){
					$image = new AdoImage("../../app.images/$image");
					$image->style = "width:20px;height:20px;";
					$link->title = $label;
					$link->add($image);
				}
				else{
					$link->add($label);
				}
				$row->addCell($link);
			}
		}
		if($this->columns){
			foreach($this->columns as $column){
				$name = $column->getName();
				$align = $column->getAlign();
				$width = $column->getWidth();
				$function = $column->getTransformer();
				$data = $object->$name;
				if($function){
					$data = call_user_func($function, $data);
				}
				$celula = $row->addCell($data);
				$celula->style = "text-align:{$align};width:{$width};";
			}
		}
		$this->rowcount ++;
	}
}
?>