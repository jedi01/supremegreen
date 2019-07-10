<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_parent_tab = 'category';
		$this->load->model("Category_model","category");
		$this->load->model("Cat_product_model","cat_product");	


	}

	public function index()
	{
		$this->selected_tab = 'view_category';
		$order_by = "cat_id";
		$where['parent'] = 0;
		$data['categories'] = $this->category->get_data("*","",$where,"","","","","",$order_by);
		$this->load->view('admin/category/index',$data);
	}

	public function manage_view($id="")
	{
		if(!empty($id))
		{
			$where['cat_id'] = $id;
			$data['category'] = $this->category->get_data("*","",$where,true);
		}
		$this->selected_tab = 'add_category';
		$catparent['parent'] = 0;
		$data['categories'] = $this->category->get_data("*","",$catparent);
		
		$this->load->view('admin/category/manage',$data);
	}

	public function manage()
	{
		$data = $this->input->post();

		if(!empty($data['cat_id']))
		{	
			$where['cat_id'] = $data['cat_id'];
			unset($data['cat_id']);
			$update = $this->category->update_data($where,$data);
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
			if(!empty($data['parent']))
			{
				$latest = $this->category->latestCategories();
				$data['disp_odr'] = $latest->disp_odr+1;
			}
			$insert = $this->category->add_data($data);
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
		redirect('admin/category/');	
	}


	function subcategories($id)
	{	$this->selected_tab = 'view_category';
		$data['sub_cat'] = category_parent($id);
		$data['cat_id'] = $id;
		$where['parent'] = $id;
		$data['sub_categories'] = $this->category->get_data("*","",$where,"","","","","","disp_odr");
		$this->load->view('admin/category/sub_category',$data);
	}




	function updateList()
	{
		$output = array();
		$list = parse_str($_POST['list'],$output);

		$where['parent'] = $_POST['id'];
		$sub_categories = $this->category->get_data("cat_id","",$where);
		$index= 0;

		foreach ($output['item'] as $key => $value) {
			$where['cat_id'] = $value;
			$data = array("disp_odr"=>$key);
			$update = $this->category->update_data($where,$data);
			$index++;
			if($index>$key)
			{
				$responce['status'] = TRUE;
			}
		}

		echo json_encode($responce);
		exit();



	}


	public function updateIngredientsOrder()
	{
		$output = array();
		$list = parse_str($_POST['list'],$output);

		debug($output['item']);

		$index= 0;

		foreach ($output['item'] as $key => $value) {
			$where['cat_pro_id'] = $value;
			$data = array("disply"=>$key);
			$update = $this->cat_product->update_data($where,$data);
			$index++;
			if($index>$key)
			{
				$responce['status'] = TRUE;
			}
		}

		echo json_encode($responce);
		exit();
	}


	public function subcatIngredients($subCat)
	{	
		$data['SubCatID'] = $subCat;
		$where['cat_pro_category'] = $subCat;
		$data['Ingredients'] = $this->cat_product->get_data("*","",$where,"","","","","","disply");
		$this->load->view('admin/category/subCategoryIngredients',$data);


	}
			


	public function delete()
	{	
		$id = $_POST['id'];
		$where['cat_id'] = $id;

		$checkWhere['parent'] = $id;
		$checkSubcategories = $this->category->get_data("*","",$checkWhere);
		if(!empty($checkSubcategories))
		{
			$response['status'] = FALSE;
			$response['msg'] = "Remove subcategories first then remove this category";
			$response['alert'] ="This category has some subcategories";
		}
		else
		{
			$IngredientsWhere['cat_pro_category'] = $id;
			$checkIngredients = $this->cat_product->get_data("*","",$IngredientsWhere);

			if(!empty($checkIngredients))
			{
				$response['status'] = FALSE;
				$response['msg'] = "Remove Ingredients first then remove this Subcategory";
				$response['alert'] ="This Subcategory has some Ingredients";
			}
			else{

				$delete = $this->category->delete_data($where);
				if($delete)
				{
					$response['status'] = TRUE;
					$response['msg'] = "Record Delete";

				}
				else
				{
					$response['status'] = FALSE;
					$response['msg'] = "Error Occur";
					$response['alert'] ="Alert";
				}
			}
		}

		echo json_encode($response);
		exit();
		
	}
}
