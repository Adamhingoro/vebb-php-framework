<?php

class OrderController
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
				"customer_id" => $_POST['customer_id'],
				"service_id" => $_POST['service_id'],
				"status" => '1',
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			);
			$users_model = new M_Order();
			$users_model->add($new_row);
			$_SESSION['FLASH_SUCCESS'] = "New Order added successfully...!";
			redirect_to(array("Orders" , "Add"));
			return;
		}
		else
		{
			$model = array();
			$model['page_title'] = "New Order";
			$model['customers'] = (new M_Customer())->all();
			$model['services'] = (new M_Service())->all();
			include('./Views/Order_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$order_model = new M_Order();
		$row_to_edit = $order_model->get_by_id($id);
        
		if($_POST)
		{
			$new_row = array(
				"status" => $_POST['status_id'],
				"updated_at" => new DateTime("now")
			);
			if($order_model->update($id, $new_row))
			{
				$_SESSION['FLASH_SUCCESS'] = "Order updated successfully...!";
				redirect_to(array("Orders" , "Edit" , $id));
				return;
			}
		}
		else
		{
			$model = array();
			$row_to_edit['service'] = (new M_Service())->get_by_id($row_to_edit['service_id']);
			$row_to_edit['customer'] = (new M_Customer())->get_by_id($row_to_edit['customer_id']);
			$row_to_edit['status_text'] = $order_model->status_at($row_to_edit['status']);
			
			$model['statues'] = $order_model->statues();
			$model['row'] = $row_to_edit;
			$model['page_title'] = "Edit Order";
			include('./Views/Order_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$model = new M_Order();
		$row_to_delete = $model->get_by_id($id);
		if($row_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the order...!";
			redirect_to(array("Orders" , "All"));
			return;
		}
		
		if($model->del($row_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "Order deleted successfully...!";
			redirect_to(array("Orders" , "All"));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the order...!";
			redirect_to(array("Orders" , "All"));
			return;
		}
	}
	
	
	public function All()
	{
		$order_model = new M_Order();
		
		$customers_model = new M_Customer();
		$services_model = new M_Service();
		
		$all_rows = $order_model->all();
		
		$servicelog_model = new M_Employee_Work_Details();
		$model = array();
		$model['rows'] = $all_rows;
		include('./Views/Order_All.php');
	}
}


?>