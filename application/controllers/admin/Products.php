<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_parent_tab = 'products';
		$this->load->model("Products_model","products");
		$this->load->model("Items_model","items");	
		$this->load->model("Category_model","category");
		$this->load->model("ProductIngredients_model","ProIng");

	}

	public function index()
	{
		$this->selected_tab = 'view_products';
		$order_by = "product_id";
		$join['categories'] = "categories.cat_id = products.product_category";
		$data['products'] = $this->products->get_data("*","","","",$join,"","","",$order_by,"DESC");
		$this->load->view('admin/products/index',$data);
	}

	public function manage_view($id="")
	{
		if(!empty($id))
		{
			$product_where['product_id'] = $id;
			$data['product'] = $this->products->get_data("*","",$product_where,true);
		}
		$this->selected_tab = 'add_products';
		$where['parent'] = 0;
		$data['categories'] = $this->category->get_data("*","",$where);

		$this->load->view('admin/products/manage',$data);	
	}





	public function manage()
	{
		$data = $this->input->post();
		$name = $data['product_name'];
		$category = $data['product_category'];
		$custom = 0;
		$productItems =  array();
		if(isset($data['product_id'])){
			$product_id = $data['product_id'];
			$slug = $data['product_slug'];
			unset($data['product_id'],$data['product_slug']);
		}

		if(isset($data['product_custom'])){
			$custom = $data['product_custom'];
			unset($data['product_custom']);
		}
		
		

		//step1 unset all feild except array of ingredients with key

		unset($data['product_name'],$data['product_category'],$data['product_id']);
		$Category = categoryInfo($category);
		$basePrice = $Category->basePrice; 
		$price= 0;
		$items = array();

		//strp2 get price of product according to max and min condition (base price)

		foreach ($data as $key => $value) {
			$items[$key] = array();
			foreach ($value as $key1 => $value1) {
				if($key == "dress"){
					$ingredient = array("product"=>$value1,"quantity"=>1,"size"=>"M",'serving'=>'Side');
				}else{
					$ingredient = array("product"=>$value1,"quantity"=>1,"size"=>"",'serving'=>'');
				}
				
				$objarr = arrayToObj($ingredient);
				array_push($items[$key],$objarr);
				array_push($productItems,$value1);
				
			}
		}

		$product_items = json_encode($items); //get json of product items

	


		
		$subCategories = get_subcategories($category);
		foreach ($subCategories as $key => $value) {
			$subcat = $value->cat_id;
			$ngs = ingredients($subcat);
			$subCategory = categoryInfo($subcat);
			$minQty = $subCategory->minQty;
			$counter = 1;
			foreach ($ngs as $k1 => $v1) {

				if (in_array($v1->cat_pro_id, $productItems))  //match the items in db
				{ 
					if($counter>$minQty) //if more than min qty charge money
					{
						$pro_price = ingredients_price($v1->cat_pro_id);
						$price += $pro_price->cat_pro_price;
					}
					$counter++;
				} 
						
			}
					
		}
			


		$price+=$basePrice;
		$insertArray['product_price'] = $price;
		$insertArray['product_items'] = $product_items;
		$insertArray['product_name'] = $name;
		$insertArray['product_category'] = $category;


		if(empty($product_id)){
			$slug = create_slug($name);
		}

		$insertArray['product_slug'] = $slug;
		$insertArray['product_custom'] = 0;

		if(!empty($custom))
		{
			$insertArray['product_custom'] = $custom;
		}


		
		if(!empty($product_id))
		{

			$where['product_id'] = $product_id;
			
			//before update delete from product ingredients table.
			$this->ProIng->delete_data($where);
			$update = $this->products->update_data($where,$insertArray);
			foreach ($data as $key => $value) {
				foreach ($value as $key1 => $value1) {
					$productIngArray = array("category_id"=>$category,"ingredients_id"=>$value1,"product_id"=>$product_id);
					//add new product ingredients in product ingredients table
					$this->ProIng->add_data($productIngArray);
				}
			}
			if($update){
				$status = "success";
				$msg = "Record Updated";

			} else {
				$status = "error";
				$msg = "Error Occur";
			}
		} else {

			$productId = $this->products->add_data($insertArray);
			foreach ($data as $key => $value) {
				foreach ($value as $key1 => $value1) {
					$productIngArray = array("category_id"=>$key,"ingredients_id"=>$value1,"product_id"=>$productId);
					//add new product ingredients in product ingredients table
					$this->ProIng->add_data($productIngArray);
				}
			}

			if($productIngArray){
				$status = "success";
				$msg = "Record Save";

			}else{
				$status = "error";
				$msg = "Error Occur";
			}
		}
		$this->session->set_flashdata($status,$msg);
		redirect('admin/products/');	
	}


	public function delete()
	{
		$id = $_POST['id'];
		$where['product_id'] = $id;
		$this->ProIng->delete_data($where);
		$delete = $this->products->delete_data($where);

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
		echo json_encode($response);
		exit();
	}

	public function subcategory()
	{
		$this->layout = '';

		if(!empty($_POST['product']))
		{
			$product_where['product_id'] = $_POST['product'];
			$data['products'] = $this->products->get_data("*","",$product_where,true);
		}
		$category = $_POST['category'];
		$where['parent'] = $category;
		$data['subcat'] = $this->category->get_data("*","",$where);
		echo $this->load->view('admin/products/subcategories',$data,true);

		
	}


	public function getCategoryLimit()
	{
		$category = $_POST['category'];
		$where['cat_id'] = $category;
		$category = $this->category->get_data("maxQty,minQty","",$where,true);
		echo json_encode($category);
		exit();

	}


	public function getCategoryProductCount()
	{
		$category = $_GET['category'];
		$productWhere['product_category'] = $category;
		$product = $this->products->get_data("COUNT('product_id') AS productCount","",$productWhere,true);
		echo json_encode($product->productCount);
		exit();
	}
}
