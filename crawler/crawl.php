<?php 
include('inc/function.php');
include('inc/conn.php');
$url    = $_POST['url']; 

$url1   = checkurl($url);
$url1   = filter_var($url1[0], FILTER_SANITIZE_URL);
$val    = getinfo($url1);
$urlstatus = checkheader($url1);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Link Submited</title>
</head>
<body>
<?php 
    if($urlstatus == 200 || $urlstatus == 301){
        $sql     = "INSERT INTO urls (url, status, date_added) VALUES('".$url1."', 0, '".date('Y-m-d')."')";
        $sql1    = "INSERT INTO search (title, url, description,keywords) VALUES('".$val[1]."','".$url1."','".$val[2]."','".$val[3]."')";
        if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
            header( "refresh:1;url=index.php?q=1" );
        } else if ($conn->query($sql) === FALSE && $conn->query($sql1) === FALSE){
            header( "refresh:1;url=index.php?q=2" );
        }else{
            header( "refresh:1;url=index.php?q=2" );
        }
        mysqli_close($conn);
    }else{
        header( "refresh:1;url=index.php?status=".$urlstatus."" );
    }
?>
</body>
</html>