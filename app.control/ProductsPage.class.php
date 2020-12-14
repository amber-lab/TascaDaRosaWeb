<?php

class ProductsPage extends AdoPage{
	function __construct(){
		parent::__construct();
		$this->class = 'container';

		/* PRODUTOS */
		$article = new AdoArticle;
		$article->class = 'productsarticle';

		$section = new AdoSection;
		$section->add(new AdoParagraph("Nossos Produtos", 'h2'));
		$article->add($section);

		foreach (array('carne', 'peixe', 'sopa', 'sobremesa', 'entrada') as $value) {
			$section = new AdoSection;
			$section->class = 'products';

			$ucvalue = ucfirst($value);
			if(in_array($value, array('sopa', 'sobremesa', 'entrada'))){
				$fvalue = $ucvalue.'s';
				$objheader = new AdoParagraph($fvalue, 'h3');
			}
			else{
				$objheader = new AdoParagraph("Prato {$ucvalue}", 'h3');
			}
			$section->add($objheader);

			$obj = new AdoPanel;
			$obj->class = "{$value} triangle downtriangle";
			$section->add($obj);

			AdoTransaction::open('ite_livro');
			$criterion = new AdoCriterion;
			$criterion->add(new AdoFilter('type', '=', $value));
			$rep = new AdoRepository('Products');
			$data = $rep->load($criterion);
			AdoTransaction::close();

			$obj = new AdoList('ul');
			$obj->class = "{$value} hide";
			$listheader = clone($objheader);
			$listheader->class = 'productstitle';
			$obj->add($listheader);
			foreach($data as $key => $value){
				$obj->add($value->toArray()['NAME']);
			}

			$section->add($obj);
			$article->add($section);
		}

		parent::add($article);

		$article = new AdoArticle;
		$article->class = 'weeklycontainer';

		/* EMENTA SEMANAL */

		$section = new AdoSection;
		$section->add(new AdoParagraph("Ementa semanal", 'h2'));
		parent::add($section);

		AdoTransaction::open('my_livro');
		AdoTransaction::setLogger(new AdoLoggerHTML('app.logs/products.html'));

		$days = array(1 => 'Domingo' , 2 => 'Segunda-feira', 3 => 'Terça-feira', 4 => 'Quarta-feira', 5 => 'Quinta-feira', 6 => 'Sexta-feira', 7 => 'Sábado');

		foreach (range(1, 7) as $day){
			$criterion = new AdoCriterion;
			$criterion->add(new AdoFilter('dia', '=', $day));
			$rep = new AdoRepository('Diarios');
			$data = $rep->load($criterion);

			$section = new AdoSection;
			$section->class = 'weeklyproducts';

			$obj = new AdoParagraph($days[$day], 'h3');
			$obj->class = 'weekday';
			$section->add($obj);

			$list = array();
			foreach($data as $obj) {
				$value = $obj->toArray();
				$list[$value['tipo']] = $value['nome'];
			}

			foreach (array('carne', 'peixe', 'sopa', 'sobremesa') as $key) {
				$section->add(new AdoParagraph(ucfirst($key), 'h3'));
				$section->add(new AdoParagraph($list[$key]));
			}
			$article->add($section);
		}
		AdoTransaction::close();

		parent::add($article);
	}
}


?>