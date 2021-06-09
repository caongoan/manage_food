<?php 
	//load file model
	include_once "models/DishModel.php";
	class DishController extends Controller{
		use DishModel;
		public function index(){
			$this->loadView("ListDish.php");
		}
		public function ListDish(){
			if(isset($_POST['searchString'])){
			$name=$_POST['searchString'];
			}
			else
			{
				$name="";
			}
			$list=$this->show_dish($name);
			return $list;
		}
		public function indexAdd(){
			$this->loadView("AddDish.php");
		}
		
		public function Add($files){
			$dishName=$_POST['dishName'];
            $price=$_POST['price'];
            $catId=$_POST['catId'];
            $dishStatusId=$_POST['dishStatusId'];
			$add=$this->insert_dish($dishName,$price,$catId,$dishStatusId,$files);
			return $add;
		}
		public function indexEdit(){
			$this->loadView("EditDish.php");
		}
		public function Edit($files){
			$id=$_POST['Id'];
			$dishName=$_POST['dishName'];
            $price=$_POST['price'];
            $catId=$_POST['catId'];
            $dishStatusId=$_POST['dishStatusId'];
			$edit=$this->update_dish($id,$dishName,$price,$catId,$dishStatusId,$files);
			return $edit;
		}
		public function Delete(){
			$dishId=$_GET['dishId'];
			$del=$this->delete_dish($dishId);
			return $del;
		}
		//edit
		
	}
 ?>