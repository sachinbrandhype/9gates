<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('CartModel', 'basket');
        $this->load->model('HomeModel','homemodel',true);
        $this->load->library('cart');
    }
    function cart()
    {
        $data['cartItem'] = $this->homemodel->getCartItemValues();
        $ses = $this->homemodel->getSessionId();
        $data['citem']=$this->homemodel->totalCartItem($ses->session_id);
        $data['total'] = $this->homemodel->countTotalCart($ses->session_id);
        $data['banner'] =$this->homemodel->getAllBanner();
        $data['position1'] = $this->homemodel->getBannerPosition1();
        $data['position2'] = $this->homemodel->getBannerPosition2();
        $data['position3'] = $this->homemodel->getBannerPosition3();
        $data['position4'] = $this->homemodel->getBannerPosition4();
        $data['position5'] = $this->homemodel->getBannerPosition5();
        $data['position6'] = $this->homemodel->getBannerPosition6();
        $data['position7'] = $this->homemodel->getBannerPosition7();
        $data['position8'] = $this->homemodel->getBannerPosition8();
        $data['position9'] = $this->homemodel->getBannerPosition9();
        $data['position11'] = $this->homemodel->getBannerPosition11();
        $data['position10'] = $this->homemodel->getBannerPosition10();
        $data['position12'] = $this->homemodel->getBannerPosition12();
        $data['position13'] = $this->homemodel->getBannerPosition13();
        $data['position14'] = $this->homemodel->getBannerPosition14();
        $data['position15'] = $this->homemodel->getBannerPosition15();
        $data['position16'] = $this->homemodel->getBannerPosition16();
        $data['position17'] = $this->homemodel->getBannerPosition17();
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $this->load->view('cart',$data);
    }


    public function index() {
        $data = array();
        $data['page'] = 'shopping-cart';
        $data['title'] = 'My Cart | Bumaco';

        $data['cartItems'] = $this->cart->contents();

        echo"<pre>";

        print_r($data['cartItems']);

        $this->load->view('cart', $data);
    }


    // product add to basket	
    /*function add() {
        $json = array();

        if (!empty($this->input->post('productID'))) {
            $this->basket->setProductID($this->input->post('productID'));

            $productInfo = $this->basket->getProduct();

            $cartData = array(
                'id' => $productInfo['id'],
                'school_name' => $productInfo['school_name'],
                'class_name' => $productInfo['class_name'],
                'subject' => $productInfo['subject'],
                'product' => $productInfo['product'],
                'price' => $productInfo['price'],
                'state' => $productInfo['state'],
                'streming' => $productInfo['streming'],
                'language' => $productInfo['language'],
                'image' => $productInfo['image'],
            );
           $this->cart->insert($cartData);

            $json['status'] = 1;
            $json['counter'] = count($this->cart->contents());
        } else {
            $json['status'] = 0;
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // remove cart item
    function remove() {
        $json = array();
        if (!empty($this->input->post('productID'))) {
            $rowid = $this->input->post('productID');
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        header('Content-Type: application/json');
        echo json_encode($json);
    }*/



    // checkout item
    /*function checkout() {
        $data = array();
        $data['metaDescription'] = 'Shopping Cart';
        $data['metaKeywords'] = 'Shopping, Cart';
        $data['title'] = "Shopping Cart - TechArise";
        $data['breadcrumbs'] = array('Home' => site_url(), 'Checkout' => '#');
        $data['productInfo'] = $this->cart->contents();
        $this->load->view('cart/checkout', $data);
    }

    //  order now
    public function orderNow() {
        $productInfo = $this->cart->contents();
        $grandTotal = 0;
        $productList = array();
        foreach ($productInfo as $key => $element) {
            $grandTotal += $element['subtotal'];
            $productList[] = array(
                'id' => $element['id'],
                'name' => $element['name'],
                'model' => $element['model'],
                'price' => $element['price'],
                'qty' => $element['qty'],
                'subtotal' => $element['subtotal'],
            );
        }

        $customerID = 0;
        $firstname = $this->input->post('firstname');
        $lastname     = $this->input->post('lastname');
        $email = $this->input->post('email');
        $phone  = $this->input->post('phone');
        $company  = $this->input->post('company');
        $address  = $this->input->post('address');
        $country  = $this->input->post('country');
        $state  = $this->input->post('state');
        $city  = $this->input->post('city');
        $zipcode  = $this->input->post('zipcode');

        $timeStamp = time();

        // firstname validation
        if(empty(trim($firstname))){
            $json['error']['firstname'] = 'Please enter first name';
        }
        // firstname validation
        if(empty(trim($lastname))){
            $json['error']['lastname'] = 'Please enter last name';
        }
        // email validation
        if(empty(trim($email))){
            $json['error']['email'] = 'Please enter email address';
        }
        // check email validation
        if ($this->basket->validateEmail($email) == FALSE) {
            $json['error']['email'] = 'Please enter valid email address';
        }
        // check conatct no validation
        if($this->basket->validateMobile($phone) == FALSE) {
            $json['error']['phone'] = 'Please enter valid contact no. format: 9000000001';
        }
        // company validation
        if(empty($company)){
            $json['error']['company'] = 'Please enter company';
        }
        if(empty($address)){
            $json['error']['address'] = 'Please enter address name';
        }
        if(empty($address)){
            $json['error']['address'] = 'Please enter address';
        }
        if(empty($country)){
            $json['error']['country'] = 'Please enter country';
        }
        if(empty($state)){
            $json['error']['state'] = 'Please enter state';
        }
        if(empty($city)){
            $json['error']['city'] = 'Please enter city';
        }
        if(empty($zipcode)){
            $json['error']['zipcode'] = 'Please enter zipcode';
        }

        if(empty($json['error'])){

            $this->basket->setFirstName($firstname);
            $this->basket->setLastName($lastname);
            $this->basket->setEmail($email);
            $this->basket->setPhone($phone);
            $this->basket->setTimeStamp($timeStamp);
            // create customer
            $customerID = $this->basket->createCustomer();

            $this->basket->setCustomerID($customerID);
            $countInvoice = $this->basket->countInvoice();
            $fullInvoice = 'INV-' . str_pad($countInvoice + 1, 4, '0', STR_PAD_LEFT);

            $this->basket->setInvoiceNo($fullInvoice);
            $this->basket->setInvoicePrefix('INV');

            $this->basket->setPaymentFirstName($firstname);
            $this->basket->setPaymentLastName($lastname);
            $this->basket->setPaymentCompany($company);
            $this->basket->setPaymentAddress($address);
            $this->basket->setPaymentCity($city);
            $this->basket->setPaymentPostCode($zipcode);
            $this->basket->setPaymentCountry($country);
            $this->basket->setPaymentState($state);
            $this->basket->setPaymentMethod('COD');
            $this->basket->setPaymentCode('COD');
            $this->basket->setComment('note');
            $this->basket->setTotal($grandTotal);
            $this->basket->setOrderStatusID(1);
            $this->basket->setCurrencyID(1);
            $this->basket->setCurrencyCode('USD');
            $this->basket->setCurrencyValue('0.000000000');
            try {
                $last_id = $this->basket->createOrder();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if(!empty($last_id)) {
                foreach ($productList as $key => $element) {
                    $batch[] = array(
                        'order_id' => $last_id,
                        'product_id' => $element['id'],
                        'model' => $element['model'],
                        'quantity' => $element['qty'],
                        'price' => $element['price'],
                        'total' => $element['subtotal'],
                    );
                }
                $this->basket->setBatchData($batch);
                $this->basket->addOrderItem();
                $this->session->unset_userdata('cart_contents');
            }

            if (!empty($last_id) && $last_id > 0) {
                $orderID = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                $json['order_id'] = $orderID;
                $json['status'] = 'success';
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }*/
    // checkout item
   /* function success() {
        $data = array();
        $data['metaDescription'] = 'Shopping Cart';
        $data['metaKeywords'] = 'Shopping, Cart';
        $data['title'] = "Shopping Cart - TechArise";
        $data['breadcrumbs'] = array('Home' => site_url(), 'Success' => '#');
        $order_id = $this->input->get('order_id');
        $data['order_id'] = $order_id;
        $this->load->view('cart/success', $data);
    }*/

}
