<?php 
	$query	= $_GET['q'];
	$kinds	= $_GET['a'];
	$kindz	=	$kinds;
	$active1= "";
	$active2= "";
	$active3= "";
	if ($query == "" || $query == " "){
		header('Location: /ilkomsearch');
	}
	if ($kinds=="1"){
		$active1 ="checked";
		$active2= "";
		$active3= "";
	}else if ($kinds=="2"){
		$active2 ="checked";
		$active1= "";
		$active3= "";
	}else if ($kinds=="3"){
		$active3 ="checked";
		$active1= "";
		$active2= "";
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/ilkomsearch/css/bs.css" >
<link rel="stylesheet" href="/ilkomsearch/css/jPages.css" >
<script src="/ilkomsearch/js/bs.js"></script>
<script src="/ilkomsearch/js/jq.js"></script>
<script src="/ilkomsearch/js/jPages.js"></script>
<title>Search Results For <?php echo $query?></title>
    <style>
    
    input[type=text] {
        width: 100%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('/ilkomsearch/img/search.png');
        background-position: 10px 10px; 
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        /*-webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;*/
    }

    footer {
        background: #f2f2f2;
        position: absolute;
        left: 0;
        bottom: 0;
        height: 40px;
        width: 100%;
        overflow:hidden;
        font-size: 13px;
        padding-top: 10px;
        padding-bottom: 5px;
        border-top: 1px solid #e4e4e4;
        border-top-width: 1px;
        border-top-style: solid;
        border-top-color: rgb(228, 228, 228);
        
    }
    footer a{
        color: #777;
        text-decoration: none !important;
    }
    .type {
    	margin-top: 10px;
    }
    .search form .type input[type="radio"]:checked + label {
		background-color: #5cb85c;
    }
    .search form .type label {
	    display: inline-block;
	    cursor: pointer;
	    line-height: 35px;
	    margin: 0 1px;
	    padding: 2px 27px;
	    background: #e5e5e5;
	        background-color: rgb(229, 229, 229);
	    background-color: rgb(229, 229, 229);
	    color: #434649;
	    font-size: 14px;
	    
	    
	}
	.search form .type input[type="radio"]:checked + label {
	    color: #fff;
	}
    </style>
</head>
<body>
    <div class="container" style="width: 700px">
        <center class="search">
	        <h1 style="padding-top: 190px"><a href="/ilkomsearch">Ilkom Search</a></h1>
	            <p>Search Results For <b><?php echo $query?></b></p>
	        <form action="search.php" method="GET" style="width: 700px">
            <div class="input-group">
              <input type="text" name="q" placeholder="Cari disini..." value="<?php echo $query;?>">
              <input type="text" name="a" value="<?php echo $kindz;?>" hidden>
              <span class="input-group-btn">
                <button type="submit" class="btn btn-success">
                    <img src="/ilkomsearch/img/search2.png" height="22" width="22">
                </button>
              </span>
            </div>
            <div class="type">
			  <input <?php echo $active1; ?> id="search-all" 		onClick="location.href='<?php echo "/ilkomsearch/process/search.php?q=".$query."&a=1";?>'" type="radio" hidden><label for="search-all">All</label>
              <input <?php echo $active2; ?> id="search-picture" 	onClick="location.href='<?php echo "/ilkomsearch/process/search.php?q=".$query."&a=2";?>'" type="radio" hidden><label for="search-picture">Picture</label>
              <input <?php echo $active3; ?> id="search-news" 		onClick="location.href='<?php echo "/ilkomsearch/process/search.php?q=".$query."&a=3";?>'" type="radio" hidden><label for="search-news">News</label>
			</div>
            </form>   
        </center>
        <br><br>
        <?php
			require_once("generate.php");
		?>
    </div>
</body>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
    <script type="text/javascript">
        $(function(){

          $("div.srg").jPages({
            containerID : "itemContainer"
          });

        });
    </script>
<!-- <footer>
    
    <center>
        <p>Copyright © 2017. Created and Designed by : <a href="http://www.abdulhalimzhr.com" target="_blank">Abdul Halim</a></p>
    </center>
</footer> -->
</html>
