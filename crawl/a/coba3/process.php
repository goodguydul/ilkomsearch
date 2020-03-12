<?php
include 'dom.php';
ini_set('memory_limit', '256M');
$urls	= file("linkbaru.txt",FILE_IGNORE_NEW_LINES);

for ($i=0; $i < 2; $i++) { 

	if (checkURL($urls[$i])) {
		getArticle($urls[$i],"sqls.txt",$i);
	}
	else{
		echo "Url cannot be found! 404\n\n\n\n";
		file_put_contents("urlblm.txt", $urls[$i], FILE_APPEND);
	}

}
echo "================== Process Done ! ====================";

	
function getArticle($url,$filename,$i){

	$html = new simple_html_dom();
	$html->load_file($url);

	echo ($i+1)."===== Processing url : ".$url."\n\n\n\n";

	$dom = str_get_html($html);
	$select = NULL;

	if (strpos($url, "blogspot")!== false || strpos($url, "100resepmasakan")!== false || strpos($url, "anekaresepmasakan")!== false || strpos($url, "belajar-masak")!== false) {
		foreach($dom->find('div[class=entry-content]') as $element) {
		    $select = $element;
		}
	}else if (strpos($url, "cara-memasak")!== false || strpos($url, "dapurmemasak")!== false || strpos($url, "hobimemasak")!== false || strpos($url, "resepmasakanku")!== false) {
		foreach($dom->find('div[class=entry]') as $element) {
		    $select = $element;
		}
	}else if (strpos($url, "dapurhalal")!== false) {
		foreach($dom->find('div[class=main-detail]') as $element) {
		    $select = $element;
		}
	}else if (strpos($url, "hobimasak")!== false) {
		foreach($dom->find('div[class=post-single]') as $element) {
		    $select = $element;
		}
	}else if (strpos($url, "resep.web.id")!== false) {
		foreach($dom->find('div[class=PostContent]') as $element) {
		    $select = $element;
		}
	}else if (strpos($url, "resepmasakanindonesia")!== false) {
		foreach($dom->find('div[class=single_post]') as $element) {
		    $select = $element;
		}
	}else{
		 $select = $description;
	}


	$select = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $select);	
	$select = str_replace("\n", " ", $select);
	$select = str_replace("&nbsp;", "", $select);
	$select = preg_replace('#<[^>]+>#', ' ', $select);

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
	curl_close($ch);

	if ( $httpCode != 404 ){
	    return TRUE;
	} else {
	    return FALSE;
	}

	
}
?>
