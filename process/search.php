<?php 
    $query  = $_GET['q'];
    $kinds  = $_GET['a'];
    $kindz  =   $kinds;
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
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Satisfy" />
<link rel="stylesheet" href="/ilkomsearch/css/bs.css" >
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="/ilkomsearch/css/jPages.css" >
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<script src="https://npmcdn.com/bootstrap@4.0.0-alpha.5/dist/js/bootstrap.min.js"></script>
<script src="/ilkomsearch/js/jPages.js"></script>
<title>Search Results For <?php echo $query?></title>
    <style>
    a:hover {
        text-decoration: none;
    }
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
        color: #434649;
        font-size: 14px;
    }
    html, body {
        height: 100%;
        margin: 0;
    }
    .wrappers {
        min-height: 100%;
        margin-bottom: -50px;
    }
    .footer {
        height: 50px;
        font-size: 13px;
        padding-top: 10px;
        padding-bottom: 5px;
        border-top: 1px solid #e4e4e4;
        border-top-width: 1px;
        border-top-style: solid;
        border-top-color: rgb(228, 228, 228);
        color: #777;
        text-decoration: none !important;
    }
    .search form .type input[type="radio"]:checked + label {
        color: #fff;
    }
    </style>
</head>
<body>
    <div class="wrappers">
        <div class="container" style="width: 800px;float: left;margin: 20px 0px 20px 10px;">
            <div class="search" style="float: left;width: 800px;">
                <span>
                    <h1 style="padding: 15px 0px 0px 40px;float: left;font-size: 24px;width: 30%;font-family: Satisfy;">
                        <a href="/ilkomsearch">Ilkom Search</a>
                    </h1>
                    <!-- <p>Search Results For <b><?php echo $query?></b></p> -->
                </span>
                <span>
                    <form action="search.php" method="GET" style="width: 70%;float: right;padding: 0px 0px 20px 0px;">
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
                          <input <?php echo $active1; ?> id="search-all"        onClick="location.href='<?php echo "/ilkomsearch/process/search.php?q=".$query."&a=1";?>'" type="radio" hidden><label for="search-all">All</label>
                          <input <?php echo $active2; ?> id="search-picture"    onClick="location.href='<?php echo "/ilkomsearch/process/search.php?q=".$query."&a=2";?>'" type="radio" hidden><label for="search-picture">Picture</label>
                          <input <?php echo $active3; ?> id="search-news"       onClick="location.href='<?php echo "/ilkomsearch/process/search.php?q=".$query."&a=3";?>'" type="radio" hidden><label for="search-news">News</label>
                        </div>
                    </form>
                </span> 
            </div>
            <br><br>
            <?php
                require_once("generate.php");
            ?>
        </div>
    </div>
    <div class="push"></div>
    <footer class="footer" style="clear: both;position: relative;z-index: 10;">  
        <center>
            <p>Copyright © 2017. Created and Designed by : <a href="http://www.abdulhalimzhr.com" target="_blank">Abdul Halim</a></p>
        </center>
    </footer>
</body>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
    <script type="text/javascript">
        $(function() {
            /* initiate plugin */
            $("div.holder").jPages({
              containerID : "itemContainer",
              perPage : 10,
            });
            /* on select change */
            $("select").change(function(){
              /* get new nº of items per page */
              var newPerPage = parseInt( $(this).val() );
              /* destroy jPages and initiate plugin again */
              $("div.holder").jPages("destroy").jPages({
                containerID   : "itemContainer",
                perPage       : newPerPage*2
              });
            });
        });
    </script>
    <script type="text/javascript">

     var before_loadtime = new Date().getTime();

     window.onload = Pageloadtime;

     function Pageloadtime() {

         var aftr_loadtime = new Date().getTime();

         // Time calculating in seconds

         pgloadtime = (aftr_loadtime - before_loadtime) / 1000

         document.getElementById("loadtime").innerHTML = " (" + pgloadtime + " sec)";

     }
</script>

</html>
