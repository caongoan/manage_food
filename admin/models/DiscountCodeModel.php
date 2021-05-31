<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait DiscountCodeModel
{
	//lay nhieu ban ghi
	public function __construct()
	{
		$this->id = $_SESSION['adminId'];
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function show_discount_code($name)
	{
		$query = "SELECT * FROM discount_code,code_type WHERE discount_code.typeId=code_type.typeId AND (discountCode LIKE N'%".$name."%' OR code_type.typeName LIKE '%".$name."%') AND AdminId='$this->id'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function list_code_type()
	{
		$query = "SELECT * FROM code_type";
		$result = $this->db->select($query);
		return $result;
	}
	public function category_by_id($id)
	{
		$query = "SELECT * FROM category WHERE catId='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function insert_discount_code($discountCode,$amount,$typeId,$details)
	{
		$discountCode = $this->fm->validation($discountCode); //gọi ham validation từ file Format để ktra
		$discountCode = mysqli_real_escape_string($this->db->link, $discountCode);
        $amount= $this->fm->validation($amount); //gọi ham validation từ file Format để ktra
		$amount = mysqli_real_escape_string($this->db->link, $amount);
        $typeId = $this->fm->validation($typeId); //gọi ham validation từ file Format để ktra
		$typeId= mysqli_real_escape_string($this->db->link, $typeId);
        $details = $this->fm->validation($details); //gọi ham validation từ file Format để ktra
		$details= mysqli_real_escape_string($this->db->link, $details);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($discountCode)||empty($amount)||empty($typeId)||empty($details)){
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

			$query = "select *from discount_code where discountCode='$discountCode' and AdminId='$this->id'";
			$result = $this->db->select($query);
			if ($result != false) {
				$alert = "<span class='error'>Mã giảm giá đã tồn tại";
				return $alert;
			} else {
				$query = "INSERT INTO discount_code(discountCode,amount,details, typeId, AdminId) VALUES ('$discountCode','$amount','details','$typeId','$this->id') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Thêm mã giảm giá thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Thêm mã giảm giá thất bại</span>";
					return $alert;
				}
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
			$alert = "<span class='success'>Xóa danh mục không thành công</span>";
			return $alert;
		}
	}
}
?>