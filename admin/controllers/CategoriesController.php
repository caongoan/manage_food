<?php 
	//load file model
	include_once "models/CategoriesModel.php";
	class CategoriesController extends Controller{
		use CategoriesModel;
		public function index(){
			$this->loadView("ListCategory.php");
		}
		public function ListCategory(){
			if(isset($_POST['searchString'])){
			$name=$_POST['searchString'];
			}
			else
			{
				$name="";
			}
			$listCatByName=$this->show_category($name);
			return $listCatByName;
		}
		public function indexAdd(){
			$this->loadView("AddCategory.php");
		}
		
		public function Add(){
			$catId=$_POST['catId'];
			$add=$this->insert_category($catId);
			return $add;
		}
		public function indexEdit(){
			$this->loadView("EditCategory.php");
		}
		public function Edit($id){
			$catId=$_POST['catId'];
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