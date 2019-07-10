<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{	
		parent::__construct();
		$this->load->model("Order_model","order");
		$this->load->model("Order_items_model","order_items");
		$this->load->model("Category_model","category");
		$this->load->model("Products_model","products");
		$this->load->model("Crud_model","crud");
		$this->load->model("User_model","users");
		$this->load->model('Usermeta_model','umeta');
		$this->load->model('Drinks_model','drink');
		
	}


	public function index()
	{
		$data['title'] = "Order";
		$data['class'] = "bg";
		$where['parent'] = 0;
		$data['categories'] = $this->category->get_data("*","",$where);
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/order/index',$data);
		$this->load->view('public/includes/footer');
	}

	public function subcategory($id)
	{

		$where['product_category'] = $id;
		$order_by = "product_id";
		$join['categories'] = "categories.cat_id = products.product_category";
		$data['products'] = $this->products->get_data("*","",$where,"",$join,"","","",$order_by);
		$cat_where['cat_id'] = $id;
		$category = $this->category->get_data("*","",$cat_where,true);
		$data['title'] = $category->name;
		$data['class'] = "bg";
		$data['category'] = $id;
		if($category->custom_made == 1)
		{
			$data['create'] = true;
		}
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/order/categories',$data);
		$this->load->view('public/includes/footer');
	}


	public function product($id="")
	{
		$data['category'] = $id;
		$data['class'] = "";
		$data['title'] = 'Custom Salad';
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/order/readymade',$data);
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
		
	}


	public function readymade($categorySlug,$id = "")
	{
		
		$product = get_product_by_slug($categorySlug);
		$data['title'] = $product->product_name;
		$data['category_id'] = $product->product_category;
		$categorywhere['parent'] = $product->product_category;
		$data['class'] = "bg";
		$where['product_id'] = $id;
		$data['re_product'] = $this->products->get_data("*","",$where,true);
		$data['categories'] = $this->category->get_data("*","",$categorywhere);


		//debug($data);
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/order/readymadeProduct',$data);
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
		
	}

	public function get_products()
	{	
		$Oneproduct = 0;
		$ing_count = 0;

		$data['subcategories'] = get_sub_categories($_POST['id'],$_POST['skip']); //get subcategory
		$allsubcategories = get_subcategories($_POST['id']); //get all subcategories
		$count = count($allsubcategories); //count all subcategories
		$allsubcats = get_subcategories_full($_POST['id']);
		if(isset($allsubcats[1])){
			$has_ingredeients = has_ingredeients($allsubcats[1]->cat_id);
			$ing_count = count($has_ingredeients);
		}

		$data['skip'] = $_POST['skip'];


		if(!empty($_POST['selected']))
		{
			$data['selected'] = $_POST['selected']; //selected ingredients 

		}
		
		
		if($_POST['flag'] == 1){
			$productItems =  array();

			foreach ($selectedArray as $key => $value) {
				foreach ($value as $key2 => $value2) {
					array_push($productItems,$value2['product']); //sort the selected items in array
				}
			}

			$ings = has_ingredeients($data['subcategories']->cat_id);
			$catIngs =  array();
			foreach ($ings as $key => $value) {
				if (in_array($value->cat_pro_id, $productItems))
				{
					array_push($catIngs, $value->cat_pro_id);
				}
			}
			$data['ingsCount'] = count($catIngs); //count ingredients 
		}

		$data['flag'] = $_POST['flag'];

		if($_POST['skip'] == 0 && $ing_count == 0)
		{
			$data['perv_button'] = FALSE;
			$data['next_button'] = FALSE;
			$data['done_button'] = TRUE;
		}
		elseif($_POST['skip'] == 0)
		{
			$data['perv_button'] = FALSE;
			$data['next_button'] = TRUE;
			$data['done_button'] = FALSE;
		}

		elseif($_POST['skip'] == $count-1)
		{
			$data['perv_button'] = TRUE;
			$data['next_button'] = FALSE;
			$data['done_button'] = TRUE;
		}
		
		else
		{
			$data['perv_button'] = TRUE;
			$data['next_button'] = TRUE;
			$data['done_button'] = FALSE;
		}

		if (!empty($data['subcategories'])) {
			echo $this->load->view('public/order/products',$data,true);
		}
		
		

	}


	public function drinks()
	{
		$this->load->library('user_agent');
		 if ($this->agent->is_mobile()) {
          $data['class'] = "drinksmbl";
          $view = "drinkmblpage";
          
     }
     else {
     	 $view = "drinkpage";
         $data['class'] = "drinksbg";
        
     }	
		$data['drink1'] = $this->drink->getDrink(1,0);
		$data['drink2'] = $this->drink->getDrink(1,1);
		$data['drink3'] = $this->drink->getDrink(1,2);
		$data['drink4'] = $this->drink->getDrink(1,3);
		$data['drink5'] = $this->drink->getDrink(1,4);
		$data['drink6'] = $this->drink->getDrink(1,5);
		$data['title'] = "Drinks";
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');
		$this->load->view('public/order/'.$view,$data);
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
	}

	public function order_drinks()
	{
		$first_order = [];
		if(!empty($_POST['drinks'])){
			foreach ($_POST['drinks'] as $k2 => $v2) {

				$getDrink = getDrink($v2['drink']);
				$order = array("slug"=>$getDrink->slug,"order_name"=>$getDrink->name,"order_price"=>$getDrink->price*$v2['quantity'],"order_category"=>"drinks","order_items"=>$getDrink->name,"qty"=>$v2['quantity'],"custom"=>1);
				array_push($first_order,$order);

				if (empty($this->session->userdata("order_cart"))) {
					$this->session->set_userdata("order_cart",$first_order);
					if(!empty($this->session->userdata("order_cart")))
					{
						$response['status'] = true;
					}
					else
					{
						$response['status'] = false;	
					}
				}
				else
				{
					$order_array =  $this->session->userdata('order_cart');
					array_push($order_array, $order);
					$this->session->set_userdata('order_cart', $order_array);
					if(!empty($this->session->userdata("order_cart")))
					{
						$response['status'] = true;
					}
					else
					{
						$response['status'] = false;	
					}
				}
			}
			echo json_encode($response);
			exit();
		}
	}

	public function order_now()
	{
		
		$order_name = $_POST['name'];
		$category = $_POST['id'];
		$Category = categoryInfo($category);
		$basePrice = $Category->basePrice; 
		$items = array();
		$order_price = 0;
		$first_order = array();
		$custom = 1;
		$productItems =  array();
		foreach ($_POST['selected'] as $key => $value) {
			foreach ($value as $key2 => $value2) {
				array_push($productItems,$value2['product']); //sort the selected items in array
			}
		}

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
						$order_price += $pro_price->cat_pro_price;
					}
					$counter++;
				} 	
			}
		}

		$order_price+=$basePrice; //order price
		$order_items = json_encode($_POST['selected']); //order items json
		
		if(isset($_POST['custom']))
		{
			$custom = 0;
		}
		
	
		if(!empty($_POST['selected'])){
			$order = array("slug"=>$_POST['slug'],"order_name"=>$order_name,"order_price"=>$order_price,"order_category"=>$category,"order_items"=>$order_items,"qty"=>1,"custom"=>$custom);
			array_push($first_order,$order); //create first order session

			if (empty($this->session->userdata("order_cart"))) {
				$this->session->set_userdata("order_cart",$first_order);
				if(!empty($this->session->userdata("order_cart")))
				{
					$response['status'] = true;
				}
				else
				{
					$response['status'] = false;	
				}
			}
			else
			{
				$order_array =  $this->session->userdata('order_cart');
				array_push($order_array, $order); // insert new order into order session
				$this->session->set_userdata('order_cart', $order_array);
				if(!empty($this->session->userdata("order_cart"))){
					$response['status'] = true;
				} else {
					$response['status'] = false;	
				}
			}
		}else {
			$response['status'] = false;
			$response['msg'] = "Please select Items";
		}

			
		echo json_encode($response);
		exit();

	}


	function getIngPrice()
	{

		$ing_info = ingredients_price($_POST['ing']);
		$response['price'] = $ing_info->cat_pro_price;
		$response['status'] = TRUE;
		echo json_encode($response); //response back 
		exit();

	}


	function getPrice()
	{	
		$order_price = 0;
		$category = $_POST['id'];
		$Category = categoryInfo($category); //get category information
		$basePrice = $Category->basePrice; //get category base price
		$selectedArray = $_POST['selected']; //selected items
		$productItems =  array();

		foreach ($selectedArray as $key => $value) {

			foreach ($value as $key2 => $value2) {
				array_push($productItems,$value2['product']); //sort the selected items in array
			}
		}

		$subCategories = get_subcategories($category);
			foreach ($subCategories as $key => $value) {
					$subcat = $value->cat_id;
					$ngs = ingredients($subcat);
					$subCategory = categoryInfo($subcat);
					$minQty = $subCategory->minQty;
					if(isset($_POST['qty']) && !empty($_POST['qty'])){
						$counter = $_POST['qty'];
					}else{
						$counter = 1;
					}
					
					foreach ($ngs as $k1 => $v1) {

						if (in_array($v1->cat_pro_id, $productItems))  //match the items in db
						{ 
							if($counter>$minQty) //if more than min qty charge money
							{
								$pro_price = ingredients_price($v1->cat_pro_id);
								$order_price += $pro_price->cat_pro_price;
							}
							$counter++;
						} 
						
					}
					
			}
			$order_price+=$basePrice;
			$response['price'] = $order_price;
			$response['status'] = TRUE;
			echo json_encode($response); //response back 
			exit();
	}


	public function add_more()
	{
		$data['title'] = "Add More";
		$data['class'] = "bg";
		$where['parent'] = 0;
		$data['categories'] = $this->category->get_data("*","",$where);
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/order/addmorepage');
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
	}


	public function view_cart()
	{	
		if(empty($this->session->userdata("order_cart")))
		{	
			$status = "error";
			$msg = "Cart is Empty";
			$this->session->set_flashdata($status,$msg);
			redirect(base_url()."order");
		}
		else
		{
		$data['title'] = "Your Cart";
		$data['class'] = "blackback";

		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/order/cart');
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
	}
	}


	public function deleteItem($index)
	{
		$orders = $this->session->userdata("order_cart"); 
		unset($orders[$index]);
		$this->session->set_userdata("order_cart",$orders); 
		$status = "success";
		$msg = "Delete Item";
		$this->session->set_flashdata($status,$msg);
		redirect(base_url()."order/view_cart");

	}


	public function checkout()
	{

		
		if (empty($this->session->userdata("user_session"))) {

			$page = base_url()."order/view_cart";
			$this->session->set_userdata("perv_page",$page);
			$redirect_url = base_url()."login";
			redirect($redirect_url);

		}
		elseif ($_SESSION['user_session']->role == "admin") {
			$page = base_url()."order/view_cart";
			$this->session->set_userdata("perv_page",$page);
			$redirect_url = base_url()."login";
			redirect($redirect_url);
		}
		else
		{


			$data['title'] = "Order Type";
			$data['class'] = "bg";
			$this->load->view('public/includes/header',$data);
			$this->load->view('public/includes/leftsidebar');	
			$this->load->view('public/order/ordertype');
			$this->load->view('public/includes/left_icons');
			$this->load->view('public/includes/footer');
		}
	}

	public function paymentMethod($orderType)
	{	
		$guest = $this->session->userdata("user_session");
		if($guest->role == "guest"){

		}else{
			$id = get_user_id();
			$where['user_id'] = $id;
			$where_umeta['user_id'] = $id;
			$user_data = $this->users->get_where('',$where,false);
			$user_meta = $this->umeta->get_data('*',"",$where_umeta);
			$data['user'] = $this->users->format_user_data($user_data,$user_meta);
		}
		
		$this->session->set_userdata("order_type",$orderType);
		if($orderType == 1){
			$array = array('day'=>$_POST['day'],'time'=>$_POST['time']);
			$this->session->set_userdata("order_timeday",$array);
		}
		$data['title'] = "Payment";
		$data['class'] = "";
		$data['countries'] = $this->crud->get_data("*","country");

		// debug($data,true);
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/order/checkoutpage',$data);	

	}

	public function combine_data()
	{
		$data = $_POST;
		
		$array = $this->session->userdata("order_cart");

		foreach ($array as $key => $value) {
			$_SESSION['order_cart'][$key]['qty'] = $data['qty'][$key];
		}
		$this->session->set_userdata("order_price",$_POST['total_price']);

	}

	public function complete()
	{
		$data = $this->input->post();
		$order_type = $this->session->userdata("order_type");
		$user_id = get_user_id();
		$order = $this->session->userdata("order_cart"); 

		$order_data = array("order_by"=>$user_id,"order_price"=>$data['total_price'],"order_type"=>$order_type);
		$order_id = $this->order->add_data($order_data);
		$count = count($order);
		foreach ($order as $key => $value) 
		{
			if(!empty($value['qty']))
			{  
				$qty = $value['qty']; 
			}
			else
			{
				$qty = 1; 
			}
			$order_price = $value['order_price']*$qty;
			$order_items = array("order_id"=>$order_id,"order_name"=>$value['order_name'],"order_price"=>$order_price,"order_items"=>$value['order_items'],"qty"=>$qty,"order_category"=>$value['order_category']);
			$odr_itms = $this->order_items->add_data($order_items);
			if($count == $key+1)
			{

				$this->session->unset_userdata("order_type");
				$this->session->unset_userdata("order_cart");
				$this->session->unset_userdata("order_price");
				$status = "success";
				$msg = "Order Completed";
				$this->session->set_flashdata($status,$msg);
				$redirect = base_url()."order";
				redirect($redirect);
			}
		}

	}


	public function cancelOrder()
	{
		$this->session->unset_userdata("order_type");
		$this->session->unset_userdata("order_cart");
		$this->session->unset_userdata("order_price");
		$response['status'] = TRUE;
		$response['msg'] = "Order Cancelled";
		echo json_encode($response);
		exit();
	}


	public function edit($slug,$key)
	{

		$data['title'] = $slug;
		$data["skey"] = $key;
		$orders = $this->session->userdata("order_cart");
		$data['items'] = $orders[$key]['order_items'];
		$data['price'] = $orders[$key]['order_price'];
		$data['order_category'] = $orders[$key]['order_category'];
		$data['class'] = "bg";
		$where['parent'] = $data['order_category'];
		$data['order_data'] =  $orders[$key];
		$data['categories'] = $this->category->get_data("*","",$where);

		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/order/editPage',$data);
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
	}


	public function edit_order()
	{
		
		$key = $_POST['key'];
		$price = $_POST['price'];
		$orders = $this->session->userdata("order_cart");
		$slug = $orders[$key]['slug'];
		$order_name = $orders[$key]['order_name'];
		$order_category = $orders[$key]['order_category'];
		$order_items =  json_encode($_POST['selected']);
		$order = array("slug"=>$slug,"order_name"=>$order_name,"order_price"=>$price,"order_category"=>$order_category,"order_items"=>$order_items,"qty"=>1,"custom"=>1);
		$orders[$key] = $order;
		$this->session->set_userdata("order_cart",$orders);
		if(!empty($this->session->userdata("order_cart"))){
			$response['status'] = true;
		} else{
			$response['status'] = false;	
		}
		echo json_encode($response);
		exit();
	}


	public function edit_drink($slug,$key)
	{
		$data['title'] = $slug;
		$data["skey"] = $key;
		$orders = $this->session->userdata("order_cart");
		$data['selectedItem'] = $orders[$key]['order_items'];
		$data['slug'] = $orders[$key]['slug'];
		$data['price'] = $orders[$key]['order_price'];
		$data['qty'] = $orders[$key]['qty'];
		$data['order_category'] = $orders[$key]['order_category'];
		$data['drink1'] = $this->drink->getDrink(1,0);
		$data['drink2'] = $this->drink->getDrink(1,1);
		$data['drink3'] = $this->drink->getDrink(1,2);
		$data['drink4'] = $this->drink->getDrink(1,3);
		$data['drink5'] = $this->drink->getDrink(1,4);
		$data['drink6'] = $this->drink->getDrink(1,5);
		$data['title'] = "Drinks";
		$data['class'] = "drinksbg";
	
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/includes/leftsidebar');	
		$this->load->view('public/order/editDrink',$data);
		$this->load->view('public/includes/left_icons');
		$this->load->view('public/includes/footer');
	}


	public function order_drinks_order()
	{	
		$key = $_POST['key'];
		$orders = $this->session->userdata("order_cart");
		unset($orders[$key]);
		$this->session->set_userdata("order_cart",$orders);
		if(!empty($_POST['drinks'])){
			foreach ($_POST['drinks'] as $k2 => $v2) {

				$getDrink = getDrink($v2['drink']);
				$order = array("slug"=>$getDrink->slug,"order_name"=>$getDrink->name,"order_price"=>$getDrink->price*$v2['quantity'],"order_category"=>"drinks","order_items"=>$getDrink->name,"qty"=>$v2['quantity'],"custom"=>1);
				
					$order_array =  $this->session->userdata('order_cart');
					array_push($order_array, $order);
					$this->session->set_userdata('order_cart', $order_array);
					if(!empty($this->session->userdata("order_cart")))
					{
						$response['status'] = true;
					}
					else
					{
						$response['status'] = false;	
					}
				}
			}
			echo json_encode($response);
			exit();
	}
	
}