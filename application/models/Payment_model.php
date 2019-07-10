<?php
include_once('Crud_model.php');
class Payment_model extends Crud_model{

	protected $table = "";

	public function __construct() {

		$this->table = "payments";
		parent::__construct();

	}


		


}


?>