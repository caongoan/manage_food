<?php 
	trait UsersModel{
		//lay nhieu ban ghi
		public function modelRead($from, $recordPerPage){
			//goi ham de lay ket qua
			$data = DB::fetchAll("select * from users order by id desc limit $from,$recordPerPage");
			return $data;
		}
		//dem so luong ban ghi trong table users
		public function modelTotalRecord(){
			$total = DB::rowCount("select id from users");
			return $total;
		}
		//edit
		public function modelEdit($id){			
			//lay mot ban ghi
			$record = DB::fetch("select * from users where id=:record_id",["record_id"=>$id]);
			return $record;
		}
		//editPost
		public function modelEditPost($id){
			//$email = $_POST["email"];
			$name = $_POST["name"];
			$password = $_POST["password"];
			//update email, name
			DB::execute("update users set name=:_name where id=:_id",["_name"=>$name,"_id"=>$id]);
			//neu user nhap password thi update password
			if($password != ""){
				$password = md5($password);
				DB::execute("update users set password=:_password where id=:_id",["_password"=>$password,"_id"=>$id]);
			}
		}
		//addPost
		public function modelAddPost(){
			$email = $_POST["email"];
			$name = $_POST["name"];
			$password = $_POST["password"];
			//ma hoa password
			$password = md5($password);
			//kiểm tra xem email đã tồn tại trong csdl chưa. nếu chưa tồn tại mới thực hiện insert bản ghi
			$check = DB::fetch("select email from users where email=:_email",["_email"=>$email]);
			if(isset($check->email) == false){
				//update email, name
				DB::execute("insert into users set name=:_name, email=:_email,password=:_password",["_name"=>$name,"_email"=>$email,"_password"=>$password]);
				header("location:index.php?controller=users");
			}
			else
				header("location:index.php?controller=users&action=add&email=exists");	
		}
		//deletePost
		public function modelDeletePost($id){			
			//delete record
			DB::execute("delete from users where id=:_id",["_id"=>$id]);
		}
	}
 ?>