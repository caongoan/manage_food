<?php

include_once('../config/database.php');
include_once('../helpers/format.php');

?>
<?php
trait AccountModel
{
    //lay nhieu ban ghi
    public function __construct()
    {
        $this->id = $_SESSION['adminId'];
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function update_admin($OldPass, $NewPass, $RetypePass)
    {
        $OldPass = $this->fm->validation($OldPass); //gọi ham validation từ file Format để ktra
        $OldPass = mysqli_real_escape_string($this->db->link, $OldPass);
        $NewPass = $this->fm->validation($NewPass); //gọi ham validation từ file Format để ktra
        $NewPass = mysqli_real_escape_string($this->db->link, $NewPass);
        $RetypePass = $this->fm->validation($RetypePass); //gọi ham validation từ file Format để ktra
        $RetypePass = mysqli_real_escape_string($this->db->link, $RetypePass);
        //mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

        if (empty($OldPass) || empty($NewPass) || empty($RetypePass)) {
            $alert = "<span class='error'>Danh mục không được để trống</span>";
            return $alert;
        } else {
            if ($NewPass != $RetypePass) {
                $alert = "<span class='error'>Mật khẩu phải trùng nhau</span>";
                return $alert;
            } else {
                $OldPass = md5($OldPass);
                $NewPass = md5($NewPass);
                $query = "select *from admin where AdminPass='$OldPass' and AdminId='$this->id'";
                $result = $this->db->select($query);
                if ($result == false) {
                    $alert = "<span class='error'>Mật khẩu không chính xác";
                    return $alert;
                } else {
                    $query = "Update admin set AdminPass='$NewPass' where AdminId='$this->id' ";
                    $result = $this->db->update($query);
                    if ($result) {
                        $alert = "<span class='success'>Đổi mật khẩu thành công</span>";
                        return $alert;
                    } else {
                        $alert = "<span class='error'>Đổi mật khẩu thất bại</span>";
                        return $alert;
                    }
                }
            }
        }
    }
    public function profile_detail()
    {
        $query = "SELECT * FROM admin WHERE AdminId='+$this->id+'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_image($files)
	{
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['images']['name'];
        $file_size = $_FILES['images']['size'];
		$file_temp = $_FILES['images']['tmp_name'];
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_images = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_images = "uploads/".$unique_images;
		
				if ($file_size > 2048000) {

					$alert = "<span class='success'>Dung lương ảnh phải dưới 2MB !</span>";
				   return $alert;
				   } 
				   elseif (in_array($file_ext, $permited) === false) 
				   {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				   $alert = "<span class='success'>Bạn chỉ có thể đăng:-".implode(', ', $permited)."</span>";
				   return $alert;
				   }
				   move_uploaded_file($file_temp,$uploaded_images);
				$query = "UPDATE Admin set images='$unique_images' where AdminId='$this->id' ";
				$result = $this->db->update($query);
				if ($result) {
					$alert = "<span class='success'>Cập nhật ảnh đại diện thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Cập nhật ảnh đại diện thất bại</span>";
					return $alert;
				}
	}
}
?>