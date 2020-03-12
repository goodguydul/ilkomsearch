<?php
	include 'lib/dom/simple_html_dom.php';
function getArticle($url,$filename){


	$html = new simple_html_dom();
	$html->load_file($url);

	$dom = str_get_html($html);
	$select = NULL;
	foreach($dom->find('div[class=entry]') as $element) {
	        $select = $element;          
	}
	$select = str_replace("(adsbygoogle = window.adsbygoogle || []).push({});", "", $select);	
	$select = str_replace("	", "", $select);
	$select = str_replace('                   ',"\n",$select);
	$select = strip_tags($select);

	$keywords 	= getKeywords($url);
	
	$description = getDescription($url);
	
	$titles		= getTitle($url);

	$ip = "INSERT INTO `search`(`title`, `url`, `description`, `keywords`, `content`, `kind`) VALUES ('".$titles."','".$url."','".$description."','".$keywords."','".$select."','')".PHP_EOL;
	file_put_contents($filename, $ip, FILE_APPEND);
}
function getCountFile($file){
	$linecount = 0;
	$handle = fopen($file, "r");
	while(!feof($handle)){
	  $line = fgets($handle);
	  $linecount++;
	}
	fclose($handle);
	return $linecount;
}
function getLineToArray($filename){
	$lines=array();
	$fp=fopen($filename, 'r');
	if ($fp) {
   		$array = explode("\n", fread($fp, filesize($filename)));
	}
	return $array;
}
function getDescription($url){

	$tags = get_meta_tags($url);
	if(isset($tags['description'])){
		return $tags['description'];
	}else{
		return " ";
	}
}
function getKeywords($url){

	$tags = get_meta_tags($url);
	if(isset($tags['keywords'])){
		return $tags['keywords'];
	}else{
		return " ";
	}
}
function getTitle($url){
	$html = file_get_html($url);
	$title = $html->find('title', 0)->innertext;	
	if (isset($title)){
		return $title;
	}else {
		return $title=" ";
	}
}
function checkURL($url){

	$html_brand = $url;
	$ch = curl_init();

	$options = array(
	    CURLOPT_URL            => $html_brand,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_HEADER         => true,
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_ENCODING       => "",
	    CURLOPT_AUTOREFERER    => true,
	    CURLOPT_CONNECTTIMEOUT => 120,
	    CURLOPT_TIMEOUT        => 120,
	    CURLOPT_MAXREDIRS      => 10,
	);
	curl_setopt_array( $ch, $options );
	$response = curl_exec($ch); 
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ( $httpCode != 200 ){
	    return 0;
	} else {
	    return 1;
	}

	curl_close($ch);
}
?>
