<?php 
function casefolding($str){
	$str = preg_replace("/[^A-Za-z0-9 ]/", '', $str);
	$str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	return $str;
}
function tokenizing($str){
	$token = strtok($str, " ");
	$i=0;
	$array = array();
	while ($token !== false)
	{
		$array[$i] =  $token; 
		$i = $i+1;
		$token = strtok(" ");
	}
}
function pos_tagging($str){

}
function stemming ($str){
	
}
?>