<?php 
	trait ProductsModel{
		//lay nhieu ban ghi
		public function modelRead($from, $recordPerPage){
			//goi ham de lay ket qua
			$data = DB::fetchAll("select * from products order by id desc limit $from,$recordPerPage");
			return $data;
		}
		//dem so luong ban ghi trong table users
		public function modelTotalRecord(){
			$total = DB::rowCount("select id from products");
			return $total;
		}
		//edit
		public function modelEdit($id){			
			//lay mot ban ghi
			$record = DB::fetch("select * from products where id=:record_id",["record_id"=>$id]);
			return $record;
		}
		//editPost
		public function modelEditPost($id){
			$name = $_POST["name"];
			$price = $_POST["price"];
			$discount = $_POST["discount"];
			$category_id = $_POST["category_id"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"]) ? 1 : 0;
			//update ban ghi
			DB::execute("update products set name=:_name,discount=:_discount, price=:_price, category_id=:_category_id,description=:_description,content=:_content,hot=:_hot where id=:_id",["_name"=>$name,"_discount"=>$discount,"_price"=>$price,"_category_id"=>$category_id,"_description"=>$description,"_content"=>$content,"_hot"=>$hot,"_id"=>$id]);
			//neu user chon anh thi thuc hien upload
			if($_FILES["photo"]["name"] != ""){
				//-----------
				//lay anh cu (neu co) de xoa
				$oldImg = DB::fetch("select photo from products where id=$id");
				if(isset($oldImg->photo)&&file_exists("../frontend/assets/upload/products/".$oldImg->photo)){
					//xoa anh
					unlink("../frontend/assets/upload/products/".$oldImg->photo);//ham unlink su dung de xoa file
				}
				//-----------
				//lay ten file
				$photo = $_FILES["photo"]["name"];
				//gan them chuoi thoi gian de cac anh khong trung ten nhau luc upload
				$photo = time().$photo;
				//upload anh
				move_uploaded_file($_FILES["photo"]["tmp_name"], "../frontend/assets/upload/products/$photo");
				//update ban ghi
				DB::execute("update products set photo=:_photo where id=:_id",["_photo"=>$photo,"_id"=>$id]);
			}
		}
		//addPost
		public function modelAddPost(){
			$name = $_POST["name"];
			$price = $_POST["price"];
			$discount = $_POST["discount"];
			$category_id = $_POST["category_id"];
			$description = $_POST["description"];
			$content = $_POST["content"];
			$hot = isset($_POST["hot"]) ? 1 : 0;
			$photo = "";
			//neu user chon anh thi thuc hien upload
			if($_FILES["photo"]["name"] != ""){
				//lay ten file
				$photo = $_FILES["photo"]["name"];
				//gan them chuoi thoi gian de cac anh khong trung ten nhau luc upload
				$photo = time().$photo;
				//upload anh
				move_uploaded_file($_FILES["photo"]["tmp_name"], "../frontend/assets/upload/products/$photo");
			}
			//update ban ghi
			DB::execute("insert into products set name=:_name,discount=:_discount, price=:_price, category_id=:_category_id,description=:_description,content=:_content,hot=:_hot,photo=:_photo",["_name"=>$name,"_discount"=>$discount,"_price"=>$price,"_category_id"=>$category_id,"_description"=>$description,"_content"=>$content,"_hot"=>$hot,"_photo"=>$photo]);
		}
		//deletePost
		public function modelDeletePost($id){	
			//-----------
			//lay anh cu (neu co) de xoa
			$oldImg = DB::fetch("select photo from products where id=$id");
			if(isset($oldImg->photo)&&file_exists("../frontend/assets/upload/products/".$oldImg->photo)){
				//xoa anh
				unlink("../frontend/assets/upload/products/".$oldImg->photo);//ham unlink su dung de xoa file
			}
			//-----------		
			//delete record
			DB::execute("delete from products where id=:_id",["_id"=>$id]);
		}
	}
 ?>