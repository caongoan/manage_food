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
		$query = "SELECT * FROM discount_code,code_type WHERE discount_code.typeId=code_type.typeId AND (discountCode LIKE N'%".$name."%' OR code_type.typeName LIKE '%".$name."%') AND AdminId='$this->id' LIMIT $each_page,$amount";
		$result = $this->db->select($query);
		return $result;
	}
	public function list_all($name)
	{
		if($name=='')
        {
            $query = "SELECT * FROM discount_code,code_type WHERE discount_code.typeId=code_type.typeId AND AdminId='$this->id'";
        }
        else
        {
			$query = "SELECT * FROM discount_code,code_type WHERE discount_code.typeId=code_type.typeId AND (discountCode LIKE N'%".$name."%' OR code_type.typeName LIKE '%".$name."%') AND AdminId='$this->id'";
        }
		$result = $this->db->select($query);
		return $result;
	}
	public function list_code_type()
	{
		$query = "SELECT * FROM code_type";
		$result = $this->db->select($query);
		return $result;
	}
	public function discount_code_by_id($id)
	{
		$query = "SELECT * FROM discount_code,code_type WHERE discount_code.typeId=code_type.typeId AND discountId=$id and AdminId='$this->id' ";
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
				$query = "INSERT INTO discount_code(discountCode,amount,details, typeId, AdminId) VALUES ('$discountCode','$amount','$details','$typeId','$this->id') ";
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
	public function update_discount_code($id,$discountCode,$amount,$details,$typeId)
	{
		$discountCode = $this->fm->validation($discountCode); //gọi ham validation từ file Format để ktra
		$discountCode = mysqli_real_escape_string($this->db->link, $discountCode);
        $amount= $this->fm->validation($amount); //gọi ham validation từ file Format để ktra
		$amount = mysqli_real_escape_string($this->db->link, $amount);
        $typeId = $this->fm->validation($typeId); //gọi ham validation từ file Format để ktra
		$typeId= mysqli_real_escape_string($this->db->link, $typeId);
        $details = $this->fm->validation($details); //gọi ham validation từ file Format để ktra
		$details= mysqli_real_escape_string($this->db->link, $details);
		//mysqli gọi 2 biến. (discountName and link) biến link -> gọi conect db từ file db

		if (empty($discountCode)||empty($amount)||empty($typeId)||empty($details)) {
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

			$query = "Update discount_code set discountCode='$discountCode',amount='$amount',details='$details',typeId='$typeId' where discountId='$id' and AdminId='$this->id'";
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Sửa mã giảm giá thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Sửa mã giảm giá thất bại</span>";
				return $alert;
			}
		}
	}
	public function delete_discount_code($discountId)
	{
		$query = "DELETE FROM discount_code where discountId = '$discountId' and AdminId='$this->id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa mã giảm giá thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Xóa mã giảm giá không thành công</span>";
			return $alert;
		}
	}
}
?>