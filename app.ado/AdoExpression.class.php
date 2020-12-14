<?php
/*
*classe FWSqlExpression
*clasee abstrata para gerenciar expressões
*/
abstract class AdoExpression{
	const AND_OPERATOR = 'AND ';
	const OR_OPERATOR = 'OR ';
	
	abstract public function dump();
}
?>