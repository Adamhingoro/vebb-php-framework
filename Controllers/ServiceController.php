<?php

class ServiceController
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
			$new_row = array(
				"name" => $_POST['fullname'],
				"price" => $_POST['price'],
				"description" => $_POST['desc'],
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			);
			$users_model = new M_Service();
			$users_model->add($new_row);
			$_SESSION['FLASH_SUCCESS'] = "New Service added successfully...!";
			redirect_to(array("Services" , "Add"));
			return;
		}
		else
		{
			$model = array();
			$model['page_title'] = "New Service";
			include('./Views/Service_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$model = new M_Service();
		$row_to_edit = $model->get_by_id($id);
		
		if($_POST)
		{
			$new_row = array(
				"name" => $_POST['fullname'],
				"price" => $_POST['price'],
				"description" => $_POST['desc'],
				"updated_at" => new DateTime("now")
			);
			if($model->update($id, $new_row))
			{
				$_SESSION['FLASH_SUCCESS'] = "Service updated successfully...!";
				redirect_to(array("Services" , "Edit" , $id));
				return;
			}
		}
		else
		{
			$model = array();
			$model['row'] = $row_to_edit;
			$model['page_title'] = "Edit Service";
			include('./Views/Service_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$model = new M_Service();
		$row_to_delete = $model->get_by_id($id);
		if($row_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the service...!";
			redirect_to(array("Services" , "All"));
			return;
		}
		
		if($model->del($row_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "Service deleted successfully...!";
			redirect_to(array("Services" , "All"));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the service...!";
			redirect_to(array("Services" , "All"));
			return;
		}
	}
	
	
	public function All()
	{
		$model = new M_Service();
		$all_rows = $model->all();
		
		$model = array();
		$model['rows'] = $all_rows;
		include('./Views/Service_All.php');
	}
}


?>