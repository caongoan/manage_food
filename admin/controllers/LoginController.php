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
	{
		//goi ham modelCheckLogin de kiem tra
		
		$check = $this->login_admin();
		if ($check) {
			header("Location:/manage_food/admin/index.php?controller=Home&action=index");
		} else {
			header("Location:/manage_food/admin/index.php?controller=login");
		}
	}
	//ham thuc hien dang xuat
	public function logOut()
	{
		//huy session
		Session::destroy();
		header("Location:/manage_food/admin/index.php?controller=login");
	}
}
