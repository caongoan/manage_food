
<?php 
	class HomeController extends Controller{
		//ham tao
		public function __construct(){
			//kiem tra xem user da dang nhap chua

		}
		public function index(){
			$this->loadView("Home.php");
		}
	}
 ?>