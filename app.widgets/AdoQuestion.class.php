<?php
class AdoQuestion{
	function __construct($message, AdoAction $action_yes, AdoAction $action_no){

		$url_yes = $action_yes->serialize();
		$url_no = $action_no->serialize();

		$style->show();

		$painel = new AdoElement('div');
		$painel->class = 'adoquestion';

		$button1 = new AdoElement('input');
		$button1->type = 'button';
		$button1->value = 'Sim';
		$button1->onclick = "javascript:location='$url_yes'";

		$button2 = new AdoElement('input');
		$button2->type = 'button';
		$button2->value = 'Não';
		$button2->onclick = "javascript:location='$url_no'";

		$table = new AdoTable;
		$table->align = 'center';
		$table->style = 'border-spacing:10px';

		$row = $table->addRow();
		
		$img = new AdoImage('../../app.images/question.png');
		$img->style = 'width:50px;height:60px;';

		$row->addCell($img);
		$row->addCell($message);

		$row = $table->addRow();
		$row->addCell($button1);
		$row->addCell($button2);

		$painel->add($table);
		$painel->show();
	}
}
?>