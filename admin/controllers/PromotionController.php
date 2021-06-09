<?php 
	//load file model
	include_once "models/PromotionModel.php";
	class PromotionController extends Controller{
		use PromotionModel;
		public function index(){
			$this->loadView("ListPromotion.php");
		}
		public function ListPromotion(){
			if(isset($_POST['searchString'])){
			$name=$_POST['searchString'];
			}
			else
			{
				$name="";
			}
			$listdcbyName=$this->show_promotion($name);
			return $listdcbyName;
		}
		public function indexAdd(){
			$this->loadView("AddPromotion.php");
		}
		
		public function Add(){
			$startDate=$_POST['startDate'];
            $endDate=$_POST['endDate'];
            $dishId=$_POST['dishId'];
            $promotionPrice=$_POST['promotionPrice'];
			$add=$this->insert_promotion($startDate,$endDate,$dishId,$promotionPrice);
			return $add;
		}
		public function Delete(){
			$promotionId=$_GET['promotionId'];
			$del=$this->delete_promotion($promotionId);
			return $del;
		}
		//edit
		
	}
 ?>