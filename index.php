<?php 
error_reporting(-1);


// Loading Application Configurations
include("Configs/App.php");
include("Configs/Database.php");


// Loading Application Libraries
include("Libraries/DatabaseLib.php");
include("Libraries/Helper.php");


// Initiating Database
Init_Database();


// Loading Models
foreach (glob("Models/*.php") as $filename)
{
    include_once $filename;
}




$page = (isset($_REQUEST['path'])) ? htmlspecialchars($_REQUEST['path']) : 'Home';
$action = (isset($_REQUEST['action'])) ? htmlspecialchars($_REQUEST['action']) : 'get';
$parameter = (isset($_REQUEST['parameter'])) ? htmlspecialchars($_REQUEST['parameter']) : '';

if($page == '')
{
	header('Location:' . URL_PREFIX . "/Home");
	die();
}


$routes = array(
	'Home'				=>	'HomeController',
	'Error' 			=>	'ErrorController',
	'Dashboard' 		=>	'DashboardController',
	'Users' 			=>	'UsersController',
	'Departments'		=>	'DepartController',
	'Employes'			=>	'EmployeController',
	'Customers'			=>	'CustomerController',
	'Orders'			=>	'OrderController',
	'Services'			=>	'ServiceController',
	'Servicelog'		=>	'ServicelogController'
);

if(!isset($routes[$page])){
	redirect_to(array("Error","NotFound"));
	die();
}

include ('./Controllers/'.$routes[$page].'.php');
session_start();
$controller = new $routes[$page]();

if(method_exists($controller , $action))
{
	if(isset($action) && $parameter != ''){
		$controller->$action($parameter);
	}
	else if(isset($action)){
		$controller->$action();
	}
}
else {
	redirect_to(array("Error","NotFound"));
	die();
}
?>