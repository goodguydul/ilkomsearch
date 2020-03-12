<?php 
	include "inc/conn.php";  
	if (isset($_GET['q'])) {
		$q			= $_GET['q']; //get the nama value from form
		$getsinonim	= mysqli_query($conn,"SELECT sinonim FROM db_sinonim WHERE kata ='".$q."'");
		
		if($getsinonim->num_rows != 0)
		{
			while( $row = mysqli_fetch_assoc($getsinonim)){
		    	$array= $row['sinonim'];
			}

			$sinonim 	= "Sinonim dari '".$q."' adalah : ".$array;	
		}else{
			goto fail;
		}	
	}else{
		fail:
		$sinonim 	= "";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Coba-coba Query Expansion</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
</head>
<body>
	<form action="query.php">
		<input type="text" name="q">
		<button type="submit">Cari Sinonim</button>
	</form>
	<br>
	<p><?php echo $sinonim?></p>
</body>
</html>

