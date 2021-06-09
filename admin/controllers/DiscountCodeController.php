<?php 
	//load file model
	include_once "models/DiscountCodeModel.php";
	class DiscountCodeController extends Controller{
		use DiscountCodeModel;
		public function index(){
			$this->loadView("ListDiscountCode.php");
		}
		public function ListDiscountCode(){
			if(isset($_POST['searchString'])){
			$name=$_POST['searchString'];
			}
			else
			{
				$name="";
			}
			$listdcbyName=$this->show_discount_code($name);
			return $listdcbyName;
		}
		public function indexAdd(){
			$this->loadView("AddDiscountCode.php");
		}
		
		public function Add(){
			$discountCode=$_POST['discountCode'];
            $amount=$_POST['amount'];
            $typeId=$_POST['typeId'];
            $details=$_POST['details'];
			$add=$this->insert_discount_code($discountCode,$amount,$typeId,$details);
			return $add;
		}
		public function indexEdit(){
			$this->loadView("EditDiscountCode.php");
		}
		public function Edit(){
			$id=$_POST['Id'];
			$discountCode=$_POST['discountCode'];
			$amount=$_POST['amount'];
			$details=$_POST['details'];
			$typeId=$_POST['typeId'];
			$edit=$this->update_discount_code($id,$discountCode,$amount,$details,$typeId);
			return $edit;
		}
		public function Delete(){
			$discountId=$_GET['discountId'];
			$del=$this->delete_discount_code($discountId);
			return $del;
		}
		//edit
		
	}
 ?>