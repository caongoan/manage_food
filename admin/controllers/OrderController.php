<?php 
	//load file model
	include_once "models/OrderModel.php";
	class OrderController extends Controller{
		use OrderModel;
		public function index(){
			$this->loadView("ListOrder.php");
		}
        public function indexOrderDetail(){
			$this->loadView("OrderDetail.php");
		}
		public function ListOrder(){
            if(isset($_POST['idStatus']))
            {
                $statusId=$_POST['idStatus'];
            }
            else
            {
                $statusId='';
            }
			$list=$this->show_Order($statusId);
			return $list;
		}
        public function OrderDetail(){	
            $id=$_GET['Id'];	
			$list=$this->order_detail($id);
			return $list;
		}
		public function CustomerDetail(){	
            $id=$_GET['customerId'];	
			$list=$this->customer_detail($id);
			return $list;
		}
		public function Map(){
			$this->loadView("Map.php");
		}
		public function indexCustomer(){
			$this->loadView("CustomerDetail.php");
		}
		public function indexAdd(){
			$this->loadView("AddOrder.php");
		}
		public function Update(){
			$id=$_GET['orderId'];
			$statusId=$_GET['statusId'];
			$edit=$this->update_Order($id,$statusId);
			return $edit;
		}
	
		//edit
		
	}
 ?>