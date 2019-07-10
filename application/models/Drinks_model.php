<?php
include_once('Crud_model.php');
class Drinks_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "drinks";
		parent::__construct();

	}


	public function getDrink($limit = 0,$offset = 0)
	{
		$this->db->select("*");
		$this->db->from($this->table);
		$this->db->limit($limit, $offset);
		$res = $this->db->get()->row();
		return $res;

	}

	
		


}


?>