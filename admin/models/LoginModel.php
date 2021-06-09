<?php
include_once('../config/session.php');
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
	public function login_admin()
	{
		$checkLogin = false;
		$adminEmail = $this->fm->validation($_POST['adminEmail']); //gọi ham validation từ file Format để ktra
		$adminPass = $this->fm->validation($_POST['adminPass']);

		$adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass); //mysqli gọi 2 biến. (adminEmail and link) biến link -> gọi conect db từ file db
		$adminPass = md5($adminPass);
		if (empty($adminEmail) || empty($adminPass)) {
			return $checkLogin;
		} else {
			$query = "SELECT * FROM admin WHERE AdminEmail = '$adminEmail' AND AdminPass = '$adminPass' AND Status=1 LIMIT 1 ";
			$result = $this->db->select($query);

			if ($result != false) {
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
				$checkLogin = true;
				return $checkLogin;
			} else {
				$checkLogin = false;
				return $checkLogin;
			}
		}
	}
	public function insert_admin($AdminName, $StoreName, $AdminEmail, $AdminPass, $Address, $RetypePass)
	{
		$AdminName = $this->fm->validation($AdminName); //gọi ham validation từ file Format để ktra
		$AdminName = mysqli_real_escape_string($this->db->link, $AdminName);
		$StoreName = $this->fm->validation($StoreName); //gọi ham validation từ file Format để ktra
		$StoreName = mysqli_real_escape_string($this->db->link, $StoreName);
		$AdminEmail = $this->fm->validation($AdminEmail); //gọi ham validation từ file Format để ktra
		$AdminEmail = mysqli_real_escape_string($this->db->link, $AdminEmail);
		$AdminPass = $this->fm->validation($AdminPass); //gọi ham validation từ file Format để ktra
		$AdminPass = mysqli_real_escape_string($this->db->link, $AdminPass);
		$Address = $this->fm->validation($Address); //gọi ham validation từ file Format để ktra
		$Address = mysqli_real_escape_string($this->db->link, $Address);
		$RetypePass = $this->fm->validation($RetypePass); //gọi ham validation từ file Format để ktra
		$RetypePass = mysqli_real_escape_string($this->db->link, $RetypePass);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		if (empty($AdminName) || empty($StoreName) || empty($AdminEmail) || empty($AdminPass) || empty($Address) || empty($RetypePass)) {
			$alert = "<span class='error'>Danh mục không được để trống</span>";
			return $alert;
		} else {
			if ($AdminPass != $RetypePass) {
				$alert = "<span class='error'>Mật khẩu phải trùng nhau</span>";
				return $alert;
			} else {
				$AdminPass=md5($AdminPass);
				$query = "select *from admin where AdminEmail='$AdminEmail'";
				$result = $this->db->select($query);
				if ($result != false) {
					$alert = "<span class='error'>Tài khoản đã tồn tại";
					return $alert;
				} else {
					$query = "INSERT INTO admin(AdminName,StoreName,AdminPass, AdminEmail, Address,Status) VALUES ('$AdminName','$StoreName','$AdminPass','$AdminEmail','$Address','1') ";
					$result = $this->db->insert($query);
					if ($result) {
						$alert = "<span class='success'>Tạo tài khoản thành công</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Tạo tài khoản thất bại</span>";
						return $alert;
					}
				}
			}
		}
	}
}
?>