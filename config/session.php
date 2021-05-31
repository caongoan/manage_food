<?php
/**
*Session Class
**/
// init khởi tạo file session
class Session{
 public static function init(){
  if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
            session_start();
        }
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
 }

 public static function set($key, $val){
    $_SESSION[$key] = $val;
 }
//set key thành giá trị

 public static function get($key){
    if (isset($_SESSION[$key])) {
     return $_SESSION[$key];
    } else {
     return false;
    }
 }

 public static function checkSession(){
    self::init();
    if (self::get("adminlogin")== false) {
     self::destroy();
     header("location:index.php?controller=login");
    }
 }
//check phiên làm việc có tồn tại hay không
 public static function checkLogin(){
    self::init();
    if (self::get("adminlogin")== true) {
     header("location:index.php?controller=Home&action=index");
    }
 }

 public static function destroy(){
  session_destroy();
  header("location:index.php?controller=login");
 }
}
?>
