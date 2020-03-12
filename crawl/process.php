<?php 
set_time_limit (10);
include 'crawlcontent.php';
$filenameURL =  $_POST['filenameurl'];
$filenameSQL =  $_POST['filenamesql'];

$countline = getCountFile($filenameURL);

$array = getLineToArray($filenameURL);
$array = array_map('trim',$array);

for ($i=0; $i < $countline; $i++) { 
    echo getTitle($array[$i]). "\n";
	echo getTitle($array[$i]). "\n";
	echo checkURL($array[$i]). "\n";
	echo "url is ".$array[$i]. "\n";

	if(checkURL($array[$i])==1)
	{
		getArticle($array[$i],$filenameSQL);
		if ($i == $countline ){
			echo "Proses Selesai";
		}
	}elseif (checkURL($array[$i])==0) {
		
	}

}

?>