<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Satisfy" />
<title>Ilkom Search by Implementing Query Expansion with Lexical Database and Vector Space Model</title>
    <style>
    input[type=text] {
        width: 100%;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('img/search.png');
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
        margin: 0 5.5px;
        padding: 2px 27px;
        background: #e5e5e5;
            background-color: rgb(229, 229, 229);
        background-color: rgb(229, 229, 229);
        color: #434649;
        font-size: 14px;
        -webkit-border-radius: 19px;
        border-radius: 19px;
    }
    .search form .type input[type="radio"]:checked + label {
        color: #fff;
    }
    </style>
</head>
<body>
    <div class="container" style="width: 700px">
        <center class="search">
            <h1 style="padding-top: 190px;font-family: Satisfy "><a href="/ilkomsearch">Ilkom Search</a></h1>
            <p>Mesin Pencari Ilkom Unsri</p>
            <form action="process/search.php" method="GET" style="width: 700px">
            <div class="input-group">
              <input type="text" name="q" placeholder="Cari disini...">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-success">
                    <img src="img/search2.png" height="22" width="22">
                </button>
              </span>
            </div>
            <div class="type">
                <input checked="" name="a" value="1" id="search-all" type="radio" hidden><label for="search-all">All</label>
                <input name="a" value="2" id="search-picture" type="radio" hidden><label for="search-picture">Picture</label>
                <input name="a" value="3" id="search-news" type="radio" hidden><label for="search-news">News</label>
            </div>
            </form>           
        </center>
    </div>
</body>
<footer>
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
    <center>
        <p>Copyright © 2017. Created and Designed by : <a href="http://www.abdulhalimzhr.com" target="_blank">Abdul Halim</a></p>
    </center>
</footer>
</html>