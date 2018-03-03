<?php
/**
* 
*/
class M_Employee
{
	private $table_name;
	function __construct()
	{
		$this->table_name = "employes";
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
	public function get_name($id)
	{
		return $this->get_col($id , "name");
	}
	public function get_department($id)
	{
		return (new M_Department())->get_name($this->get_col($id , "department"));
	}
	public function get_email($id)
	{
		return $this->get_col($id , "email");
	}
	public function get_image($id)
	{
		return $this->get_col($id , "image");
	}
	public function get_col($id , $col_nname)
	{
		$row = $this->get_by_id($id);
		if(isset($row[$col_nname])){
			return $row[$col_nname];
		}
		else {
			return null;
		}
	}
}


?>