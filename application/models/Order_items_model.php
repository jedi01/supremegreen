<?php
include_once('Crud_model.php');
class Order_items_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "order_items";
		parent::__construct();

	}

	public function checkIngredients($id)
	{
		$this->db->select();
		$this->db->from($this->table);
		$this->db->like("order_items",$id,'both',false);
		$query = $this->db->get();
		return $query->result_array();
	}

	


}


?>