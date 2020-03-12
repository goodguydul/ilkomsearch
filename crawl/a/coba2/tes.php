<?php
include 'website_parser.php';

$urls   = file("urlzz.txt",FILE_IGNORE_NEW_LINES);
  
    for ($i=0; $i < count($urls) ; $i++) { 
        $links = array();
        $target_url = $urls[$i];
        echo "\n\n::::::::::::::::Crawling URL = ".$target_url."\n\n";
        echo "::::::::::::::::\n\n";
        $link_type = 'internal';

        $parser = new WebsiteParser($target_url, $link_type);

        $links = $parser->getHrefLinks(true);
        for ($k=0; $k < count($links) ; $k++) { 
            file_put_contents("urlz.txt", $links[$k][0]."\n",FILE_APPEND);
            echo "--------------".$links[$k][0]."\n";
        }
        sleep(2);
    }echo "\n\n===================Crawling is done!==================";