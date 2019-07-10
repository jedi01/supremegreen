<?php
include_once('Crud_model.php');
class Order_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "orders";
		parent::__construct();

	}




	



}


?>