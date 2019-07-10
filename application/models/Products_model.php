<?php
include_once('Crud_model.php');
class Products_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "products";
		parent::__construct();

	}

	public function check_slug($string,$like)
	{
		$this->db->select();
		$this->db->from($this->table);
		$this->db->like($like,$string,'after',false);
		$query = $this->db->get();
		return $query->result_array();

	}
	
	public function checkIngredients($id)
	{
		$this->db->select();
		$this->db->from($this->table);
		$this->db->like("product_items",$id,'both',false);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function updateProductStatus($id,$status)
	{

		$data = array("product_status"=>$status);
		$this->db->like("product_items",$id,'both',false);
		$res = $this->db->update($this->table, $data);
		return $res;
	}



}


?>