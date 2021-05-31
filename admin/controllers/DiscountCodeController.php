<?php 
	//load file model
	include_once "models/DiscountCodeModel.php";
	class DiscountCodeController extends Controller{
		use DiscountCodeModel;
		public function index(){
			$this->loadView("ListDiscountCode.php");
		}
		public function ListDiscountCode(){
			if(isset($_GET['searchString'])){
			$name=$_GET['searchString'];
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
			$discountCode=$_GET['discountCode'];
            $amount=$_GET['amount'];
            $typeId=$_GET['typeId'];
            $details=$_GET['details'];
			$add=$this->insert_discount_code($discountCode,$amount,$typeId,$details);
			return $add;
		}
		public function indexEdit(){
			$this->loadView("EditCategory.php");
		}
		public function Edit($id){
			$catId=$_GET['catId'];
			$edit=$this->update_category($catId,$id);
			return $edit;
		}
		public function Delete($catId){
			
			$del=$this->delete_category($catId);
			return $del;
		}
		//edit
		
	}
 ?>