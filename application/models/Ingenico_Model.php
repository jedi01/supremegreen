<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'/libraries/connect-sdk-php-master/lib/bootstrap.php'); // require Ingenico files

use Ingenico\Connect\Sdk\CommunicatorConfiguration;
use Ingenico\Connect\Sdk\DefaultConnection;

use Ingenico\Connect\Sdk\Communicator;
use Ingenico\Connect\Sdk\Client;



use Ingenico\Connect\Sdk\Domain\Definitions\Card;
use Ingenico\Connect\Sdk\Domain\Definitions\AmountOfMoney;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\CardPaymentMethodSpecificInput;
use Ingenico\Connect\Sdk\Domain\Definitions\Address;
use Ingenico\Connect\Sdk\Domain\Definitions\CompanyInformation;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\ContactDetails;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\PersonalName;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\PersonalInformation;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\AddressPersonal;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\Customer;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\OrderInvoiceData;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\OrderReferences;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\LineItemInvoiceData;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\LineItem;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\ShoppingCart;
use Ingenico\Connect\Sdk\Domain\Payment\Definitions\Order;
use Ingenico\Connect\Sdk\Domain\Payment\CreatePaymentRequest;
use Ingenico\Connect\Sdk\Merchant\Payments\FindPaymentsParams;
use Ingenico\Connect\Sdk\Domain\Hostedcheckout\Definitions\HostedCheckoutSpecificInput;
use Ingenico\Connect\Sdk\Domain\Hostedcheckout\CreateHostedCheckoutRequest;
use Ingenico\Connect\Sdk\Domain\Hostedcheckout\Definitions\PaymentProductFiltersHostedCheckout;
use Ingenico\Connect\Sdk\Domain\Definitions\PaymentProductFilter;




include_once('Crud_model.php');
class Ingenico_Model extends Crud_model {
    protected $client = null;
    protected $configFilePath = null;
    protected $communicatorConfiguration;
    protected $merchant = null;

   

    public function __construct(){
        parent::__construct();
      
        $this->configFilePath = dirname(__FILE__) . '/../../../config.json';
        $this->merchant = "3510";
    }

    protected function getCommunicatorConfiguration()
    {
        $this->communicatorConfiguration = new CommunicatorConfiguration(
         "d45f35c0c97ab1a0",
         "lh37bTuMPVUqyPWACsg6tuUaPkieRENG7K1vhiAWdB4=",
         "https://eu.sandbox.api-ingenico.com",
         'bitsclan'
     );
        return $this->communicatorConfiguration;
    }

    protected function getClient()
    {
        if (is_null($this->client)) {
            $connection = new DefaultConnection();
            $communicatorConfiguration = $this->getCommunicatorConfiguration();
            $communicator = new Communicator($connection, $communicatorConfiguration);
            $this->client = new Client($communicator);
        }
        return $this->client;
    }

    function paymentMethods($data)
    {
         
        $client = $this->getClient();
        $hostedCheckoutSpecificInput = new HostedCheckoutSpecificInput();
        $hostedCheckoutSpecificInput->locale = "en_GB";
        $hostedCheckoutSpecificInput->variant = "testVariant";
        $hostedCheckoutSpecificInput->showResultPage = TRUE;
        $hostedCheckoutSpecificInput->returnUrl = base_url()."OrderComplete";
        $hostedCheckoutSpecificInput->variant = 100;

        $billingAddress = new Address();
        $billingAddress->countryCode = "US";

        $customer = new Customer();
        $customer->billingAddress = $billingAddress;
        $customer->merchantCustomerId = "1234";

        $order_array = $this->session->userdata("order_cart"); 
        // debug($order_array,true);


        $sum = 0;
        $item_array = array();
        $number = 1;

         foreach ($order_array as $key => $value) {
            
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

            $amountOfMoney[$number] = new AmountOfMoney;
            $amountOfMoney[$number]->amount =  ($odr_pr*$qty)*100;
            $amountOfMoney[$number]->currencyCode = "USD";

           $lineItem[$number] = new LineItem;
           $lineItem[$number]->amountOfMoney = $amountOfMoney[$number];
           $lineItemInvoiceData[$number] = new LineItemInvoiceData;
           $lineItemInvoiceData[$number]->nrOfItems = $qty;
           $lineItemInvoiceData[$number]->description = $value['order_name'];
           $lineItemInvoiceData[$number]->pricePerItem = $value['order_price'];
           $lineItem[$number]->invoiceData = $lineItemInvoiceData[$number];
           array_push($item_array,$lineItem[$number]);
           $number++;
           if($value['order_category'] == "drinks"){
              $sum += $odr_pr*$value['qty'];
          }else{

            $sum += $value['order_price']; 
        }
        }


        $shippingAddress = new AddressPersonal();
        $shippingName = new PersonalName();
        $shippingName->firstName = $data['firstName'];
        $shippingAddress->name = $shippingName;
        $shippingAddress->street = $data['street'];
        $shippingAddress->houseNumber = $data['houseNumber'];
        $shippingAddress->zip = $data['zip'];
        $shippingAddress->city = $data['city'];
        $shippingAddress->state = $data['state'];
        $shippingAddress->countryCode = $data['countryCode'];
        $customer->shippingAddress = $shippingAddress;


        $billingAddress = new Address();
        $billingAddress->street = $data['state'];
        $billingAddress->houseNumber = $data['houseNumber'];
        $billingAddress->zip = $data['zip'];
        $billingAddress->city = $data['city'];
        $billingAddress->state = $data['state'];
        $billingAddress->countryCode = $data['countryCode'];
        $customer->billingAddress = $billingAddress;


        $contactDetails = new ContactDetails();
        $contactDetails->emailAddress = $data['email'];
        $contactDetails->emailMessageType = "html";
        $contactDetails->phoneNumber = "+".$data['phone'];
        $contactDetails->faxNumber = "+".$data['phone'];
        $customer->contactDetails = $contactDetails;



        $amountOfMoney = new AmountOfMoney;
        if(empty($this->session->userdata('order_price')))
            { 
                 $amountOfMoney->amount = $sum*100; 
            }
            else
            { 
                 $amountOfMoney->amount = ($this->session->userdata('order_price')*100); 
            }
        $amountOfMoney->currencyCode = "USD";


        $shoppingCart = new ShoppingCart;
        $shoppingCart->items = $item_array;

        $order = new Order;
        $order->amountOfMoney = $amountOfMoney;
        $order->customer = $customer;
        $order->shoppingCart = $shoppingCart;
        $references = new OrderReferences();

        $references->merchantOrderId = $data['merchantOrderId'];
        $references->merchantReference = $data['merchantReference'];
        $references->descriptor = "Supergreen";

        $order->references = $references;

        
        // $hostedCheckoutSpecificInput->paymentProductFilters = new PaymentProductFiltersHostedCheckout();
        // $hostedCheckoutSpecificInput->paymentProductFilters->exclude = new PaymentProductFilter();
        //$createHostedCheckoutRequest->hostedCheckoutSpecificInput = $hostedCheckoutSpecificInput;

        $body = new CreateHostedCheckoutRequest;
        $body->hostedCheckoutSpecificInput = $hostedCheckoutSpecificInput;
        $body->order = $order;
        $response = $client->merchant($this->merchant)->hostedcheckouts()->create($body);
        return $response;
    
    }


    public function GetHostedCheckoutStatus($hostedCheckoutId)
    {
        $client = $this->getClient();
        $merchantId = $this->merchant;
        $getHostedCheckoutResponse = $client->merchant($merchantId)->hostedcheckouts()->get($hostedCheckoutId);
        return $getHostedCheckoutResponse->status;
    }




    function payment_response($merchantOrderId,$merchantReference)
    {
          
        $client = $this->getClient();
         $merchantId = $this->merchant;
        $query = new FindPaymentsParams();
        $query->merchantReference = $merchantReference;
        $query->merchantOrderId = $merchantOrderId;
        $query->offset = 0;
        $query->limit = 10;
        $response = $client->merchant($merchantId)->payments()->find($query);
        return $response;

    }

    public function paymentStatus($paymentId)
    {
        $client = $this->getClient();
        $paymentResponse = $client->merchant($this->merchant)->payments()->get($paymentId);
        return $paymentResponse;
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