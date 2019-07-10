<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Order_model","order");
		$this->load->model("Order_items_model","order_items");
		$this->load->model("Category_model","category");
		$this->load->model("Products_model","products");
		
	}

	public function index()
	{
		$data['title'] = "Supreme Green";
		$this->load->view("public/pIncludes/header",$data);
		$this->load->view("public/index",$data);
		$this->load->view("public/pIncludes/footer",$data);
		
	}

	public function test($value='')
	{
		$data['title'] = "Supreme Green";
		$this->load->view("public/pIncludes/header",$data);
		$this->load->view("test");
		$this->load->view("public/pIncludes/footer",$data);
		
	}

}

?>