<?php

class ErrorController
{
	private $model;
	function __construct()
	{
		$this->model = new HomeModel();
		$this->model->title = "Welcome to simple MVC Framework";
		$this->model->page_content = "this is just a simple text and this is alway long and long as long as long and this is goinf to be long and a llot of long and you may be thining how long it gonna be but this is going to be long and please be aware of this long and long application text and thank you for reading...!";
		$this->model->contact_info = "this is a sample of the text";
	}

	public function NotFound()
	{
		$model = array(
			'message' => 'Sorry we are unable to find what page you want to see.' 
		);
		include('./Views/Error/404.php');
	}
	public function Blank()
	{
		$model = array(
			'message' => 'Sorry we are unable to find what page you want to see.' 
		);
		include('./Views/BlankView.php');
	}
}


?>