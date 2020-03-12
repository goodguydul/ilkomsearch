<?php
include 'website_parser.php';

$urls   = file("la.txt",FILE_IGNORE_NEW_LINES);
  
    for ($i=0; $i < count($urls) ; $i++) { 
        $links = array();
        $target_url = $urls[$i];
        echo "\n\n".$i."-::::::::::::::::Crawling URL = ".$target_url."\n\n";
        echo "::::::::::::::::\n\n";
        $link_type = 'internal';

        $parser = new WebsiteParser($target_url, $link_type);

        $meta_tags = $parser->getMetaTags(true);

        for ($k=0; $k < count($meta_tags) ; $k++) { 
           $varr[$k] = $meta_tags[$k][0];
           $vall[$k] = $meta_tags[$k][1];
        }
        if (count($meta_tags)!=0) {
            $var = implode("`,`", $varr);
            $val = implode("','", $vall);
        }else{
            $var = "";
            $val = "";
        }
        
        $sql = "INSERT INTO index (`url`,`".$var."`) VALUES ('".$target_url."','".$val."')";

        file_put_contents("sql.txt", $sql."\n",FILE_APPEND);
        sleep(2);
    }echo "\n\n===================Crawling is done!==================";
?>
?>