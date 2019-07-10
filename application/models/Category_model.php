<?php
include_once('Crud_model.php');
class Category_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "categories";
		parent::__construct();

	}

	public function get_sub_categories($id,$offset)
	{
		$this->db->select("*");
		$this->db->from('categories');
		$this->db->where("parent",$id);
		$this->db->order_by("disp_odr","ASC");
		$this->db->limit(1);
		$this->db->offset($offset);
		$res = $this->db->get()->row();
		return $res;
	}

	public function latestCategories()
	{
		$this->db->select("*");
		$this->db->from('categories');
		$this->db->order_by("cat_id","DESC");
		$res = $this->db->get()->row();
		return $res;
	}
		


}


?>