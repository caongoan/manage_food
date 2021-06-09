<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait StatisticalModel
{
	//lay nhieu ban ghi
	public function __construct()
	{
		$this->id = $_SESSION['adminId'];
		$this->db = new Database();
		$this->fm = new Format();
	}
	
	public function list_many_sales()
	{
        $query="SELECT orderdetail.dishId,orderdetail.dishName,SUM(quantity) as quantity ,price,SUM(intoMoney) as intoMoney  FROM orderdetail,orderstatus,orders WHERE orderdetail.id=orders.id and orders.statusId=orderstatus.statusId and orderstatus.statusId=4 and YEAR(orders.dateOrder)=YEAR(Now()) and MONTH(orders.dateOrder)=MONTH(Now()) and orders.AdminId='$this->id' GROUP by orderdetail.dishId ORDER by quantity DESC LIMIT 10";
		$result = $this->db->select($query);
		return $result;
	}
	public function revenue()
	{
		$query = "SELECT dishId,dishName,SUM(quantity) as quantity ,price,SUM(intoMoney) as intoMoney FROM orders,orderstatus,orderdetail WHERE orders.id=orderdetail.id AND orders.statusId=orderstatus.statusId and YEAR(orders.dateOrder)=YEAR(Now()) and MONTH(orders.dateOrder)=MONTH(Now()) AND orderstatus.statusId=4 and orders.AdminId='$this->id' GROUP by orderdetail.dishId ORDER by orderdetail.dishId DESC";
		$result = $this->db->select($query);
		return $result;
	}
    
}
?>