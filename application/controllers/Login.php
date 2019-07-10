<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("User_model","users");
		
	}


	public function index()
	{
		$data['role'] = 'user';
		$data['title'] = "Login";
		$data['class'] = "";
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/login',$data);
		$this->load->view('public/includes/footer',$data);
		
	}

	public function admin()
	{	
		$data['role'] = 'admin';
		$this->load->view('admin/login',$data);
	}

	public function authenticate()
	{
		$data = $this->input->post();

		$result = $this->users->login_user($data);
		if($result->role == "admin" ){
			$this->session->set_userdata("user_session",$result);
			if(!empty($this->session->userdata("user_session")))
			{
				$redirect = base_url()."admin/dashboard/";
			}
		}
		elseif($result->role == "user" ){
			$this->session->set_userdata("user_session",$result);
			if(!empty($this->session->userdata("user_session")))
			{
				$redirect = base_url()."order";
				if(!empty($this->session->userdata("perv_page")))
				{
					$redirect = $this->session->userdata("perv_page");
				}
			}
		}
		else
		{
			$status = "error";
			$msg = "Authentication Fail";
			$this->session->set_flashdata($status,$msg);
			$redirect = base_url()."login/".$data['role'];
			
			
			
		}
		redirect($redirect);	
	}

	public function manage_password()
	{
		$this->layout = 'admin-dashboard';
		$this->load->view('admin/change_password');
	}

	public function change_password()
	{
		$user_id = get_user_id();
		$where['user_id'] = $user_id;
		$data = $this->input->post();
		unset($data['confirm_password']);
		$update = $this->users->update_data($where,$data);
		if($update)
		{
			$status = "success";
			$msg = "Password Change";

		}
		else
		{
			$status = "error";
			$msg = "Error Occur";
		}
		$this->session->set_flashdata($status,$msg);
		$redirect = base_url()."admin/dashboard/";
		redirect($redirect);
	}


	public function guest()
	{
		$guest = randomNumber(5);
		$array = array("name"=>"guest".$guest,"email"=>"","role"=>"guest");
		$result = arrayToObj($array);
		$this->session->set_userdata("user_session",$result);
		if(!empty($this->session->userdata("user_session")))
			{
				$redirect = base_url()."order";
				if(!empty($this->session->userdata("perv_page")))
				{
					$redirect = $this->session->userdata("perv_page");
				}
			}
			redirect($redirect);	
	}
	
}
