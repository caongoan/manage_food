<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait DishModel
{
	//lay nhieu ban ghi
	public function __construct()
	{
		$this->id = $_SESSION['adminId'];
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function show_dish($name)
	{
		$amount=10;
			if(!isset($_GET['page']))
		   {
			   $page=1;
		   }
		   else
		   {
			   $page=$_GET['page'];
		   }
		   $each_page=($page-1)*$amount;
		$query = "SELECT * FROM dish,dishstatus,category WHERE dish.catId=category.catId AND dish.dishStatusId=dishstatus.dishStatusId AND (dishName LIKE N'%".$name."%' OR catName LIKE '%".$name."%') AND AdminId='$this->id' LIMIT $each_page,$amount";
		$result = $this->db->select($query);
		return $result;
	}
	public function list_all($name)
	{
		if($name=='')
        {
            $query = "SELECT * FROM dish,dishstatus,category WHERE dish.catId=category.catId AND dish.dishStatusId=dishstatus.dishStatusId AND AdminId='$this->id'";
        }
        else
        {
			$query = "SELECT * FROM dish,dishstatus,category WHERE dish.catId=category.catId AND dish.dishStatusId=dishstatus.dishStatusId AND (dishName LIKE N'%".$name."%' OR catName LIKE '%".$name."%') AND AdminId='$this->id'";
        }
		$result = $this->db->select($query);
		return $result;
	}
	public function list_cat()
	{
		$query = "SELECT * FROM category_saler,category WHERE category_saler.catId=category.catId AND AdminId='$this->id'";
		$result = $this->db->select($query);
		return $result;
	}
    public function list_status()
	{
		$query = "SELECT * FROM dishstatus";
		$result = $this->db->select($query);
		return $result;
	}
	public function dish_by_id($id)
	{
		$query = "SELECT * FROM dish,dishstatus,category WHERE dish.catId=category.catId AND dish.dishStatusId=dishstatus.dishStatusId AND  dishId=$id and AdminId='$this->id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function insert_dish($dishName,$price,$catId,$dishStatusId,$files)
	{
		$dishName = $this->fm->validation($dishName); //gọi ham validation từ file Format để ktra
		$dishName = mysqli_real_escape_string($this->db->link, $dishName);
        $price= $this->fm->validation($price); //gọi ham validation từ file Format để ktra
		$price = mysqli_real_escape_string($this->db->link, $price);
        $catId = $this->fm->validation($catId); //gọi ham validation từ file Format để ktra
		$catId= mysqli_real_escape_string($this->db->link, $catId);
        $dishStatusId = $this->fm->validation($dishStatusId); //gọi ham validation từ file Format để ktra
		$dishStatusId= mysqli_real_escape_string($this->db->link, $dishStatusId);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['images']['name'];
        $file_size = $_FILES['images']['size'];
		$file_temp = $_FILES['images']['tmp_name'];
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_images = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_images = "uploads/".$unique_images;
		if (empty($dishName)||empty($price)||empty($catId)||empty($dishStatusId)||empty($file_name)){
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

			$query = "select *from dish where dishName='$dishName' and AdminId='$this->id'";
			$result = $this->db->select($query);
			if ($result != false) {
				$alert = "<span class='error'>Món ăn đã tồn tại";
				return $alert;
			} else {
				if ($file_size > 2048000) {

					$alert = "<span class='success'>Dung lương ảnh phải dưới 2MB !</span>";
				   return $alert;
				   } 
				   elseif (in_array($file_ext, $permited) === false) 
				   {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				   $alert = "<span class='success'>Bạn chỉ có thể đăng:-".implode(', ', $permited)."</span>";
				   return $alert;
				   }
				   move_uploaded_file($file_temp,$uploaded_images);
				$query = "INSERT INTO dish(dishName,images,price,dishStatusId, catId, AdminId) VALUES ('$dishName','$unique_images','$price','$dishStatusId','$catId','$this->id') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Thêm món ăn thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Thêm món ăn thất bại</span>";
					return $alert;
				}
			}
		}
	}
	public function update_dish($dishId,$dishName,$price,$catId,$dishStatusId,$files)
	{
		$dishName = $this->fm->validation($dishName); //gọi ham validation từ file Format để ktra
		$dishName = mysqli_real_escape_string($this->db->link, $dishName);
        $price= $this->fm->validation($price); //gọi ham validation từ file Format để ktra
		$price = mysqli_real_escape_string($this->db->link, $price);
        $catId = $this->fm->validation($catId); //gọi ham validation từ file Format để ktra
		$catId= mysqli_real_escape_string($this->db->link, $catId);
        $dishStatusId = $this->fm->validation($dishStatusId); //gọi ham validation từ file Format để ktra
		$dishStatusId= mysqli_real_escape_string($this->db->link, $dishStatusId);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
		if(isset($files))
		{
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['images']['name'];
        $file_size = $_FILES['images']['size'];
		$file_temp = $_FILES['images']['tmp_name'];
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_images = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_images = "uploads/".$unique_images;
		if (empty($dishName)||empty($price)||empty($catId)||empty($dishStatusId)||empty($file_name)){
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {
				if ($file_size > 2048000) {

					$alert = "<span class='success'>Dung lương ảnh phải dưới 2MB !</span>";
				   return $alert;
				   } 
				   elseif (in_array($file_ext, $permited) === false) 
				   {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				   $alert = "<span class='success'>Bạn chỉ có thể đăng:-".implode(', ', $permited)."</span>";
				   return $alert;
				   }
				   move_uploaded_file($file_temp,$uploaded_images);
				$query = "UPDATE dish set dishName='$dishName',images='$unique_images',price='$price',dishStatusId='$dishStatusId',catId='$catId' where dishId = '$dishId' and AdminId='$this->id' ";
				$result = $this->db->update($query);
				if ($result) {
					$alert = "<span class='success'>Sửa món ăn thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Sửa món ăn thất bại</span>";
					return $alert;
				}
		}}
		else
		{
			if (empty($dishName)||empty($price)||empty($catId)||empty($dishStatusId)){
				$alert = "<span class='error'>Danh mục không được để trống</span>";
				return $alert;
			} else {
					
					$query = "UPDATE dish set dishName='$dishName',price='$price',dishStatusId='$dishStatusId',catId='$catId' where dishId = '$dishId' and AdminId='$this->id' ";
					$result = $this->db->update($query);
					if ($result) {
						$alert = "<span class='success'>Sửa món ăn thành công</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Sửa món ăn thất bại</span>";
						return $alert;
					}
			}

		}
	}
	public function delete_dish($dishId)
	{
		$query = "DELETE FROM dish where dishId = '$dishId' and AdminId='$this->id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa món ăn thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Xóa món ăn không thành công</span>";
			return $alert;
		}
	}
}
?>