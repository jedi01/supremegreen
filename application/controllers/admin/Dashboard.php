<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_tab = 'dashboard';

	}


	public function index()
	{
		$this->load->view('admin/dashboard');
	}
}
?>