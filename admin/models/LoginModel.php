<?php
	include_once ('../config/session.php');
	Session::checkLogin(); // gọi hàm check login để ktra session
	include_once('../config/database.php');
	include_once('../helpers/format.php');
?>



<?php 
	/**
	* 
	*/
	trait LoginModel
	{
		private $db;
		private $fm;
        public $AdminId;
        public $AdminName;
        public $AdminUser;
        public $AdminEmail;
        public $AdminPass;
        public $Status;
        
		public function __construct()
		{
            
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function login_admin(){
            $checkLogin=false;
			$adminEmail = $this->fm->validation($_POST['adminEmail']); //gọi ham validation từ file Format để ktra
			$adminPass = $this->fm->validation($_POST['adminPass']);

			$adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass); //mysqli gọi 2 biến. (adminEmail and link) biến link -> gọi conect db từ file db
			
			if(empty($adminEmail) || empty($adminPass)){
				$checkLogin=false;
				return $checkLogin;
			}else{
				$query = "SELECT * FROM admin WHERE AdminEmail = '$adminEmail' AND AdminPass = '$adminPass' AND Status=1 LIMIT 1 ";
				$result = $this->db->select($query);

				if($result != false){
					//session_start();
					// $_SESSION['login'] = 1;
					//$_SESSION['Email'] = $Email;
					$value = $result->fetch_assoc();
					Session::set('adminlogin', true); // set adminlogin đã tồn tại
					// gọi function Checklogin để kiểm tra true.
					Session::set('adminId', $value['AdminId']);
					Session::set('adminEmail', $value['AdminEmail']);
					Session::set('adminName', $value['AdminName']);
					$_SESSION['Id'] = $value['AdminId'];
					$checkLogin=true;
                    return $checkLogin;
				}else {
					$checkLogin=false;
					return $checkLogin;
				}
			}


		}
	}
 ?>