<?php
/**
* 
*/
class M_Order
{
	private $table_name;
	private $order_statues;
	function __construct()
	{
		$this->table_name = "customer_services_rel";
		$this->order_statues = array(
			1 => "Just Ordered",
			2 => "Not Allocated",
			3 => "Under Progress",
			4 => "Done",
			5 => "Payment Pending",
			6 => "Completed",
			7 => "Cancled"
		);
	}
	
	public function statues(){
		return $this->order_statues;
	}
	
	public function status_at($id)
	{
		return $this->order_statues[$id];
	}
	
	public function all()
	{
		return DB::query("SELECT * FROM " . $this->table_name);
	}
	public function count_all()
	{
		return DB::queryFirstRow("SELECT COUNT(*) as total FROM " . $this->table_name)['total'];
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
	public function del($id)
	{
		return DB::query("DELETE FROM ".$this->table_name." WHERE id=%s", $id);
	}
}


?>