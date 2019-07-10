<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SU_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->layout = 'admin-dashboard';
		if (empty($this->session->userdata("user_session"))) {
			$redirect_url = base_url("login/admin");
			redirect($redirect_url);

		}
		elseif($_SESSION['user_session']->role != "admin")
		{
			$redirect_url = base_url("login/admin");
			redirect($redirect_url);
		}
		
		
	}
	

}