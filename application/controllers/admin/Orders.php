<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends SU_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->selected_tab = 'orders';
		$this->load->model("Order_model","order");
		$this->load->model("Order_items_model","order_items");
		$this->load->model("Category_model","category");
		$this->load->model("Products_model","products");
		$this->load->model("Ingenico_Model","Ingenico");

	}


	public function index()
	{	
		$join['users'] = "users.user_id = orders.order_by";
		$join['order_items'] ="order_items.order_id = orders.order_id";
		$join['payments'] = "payments.hostedCheckoutId = orders.hostedCheckoutId";
		$data['orders'] = $this->order->get_data("order_items.order_price as per_order_price,orders.*,users.*,order_items.*,payments.* ","","","",$join);
		$this->load->view('admin/orders/index',$data);
	}

	public function complete()
	{
		$id = $_POST['id'];
		$where['order_id'] = $id;
		$data = array("order_status"=>"1");
		$update = $this->order->update_data($where,$data);
		if($update)
		{
			$response['status'] = TRUE;
			$response['msg'] = "Order Completed";

		}
		else
		{
			$response['status'] = FALSE;
			$response['msg'] = "Error Occur";
			$response['alert'] ="Alert";
		}


		echo json_encode($response);
		exit();
	}


	public function delete()
	{
		$id = $_POST['id'];
		$where['order_id'] = $id;
		$delete = $this->order->delete_data($where);
		if($delete)
		{	
			$this->order_items->delete_data($where);
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