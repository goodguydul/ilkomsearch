<?php
$url = file("url.txt",FILE_IGNORE_NEW_LINES);
if (isset($_POST['u'])) {
	for ($i=0; $i < count($url); $i++) { 
		$homepage = file_get_contents($url[$i]);
	    $rss = new SimpleXMLElement($homepage);

	    foreach($rss->channel->item as $opt){
	        //print_r($opt); // for debugging

	        $title = $opt->title;
	        $link = $opt->link;
	        $description = $opt->description;

	        //echo 'title: ' .$title. ' - description: ' .$description. ' - link: ' .$link.'<br/><br/><br/>';
	        file_put_contents("urls.txt", $link."\n" ,FILE_APPEND);
	    }
	}
}else{
		echo '<form action="index.php" method="POST">
				<input type="text" name="u" value="1">
				<button type="Submit">Submit</button>
			</form>';
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Crawl Memasak</title>
	<style type="text/css">
		table {
		    border-collapse: collapse;
		}
		table, th, td {
		    border: 1px solid black;
		}
	</style>
</head>
<body>

<?php
	
?>

</body>
</html>