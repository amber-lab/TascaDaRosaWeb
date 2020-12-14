<?php
class AdoTranslation{
	private static $instance;
	private $lang;
	public $messages;

	public function __construct(){
		$this->messages['en'][] = 'Function';
		$this->messages['en'][] = 'Table';
		$this->messages['en'][] = 'Tool';

		$this->messages['pt'][] = 'Função';
		$this->messages['pt'][] = 'Tabela';
		$this->messages['pt'][] = 'Ferramenta';

		$this->messages['it'][] = 'Funzione';
		$this->messages['it'][] = 'Tabelle';
		$this->messages['it'][] = 'Strumenento';
	}

	public static function getInstance(){
		if(empty(self::$instance)){
			self::$instance = new AdoTranslation;
		}
		return self::$instance;
	}

	public static function setLanguage($lang){
		$instance = self::getInstance();
		$instance->lang = $lang;
	}

	public static function getLanguage(){
		$instance = self::getInstance();
		return $instance->lang;
	}

	public function translate($word){
		$instance = self::getInstance();
		$language = self::getLanguage();

		$key = array_search($word, $instance->messages['en']);

		return $instance->messages[$language][$key];
	}
}

function _t($word){
	return AdoTranslation::translate($word);
}

?>