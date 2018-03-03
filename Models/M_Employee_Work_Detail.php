<?php
/**
* 
*/
class M_Employee_Work_Details
{
	private $table_name;
	function __construct()
	{
		$this->table_name = "work_details";
	}
	
	public function all()
	{
		return DB::query("SELECT * FROM " . $this->table_name);
	}
	public function total_hours()
	{
		return DB::queryFirstRow("SELECT SUM(hours_worked) as total FROM " . $this->table_name)['total'];
	}
	public function add($new_employee)
	{
		return DB::insert($this->table_name , $new_employee );
	}
	public function update($id , $updated_employee){
		return DB::update($this->table_name, $updated_employee, "id=%s", $id);
	}
	public function get_by_id($id)
	{
		return DB::queryFirstRow("SELECT * FROM ".$this->table_name." WHERE id=%s", $id);
	}
	
	public function get_by_order_id($id)
	{
		return DB::query("SELECT * FROM ".$this->table_name." WHERE order_id=%s order by created_at DESC", $id);
	}
	public function get_total_hours_by_order($id)
	{
		return DB::queryFirstRow("SELECT SUM(hours_worked) as total FROM ".$this->table_name." WHERE order_id=%s", $id);
	}
	public function get_total_hours_by_employe($id)
	{
		return DB::queryFirstRow("SELECT SUM(hours_worked) as total FROM ".$this->table_name." WHERE employe_id=%s", $id);
	}
	
	public function del($id)
	{
		return DB::query("DELETE FROM ".$this->table_name." WHERE id=%s", $id);
	}
}


?>