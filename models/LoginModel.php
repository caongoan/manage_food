<?php 
	trait LoginModel{
		//ham kiem tra dang nhap
		public function modelCheckLogin(){
			$email = $_POST["email"];
			$password = $_POST["password"];
			//ma hoa password bang ham md5
			$password = md5($password);
			//truy van csdl
			$check = DB::fetch("select users.email, users.password from users where email=:email and password=:password",["email"=>$email,"password"=>$password]);
			if($check->email == $email && $check->password==$password){
				//dang nhap thanh cong
				//set session
				$_SESSION["admin_email"]=$email;
			}
			//quay tro lai trang index
			header("location:index.php");
		}
	}
 ?>