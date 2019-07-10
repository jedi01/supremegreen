<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("User_model","users");
		$this->load->model("Crud_model","crud");
		$this->load->model('Usermeta_model','umeta');
		
	}

	public function index()
	{
		
		$data['title'] = "Register";
		$data['class'] = "";
		$data['countries'] = $this->crud->get_data('*',"country");
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/register',$data);
		$this->load->view('public/includes/footer',$data);
	}

	public function manage()
	{
		$data = $this->input->post();
		$meta_data = $data['meta'];
		unset($data['meta']);		
		unset($data['password_confirmation']);
		$user_id = $this->users->add_data($data);
		$this->umeta->manage_user_meta($meta_data,$user_id);
		if($user_id)
		{
			$status = "success";
			$msg = "Account Created";

		}
		else
		{
			$status = "error";
			$msg = "Error Occur";
		}
		$this->session->set_flashdata($status,$msg);
		$redirect = base_url()."login/user";
		redirect($redirect);
	}

}
?>