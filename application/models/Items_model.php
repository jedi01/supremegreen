<?php
include_once('Crud_model.php');
class Items_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "product_items";
		parent::__construct();

	}

}


?>