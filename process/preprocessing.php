<?php 

	namespace Sastrawi\Tokenizer;

	require __DIR__. '/inc/Sastrawi/Tokenizer/DefaultTokenizer.php';
	require __DIR__. '/inc/Sastrawi/Tokenizer/TokenizerFactory.php';

	function casefolding($strings){
		return $str =  mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	}

	function tokenizing($strings){

		$tokenizerFactory  = new TokenizerFactory();
		$tokenizer = $tokenizerFactory->createDefaultTokenizer();

		$tokens = $tokenizer->tokenize($strings);

		var_dump($tokens);

	}

	tokenizing("ini testing he");

