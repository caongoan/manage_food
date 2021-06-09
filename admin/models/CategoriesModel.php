<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait CategoriesModel
{
	//lay nhieu ban ghi
	public function __construct()
	{
		$this->id = $_SESSION['adminId'];
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function show_category($name)
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
		$query = "SELECT * FROM category,category_saler WHERE category.catId=category_saler.catId AND category_saler.AdminId='+$this->id+' AND catName LIKE N'%" . $name . "%' LIMIT $each_page,$amount ";
		$result = $this->db->select($query);
		return $result;
	}
	public function list_all($name)
	{
		if($name=='')
        {
            $query = "SELECT * FROM category,category_saler WHERE category.catId=category_saler.catId AND category_saler.AdminId='+$this->id+'";
        }
        else
        {
			$query = "SELECT * FROM category,category_saler WHERE category.catId=category_saler.catId AND category_saler.AdminId='+$this->id+' AND catName LIKE N'%" . $name . "%' ";
        }
		$result = $this->db->select($query);
		return $result;
	}
	public function list_category()
	{
		$query = "SELECT * FROM category WHERE catId NOT IN (SELECT catId FROM category_saler where AdminId='+$this->id+')";
		$result = $this->db->select($query);
		return $result;
	}
	public function category_by_id($id)
	{
		$query = "SELECT * FROM category WHERE catId='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function insert_category($catId)
	{
		$catId = $this->fm->validation($catId); //gọi ham validation từ file Format để ktra
		$catId = mysqli_real_escape_string($this->db->link, $catId);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($catId)) {
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

				$query = "INSERT INTO category_saler(adminId,catId) VALUES('$this->id','$catId') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Thêm danh mục món ăn thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Thêm danh mục món ăn thất bại</span>";
					return $alert;
				}

		}
	}
	public function update_category($catId, $id)
	{
		$catId = $this->fm->validation($catId); //gọi ham validation từ file Format để ktra
		$catId = mysqli_real_escape_string($this->db->link, $catId);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($catId)) {
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

			$query = "Update category_saler set catId='$catId' where catId=$id and AdminId='$this->id'";
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Sửa danh mục món ăn thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Sửa danh mục món ăn thất bại</span>";
				return $alert;
			}
		}
	}
	public function delete_category($catId)
	{
		$query = "DELETE FROM category_saler where catId = '$catId' and AdminId='$this->id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa danh mục thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Xóa danh mục không thành công</span>";
			return $alert;
		}
	}
}
?>