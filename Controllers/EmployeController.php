<?php

class EmployeController
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
			$verifyimg = getimagesize($_FILES['upload_image']['tmp_name']);
			if($verifyimg['mime'] != 'image/png' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/jpg' && $verifyimg['mime'] != 'image/gif') {
				$_SESSION['FLASH_ERROR'] = "Only PNG/JPG/JPEG/GIF images are allowed!";
				redirect_to(array("Employes" , "Edit" , $id));
				return;
			}
			
			$uploaddir = 'Uploads/';
			$image_name= md5(date("Y-M-D H I S")).  basename($_FILES['upload_image']['name']);
			$uploadfile = $uploaddir . $image_name;
			
			if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile)) {
				$new_employe = array(
					"name" => $_POST['fullname'],
					"email" => $_POST['email'],
					"address" => $_POST['address'],
					"summary" => $_POST['summary'],
					"department" => $_POST['department'],
					"image" => $image_name,
					"created_at" => new DateTime("now"),
					"updated_at" => new DateTime("now")
				);
				$users_model = new M_Employee();
				$users_model->add($new_employe);
				$_SESSION['FLASH_SUCCESS'] = "New Employe added successfully...!";
				redirect_to(array("Employes" , "Add"));
				return;
			} else {
				$_SESSION['FLASH_ERROR'] = "Error while uploading image...!";
				redirect_to(array("Employes" , "Edit" , $id));
				return;
			}
		}
		else
		{
			$model = array();
			$model['page_title'] = "New Employe";
			$model['departments'] = (new M_Department())->all();
			include('./Views/Employe_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$employe_model = new M_Employee();
		$employe_to_edit = $employe_model->get_by_id($id);
		
		if($_POST)
		{
			$image_name = $employe_to_edit['image'];
			if(isset($_FILES['upload_image'])&& $_FILES['upload_image']['size'] > 0)
			{
				$verifyimg = getimagesize($_FILES['upload_image']['tmp_name']);
				if($verifyimg['mime'] != 'image/png' && $verifyimg['mime'] != 'image/jpeg' && $verifyimg['mime'] != 'image/jpg' && $verifyimg['mime'] != 'image/gif') {
					$_SESSION['FLASH_ERROR'] = "Only PNG/JPG/JPEG/GIF images are allowed!";
					redirect_to(array("Employes" , "Edit" , $id));
					return;
				}
				
				$uploaddir = 'Uploads/';
				$image_name= md5(date("Y-M-D H I S")).  basename($_FILES['upload_image']['name']);
				$uploadfile = $uploaddir . $image_name;
				
				if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploadfile)) {
					$new_employe = array(
						"image" => $image_name
					);
					$employe_model->update($id, $new_employe);
				} else {
					$_SESSION['FLASH_ERROR'] = "Error while uploading image...!";
					redirect_to(array("Employes" , "Edit" , $id));
					return;
				}
			}
			$new_employe = array(
				"name" => $_POST['fullname'],
				"email" => $_POST['email'],
				"address" => $_POST['address'],
				"summary" => $_POST['summary'],
				"department" => $_POST['department'],
				"image" => $image_name,
				"updated_at" => new DateTime("now")
			);
			if($employe_model->update($id, $new_employe))
			{
				$_SESSION['FLASH_SUCCESS'] = "Employe deleted successfully...!";
				redirect_to(array("Employes" , "All"));
				return;
			}
		}
		else
		{
			$model = array();
			$model['employe'] = $employe_to_edit;
			$model['page_title'] = "New Employe";
			$model['departments'] = (new M_Department())->all();
			include('./Views/Employe_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$employe_model = new M_Employee();
		$employe_to_delete = $employe_model->get_by_id($id);
		if($employe_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the employe...!";
			redirect_to(array("Employes" , "All"));
			return;
		}
		
		if($employe_model->del($employe_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "Employe deleted successfully...!";
			redirect_to(array("Employes" , "All"));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the employe...!";
			redirect_to(array("Employes" , "All"));
			return;
		}
	}
	
	
	public function All()
	{
		$employee_model = new M_Employee();
		$all_employes = $employee_model->all();
		
		$departments_model = new M_Department();
		$servicelog_model = new M_Employee_Work_Details();
		$model = array();
		$model['employes'] = $all_employes;
		include('./Views/Employe_All.php');
	}
}


?>