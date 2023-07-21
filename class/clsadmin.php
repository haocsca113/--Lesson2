<?php
include("clstmdt.php");
class admin extends tmdt
{
    public function loadcombo_danhmuc($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if($i > 0)
		{
			echo '<select name="danhmuc" id="danhmuc">
          			<option>Chọn danh mục</option>';
			while($row = mysqli_fetch_array($ketqua))
			{
				$id = $row['id'];
				$tendanhmuc = $row['tendanhmuc'];
				
                echo '<option value="'.$id.'">'.$tendanhmuc.'</option>';
			}
			
			echo '</select>';
		}
		else
		{
			echo 'Không có cơ sở dữ liệu';
		}
		mysqli_close($link);
	}

    public function loadcombo_danhmuc2($sql, $id_danhmuc)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		if($i > 0)
		{
			echo '<select name="danhmuc" id="danhmuc">
          			<option>Chọn danh mục</option>';
			while($row = mysqli_fetch_array($ketqua))
			{
				$id = $row['id'];
				$tendanhmuc = $row['tendanhmuc'];
				if($id == $id_danhmuc)
				{
					echo '<option value="'.$id.'" selected>'.$tendanhmuc.'</option>';
				}
				else
                {
                    echo '<option value="'.$id.'">'.$tendanhmuc.'</option>';
                }
			}
			
			echo '</select>';
		}
		else
		{
			echo 'Không có cơ sở dữ liệu';
		}
		mysqli_close($link);
	}

    public function uphinh($name, $folder, $tmp_name)
	{
		if($name != '' && $folder != '' && $tmp_name != '')
		{
			$newname = $folder."/".$name;
			if(move_uploaded_file($tmp_name, $newname))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}

    function themxoasua($sql)
    {
        $link = $this->connect();
        if(mysqli_query($link, $sql))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function laycot($sql)
	{
		$link = $this->connect();
		$ketqua = mysqli_query($link, $sql);
		$i = mysqli_num_rows($ketqua);
		$giatri = '';
		if($i > 0)
		{
			while($row = mysqli_fetch_array($ketqua))
			{
				$giatri = $row[0];
			}	
		}
		return $giatri;
	}
}
?>