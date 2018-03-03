<?php
/**
* 
*/
class M_User
{
	private $table_name;
	private $roles;
	function __construct()
	{
		$this->table_name = "users";
		$this->roles = array(
			0	=>	"superadmin",
			1	=>	"salesmanager",
			2	=>	"hrmanager",
		);
	}
	
	public function get_role_name($id)
	{
		return $this->roles[$id];
	}
	
	public function all()
	{
		return DB::query("SELECT * FROM " . $this->table_name);
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
	
	public function user_login($email , $password)
	{
		return DB::queryFirstRow("SELECT * FROM ".$this->table_name." WHERE email= %s and password = %s", $email , $password);
	}
}


?>