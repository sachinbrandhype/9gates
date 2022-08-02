<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel','homemodel',true);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('email');
        $this->load->helper('string');
        $this->load->helper('array');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper('text');
        

    }
///$this->db->where_in('id', explode(",", $ids));
//$this->db->delete('items');
//https://www.webslesson.info/2018/11/how-to-delete-multiple-records-using-checkbox-in-codeigniter.html

    function fashion()
    {
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
        $this->load->view('fashion',$data);

    }

    function makeup($url)
    {
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
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $data['beautycat'] =$this->homemodel->getBottomCategoryByUrl($url);
        $this->load->view('makeup',$data);

    }

    function beauty($url)
    {
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
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $data['beautycat'] =$this->homemodel->getBottomCategoryByUrl($url);
        $this->load->view('beauty-category',$data);

    }



    function addToCart()
    {
        $this->load->library('cart');
        $this->load->library('session');

        $id=$this->input->post('productID');
        $product = $this->homemodel->getsRowData($id);
        $prid = $product->id;
        $prname = $product->product;
        $price = $product->mrp;
        $retail = $product->retail;
        $short = $product->short_description;
        $image = $product->fimage;
        
        $data = array(
            'product_id' => $prid,
            'product' => $prname,
            'price' => $price,
            'retail' => $retail,
            'short_description' => $short,
            'image' => $image,
            'session_id' => $this->session->session_id,
             'qty' => 1
            
            );


       /*echo"<pore>";
        print_r($data);


        $this->cart->insert($data);

        echo count($this->cart->contents());*/

        //$this->load->view('cart');


        //$this->cart->insert($data);

      // echo $this->show_cart();

        //$this->homemodel->saveCart('temp_cart',$data);

        $this->homemodel->saveCartItem('cart',$data);

        echo $this->show_cart();
       
       //redirect('cart');
        
    }
    
    function show_cart()
    {
        /*$items = $this->cart->contents();

        var_dump($items);*/

      $id =$this->session->session_id;
        echo $this->homemodel->totalCartItem($id);

    }

    function load_cart(){
       echo $this->show_cart();
    }

    function getSearchProduct111()
    {
        $key = $this->input->post("key");
        $data['d'] = $this->homemodel->getDataByFilterId111($key);
        $prid =$data['d']->productid;
        echo $this->homemodel->getproctFilterByGroup($prid);
        
    }
     
    function getSearchProduct11()
    {
        $key = $this->input->post("key");
        $data['d'] = $this->homemodel->getDataByFilterId11($key);
       $prid =$data['d']->productid;
        echo $this->homemodel->getproctFilterByGroup($prid);
        
    }

    function getSearchProduct()
    {
        $key = $this->input->post("key");
        $data['d'] = $this->homemodel->getDataByFilterId($key);
        $prid =$data['d']->productid;
        echo $this->homemodel->getproctFilterByGroup($prid);
        
    }
    function schoolsearch()
    {
        $keyword=$this->input->post('school_search');

        $data['sch']=$this->homemodel->searchAllSchoolData($keyword);

        $this->load->view('schoolsearch', $data);
    }



    function searchalldata()
    {
        $keyword=$this->input->post('search_key');

        $data['pro']=$this->homemodel->searchAllData($keyword);

        $this->load->view('searchdata', $data);
    }
 
    function contactmail()
    {
        
        $name = $this->input->post('name');
        $phone  = $this->input->post('phone');
        $email = $this->input->post('email');
        $des  = $this->input->post('des');
        $list = array('no-reply info@gyansansarweb.com');
        $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => '146.196.39.57',
		'smtp_user' => 'info@modernwalk.in',
		'smtp_pass' => ',OCwa7yeDVp0',
		'smtp_port' => '21',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'crlf' => "\r\n",
		'newline' => "\r\n"
    	);        
    	$this->load->library('email', $config); 
    	$this->email->set_mailtype("html"); 
    	$this->email->from('info@modernwalk.in', 'The After Morning');
    	$this->email->to($list);
    	//$this->email->cc('another@another-example.com');
    	//$this->email->bcc('them@their-example.com');
    	$this->email->subject('Contact Inquiry From The After Morning');
							
		
        $message = "<html><body >";
        $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='http://onewebexperts.com/gyansansar/public/images/logo.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Name</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $name. PHP_EOL . "</td> </tr>";
        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email . PHP_EOL . "</td> </tr>";

        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Phone</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $phone . PHP_EOL . "</td> </tr>";


        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Description</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $des . PHP_EOL . "</td> </tr>";

            $message .= "</table></div>";
            $message .= "</body></html>";
            $this->email->message($message);	
		    $qr = $this->email->send();
		     
		    $data['error']="Your contact inquiry sent successfully";
		    $this->load->view('contact-us',@$data);
        //redirect($_SERVER['HTTP_REFERER']);

    }

    public function sendpassword()
    {
        
        $email=$this->input->post('email');
        if(!empty($email)){
        $que=$this->db->query("select password,email from user where email='$email'");
       
        $row=$que->row();
        
        
        
        $uemail=$row->email;
        $pass=$row->password;
        
        
        $list = array($email);
        $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => '149.202.98.186',
		'smtp_user' => 'info@modernwalk.in',
		'smtp_pass' => ',OCwa7yeDVp0',
		'smtp_port' => '21',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'crlf' => "\r\n",
		'newline' => "\r\n"
    	);        
    	$this->load->library('email', $config); 
    	$this->email->set_mailtype("html"); 
    	$this->email->from('info@modernwalk.in', 'The After Morning');
    	$this->email->to($list);
    	$this->email->subject('Your login details of The After Morning');
							
		
        $message = "<html><body >";
        $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='http://onewebexperts.com/gyansansar/public/images/logo.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email. PHP_EOL . "</td> </tr>";
        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Password</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $pass . PHP_EOL . "</td> </tr>";

        $message .= "</table></div>";
        $message .= "</body></html>";
        $this->email->message($message);	
	    $qr = $this->email->send();
	    
	    $data['error']="Please check your mail, password sent";
        }
        $this->load->view('forgatepassword',@$data);
        

        
    }


      

    function changePriceByState($state)
    {
        //$state =$this->input->post('state');

       /*$ind = $this->homemodel->matchPriceByState($state);
        echo json_encode($ind);*/

        $result = $this->db->where("state",$state)->get("product")->result();
        echo json_encode($result);


    }

    function addtowishlist() {

        $id = $this->input->post('productID');


            $productInfo = $this->homemodel->getsRowData($id);
           
            $cartData = array(
                'product_id' => $productInfo->id,
                'product' => $productInfo->product,
                'price' => $productInfo->price,
                'image' => $productInfo->image,
            );
            $this->homemodel->saveWishlist('wishlist',$cartData);



        //echo $this->show_cart();

    }

    function register()
    {

        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $this->load->view('register',$data);

    }



    function  filtergropdataname()
    {
        $name=$this->input->post('filtergroup');
        if($name)
        {
            echo $this->homemodel->fetchFilterGroupDataName($this->input->post('filtergroup'));

        }
    }


    function loginuser()
    {
        $email= $this->input->post('email');
        $pass = $this->input->post('password');


        $check = $this->homemodel->logingUser($email,$pass);


        if($check){
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['id'] = $check->id;
            $this->session->userdata['name'] = $check->name;
            $this->session->userdata['email'] = $check->email;
            redirect('home/myaccount');
        } else{
            $data['error1'] = $this->session->set_flashdata('error','Invalid login. Email or Password not found');
            redirect('home/login',$data);

        }
        redirect($_SERVER['HTTP_REFERER']);

    }
    function registeruser(){



        $email = $this->input->post('email');
        $pass = $this->input->post('password');


        $insert['name'] =$this->input->post('name');
        $insert['email'] =$this->input->post('email');
        $insert['phone'] =$this->input->post('mobile');
        $insert['password'] =$this->input->post('password');


        $checkUser = $this->homemodel->checkUser($email);



        if($checkUser){

            $data['error']=$this->session->set_flashdata('error','Email Already Exists');
            redirect('home/login',$data);

        }
        else
        {
        $in =$this->homemodel->registerUser('user',$insert);
        if($in)
        {
           
        $list = array($email);
        $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => 'ssl://mail.modernwalk.in',
		'smtp_user' => 'Info@modernwalk.in',
		'smtp_pass' => ',kapil*123',
		'smtp_port' => '465',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'crlf' => "\r\n",
		'newline' => "\r\n"
    	);  
    	 
    	$this->load->library('email', $config); 
    	$this->email->set_mailtype("html"); 
    	$this->email->from('info@modernwalk.in', 'The After Morning');
    	$this->email->to($list);
    	$this->email->subject('Register Successfully, Please login now');
							
		
        $message = "<html><body >";
        $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='http://modernwalk.in/aftermorning/front/images/logo.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email. PHP_EOL . "</td> </tr>";
        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Password</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $pass . PHP_EOL . "</td> </tr>";

        $message .= "</table></div>";
        $message .= "</body></html>";
        $this->email->message($message);	
	    $qr = $this->email->send();
	    
	    $data['error']="Register Successfully, Please login now ";
	    
        redirect('home/login',@$data);
        }
        else

        {
        $data['error']=$this->session->set_flashdata('error','Register Successfully, Please login now ');
        redirect('home/login',$data);
        }
        redirect('home/index');
        }
    }

    function ordernow(){
        $userid = $this->input->post('userid');
        $last_id = $this->input->post('product_id');
        $firstname = $this->input->post('firstname');
        $lastname     = $this->input->post('lastname');
        $email = $this->input->post('email');
        $phone  = $this->input->post('phone');
        $school_name  = $this->input->post('school_name');
        $school_address  = $this->input->post('school_address');
        $student_addmission  = $this->input->post('student_addmission');
        $street_address  = $this->input->post('street_address');
        $apartment = $this->input->post('apartment');
        $city  = $this->input->post('city');
        $state  = $this->input->post('state');
        $userstate  = $this->input->post('userstate');
        $zipcode  = $this->input->post('pincode');
        $des  = $this->input->post('des');


        $data['userid'] =$userid;
        $data['orderid'] =$last_id;
        $data['firstname'] =$firstname;
        $data['lastname'] =$lastname;
        $data['email'] =$email;
        $data['phone'] =$phone;
        $data['school_name'] =$school_name;
        $data['school_address'] =$school_address;
        $data['student_addmission'] =$student_addmission;
        $data['street_address'] =$street_address;
        $data['apartment'] =$apartment;
        $data['city'] =$city;
        $data['state'] =$state;
        $data['userstate'] =$userstate;
        $data['pincode'] =$zipcode;
        $data['des'] =$des;



        $productInfo = $this->homemodel->getProduct($last_id);



        $data['class_name'] = $productInfo['class_name'];
        $data['product'] = $productInfo['product'];
        $data['product_url'] = $productInfo['product_url'];
        $data['price'] = $productInfo['price'];
        $data['shipping_charge'] = $productInfo['shipping_charge'];
        $data['product_state'] = $productInfo['state'];
        $data['image'] = $productInfo['image'];
        $data['status'] = 1;
        
         $dtl=$this->homemodel->deleteCartItems($last_id);
        
         $ins =  $this->homemodel->saveOrder('tbl_order',$data);
           
         $this->homemodel->updateUserInfo($userid);


        if($ins)
        {

        $list = array('no-reply info@gyansansarweb.com',$email);
        $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => '146.196.39.57',
		'smtp_user' => 'info@gyansansarweb.com',
		'smtp_pass' => ',OCwa7yeDVp0',
		'smtp_port' => '21',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'crlf' => "\r\n",
		'newline' => "\r\n"
    	);        
    	$this->load->library('email', $config); 
    	$this->email->set_mailtype("html"); 
    	$this->email->from('info@gyansansarweb.com', 'Gyan Sansar');
    	$this->email->to($list);
    	//$this->email->cc('another@another-example.com');
    	//$this->email->bcc('them@their-example.com');
    	$this->email->subject('Order Details From Gyan Sansar');
            $message = "<html><body >";
            $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='http://localhost/ci-project/gyansansar/public/images/logo.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>School Name</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['school_name']. PHP_EOL . "</td> </tr>";
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Class Name</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['class_name'] . PHP_EOL . "</td> </tr>";

            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Product</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['product'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Price</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['price'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Shipping Charge</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['shipping_charge'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>State</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $state . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Streming</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['streming'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Language</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $productInfo['language'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Product Image</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;'.$productInfo['language'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>First Name</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;'.$firstname . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Phone</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;'.$phone . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Address</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;'.$street_address . PHP_EOL . "</td> </tr>";


            $message .= "</table></div>";
            $message .= "</body></html>";
            
            $this->email->message($message);	
		    $qr = $this->email->send();
		     
		   $data['error'] = $this->session->set_flashdata('Order successfully. Thank you ');
		    $this->load->view('contact-us',@$data);

            $this->homemodel->deleteCartItemsEmpty($last_id);

            
           // echo json_encode($data);
            redirect('home/finalpayment',$data);


        }
        else
        {
            echo"Fail";
        }

       // echo json_encode($json);

    }

    function finalpayment()
    {
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $userid =$this->session->userdata['id'];
        $data['user']= $this->homemodel->getUserDataById($userid);
        $data['orderfianl'] = $this->homemodel->finalOrder();
        $this->load->view('finalcheckout',$data);
    }
    function deletewishlist($id)
    {
        $this->homemodel->deleteWishList($id);
        redirect($_SERVER['HTTP_REFERER']);
    }




    function accdetails()
    {
        if($this->session->userdata('isUserLogin') != TRUE){
            redirect('home');
        }
        $userid=$this->session->userdata['id'];
        $this->homemodel->updateAccountDetail($userid);
        redirect($_SERVER['HTTP_REFERER']);

    }

    function updateCartItem($id)
    {
        $this->homemodel->updateCart($id);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('index');
    }
    function myaccount()
    {

    if($this->session->userdata('isUserLogin') != TRUE){
            redirect('home/login');
        }
        $userid =$this->session->userdata('id');


        $data['user'] = $this->homemodel->getUserDataById($userid);

        $data['order'] = $this->homemodel->getOrderByid($userid);


        $data['wish'] =$this->homemodel->getWishList();
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $this->load->view('my-account',$data);
    }
    function checkout()
    {
       /* if($this->session->userdata('isUserLogin') != TRUE){
            redirect('home/register');
        }*/
        error_reporting(0);
        $data['cartItem'] = $this->homemodel->getCartItemValues();
        $ses = $this->homemodel->getSessionId();
        $data['citem']=$this->homemodel->totalCartItem($ses->session_id);
        $data['total'] = $this->homemodel->countTotalCart($ses->session_id);
        //$data['testi'] = $this->homemodel->getTestimonial();*/
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

        $data['cartItems'] =$this->cart->contents();
        $userid=$this->session->userdata['id'];

        //$data['st'] =$this->homemodel->getAllState();
        $data['user']= $this->homemodel->getUserDataById($userid);
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $this->load->view('checkout',$data);


    }

    function updateQty()
    {
        $id =$this->input->post('id');
        $qty = $this->input->post('qty');

        $data =array(
            'qty' =>$qty
        );
        $this->db->where(array('product_id' => $id));
        $this->db->update('cart', $data);
        //$this->homemodel->updateCartQty($data);
    }

    function cart()
    {
        error_reporting(0);
        $data['cartItem'] = $this->homemodel->getCartItemValues();
        $ses = $this->homemodel->getSessionId();
        $id =$this->session->session_id;
        $data['citem']=$this->homemodel->totalCartItem($id);
        $data['total'] = $this->homemodel->countTotalCart($ses->session_id);
         //$data['testi'] = $this->homemodel->getTestimonial();*/
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

        $data['cartItems'] =$this->cart->contents();

        $this->load->view('cart',$data);
    }

    function index()
    {
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
        $data['pro'] =$this->homemodel->getAllProductList();

        $this->load->view('index',$data);


    }
    
    function delete_wish($id)
    {

        $this->homemodel->deleteWishItem($id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function delete_cart($id)
    {

       $data['data']= $this->homemodel->deleteCartItem($id);

        print_r ($data['data']);
        //redirect($_SERVER['HTTP_REFERER']);
    }

    function myclass($url)
    {
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        //$url = $this->uri->segment(2);
        $data['sc'] =$this->homemodel->getschoolNameByUrl($url);
        $data['school'] =$this->homemodel->getAllSchoolDataByUrl($url);
        $id=$data['school']->id;
        $data['class'] =$this->homemodel->getAllClassBySchool($id);
        $this->load->view('myclass',$data);
    }

    function product($id)
    {
        
        $data['productInfo'] = $this->homemodel->getCartItemValues();

        $data['proid'] =$this->homemodel->getproId($id);
        
        if(!empty($data['proid']->school_name))
        {
        $p = $data['proid']->school_name;
        }
        else 
        {
            
        }
        if(!empty($p)){
        $data['scname'] =$this->homemodel->getschoolName($p);
        }
        else {
            
        }
        $data['p']=$this->homemodel->getAllProductByClass($id);

        $data['cname']=$this->homemodel->getAllClassNameByProduct($id);
        
        $data['product'] =$this->homemodel->getAllProduct($id);
        
        
        if(!empty($data['proid']->id)){
        $prid =$data['proid']->id;
        

        $data['class'] =$this->homemodel->getAllClass();
        
        $data['subject'] =$this->homemodel->getAllSubject();

        $data['group'] =$this->homemodel->getGroupFilter();
        $data['filter'] =$this->homemodel->filterGroupDataById($prid);

        $data['groupname'] = $this->homemodel->filterGroupDataByNameGroupTable($prid);
        
        
        
        $data['filter2'] =$this->homemodel->filterGroupDataById2($prid);

        $data['groupname2'] = $this->homemodel->filterGroupDataByNameGroupTable2($prid);



        $data['filter3'] =$this->homemodel->filterGroupDataById3($prid);

        $data['groupname3'] = $this->homemodel->filterGroupDataByNameGroupTable3($prid);
        }
        else
        {
            
        }

        $this->load->view('product',$data);
    }
    
    function productdetail($url)
    {
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['proid'] =$this->homemodel->getproIdByUrl($url);
/*
        $p =$data['proid']->school_name;

        $data['scname'] =$this->homemodel->getschoolName($p);*/

        $data['productInfo'] = $this->homemodel->getCartItemValues();
        // echo $url = $this->uri->segment(3);
        $data['product'] =$this->homemodel->getAllProductByClass($url);
        $data['reproduct'] =$this->homemodel->getAllRelatedProduct($url);

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
        $this->load->view('listing',$data);
    }

    function category($url)
    {
        $data['testi'] = $this->homemodel->getTestimonial();
        $data['categ'] = $this->homemodel->getCategoryByUrl($url);
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();

        $this->load->view('category',$data);
    }

    function listing($url)
    {
        $data['testi'] = $this->homemodel->getTestimonial();
        $data['prod'] = $this->homemodel->getproductyByUrl($url);
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $this->load->view('product-detail',$data);
    }


    function subcategory($url)
    {
        $data['testi'] = $this->homemodel->getTestimonial();
        $data['scate'] = $this->homemodel->getSubCategoryByUrl($url);
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $this->load->view('subcategory',$data);
    }
    function wishlist()
    {
        $data['wish'] = $this->homemodel->getWishLishData();
         $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('wishlist',$data);

    }

    function about()
    {
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('about-us',$data);

    }


    function returnpolicy()
    {
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
        $this->load->view('return-policy');

    }

    function contact()
    {
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
         $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('contact-us',$data);

    }
    function termscondition()
    {
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('terms-condition',$data);

    }
    
     function privacypolicy()
    {
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('privacy-policy',$data);

    }

    function forgatepass()
    {
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $this->load->view('forgatepassword',$data);

    }

    function login()
    {
        $this->load->view('login');
    }



}