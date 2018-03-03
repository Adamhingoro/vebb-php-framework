<?php

class DashboardController
{
	private $model;
	function __construct()
	{
		if(!isset($_SESSION['logined']) && $_SESSION['logined'] != true)
		{
			$_SESSION['FLASH_MESSAGE'] = "Access denied...!";
			redirect_to("Home");
			die();
		}
	}
	public function get()
	{
		$model = $this->model;
		$model['total_employes'] = (new M_Employee())->count_all();
		$model['total_orders'] = (new M_Order())->count_all();
		$model['total_hours'] = (new M_Employee_Work_Details())->total_hours();
		include('./Views/Dashboard.php');
	}

}


?>