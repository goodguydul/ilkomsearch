<?php
	include "inc/conn.php";  
	$qq= $_GET['q']; //get the nama value from form
	$q = "SELECT * from search where description like '%$qq%' "; //query to get the search result
	$result = mysqli_query($conn,$q); //execute the query $q
	
	while( $row = mysqli_fetch_assoc($result)){
    	$array[] = $row;
	}

	print_r($array);
	file_put_contents('searchresult.txt', print_r($array, TRUE));
	$aw	= $result->num_rows;
	$aw = intval($aw);
		if ($aw >= 1){
			echo "<i style=\"font-size:12px;margin: 20px 0 0 195px;\">We found " . $aw ." Records on our database about \"".$qq."\"</i><i id=\"loadtime\" style=\"font-size:12px\"></i><br>";
			echo '<div class="srg" style="margin: 20px 0 0 195px;">';
			echo "<ul id=\"itemContainer\"> ";
		while ($data = mysqli_fetch_array($result)) {  //fetch the result from query into an array
			$search = array(1 	=> ucfirst($qq),
							2	=> ucwords($qq),
							3	=> strtoupper($qq),
							4	=> strtolower($qq)
				);
			$dbContent = str_replace( $search['1'] , '<b>'.$search['1'].'</b>' , $data['description'] );
			$dbContent = str_replace( $search['2'] , '<b>'.$search['2'].'</b>' , $dbContent );
			$dbContent = str_replace( $search['3'] , '<b>'.$search['3'].'</b>' , $dbContent );
			$dbContent = str_replace( $search['4'] , '<b>'.$search['4'].'</b>' , $dbContent );

			$dataurl = str_replace( $search['1'] , '<b>'.$search['1'].'</b>' , $data['url'] );
			$dataurl = str_replace( $search['2'] , '<b>'.$search['2'].'</b>' , $dataurl );
			$dataurl = str_replace( $search['3'] , '<b>'.$search['3'].'</b>' , $dataurl );
			$dataurl = str_replace( $search['4'] , '<b>'.$search['4'].'</b>' , $dataurl );
				echo '
				<li class="g" style="list-style-type: none;margin-bottom: 15px">
				    <div class="rc">
				        <h3 class="r" >
				          <a href="'.$data['url'].'" style="font-size: 23px;width: 10em; height: 1.2em; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">'.$data['title'].' </a>
				        </h3>
					    <div class="s">
						    <div style="padding-bottom: 10px;">
						        <cite class="_Rm" style="font-size: 12px;" >'.$dataurl.'</cite>
						    </div>
							<span class="st" >
							        <p style="font-size: 13px;width: 100em;word-wrap: break-word;height: 2em; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;width:600px;">'.$dbContent.'</p>
							</span>
						</div>
					</div>
				</li><!--n-->
				<br>
			';
		}
		echo "<center><p><i>----End of search result list----</i></p></center>";
		echo "</ul>";
			echo "<div>";
				echo "<div class=\"holder\" style=\"float:left;\"></div>";
				echo "
				<form style=\"float:right;font-size:12px\">
		        	<label >items per page: </label>
		        	<select >
		          		<option  selected=\"selected\">5</option>
		          		<option>10</option>
		          		<option>15</option>
		        	</select>
				</form>";
			echo "</div>";
		echo "</div>";
	}else if($aw == 0){
		echo"
			<center>
			<cite class='_Rm'>Sorry, Result for <b>".$qq."</b> is not found on our databases</cite>
			</center>
		";
	}	
?>