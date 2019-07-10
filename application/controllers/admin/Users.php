<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_tab = 'users';
		$this->load->model("User_model","users");
		$this->load->model('Usermeta_model','umeta');
		$this->load->model('Crud_model','crud');
	}


	public function index()
	{
		$where['role'] = 'user';
		$data['users'] = $this->users->get_data("*","",$where);
		$this->load->view('admin/users/index',$data);
	}


	public function manage_view($id="")
	{
		if(!empty($id))
		{
			$where['user_id'] = $id;
			$where_umeta['user_id'] = $id;
			$user_data = $this->users->get_where('',$where,false);
			$user_meta = $this->umeta->get_data('*',"",$where_umeta);
			$data['user'] = $this->users->format_user_data($user_data,$user_meta);
			$data['countries'] = $this->crud->get_data('*',"country");
		}
		else
		{
			$data['countries'] = $this->crud->get_data('*',"country");
			
		}
		$this->load->view('admin/users/manage',$data);
	}


	public function manage()
	{

		$data = $this->input->post();
		$meta_data = $data['meta'];
		unset($data['meta']);
		if(!empty($data['user_id']))
		{
			$user_id = $data['user_id'];
			$where['user_id'] =$user_id;
			unset($data['user_id']);
			$update = $this->users->update_data($where,$data);
			$this->umeta->manage_user_meta($meta_data,$user_id);

			if($update)
			{
				$status = "success";
				$msg = "Record Updated";

			}
			else
			{
				$status = "error";
				$msg = "Error Occur";
			}
		}
		else
		{
			unset($data['user_id']);
			$user_id = $this->users->add_data($data);
			$this->umeta->manage_user_meta($meta_data,$user_id);
			if($success)
			{
				$status = "success";
				$msg = "Record Save";

			}
			else
			{
				$status = "error";
				$msg = "Error Occur";
			}
		}
		$this->session->set_flashdata($status,$msg);
		redirect('admin/users/');	
	}


}

?>