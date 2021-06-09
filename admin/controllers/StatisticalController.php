<?php 
	//load file model
	include_once "models/StatisticalModel.php";
	class StatisticalController extends Controller{
		use StatisticalModel;
		public function indexManySales(){
			$this->loadView("ManySales.php");
		}
        public function indexRevenue(){
			$this->loadView("Revenue.php");
		}
	
		
	}
 ?>