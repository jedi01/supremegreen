<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Ingenico extends CI_Controller {
    protected $client = null;
    protected $configFilePath = null;
    protected $communicatorConfiguration;
    protected $merchant = null;

   

    public function __construct(){
        parent::__construct();
        $this->load->model("Order_model","order");
        $this->load->model("Order_items_model","order_items");
        $this->load->model("Category_model","category");
        $this->load->model("Products_model","products");
        $this->load->model("Ingenico_Model","Ingenico");
    }


    function methods(){

        $data = $this->input->post();
        $data['merchantOrderId'] = 12345;
        $data['merchantReference'] = 'junaid';
    
        $res = $this->Ingenico->paymentMethods($data);
  
        $redirect_link = "https://payment.".$res->partialRedirectUrl;
        $order_type = $this->session->userdata("order_type");
        $user_id = get_user_id();
        $order = $this->session->userdata("order_cart"); 

        
        if($order_type == 1){
            $ordertime = $this->session->userdata("order_timeday"); 
            $order_data = array("order_by"=>$user_id,"order_price"=>$data['total_price'],"order_type"=>$order_type,'order_day'=>$ordertime['day'],'order_time'=>$ordertime['time'], 'hostedCheckoutId'=>$res->hostedCheckoutId,'merchantReference'=>$data['merchantReference'],'merchantOrderId'=>$data['merchantOrderId']);
        }else{
            $order_data = array("order_by"=>$user_id,"order_price"=>$data['total_price'],"order_type"=>$order_type,'hostedCheckoutId'=>$res->hostedCheckoutId,'merchantReference'=>$data['merchantReference'],'merchantOrderId'=>$data['merchantOrderId']);
        }


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
            $odr_pr = $value['order_price'];
              if($value['order_category'] == "drinks"){
                $odr_pr = $value['order_price']/$qty;
              }
            $order_price = $odr_pr*$qty;
            $order_items = array("order_id"=>$order_id,"order_name"=>$value['order_name'],"order_price"=>$order_price,"order_items"=>$value['order_items'],"qty"=>$qty,"order_category"=>$value['order_category']);
            $odr_itms = $this->order_items->add_data($order_items);
            if($count == $key+1)
            {

                $this->session->unset_userdata("order_type");
                $this->session->unset_userdata("order_cart");
                $this->session->unset_userdata("order_price");
        
            }
        }



        redirect($redirect_link);
        


    }
    





    function show_all_payments()
    {
          
        $client = $this->getClient();
        $query = new FindPaymentsParams();
        $query->merchantReference = "AcmeOrder0001";
        $query->merchantOrderId = 123456;
        $query->offset = 0;
        $query->limit = 10;
        $response = $client->merchant($this->merchant)->payments()->find($query);
        echo "<pre>";
        print_r($response);



    }
function payment_response($merchantOrderId,$merchantReference)
    {
        $response = $this->Ingenico->payment_response($merchantOrderId,$merchantReference);
         debug($response);

    }

    function payment()
    {


        $client = $this->getClient();

        $card = new Card();
        $card->cardNumber = "4567350000427977";
        $card->cardholderName = "Wile E. Coyote";
        $card->cvv = "123";
        $card->expiryDate = "1220";

        $cardPaymentMethodSpecificInput = new CardPaymentMethodSpecificInput();
        $cardPaymentMethodSpecificInput->card = $card;
        $cardPaymentMethodSpecificInput->paymentProductId = 1;
        $cardPaymentMethodSpecificInput->skipAuthentication = false;

        $amountOfMoney = new AmountOfMoney();
        $amountOfMoney->amount = 6000;
        $amountOfMoney->currencyCode = "EUR";

        $billingAddress = new Address();
        $billingAddress->additionalInfo = "b";
        $billingAddress->city = "Monument Valley";
        $billingAddress->countryCode = "US";
        $billingAddress->houseNumber = "13";
        $billingAddress->state = "Utah";
        $billingAddress->street = "Desertroad";
        $billingAddress->zip = "84536";

        $companyInformation = new CompanyInformation();
        $companyInformation->name = "Acme Labs";

        $contactDetails = new ContactDetails();
        $contactDetails->emailAddress = "wile.e.coyote@acmelabs.com";
        $contactDetails->emailMessageType = "html";
        $contactDetails->faxNumber = "+1234567891";
        $contactDetails->phoneNumber = "+1234567890";

        $name = new PersonalName();
        $name->firstName = "Wile";
        $name->surname = "Coyote";
        $name->surnamePrefix = "E.";
        $name->title = "Mr.";

        $personalInformation = new PersonalInformation();
        $personalInformation->dateOfBirth = "19490917";
        $personalInformation->gender = "male";
        $personalInformation->name = $name;

        $shippingName = new PersonalName();
        $shippingName->firstName = "Road";
        $shippingName->surname = "Runner";
        $shippingName->title = "Miss";

        $shippingAddress = new AddressPersonal();
        $shippingAddress->additionalInfo = "Suite II";
        $shippingAddress->city = "Monument Valley";
        $shippingAddress->countryCode = "US";
        $shippingAddress->houseNumber = "1";
        $shippingAddress->name = $shippingName;
        $shippingAddress->state = "Utah";
        $shippingAddress->street = "Desertroad";
        $shippingAddress->zip = "84536";

        $customer = new Customer();
        $customer->billingAddress = $billingAddress;
        $customer->companyInformation = $companyInformation;
        $customer->contactDetails = $contactDetails;
        $customer->locale = "en_US";
        $customer->merchantCustomerId = "1234";
        $customer->personalInformation = $personalInformation;
        $customer->shippingAddress = $shippingAddress;
        $customer->vatNumber = "1234AB5678CD";

        $invoiceData = new OrderInvoiceData();
        $invoiceData->invoiceDate = "20140306191500";
        $invoiceData->invoiceNumber = "000000123";

        $references = new OrderReferences();
        $references->descriptor = "Fast and Furry-ous";
        $references->invoiceData = $invoiceData;
        $references->merchantOrderId = 123456;
        $references->merchantReference = "AcmeOrder0001";

        $items = array();

        $item1AmountOfMoney = new AmountOfMoney();
        $item1AmountOfMoney->amount = 2500;
        $item1AmountOfMoney->currencyCode = "EUR";

        $item1InvoiceData = new LineItemInvoiceData();
        $item1InvoiceData->description = "ACME Super Outfit";
        $item1InvoiceData->nrOfItems = "1";
        $item1InvoiceData->pricePerItem = 2500;

        $item1 = new LineItem();
        $item1->amountOfMoney = $item1AmountOfMoney;
        $item1->invoiceData = $item1InvoiceData;

        $items[] = $item1;

        $item2AmountOfMoney = new AmountOfMoney();
        $item2AmountOfMoney->amount = 480;
        $item2AmountOfMoney->currencyCode = "EUR";

        $item2InvoiceData = new LineItemInvoiceData();
        $item2InvoiceData->description = "dspirin";
        $item2InvoiceData->nrOfItems = "12";
        $item2InvoiceData->pricePerItem = 40;

        $item2 = new LineItem();
        $item2->amountOfMoney = $item2AmountOfMoney;
        $item2->invoiceData = $item2InvoiceData;

        $items[] = $item2;

        $shoppingCart = new ShoppingCart();
        $shoppingCart->items = $items;

        $order = new Order();
        $order->amountOfMoney = $amountOfMoney;
        $order->customer = $customer;
        $order->references = $references;
        $order->shoppingCart = $shoppingCart;

        $body = new CreatePaymentRequest();
        $body->cardPaymentMethodSpecificInput = $cardPaymentMethodSpecificInput;
        $body->order = $order;

        try {
            $response = $client->merchant($this->merchant)->payments()->create($body);
        } catch (DeclinedPaymentException $e) {
            $this->handleDeclinedPayment($e->getPaymentResult());
        } catch (ApiException $e) {
            $this->handleApiErrors($e->getErrors());
        }
        echo "<pre>";
        print_r($response);


        
    }



}