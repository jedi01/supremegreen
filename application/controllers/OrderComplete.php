<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderComplete extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Crud_Model","crud");
		$this->load->model("Ingenico_Model","Ingenico");
		$this->load->model("Payment_model","payment");
		
	}

	public function index()
	{
		$hostedCheckoutId = $_GET['hostedCheckoutId'];
		$hostWhere['hostedCheckoutId'] = $hostedCheckoutId;
		$orderStat = $this->crud->get_data("*","orders",$hostWhere,true);
		$response = $this->Ingenico->payment_response($orderStat->merchantOrderId,$orderStat->merchantReference);

		if(isset($response->payments[0]->id))
		{
			$res = $this->Ingenico->paymentStatus($response->payments[0]->id);
			$statusCategory = $res->statusOutput->statusCategory;
			$statusCode = $res->statusOutput->statusCode;
			$amountOfMoney = $res->paymentOutput->amountOfMoney->amount;
			$name = $res->paymentOutput->redirectPaymentMethodSpecificOutput->paymentProduct840SpecificOutput->customerAccount->firstName;
			$paymentStatus = $res->status;
			$payment_array = array("id"=>$response->payments[0]->id,"amount"=>$amountOfMoney,"statusCategory"=>$statusCategory,"statusCode"=>$statusCode,'paymentStatus'=>$paymentStatus,'hostedCheckoutId'=>$hostedCheckoutId);
			$this->payment->add_data($payment_array);
			$status = "success";
            $msg = "Your order is created";
            $this->session->set_flashdata($status,$msg);
            $data['status'] = TRUE;
		}
		else
		{
			 $status = "error";
             $msg = "You Cancelled Your Payment";
             $this->session->set_flashdata($status,$msg);
             $data['status'] = FALSE;
           
		}
		
		
		$data['title'] = "Supreme Green";
		$where['parent'] = 0;	
		$data['class'] = "";
		$this->load->view('public/includes/header',$data);
		$this->load->view('public/thankyou',$data);
		$this->load->view('public/includes/footer',$data);
	}

}

?>