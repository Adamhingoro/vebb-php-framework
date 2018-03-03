<?php

class UsersController
{
	function __construct()
	{
		if(!isset($_SESSION['logined']) && $_SESSION['logined'] != true)
		{
			$_SESSION['FLASH_MESSAGE'] = "Access denied...!";
			redirect_to("Home");
			die();
		}
	}

	public function Add()
	{
		if($_POST)
		{
			$name = $_POST['fullname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			$role = $_POST['role'];
			
			$new_user = array(
				"name" => $name,
				"email" => $email,
				"password" => sha1($password),
				"role" => $role,
				"created_at" => "CURRENT_TIMESTAMP"
			);
			
			if($password != $cpassword)
			{
				
				$_SESSION['FLASH_ERROR'] = "Password and Confirm password does not match..!";
				redirect_to(array("Users" , "Add"));
				return;
			}
			
			$users_model = new M_User();
			$users_model->add($new_user);
			$_SESSION['FLASH_SUCCESS'] = "New user added successfully...!";
			redirect_to(array("Users" , "Add"));
			return;
		}
		else
		{
			$model = array();
			$model['page_title'] = "New User";
			include('./Views/Users_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$users_model = new M_User();
		$user_to_edit = $users_model->get_by_id($id);
		
		if($_POST)
		{
			$name = $_POST['fullname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			$role = $_POST['role'];
			
			$new_user = array(
				"name" => $name,
				"email" => $email,
				"role" => $role
			);
			
			if($password != '' || $cpassword != '')
			{
				if($password == $cpassword)
				{
					$new_user['password'] = sha1($password);
				}
				else
				{
					$_SESSION['FLASH_ERROR'] = "Password and Confirm password does not match..!";
					redirect_to(array("Users" , "Edit" , $id));
					return;
				}
			}
			if($users_model->update($id , $new_user))
			{
				$_SESSION['FLASH_SUCCESS'] = "User updated successfully..!";
				redirect_to(array("Users" , "Edit" , $id));
				return;
			}
			else
			{
				$_SESSION['FLASH_ERROR'] = "Error while updating user..!";
				redirect_to(array("Users" , "Edit" , $id));
				return;
			}
		}
		else {
			$model = array();
			$model['page_title'] = "Edit User";
			$model['user'] = $user_to_edit;
			include('./Views/Users_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$users_model = new M_User();
		$user_to_delete = $users_model->get_by_id($id);
		if($user_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the user...!";
			redirect_to(array("Users" , "All"));
			return;
		}
		
		if($users_model->del($user_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "User deleted successfully...!";
			redirect_to(array("Users" , "All"));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the user...!";
			redirect_to(array("Users" , "All"));
			return;
		}
	}
	
	
	public function All()
	{
		$users_model = new M_User();
		$all_users = $users_model->all();
		
		$model = array();
		
		$model['users'] = $all_users;
		include('./Views/Users_All.php');
	}
}


?>