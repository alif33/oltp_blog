<?php
class Session{
	 public static function init(){
	 	session_start();
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }
 //--------For admin------------
	 public static function checkSession(){
	 	self::init();
	 	if (self::get("adminlogin") == false) {
	 		self::destroy();
	 		header("Location:login.php");
	 	}
	 }

	 public static function checkLogin(){
	 	self::init();
	 	if (self::get("adminlogin") == true) {
	 		header("Location:dashbord.php");
	 	}
	 }

	 public static function destroy(){
	 	session_destroy();
	 	header("Location:dashbord.php");
	 }
 //--------For admin------------
	public static function check_cus_Login(){
		if (self::get("cmrlogin") == true) {
		header("Location:order.php");
		}
	}
	public static function cus_destroy(){
		session_destroy();		
		header("Location:login.php");
	}	


}

?>