<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait OrderModel
{
	//lay nhieu ban ghi
	public function __construct()
	{
		$this->id = $_SESSION['adminId'];
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function show_Order($statusId)
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
        if($statusId=='')
        {
            $query = "SELECT * FROM Orders,Orderstatus WHERE Orders.statusId=orderstatus.statusId and AdminId='$this->id' order by dateOrder desc LIMIT $each_page,$amount";
        }
        else
        {
		$query = "SELECT * FROM Orders,Orderstatus WHERE Orders.statusId=orderstatus.statusId AND orderstatus.statusId=$statusId and AdminId='$this->id' order by dateOrder desc LIMIT $each_page,$amount";
        }
		$result = $this->db->select($query);
		return $result;
	}
	public function list_all($statusId)
	{
        if($statusId=='')
        {
            $query = "SELECT * FROM Orders,Orderstatus WHERE Orders.statusId=orderstatus.statusId and AdminId='$this->id' order by dateOrder desc";
        }
        else
        {
		$query = "SELECT * FROM Orders,Orderstatus WHERE Orders.statusId=orderstatus.statusId AND orderstatus.statusId=$statusId and AdminId='$this->id' order by dateOrder desc";
        }
		$result = $this->db->select($query);
		return $result;
	}
	public function order_detail($id)
	{
		$query = "SELECT * FROM orderdetail WHERE id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
    public function list_status()
	{
		$query = "SELECT * FROM Orderstatus";
		$result = $this->db->select($query);
		return $result;
	}
	public function customer_detail($id)
	{
		$query = "SELECT * FROM customer WHERE customerId='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_Order($orderId,$statusId)
	{
		$query = "UPDATE Orders set statusId = '$statusId' where id=$orderId and AdminId='$this->id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Cập nhật đơn hàng thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Cập nhật đơn hàng không thành công</span>";
			return $alert;
		}
	}
}
?>