<?php

class EventFormPage extends AdoPage{
	private $form;

	function __construct(){
		parent::__construct();
		$this->class = 'container';

		//FORM ARTICLE
		$article = new AdoArticle;

		$obj = new AdoParagraph('Criar Evento', 'h2');
		$article->add($obj);

		$this->form = new AdoForm('tascaform');
		$this->form->setClass('tascaform');
		$this->form->setAction(new AdoAction(array($this, 'OnSubmit')));
		$this->form->setOnSubmit('formValidation');

		//WIDGETS INFORMAÇÕES PESSOAIS
		$name = new AdoEntry('name');
		$name->setPlaceholder('Nome Completo');
		$locality = new AdoEntry('locality');
		$locality->setPlaceholder('Localidade');
		$email = new AdoMail('email');
		$email->setPlaceholder('exemplo@exm.com');
		$phone = new AdoTel('phone');
		$phone->setPlaceholder('Número Português');
		
		//WIDGETS INFORMAÇÕES EVENTO
		$type = new AdoCombo('type');
		$number = new AdoEntryNumber('number', 25, 500);
		$number->setPlaceholder('25-500');
		$date = new AdoDate('date');

		//WIDGETS INFORMAÇÕES MENU
		//ITEMS CARREGADOS DA BD DE CATERINGWARE
		//array_produtos(array_pratos(), array_sopas(), array_desserts(), array_appetizers(), array_bar())
		$soup = new AdoCombo('soup');
		$mainplate = new AdoCombo('mainplate');
		$secondplate = new AdoCombo('secondplate');
		$appetizers = new AdoCheckGroup('appetizers');
		$desserts = new AdoCheckGroup('desserts');
		$bar = new AdoCheckGroup('bar');

		//INFORMAÇÃO PESSOAL
		$section = new AdoSection();
		$section->add(new AdoLabel('Nome', 'name'));
		$section->add($name);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Localidade', 'locality'));
		$section->add($locality);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Email', 'email'));
		$section->add($email);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Número Telefone', 'phone'));
		$section->add($phone);
		$article->add($section);

		//INFORMAÇÃO DE EVENTO
		$section = new AdoSection();
		$section->add(new AdoLabel('Tipo de Evento', 'type'));
		$type->addItems(array('Casamento', 'Batizado', 'Aniversário', 'Takeaway', 'Evento Alternativo'));
		$section->add($type);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Número de Pessoas', 'number'));
		$section->add($number);
		$article->add($section);

		$section = new AdoSection();
		$section->add(new AdoLabel('Data', 'date'));
		$section->add($date);
		$article->add($section);

		//INFORMAÇÃO DE MENU

		//SOPA
		$section = new AdoSection();
		$section->add(new AdoLabel('Sopa', 'soup'));
		$items = array();
		AdoTransaction::open('ite_livro');
		$criterion = new AdoCriterion();
		$criterion->add(new AdoFilter('type', '=', 'sopa'));
		$rep = new AdoRepository('Products');
		$data = $rep->load($criterion);
		foreach ($data as $value) {
			$value_arr = $value->toArray();
			array_push($items, $value_arr['NAME']);
		}
		AdoTransaction::close();
		$soup->addItems($items);
		$section->add($soup);
		$article->add($section);

		//PRATO PRINCIPAL
		$section = new AdoSection();
		$section->add(new AdoLabel('Prato Principal', 'mainplate'));
		$items = array();
		AdoTransaction::open('ite_livro');
		$criterion = new AdoCriterion();
		$criterion->add(new AdoFilter('type', '=', 'carne'));
		$criterion->add(new AdoFilter('type', '=', 'peixe'), $criterion::OR_OPERATOR);
		$rep = new AdoRepository('Products');
		$data = $rep->load($criterion);
		foreach ($data as $value) {
			$value_arr = $value->toArray();
			array_push($items, $value_arr['NAME']);
		}
		AdoTransaction::close();
		$mainplate->addItems($items);
		$section->add($mainplate);
		$article->add($section);

		//PRATO SECUNDARIO
		$section = new AdoSection();
		$section->add(new AdoLabel('Prato Secundário', 'secondplate'));
		$secondplate->addItems($items);
		$section->add($secondplate);
		$article->add($section);

		//entradas
		$section = new AdoSection();
		$section->class = 'comboboxheader';
		$section->add(new Adolabel('Entradas'));
		$article->add($section);
		$section = new AdoSection();
		$section->class = 'comboboxsection';
		$items = array();
		$itemsvalues = array();
		AdoTransaction::open('ite_livro');
		$criterion = new AdoCriterion();
		$criterion->add(new AdoFilter('type', '=', 'entrada'));
		$rep = new AdoRepository('Products');
		$data = $rep->load($criterion);
		foreach ($data as $value) {
			$value_arr = $value->toArray();
			array_push($items, $value_arr['NAME']);
			array_push($itemsvalues, $value_arr['ID']);
		}
		AdoTransaction::close();
		$appetizers->addItems($items);
		$appetizers->addItemsValues($itemsvalues);
		$section->add($appetizers);
		$article->add($section);

		//sobremesas
		$section = new AdoSection();
		$section->class = 'comboboxheader';
		$section->add(new Adolabel('Sobremesas'));
		$article->add($section);
		$section = new AdoSection();
		$section->class = 'comboboxsection';
		$items = array();
		$itemsvalues = array();
		AdoTransaction::open('ite_livro');
		$criterion = new AdoCriterion();
		$criterion->add(new AdoFilter('type', '=', 'sobremesa'));
		$rep = new AdoRepository('Products');
		$data = $rep->load($criterion);
		foreach ($data as $value) {
			$value_arr = $value->toArray();
			array_push($items, $value_arr['NAME']);
			array_push($itemsvalues, $value_arr['ID']);
		}
		AdoTransaction::close();
		$desserts->addItems($items);
		$desserts->addItemsValues($itemsvalues);
		$section->add($desserts);
		$article->add($section);

		$section = new AdoSection();
		$section->class = 'comboboxheader';
		$section->add(new Adolabel('Bar'));
		$article->add($section);
		$section = new AdoSection();
		$section->class = 'comboboxsection';
		$items = array();
		$itemsvalues = array();
		AdoTransaction::open('ite_livro');
		$criterion = new AdoCriterion();
		$criterion->add(new AdoFilter('type', '=', 'bebida'));
		$rep = new AdoRepository('Products');
		$data = $rep->load($criterion);
		foreach ($data as $value){
			$value_arr = $value->toArray();
			array_push($items, $value_arr['NAME']);
			array_push($itemsvalues, $value_arr['ID']);
		}
		AdoTransaction::close();
		$bar->addItems($items);
		$bar->addItemsValues($itemsvalues);
		$section->add($bar);
		$article->add($section);

		$section = new AdoSection();
		$button = new AdoSubmit('submitb');
		$button->setLabel('Enviar');
		$button->setProperty('disabled', '1');
		$article->add($button);

		$this->form->setFields($name, $locality, $email, $phone, $type, $number, $date, $soup, $mainplate, $secondplate, $appetizers, $desserts, $bar, $button);

		$this->form->add($article);
		parent::add($this->form);
	}
	function onSubmit(){
		if(count($_POST) >= 8){
			$data = $_POST;
			unset($data['submitb']);
			$data['accepted'] = 0;
			$data['extras'] = 0;

			AdoTransaction::open('ite_livro');
			AdoTransaction::setLogger(new AdoLoggerHTML('app.logs/newservices.html'));

			$obj = new NewServiceRecord;
			$obj->fromArray($data);
			$obj->store();

			AdoTransaction::close();
			new AdoMessage('info', 'Evento criado com sucesso<br>Por favor aguarde um contacto');
		}
		else{
			new AdoMessage('info', 'Falta de dados para criar evento');
		}
	}
}
?>