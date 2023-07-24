<?php
class tmdt
{
    public function connect()
	{
		$conn = mysqli_connect("localhost", "tmdt", "123456", "lampart_test2");
		if(!$conn)
		{
			echo 'Khong ket noi dc csdl';
			exit();
		}
		else
		{
			mysqli_set_charset($conn,"utf8");
			return $conn;
		}
	}

    public function xuatsanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        $dem = 1;
        
        if($i > 0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id = $row['id'];
                $tensp = $row['tensp'];
                $hinhanh = $row['hinhanh'];
                $id_danhmuc = $row['id_danhmuc'];

                echo '<tr>
                        <td class="pc">'.$dem.'</td>
                        <td class="pc">'.$tensp.'</td>
                        <td class="pc">'.$id_danhmuc.'</td>
                        <td><img src="images/'.$hinhanh.'" alt="" style="width: 100px;"></td>
                        <td class="pc">
                            <a href="qlsp/suasp.php?layid='.$id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="qlsp/xoasp.php?layid='.$id.'"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-clone" aria-hidden="true"></i></a>
                            <a href="chitietsp.php?layid='.$id.'"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    ';
                $dem++;
                    
            }
        }
        else{
            echo 'Khong co csdl';
        }


        mysqli_close($link);
    }


    public function xuatchitietsp($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        

        if($i > 0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id = $row['id'];
                $tensp = $row['tensp'];
                $hinhanh = $row['hinhanh'];
                $id_danhmuc = $row['id_danhmuc'];
                
                echo '<div class="row mt-4">
                        <div class="col-md-4">
                            <img src="images/'.$hinhanh.'" alt="" style="width: 100%;">
                        </div>
                        <div class="col-md-4 offset-2" style="margin-left: 6%;">
                            <p><b>Product name: </b>'.$tensp.'</p>
                            <p><b>Category:</b> '.$id_danhmuc.'</p>
                        </div>
                    </div>';
            }
        }
        else{
            echo 'Khong co csdl';
        }

        mysqli_close($link);
    }

    public function load_menu_danhmuc($sql)
    {
        $link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if($i > 0)
		{
			while($row = mysqli_fetch_array($ketqua))
			{
				$id = $row['id'];
				$tendanhmuc = $row['tendanhmuc'];
				echo '<li><a href="?id_danhmuc='.$id.'">'.$tendanhmuc.'</a></li>';
			}
		}
		else
		{
			echo 'Khong co csdl';
		}
		mysqli_close($link);
    }

    public function phantrang($sql)
    {
        $link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
        $soluong_moi_trang = 10;
        $tongsotrang = ceil($i / $soluong_moi_trang);

        for($j = 1; $j <= $tongsotrang; $j++)
        {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.$j.'">'.$j.'</a></li>';
            
        }
		mysqli_close($link);
    }
}
?>