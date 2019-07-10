<?php
include_once('Crud_model.php');
class ProductIngredients_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "product_ingredients";
		parent::__construct();

	}


	



}


?>