<?php
include("class/clstmdt.php");
$p = new tmdt();

if(isset($_REQUEST['layid']))
{
	$layid = $_REQUEST['layid'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data" name="form1" style="width: 100%">
            <!--********** CODE PHP XUẤT CHI TIET SP TRONG FILE clstmdt.php function xuatchitietsp() ************-->
            <?php
                $p->xuatchitietsp("select * from sanpham where id='$layid'");
            ?>
        </form>
    </div>

    
</body>
</html>