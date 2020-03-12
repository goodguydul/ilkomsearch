<?php

$anu = file("anu.txt", FILE_IGNORE_NEW_LINES);
for ($k=1; $k < count($anu); $k++) { 

	$jsondecoded = json_decode(file_get_contents(dirname(__FILE__) . '\Cache\1 ('.$k.').json'));
	for ($i=0; $i < count($jsondecoded) ; $i++) { 
		$link[$i] = $jsondecoded[$i]->link;
	}
	file_put_contents("urls.txt", implode(PHP_EOL, $link),FILE_APPEND);

}

?>