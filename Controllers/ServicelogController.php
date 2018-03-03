<?php

class ServicelogController
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

	public function Add($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		
		$order_model = new M_Order();
		$order = $order_model->get_by_id($id);
		
		
		if($order == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		if($_POST)
		{
			$new_row = array(
				"order_id" => $id,
				"employe_id" => $_POST['employe_id'],
				"hours_worked" => $_POST['hours_worked'],
				"note" => $_POST['note'],
				"created_at" => new DateTime("now"),
				"updated_at" => new DateTime("now")
			);
			$service_log = new M_Employee_Work_Details();
			$service_log->add($new_row);
			$_SESSION['FLASH_SUCCESS'] = "Service log added successfully...!";
			redirect_to(array("Orders" , "All"));
			return;
		}
		else
		{
			$order['service'] = (new M_Service())->get_by_id($order['service_id']);
			$order['customer'] = (new M_Customer())->get_by_id($order['customer_id']);
			$order['status_text'] = $order_model->status_at($order['status']);
			
			$model = array();
			$model['page_title'] = "New Service log";
			$model['employes'] = (new M_Employee())->all();
			$model['order'] = $order;
			include('./Views/Servicelog_Add_Form.php');
		}
	}
	
	public function Edit($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$servicelog_model = new M_Employee_Work_Details();
		$order_model = new M_Order();
		
		$row_to_edit = $servicelog_model->get_by_id($id);
		$order = $order_model->get_by_id($row_to_edit['order_id']);
		
		if($_POST)
		{
			$new_row = array(
				"order_id" => $row_to_edit['order_id'],
				"employe_id" => $_POST['employe_id'],
				"hours_worked" => $_POST['hours_worked'],
				"note" => $_POST['note'],
				"updated_at" => new DateTime("now")
			);
			if($servicelog_model->update($id, $new_row))
			{
				$_SESSION['FLASH_SUCCESS'] = "Service log updated successfully...!";
				redirect_to(array("Servicelog" , "All" , $row_to_edit['order_id']));
				return;
			}
		}
		else
		{
			$model = array();
			$model['row'] = $row_to_edit;
			$order['service'] = (new M_Service())->get_by_id($order['service_id']);
			$order['customer'] = (new M_Customer())->get_by_id($order['customer_id']);
			$order['status_text'] = $order_model->status_at($order['status']);
			
			$model['employes'] = (new M_Employee())->all();
			$model['order'] = $order;
			$model['page_title'] = "Edit Service";
			include('./Views/Servicelog_Edit_Form.php');
		}
	}
	
	public function Delete($id)
	{
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$model = new M_Employee_Work_Details();
		$row_to_delete = $model->get_by_id($id);
		if($row_to_delete == null)
		{
			$_SESSION['FLASH_ERROR'] = "Unable to find the log...!";
			redirect_to(array("Servicelog" , "All", $row_to_delete['order_id']));
			return;
		}
		
		if($model->del($row_to_delete['id'])){
			$_SESSION['FLASH_SUCCESS'] = "log deleted successfully...!";
			redirect_to(array("Servicelog" , "All", $row_to_delete['order_id']));
			return;
		}
		else
		{
			$_SESSION['FLASH_ERROR'] = "Error while deleting the log...!";
			redirect_to(array("Servicelog" , "All", $row_to_delete['order_id']));
			return;
		}
	}
	
	
	public function All($id)
	{
		$service_log_model = new M_Employee_Work_Details();
		
		if($id == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		
		$order_model = new M_Order();
		$order = $order_model->get_by_id($id);
		
		
		if($order == null)
		{
			redirect_to("Dashboard");
			return;
		}
		
		$employe_model = new M_Employee();
		
		$model = array();
		$model['rows'] = $service_log_model->get_by_order_id($id);
		include('./Views/Servicelog_All.php');
	}
}


?>