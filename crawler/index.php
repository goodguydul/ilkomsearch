<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>Submit Link</title>
<style>
.topz {

}
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

/*input[type=text]:focus {
    width: 100%;
}*/
</style>
</head>
<body>
    <div class="container" style="width: 700px">
    <?php 
        if (isset($_GET['q']) && $_GET['q']==1) {
            echo '<div class="alert alert-success" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sukses!</strong> Link telah diterima dan akan segera diproses.
                  </div>';
            header( "refresh:5;url=index.php" );
        }else if (isset($_GET['q']) && $_GET['q']!=1){
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Ada kesalahan dalam proses. Coba lagi nanti.
                  </div>';
                  header( "refresh:5;url=index.php" );           
        }else if (isset($_GET['status']) && $_GET['status']== 404){
            $coeg = $_GET['status'];
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Error code : '.$coeg.'.
                  </div>';
                  header( "refresh:5;url=index.php" );             
        }else if (isset($_GET['status']) && $_GET['status']== 408){
            $coeg = $_GET['status'];
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Error code : '.$coeg.'.
                  </div>';
                  header( "refresh:5;url=index.php" );             
        }else if (isset($_GET['status']) && $_GET['status']== 500){
            $coeg = $_GET['status'];
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Error code : '.$coeg.'.
                  </div>';
                  header( "refresh:5;url=index.php" );             
        }else if (isset($_GET['status']) && $_GET['status']== 502){
            $coeg = $_GET['status'];
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Error code : '.$coeg.'.
                  </div>';
                  header( "refresh:5;url=index.php" );             
        }else if (isset($_GET['status']) && $_GET['status']== 504){
            $coeg = $_GET['status'];
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Error code : '.$coeg.'.
                  </div>';
                  header( "refresh:5;url=index.php" );             
        }else if (isset($_GET['status']) && $_GET['status']== 403){
            $coeg = $_GET['status'];
            echo '<div class="alert alert-danger" role="alert" style="margin-top:50px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Gagal!</strong> Error code : '.$coeg.'.
                  </div>';
                  header( "refresh:5;url=index.php" );             
        }
    ?>
        <center>
            <h1 style="padding-top: 190px">Ilkom Search</h1>
            <p>Submit Link for Crawl</p>
            <form action="crawl.php" method="POST" style="width: 700px">
            <div class="input-group">
              <input type="text" name="url" placeholder="Submit you URL here">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-success"><img src="img/search2.png" height="22" width="22"></button>
              </span>
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
</footer>
</html>