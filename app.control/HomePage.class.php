<?php
class HomePage extends AdoPage{
	function __construct(){
		parent::__construct();
		$this->class = "container ";

		//home-panel
		$article = new AdoArticle;
		$article->class = 'home-panel';

		$list = new AdoList('ul');

		$list->add(1);
		$list->add(2);
		$list->add(3);

		$article->add($list);

		parent::add($article);

		//TASCA DA ROSA

		$article = new AdoArticle();
		$article->class = 'destaque';
		$section = new AdoSection();
		
		$obj = new AdoParagraph('Bem-vindo(a)<br>Tasca da Rosa', 'h2');
		$section->add($obj);

		$list = new AdoList('ul');
		$list->add('Entregas disponíveis toda a semana');
		$list->add('Serviços de Catering no seu espaço');
		$list->add('Consulte-nos a partir dos contatos');

		$section->add($list);

		$article->add($section);
		parent::add($article);

		$days = array(1 => 'Domingo' , 2 => 'Segunda-feira', 3 => 'Terça-feira', 4 => 'Quarta-feira', 5 => 'Quinta-feira', 6 => 'Sexta-feira', 7 => 'Sábado');
		$daywn = date('w') + 1;
		$dayw = $days[$daywn];

		AdoTransaction::open('my_livro');
		AdoTransaction::setLogger(new AdoLoggerHTML('app.logs/diarios.html'));
		$criterion = new AdoCriterion;
		$criterion->add(new AdoFilter('dia', '=', $daywn));
		$rep = new AdoRepository('Diarios');
		$data = $rep->load($criterion);
		AdoTransaction::close();

		$list = array();
		foreach ($data as $key) {
			$list[$key->tipo] = $key->nome;
		}

		$order = ['sopa', 'carne', 'peixe', 'sobremesa'];

		$article = new AdoArticle;
		$article->class = 'diarios';

		$section = new AdoSection;
		$section->class = 'prato-dia';
		$obj = new AdoParagraph("Ementa de {$dayw}", 'h2');
		$section->add($obj);
		$article->add($section);

		$img = "app.img/produtos/p{$daywn}#.jpg";

		foreach ($order as $key) {
			$section = new AdoSection;
			$section->add(new AdoParagraph(ucfirst($key), 'h3'));
			$href = str_replace('#', $key, $img);
			$section->add(new AdoFigure($href, $list[$key]));
			$article->add($section);
		}

		parent::add($article);
	}
}
?>