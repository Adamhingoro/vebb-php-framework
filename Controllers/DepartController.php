<?php

class DepartController
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
			$new_department = array(
				"name" => $_POST['fullname'],
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			);
			
			$depart_model = new M_Department();
			$depart_model->add($new_department);
			$_SESSION['FLASH_SUCCESS'] = "New Department added successfully...!";
			redirect_to(array("Departments" , "Add"));
			return;
		}
		else
		{
			$model = array();
			$model['page_title'] = "New Department";
			include('./Views/Depart_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$depart_model = new M_Department();
		$depart_to_edit = $depart_model->get_by_id($id);
		
		if($_POST)
		{
			$new_department = array(
				"name" => $_POST['fullname'],
				"updated_at" => new DateTime("now")
			);
			
			if($depart_model->update($id , $new_department))
			{
				$_SESSION['FLASH_SUCCESS'] = "Department updated successfully..!";
				redirect_to(array("Departments" , "Edit" , $id));
				return;
			}
			else
			{
				$_SESSION['FLASH_ERROR'] = "Error while updating department..!";
				redirect_to(array("Departments" , "Edit" , $id));
				return;
			}
		}
		else {
			$model = array();
			$model['page_title'] = "Edit Department";
			$model['depart'] = $depart_to_edit;
			include('./Views/Depart_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$depart_model = new M_Department();
		$depart_to_delete = $depart_model->get_by_id($id);
		if($depart_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the department...!";
			redirect_to(array("Departments" , "All"));
			return;
		}
		
		if($depart_model->del($depart_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "Department deleted successfully...!";
			redirect_to(array("Departments" , "All"));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the department...!";
			redirect_to(array("Departments" , "All"));
			return;
		}
	}
	
	
	public function All()
	{
		$depart_model = new M_Department();
		$all_departments = $depart_model->all();
		
		$model = array();
		
		$model['departs'] = $all_departments;
		include('./Views/Depart_All.php');
	}
}


?>