<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingredients extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_parent_tab = 'Ingredients';
		$this->load->model("Category_model","category");	
		$this->load->model("Cat_product_model","cat_product");	
		$this->load->model("Order_items_model","order_items");
		$this->load->model("Products_model");
	
	}

	public function index()
	{
		$this->selected_tab = 'view_ingredients';
		$order_by = "cat_pro_id";
		$join['categories'] = 'categories.cat_id = ingredients.cat_pro_category';
		$data['products'] = $this->cat_product->get_data("*","","","",$join,"","","",$order_by);
		$this->load->view('admin/ingredients/index',$data);
	}

	public function manage_view($id="")
	{
		$this->selected_tab = 'add_ingredients';
		if(!empty($id))
		{
			$where['cat_pro_id'] = $id;
			$data['product'] = $this->cat_product->get_data("*","",$where,true);
		}
		
		$where = "parent != 0";
		$data['categories'] = $this->category->get_data("*","",$where);
		$this->load->view('admin/ingredients/manage',$data);
	}

	public function manage()
	{
		$data = $this->input->post();


		$profile_image = $this->cat_product->upload_file($_FILES['cat_pro_image'],'cat_pro_image',PRODUCT_IMAGE_UPLOAD);

		if ($profile_image) 
		{

			$data['cat_pro_image'] = $profile_image;

		}
		else
		{
			$data['cat_pro_image'] = $data['perv_image'];
		}
		
		

		if(!empty($data['cat_pro_id']))
		{
			$where['cat_pro_id'] = $data['cat_pro_id'];
			unset($data['cat_pro_id']);
			unset($data['perv_image']);
			$update = $this->cat_product->update_data($where,$data);
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
			$insert = $this->cat_product->add_data($data);
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
		redirect('admin/ingredients/');	
	}

	public function updateStatus()
	{
		
		$id = $_POST['id'];
		$status = $_POST['status'];
		$this->Products_model->updateProductStatus($id,$status);
		// echo $this->db->last_query();
		// die;


		$where['cat_pro_id'] = $id;
		$data =  array("status"=>$status);
		$update = $this->cat_product->update_data($where,$data);
		if($update)
		{
			$response['status'] = TRUE;
			$response['msg'] = "Record Updated";
		}
		else
		{
			$response['status'] = FALSE;
			$response['msg'] = "Record not Updated";

		}
		echo json_encode($response);
		exit();

	}

	public function delete()
	{
		$id = $_POST['id'];
		$where['cat_pro_id'] = $id;

		$checkIngredients = $this->order_items->checkIngredients($id);
		$chIng = $this->Products_model->checkIngredients($id);

		if(!empty($checkIngredients)){
			$response['status'] = FALSE;
			$response['msg'] = "Remove Order first then remove this Ingredient";
			$response['alert'] ="This Ingredient has some Order";
		}
		elseif(!empty($chIng))
		{
			
			$response['status'] = FALSE;
			$response['msg'] = "Remove Product first then remove this Ingredient";
			$response['alert'] ="This Ingredient has some Product";
			
		}
		else
		{
			$delete = $this->cat_product->delete_data($where);
			if($delete)
			{
				$response['status'] = TRUE;
				$response['msg'] = "Record Delete";

			}
			else
			{
				$response['status'] = FALSE;
				$response['msg'] = "Error Occur";
			}
		}
		echo json_encode($response);
		exit();
	}

	
}
