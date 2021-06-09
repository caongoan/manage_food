<?php 
	//load file model
	include_once "models/AccountModel.php";
	class AccountController extends Controller{
		use AccountModel;
		public function indexChangePass(){
			$this->loadView("ChangePassword.php");
		}
		
		public function ChangePassword(){
			$OldPass=$_POST['OldPass'];
            $NewPass=$_POST['NewPass'];
            $RetypePass=$_POST['RetypePass'];
			$update=$this->update_admin($OldPass,$NewPass,$RetypePass);
			return $update;
		}
		public function Profile(){
			$this->loadView("Profile.php");
		}
	}
 ?>