<?php
    include("class/clstmdt.php");
    $p = new tmdt();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .table>tbody>tr>td.pc
        {
            padding-top: 4%;
        }
        form .fa{
            padding: 3px;
            font-size: 20px;
        }
    </style>

    
</head>
<body>
    <div class="container">
        <header>
            <div class="row mt-4">
                <!-- Div trái Header -->
                <div class="col-md-6 d-flex">
                    <!-- ẤN VÀO NÚT Products thì hiện thông tin toàn bộ sản phẩm -->
                    <a href="index.php"><button class="btn btn-primary mr-2" style="height: 40px;">Products</button></a>

                    <button class="btn btn-light" style="height: 40px;">Categories</button> 
                    <ul style="list-style: none; padding-left: 10px;">
                        <!--************** CODE PHP LOAD TẤT CẢ TÊN DANH MỤC TRONG DB danhmuc  *****************-->
                        <?php
                            $p->load_menu_danhmuc("select * from danhmuc order by id asc");
                        ?>
                        <!--************** END CODE PHP LOAD TẤT CẢ TÊN DANH MỤC TRONG DB danhmuc *****************-->
                    </ul>
                </div>

                <!-- Logo div phải Header -->
                <div class="col-md-6">
                    <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBeWtwREE9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--14de276b6be760860ab26df8376669b2eaee11ae/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJYW5CbkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--1b8988b96ed4a58d3628eb3340c8b231786ccfc0/lampart-logo.jpg" alt="" style="width: 10%; height: 100%; float: right;">
                </div>
            </div>
        </header>
        <!-- End Header -->
        
        <div class="content">
            <!-- Thanh tìm kiếm -->
            <!-- <input type="text" name="" id="" placeholder="Search" class="w-100" style="border: 2px solid #ccc; padding: 0 45%;"> -->
            <form action="" method="post" class="w-100">
                <div class="row mt-4">

                    <div class="col-md-10">
                        <input type="text" name="search" id="search" placeholder="Search" value="" style="border: 2px solid #ccc; width: 100%; padding: 0 45%;">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark btn-sm w-100" type="submit" name="submit">Search</button>
                    </div>
                </div>
            </form>
            
            <div class="row mt-4">
                <div class="col-md-6">
                    <p class="font-weight-bold">Search found 10 results</p>
                </div>

                <!-- Nút thêm sản phẩm -->
                <div class="col-md-6">
                    <a href="qlsp/themsp.php">
                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right; font-size: 30px;"></i>
                    </a>
                </div>
            </div>

            <!-- Row chứa Form thông tin sản phẩm -->
            <div class="row mt-4" style="text-align: center; ">
                <div class="col-md-12">
                    <form action="" method="post" enctype="multipart/form-data" name="form1">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!--*********** CODE PHP XUẤT TẤT CẢ SẢN PHẨM TRONG DB sanpham  -->
                                <?php
                                    // Nhận id_danhmuc trong file clstmdt.php function load_menu_danhmuc() 
                                    if(isset($_REQUEST['id_danhmuc']))
                                    {
                                        $id_danhmuc = $_REQUEST['id_danhmuc'];
                                    }
                                    else
                                    {
                                        $id_danhmuc = 0;
                                    }

                                    $soluong_moi_trang = 10;
                                    if(isset($_REQUEST['page']))
                                    {
                                        $page = $_REQUEST['page'];
                                    }
                                    else
                                    {
                                        $page = 1;
                                    }
                                    $start_from = ($page - 1) * $soluong_moi_trang;

                                    if(isset($_POST['submit']))
                                    {
                                        $search = $_POST['search'];
                                        $id_danhmuc = -99;
                                        $page = -99;

                                        $p->xuatsanpham("select * from sanpham where tensp='$search'");
                                    }
                                    
                                    // Nếu sanpham có id_danhmuc nào thì xuất sản phẩm có id_danhmuc tương ứng
                                    if($id_danhmuc > 0)
                                    {
                                        $p->xuatsanpham("select * from sanpham where id_danhmuc='$id_danhmuc' order by id asc");
                                    }
                                    else if($page > 0)
                                    {
                                        $p->xuatsanpham("select * from sanpham limit $start_from,$soluong_moi_trang");
                                    }
                                    
                                    // Ngược lại nếu $id_danhmuc == 0 in ra toàn bộ sản phẩm
                                    else if($id_danhmuc == 0)
                                    {
                                        $p->xuatsanpham("select * from sanpham order by id asc");
                                    }

                                    
                                ?>
                                <!--*********** END CODE PHP XUẤT TẤT CẢ SẢN PHẨM TRONG DB sanpham  -->
                            </tbody>
                        </table>
                    </form>
                    <!-- End form --> 
                </div>
            </div>

            <!-- Row phân trang -->
            <div class="row">
                <div class="col-md-12" style="padding: 0 30%;">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <?php
                                $p->phantrang("select * from sanpham");
                            ?>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                    
                </div>
            </div>
        </div>
        <!-- End content -->

        <footer>
            <p>Copy right © 2021 - All right rersver</p>
        </footer>
        <!-- End footer -->
    </div>
</body>
</html>