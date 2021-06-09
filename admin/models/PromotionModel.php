<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait PromotionModel
{
	//lay nhieu ban ghi
	public function __construct()
	{
		$this->id = $_SESSION['adminId'];
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function show_promotion($name)
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
		$query = "SELECT * FROM promotion,dish WHERE promotion.dishId=dish.dishId AND dish.dishName LIKE '%".$name."%' AND promotion.AdminId='$this->id' LIMIT $each_page,$amount";
		$result = $this->db->select($query);
		return $result;
	}
	public function list_all($name)
	{
		if($name=='')
        {
            $query = "SELECT * FROM promotion,dish WHERE promotion.dishId=dish.dishId AND promotion.AdminId='$this->id'";
        }
        else
        {
			$query = "SELECT * FROM promotion,dish WHERE promotion.dishId=dish.dishId AND dish.dishName LIKE '%".$name."%' AND promotion.AdminId='$this->id' ";
        }
		$result = $this->db->select($query);
		return $result;
	}
	public function list_dish()
	{
		$query = "SELECT * FROM dish where AdminId='$this->id'";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function insert_promotion($startDate,$endDate,$dishId,$promotionPrice)
	{
		$startDate = $this->fm->validation($startDate); //gọi ham validation từ file Format để ktra
		$startDate = mysqli_real_escape_string($this->db->link, $startDate);
        $endDate= $this->fm->validation($endDate); //gọi ham validation từ file Format để ktra
		$endDate = mysqli_real_escape_string($this->db->link, $endDate);
        $dishId = $this->fm->validation($dishId); //gọi ham validation từ file Format để ktra
		$dishId= mysqli_real_escape_string($this->db->link, $dishId);
        $promotionPrice = $this->fm->validation($promotionPrice); //gọi ham validation từ file Format để ktra
		$promotionPrice= mysqli_real_escape_string($this->db->link, $promotionPrice);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($startDate)||empty($endDate)||empty($dishId)||empty($promotionPrice)){
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {

			$query = "select *from promotion where dishId='$dishId' and AdminId='$this->id'";
			$result = $this->db->select($query);
			if ($result != false) {
				$alert = "<span class='error'>Giá khuyến mãi đã tồn tại";
				return $alert;
			} else {
				$query = "INSERT INTO promotion(startDate,endDate,promotionPrice, dishId, AdminId) VALUES ('$startDate','$endDate','$promotionPrice','$dishId','$this->id') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Thêm Giá khuyến mãi thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Thêm Giá khuyến mãi thất bại</span>";
					return $alert;
				}
			}
		}
	}
	
	public function delete_promotion($promotionId)
	{
		$query = "DELETE FROM promotion where promotionId = '$promotionId' and AdminId='$this->id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Xóa Giá khuyến mãi thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Xóa Giá khuyến mãi không thành công</span>";
			return $alert;
		}
	}
}
?>