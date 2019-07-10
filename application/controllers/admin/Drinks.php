<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drinks extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_tab = 'drinks';
		$this->load->model("Drinks_model","drink");


	}


	public function index()
	{	
		$data['drinks'] = $this->drink->get_data("*");
		$this->load->view('admin/drinks/index',$data);
	}

	public function manage_view($id="")
	{
		
		$where['id'] = $id;
		$data['drink'] = $this->drink->get_data("*","",$where,true);
		$this->load->view('admin/drinks/manage',$data);
	}


	public function manage()
	{
		$data = $this->input->post();

		if(!empty($data['id']))
		{
			$where['id'] = $data['id'];
			unset($data['id']);
			$update = $this->drink->update_data($where,$data);
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
			$insert = $this->drink->add_data($data);
			if($insert)
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
		redirect('admin/drinks/');	
	
}



	public function delete()
	{
		$id = $_POST['id'];
		$where['order_id'] = $id;
		$delete = $this->drink->delete_data($where);
		if($delete)
		{	
			$response['status'] = TRUE;
			$response['msg'] = "Record Delete";

		}
		else
		{
			$response['status'] = FALSE;
			$response['alert'] = "Alert";
			$response['msg'] = "Error Occur";
		}
		echo json_encode($response);
		exit();
	}
}

?>