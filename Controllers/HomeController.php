<?php

class HomeController
{
	private $model;
	function __construct()
	{
		
	}

	public function get()
	{
		$model = array();
		include('./Views/LoginView.php');
	}
	
	public function Login(){
		if($_POST){
			$user_model = new M_User();
			$email = $_POST['email'];
			$password = sha1($_POST['password']);
			$user = $user_model->user_login($email , $password);
			if($user == null)
			{
				$_SESSION['FLASH_MESSAGE'] = "Invalid Email Or Password...!";
				redirect_to("Home");
			}
			else
			{
				$_SESSION['logined'] = true;
				$_SESSION['user'] = $user;
				redirect_to("Dashboard");
			}
		}
	}
	public function Logout(){
		session_destroy();
		redirect_to("Home");
	}
}


?>