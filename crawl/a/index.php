<?php
if (isset($_POST['query'])) {
	require('Bing.php');
	$url = file(dirname(__FILE__) . '\url.txt',FILE_IGNORE_NEW_LINES);
	for ($i=0; $i < count($url); $i++) { 
		$bing = new Bing($url[$i]);	
		//echo "<pre>",print_r($bing->data), "</pre>";
		$obj = $bing->data;
			echo "
	<table>
		<tr>
			<th>
				No.
			</th>
			<th>
				Url.
			</th>	
		</tr>";

				for ($i=0; $i < count($obj) ; $i++) { 
					echo "<tr>";
						echo "<td>".($i+1)."</td>";
						echo "<td>".$obj[$i]['link']."</td>";
					echo "</tr>";
				}
			
		echo "</table>";
	}
}else{
		echo '<form action="index.php" method="POST">
				<input type="text" name="query" value="1">
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