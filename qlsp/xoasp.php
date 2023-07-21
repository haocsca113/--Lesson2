<?php
include("../class/clsadmin.php");
$p = new admin();

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
        <div class="row mt-4">
            <div class="col-md-6 offset-3">
                <!-- Form xóa sp -->
                <form action="" method="post" enctype="multipart/form-data" name="form1">
                    <h3>Delete product</h3>
                    <div class="form-group">
                        <label for="">Product name</label>
                        <input type="text" name="txttensp" class="form-control" placeholder="" value="<?php echo $p->laycot("select tensp from sanpham where id='$layid' limit 1");?>">
                        <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group mt-4 mb-4">
                        <label for="">Category</label> <br>
                        <!--************ CODE PHP LOAD COMBO BOX của danhmuc  *************-->
                        <?php
                            $id_danhmuc = $p->laycot("select id_danhmuc from sanpham where id='$layid' limit 1");
                            $p->loadcombo_danhmuc2("select * from danhmuc order by id asc", $id_danhmuc);
                        ?>
                        <!--************ END CODE PHP LOAD COMBO BOX của danhmuc  *************-->
                    </div>

                    <div class="form-group">
                        <label for="myfile">Product image</label> <br>
                        <input type="file" name="myfile" id="myfile" />
                    </div>
                    
                    <button type="submit" name="xoasp" class="btn btn-danger mt-4">Delete</button>

                    <!--************** CODE PHP XỬ LÝ NÚT SUBMIT ĐỂ XÓA SP  *************-->
                    <?php
                        if(isset($_POST['xoasp']))
                        {
                            $idxoa = $_REQUEST['layid'];
                            
                            if($idxoa > 0)
                            {
                                $hinhanh = $p->laycot("select hinhanh from sanpham where id = '$idxoa' limit 1");
                                $vitri = "../images/".$hinhanh;
                                if(unlink($vitri))
                                {
                                    if($p->themxoasua("delete from sanpham where id = '$idxoa' limit 1") == 1)
                                    {
                                        echo '<script language="javascript">
                                                    alert("Xóa sản phẩm thành công");
                                                </script>';
                                            
                                        echo '<script language="javascript">
                                                    window.location = "../?id_danhmuc=0";
                                                </script>';
                                    }
                                    else
                                    {
                                        echo 'Xóa sản phẩm ko thành công';
                                    }
                                }
                                else
                                {
                                    echo 'Xóa hình ko thành công';
                                }
                            }   
                        }
                    ?>
                    <!--************** END CODE PHP XỬ LÝ NÚT SUBMIT ĐỂ XÓA SP  *************-->
                </form>
                <!-- End Form xoá sp -->
            </div>
        </div>
    </div>

    
</body>
</html>