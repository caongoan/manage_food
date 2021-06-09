<?php
include "../config/session.php";
include_once "models/LoginModel.php";
class LoginController extends Controller
{
	use LoginModel;
	//ke thua class LoginModel
	public function index()
	{
		//load view
		$this->loadView("login.php");
	}
	//khi an nut submit -> se den action=checkLogin
	public function checkLogin()
	{		//goi ham modelCheckLogin de kiem tra	
		$check = $this->login_admin();
		if ($check) {
			header("Location:/manage_food/admin/index.php?controller=Home&action=index");
		} else {
			return "Tên đăng nhập hoặc mật khẩu không chính xác";
		}
	}
	//ham thuc hien dang xuat
	public function logOut()
	{
		//huy session
		Session::destroy();
		header("Location:/manage_food/admin/index.php?controller=login");
	}
	public function register()
	{
		$this->loadView("Register.php");
	}
	public function AddAdmin()
	{
		    $AdminName=$_POST['AdminName'];
            $StoreName=$_POST['StoreName'];
            $AdminEmail=$_POST['AdminEmail'];
            $AdminPass=$_POST['AdminPass'];
			$Address=$_POST['Address'];
			$RetypePass=$_POST['RetypePass'];
			$add=$this->insert_admin($AdminName,$StoreName,$AdminEmail,$AdminPass,$Address,$RetypePass);
			return $add;
	}
	
}
