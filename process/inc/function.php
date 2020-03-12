<?php 
include('inc/dom.php');

function file_get_contents_curl($url)
{
    $ch1 = curl_init();

    curl_setopt($ch1, CURLOPT_HEADER, 0);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch1, CURLOPT_URL, $url);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch1, CURLOPT_CAINFO, 'inc/ssl/cacert.pem');
    $data = curl_exec($ch1);
    curl_close($ch1);

    return $data;
}

function checkheader($url){
	$ch2 = curl_init($url);
	curl_setopt($ch2, CURLOPT_HEADER, true);    // we want headers
	curl_setopt($ch2, CURLOPT_NOBODY, true);    // we don't need body
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch2, CURLOPT_TIMEOUT,10);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch2, CURLOPT_CAINFO, 'inc/ssl/cacert.pem');
	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
	$output = curl_exec($ch2);
	$httpcode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
	curl_close($ch2);
	return $httpcode;
}

function checkurl($url){ //check url if redirect is true
	$ret ="";
	$ch2 = curl_init($url);
	curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch2, CURLOPT_HEADER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch2, CURLOPT_CAINFO, 'inc/ssl/cacert.pem');
	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:21.0) Gecko/20100101 Firefox/21.0"); // Necessary. The server checks for a valid User-Agent.
	$response = curl_exec($ch2);
	preg_match_all('/^Location:(.*)$/mi', $response, $matches);
	curl_close($ch2);
	$status = checkheader($url);
	if($status == 301 || $status ==  302){
		$ret	= $matches[1];	
	}else {
		$ret	= $url;
	}
	return $ret;
}

function getinfo($url){
	
    $html 		= file_get_contents_curl($url);
    $keywords 	= "";
    $description= "";
    $title 		= "";
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');
    if(strlen($html)>0){
    	$title = $nodes->item(0)->nodeValue;
	}
    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++)
    {
        $meta = $metas->item($i);
        if($meta->getAttribute('name') == 'description'){
            $description = $meta->getAttribute('content');
        }
        if($meta->getAttribute('name') == 'keywords'){
            $keywords = $meta->getAttribute('content');
        }
    }
    $values = array($url,$title,$description,$keywords);
    return $values;
}


?>