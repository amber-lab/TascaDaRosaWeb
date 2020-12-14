<?php

class AdoMessage{
	#type = erro OR info OR sucess
	public function __construct($type, $message){

		$mainpanel = new AdoElement('div');
		$mainpanel->class = 'statscontainer';
		$mainpanel->id = 'statscontainer';

		$panel = new AdoElement('div');
		$panel->class = 'stats';
		$panel->id = 'stats';

		$button = new AdoElement('input');
		$button->type = 'button';
		$button->value = 'Fechar';
		$button->onclick = "document.getElementById('statscontainer').style.display='none'";

		$img = new AdoImage("../../app.img/{$type}.png");
		$img->style = 'width:50px;height:50px;';

		$panel->add($img);
		$panel->add(new AdoParagraph($message));
		$panel->add($button);

		$mainpanel->add($panel);

		$mainpanel->show();
	}
}
?>