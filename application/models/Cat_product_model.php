<?php
include_once('Crud_model.php');
class Cat_product_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "ingredients";
		parent::__construct();

	}


}


?>