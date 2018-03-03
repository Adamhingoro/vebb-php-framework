<?php

class CustomerController
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
				"email" => $_POST['email'],
				"company" => $_POST['company'],
				"description" => $_POST['desc'],
				"created_by" => $_SESSION['user']['id'],
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			);
			
			$customer_model = new M_Customer();
			$customer_model->add($new_row);
			$_SESSION['FLASH_SUCCESS'] = "New customer added successfully...!";
			redirect_to(array("Customers" , "Add"));
			return;
		}
		else
		{
			$model = array();
			$model['page_title'] = "New Customer";
			include('./Views/Customers_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$customer_model = new M_Customer();
		$customer_to_edit = $customer_model->get_by_id($id);
		
		if($_POST)
		{
			
			$new_row = array(
				"name" => $_POST['fullname'],
				"email" => $_POST['email'],
				"company" => $_POST['company'],
				"description" => $_POST['desc'],
				"updated_at" => new DateTime("now")
			);
			if($customer_model->update($id , $new_row))
			{
				$_SESSION['FLASH_SUCCESS'] = "Customer updated successfully..!";
				redirect_to(array("Customers" , "Edit" , $id));
				return;
			}
			else
			{
				$_SESSION['FLASH_ERROR'] = "Error while updating customer..!";
				redirect_to(array("Customers" , "Edit" , $id));
				return;
			}
		}
		else {
			$model = array();
			$model['page_title'] = "Edit Customer";
			$model['customer'] = $customer_to_edit;
			include('./Views/Customers_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$model = new M_Customer();
		$row_to_delete = $model->get_by_id($id);
		if($row_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the customer...!";
			redirect_to(array("Customers" , "All"));
			return;
		}
		
		if($model->del($row_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "Customer deleted successfully...!";
			redirect_to(array("Customers" , "All"));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the customer...!";
			redirect_to(array("Customers" , "All"));
			return;
		}
	}
	
	
	public function All()
	{
		$customer_model = new M_Customer();
		$all_customers = $customer_model->all();
		
		$model = array();
		
		$model['customers'] = $all_customers;
		include('./Views/Customers_All.php');
	}
}


?>