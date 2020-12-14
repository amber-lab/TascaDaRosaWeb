<?php
class AboutPage extends AdoPage{
	function __construct(){
		parent::__construct();
		$this->class = "container";

		//TASCA DA ROSA

		$article = new AdoArticle;
		$section = new AdoSection;
		$section->class='med-panel';

		$obj = new AdoParagraph('Nossa História', 'h2');
		$section->add($obj);

		$obj = new AdoParagraph('A Tasca da Rosa, nascida em 1989, é uma pequena casa de refeições situada na cidade de Valpaços que desde o seu primeiro dia de abertura conquista todos aqueles que se atrevem a provar os seus produtos. Nesta casa, a tradição da gastronomia é mantida usando produtos frescos e nacionais com ajuda das melhores cozinheiras da localidade, que vêm passando receitas de geração em geração.');
		$section->add($obj);
		$article->add($section);

		$aside = new AdoAside;
		$obj = new AdoFigure('app.img/tasca-1.jpg');
		$aside->add($obj);
		$article->add($aside);

		parent::add($article);

		//CATERING

		$article = new AdoArticle;

		$section = new AdoSection;
		$section->class = 'med-panel';

		$obj = new AdoParagraph('Catering', 'h2');
		$section->add($obj);

		$obj = new AdoParagraph('O serviço de Catering da Tasca da Rosa foi iniciado no ano de 2000, depois de um casal de amigos da Sra. Rosa insistir em ser a Tasca da Rosa a tratar do casamento dentro da sua adega, este foi um sucesso até aos dias de hoje e fez com que nos expandíssemos por todo o conselho, podendo hoje, atingir todo o Distrito de Vila Real com um suporte até 500 pessoas.');
		$section->add($obj);

		$article->add($section);

		$aside = new AdoAside;

		$obj = new AdoFigure('app.img/casamento.jpg');
		$aside->add($obj);
		$article->add($aside);

		parent::add($article);

		//TAKEAWAY
		$article = new AdoArticle;

		$section = new AdoSection;
		$section->class = 'med-panel';

		$obj = new AdoParagraph('Takeaway', 'h2');
		$section->add($obj);

		$obj = new AdoParagraph('O serviço de Takeaway da Tasca da Rosa começou desde a abertura do espaço, com uma ementa de 3 pratos diarios com o objetivo de atingir todos os gostos. É possivel encomendar um prato fora da lista de diarios entre 30 a 100 doses. Será entregue no local desejado de forma gratuita num raio até uma distância de 10km.');
		$section->add($obj);
		$article->add($section);

		$aside = new AdoAside;
		$obj = new AdoFigure('app.img/takeaway.jpg');
		$aside->add($obj);
		$article->add($aside);
		parent::add($article);

	}
}
?>