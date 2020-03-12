<?php
libxml_use_internal_errors(true);
$html = file_get_contents("https://masakanterbarukuu.blogspot.com/2015/02/resep-cara-membuat-asinan-betawi-enak.html");

$classname = 'feedEntryContent';
$dom = new DOMDocument;
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$results = $xpath->query("//div[@class='" . $classname . "']");

if ($results->length > 0) {
    echo $review = $results->item(0)->nodeValue;
}
echo "<pre>",print_r($results),"</pre>";
?>