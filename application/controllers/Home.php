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
        $this->load->library('cart');

    } 
///$this->db->where_in('id', explode(",", $ids));
//$this->db->delete('items');
//https://www.webslesson.info/2018/11/how-to-delete-multiple-records-using-checkbox-in-codeigniter.html


    function discount()
        {
            $data['voucher1'] =$this->homemodel->getVouchers1();
            $data['topcat'] =$this->homemodel->getTopCategory();
            $data['botcat'] =$this->homemodel->getBottomCategory();
            $this->load->view('discount',$data);
    
        }



    function voucher()
    {
        $data['voucher'] =$this->homemodel->getVouchers();
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $this->load->view('offer',$data);

    }

    function returnproduct($id)
    {
        
         $this->homemodel->returnOrderByOderId($id);
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
     function canceledproduct($id)
    {
        
         $this->homemodel->cancelProductByOderId($id);
        
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    function paymentCheckOut()
    {
       $this->homemodel->updatePaymentStatus();
    }
    
     function thank_you()
     {
         $data['topcat'] =$this->homemodel->getTopCategory();
         $this->load->view('thankyou',$data);
     }
    
    
    function updateprofile($id)
    {
        
       $this->homemodel->updateProfileData($id);
       redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    function updateCheckOut()
    {
        
       $this->homemodel->updateOrderItem();
    }

    function subscribeEmail(){
        $arr['email'] = $this->input->post('email');
        $email = $this->input->post('email');
        $save = $this->homemodel->saveSubscribe($arr);

        if(!empty($save)){

        $list = array('no-reply info@sarkarinaukrilive.com',$email);
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => '162.214.80.34',
            'smtp_user' => 'info@sarkarinaukrilive.com',
            'smtp_pass' => 'PZALIVobpfEY',
            'smtp_port' => '21',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        );
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->from('info@sarkarinaukrilive.com', '9Gates');
        $this->email->to($list);
        $this->email->cc($email);
        $this->email->subject('Subscribe enquiry From 9Gates');


        $message = "<html><body >";
        $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='https://brandhype.co.in/bumaco/public/img/logo1.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

        $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email. PHP_EOL . "</td> </tr>";


        $message .= "</table></div>";
        $message .= "</body></html>";

        $this->email->message($message);
        $this->email->send();

        $data['error'] = 'Send mail successfully. Thank you ';
        $this->load->view('index',@$data);
       // echo json_encode($data);

        }
    }


    function removewishlist($id)
    {
        //$id = $this->input->post('cartid');
         $this->homemodel->deleteWishListDataList('wishlist', array("id" => $id));
       redirect($_SERVER['HTTP_REFERER']);
    }

    function productFilterByChaildCategory()
    {
        //$name = $this->input->post('langPref');
        $brand_filter = implode("','", $this->input->post('langPref'));
        if($brand_filter)
        {
            //$a = implode('","', $name);
            echo $this->homemodel->fetchFilterDataListByChiltCategory($brand_filter);

        }
    }
    
    function ratingFilter()
    {
        $name = $this->input->post('rating');
        
        if(!empty($name)){
        echo $this->homemodel->ratingDataList($name);
        }
        else 
        {
            echo 'No Data Found';
        }
        
     /* $data['reting'] = $this->homemodel->getRatingData($name);
      
      foreach($data['reting'] as $rat ){
         
          $id = $rat->proid;
      }
         echo $this->homemodel->ratingDataList($id);*/   

         
    }
    
     
    
     function lowFiltercat()
    {     
        $name = $this->input->post('low');
        
        if($name)
        {
            echo $this->homemodel->fetchlowDataListCat($name);

        } 
         
    }
    
    function highFiltercat()
    {
        $name = $this->input->post('high');
        
        if($name)
        {
            echo $this->homemodel->fetchhighDataListCat($name);

        } 
         
    } 
    
    
    
    
    function lowFilter()
    {     
        $name = $this->input->post('low');
        
        if($name)
        {
            echo $this->homemodel->fetchlowDataList($name);

        } 
         
    }
    
    function highFilter()
    {
        $name = $this->input->post('high');
        
        if($name)
        {
            echo $this->homemodel->fetchhighDataList($name);

        } 
         
    } 
    
    function newarrivalFilter()
    {
        $name = $this->input->post('newarrival');
        
        if($name=='New Arrivals')
        {
            echo $this->homemodel->fetchFilterDataList($name);

        } 
        
    }
    
    function discountFilter()
    {
        $name = $this->input->post('discount');
        
        if($name=='Discount')
        {
            echo $this->homemodel->fetchFilterDataList($name);

        }
        
        
    }
    
    function populartiFilter()
    {
        $name = $this->input->post('proid');
        
        if($name=='Popularity')
        {
            echo $this->homemodel->fetchPopularDataList();

        }
       
    }
    
    function saveCheckOut(){

         $userid = $this->session->userdata['userid'] ;
         
         //$userid = $this->input->post('userid');
        $userInfo = $this->homemodel->getUserInfoDetails($userid);
        
        $phone = $userInfo->phone;
        $arr['fname'] = $this->input->post('fname');
        $arr['lname'] = $this->input->post('lname');
        $arr['email'] = $this->input->post('email');
        $arr['street_no'] = $this->input->post('street_no');
        $arr['city'] = $this->input->post('city');
        $arr['state'] = $this->input->post('state');
        $arr['email'] = $this->input->post('email');
        $arr['pincode'] = $this->input->post('pincode');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $stret = $this->input->post('street_no');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $method = $this->input->post('payment_method');
        $pincode = $this->input->post('pincode');
        
        
		$ip_address = $this->homemodel->get_ip();
		
         $this->homemodel->updateCheckoutData($userid, $arr);
        
        
        //$orderid = $this->db->insert_id();
        
           
        
        if($method == 'COD'){
        $cart = $this->cart->contents();
        	$randomNumber = random_int(100000, 999999);
                $this->session->userdata['ord'] = $randomNumber;
                $prime = $this->session->userdata['ord'];
                if(!empty($cart)){
       $subtotal = 0;
       $s = array();
        foreach($cart as $item)
		{
        
        $id = $item["id"];
       
        
         $total_price1 = $item["qty"]*$item["retail"];
        
        
                $subtotal = $subtotal + ($item['retail']*$item['qty']);
                
                
             
                
                
                
                if ( ! isset($s['total'])) {
                $s['total'] = null;
                }
                $s['total'] = $s['total'] + ($item['retail']*$item['qty']);
                
                
		
                
        $p = $this->homemodel->getProductName($id);
        
        $ins_data = array(
		              "orderid" => $prime,
					  "product_id" => $item["id"],
					  "product" => $p->product,
					  "image" => $item["image"],
					  "sku" => $item["sku"],
					  "product_url" => $p->product_url,
					  "short_description" => $p->short_description,
					  "hsnno" => $item["hsnno"],
					  "qty" => $item["qty"],
					  "price" => $item["retail"],
					  "total_price" => $subtotal,
					  "total" => $s['total'],
					  "ip_address" => $ip_address,
					  "userid" => $userid,
					  'session_id' => $this->session->session_id,
					  'payment_method' =>$method,
					  'status' =>"pending"
					);
					
					
					 
					
                    $odid = $this->db->insert('tbl_order',$ins_data);
					$id = $this->db->insert_id();
					//Minus in stock quantity
					
					$sql5 = "update product set stock=stock-? where id=?";
					$val5 = array($item["qty"],$item["id"]);
					$this->homemodel->iud_data($sql5,$val5);
		}
        $list = array('no-reply info@sarkarinaukrilive.com',$email);
        $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => '162.214.80.34',
		'smtp_user' => 'info@sarkarinaukrilive.com',
		'smtp_pass' => 'PZALIVobpfEY',
		'smtp_port' => '21',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'crlf' => "\r\n",
		'newline' => "\r\n"
    	);        
    	$this->load->library('email', $config); 
    	$this->email->set_mailtype("html"); 
    	$this->email->from('info@sarkarinaukrilive.com', '9Gates');
    	$this->email->to($list);
    	$this->email->cc($email);
    	//$this->email->bcc('them@their-example.com');
    	$this->email->subject('Order Details From 9Gates');
            $message = "<html><body >";
            $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='https://brandhype.co.in/riviera/private/img/logo-1.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>User Name</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $fname.$lname. PHP_EOL . "</td> </tr>";
            
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email. PHP_EOL . "</td> </tr>";
					
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Product</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['name'] . PHP_EOL . "</td> </tr>";

            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Price</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['price'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Image</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['image'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Street No </td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $stret . PHP_EOL . "</td> </tr>";


            
            
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>State</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $state . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>City</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $city . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Total</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['price']*$item['qty'] . PHP_EOL . "</td> </tr>";

            $message .= "</table></div>";
            $message .= "</body></html>";
            $message .= 'Cash On Delivery';
            $this->email->message($message);	
		    $qr = $this->email->send();
		    $this->cart->destroy();
		 
		    echo "1";
            $this->load->view('thankyou');
		}
        
        }
        
        
        
        else if($method == 'Razorpay')
        {
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $stret = $this->input->post('street_no');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $method = $this->input->post('payment_method');
        $pincode = $this->input->post('pincode');
            
        
				$randomNumber = random_int(100000, 999999);
                $this->session->userdata['ord'] = $randomNumber;
                $prime = $this->session->userdata['ord'];
					
				$cart = $this->cart->contents();
                 if(!empty($cart)) 
                 {
                     $subtotal=0;
                    $s = array();
                foreach ($cart as $item) {
                $tPrice=$item['price'];
                $subtotal = $subtotal + ($item['retail']*$item['qty']);
                
                if ( ! isset($s['total'])) {
                $s['total'] = null;
                }
                $s['total'] = $s['total'] + ($item['retail']*$item['qty']);
               
               
                $id = $item["id"];
                
               
                
                //$prid = $this->session->userdata($id);
                
              
                $subtotal = $subtotal + ($item['retail']*$item['qty']);
                        
                $p = $this->homemodel->getProductName($id);
            
                
                $qty = $item["qty"];
                $ins_data = array(
		              "orderid" => $prime,
					  "product_id" => $item["id"],
					  "product" => $p->product,
					  "image" => $item["image"],
					  "sku" => $item["sku"],
					  "product_url" => $p->product_url,
					  "short_description" => $p->short_description,
					  "hsnno" => $item["hsnno"],
					  "qty" => $item["qty"],
					  "price" => $item["retail"],
					  "total_price" => $subtotal,
					  "total" => $s['total'],
					  "ip_address" => $ip_address,
					  "userid" => $userid,
					  'session_id' => $this->session->session_id,
					  'payment_method' =>$method,
					  'status' =>"pending"
					); 
					
					
				 	
            $this->homemodel->saveOrderPayment($ins_data);
            $id = $this->db->insert_id();
            
    		$sql5 = "update product set stock=stock-? where id=?";
    		$val5 = array($qty,$id);
    	    $this->homemodel->iud_data($sql5,$val5);
        	
        $list = array($email);
        $config = Array(
		'protocol' => 'smtp',
		'smtp_host' => '162.214.80.34',
		'smtp_user' => 'info@sarkarinaukrilive.com',
		'smtp_pass' => 'PZALIVobpfEY',
		'smtp_port' => '21',
		'mailtype'  => 'html',
		'charset'   => 'iso-8859-1',
		'crlf' => "\r\n",
		'newline' => "\r\n"
    	);        
    	$this->load->library('email', $config); 
    	$this->email->set_mailtype("html"); 
    	$this->email->from('info@sarkarinaukrilive.com', '9Gates');
    	$this->email->to($list);
    	$this->email->cc($email);
    	//$this->email->bcc('them@their-example.com');
    	$this->email->subject('Order Details From 9Gates');
            $message = "<html><body >";
            $message .= "<div style='background:#dcdcdc; width:499px; padding:4px 5px;'>
				<table style='width:500px; background-color:#fff;border:0; padding:10px; margin:0 auto;' cellpadding='0' cellpadding='0'>
				<tr><td colspan='2'><table width='100%' cellpadding='0' cellspacing='0' border='0'>
				<tr><td style='color: #0eabd4;padding:10px 0;border-bottom: 2px solid #eee;border-top: 2px solid #eee;border-left: 2px solid #eee;border-right: 2px solid #eee;padding: 5px;'><img src='https://brandhype.co.in/bumaco/public/img/logo1.png' style='max-height: 67px !important;margin:auto;'></td>
				</tr></table></td></tr>";

            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>User Name</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $fname.$lname. PHP_EOL . "</td> </tr>";
            
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Email</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $email. PHP_EOL . "</td> </tr>";
					
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Product</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['name'] . PHP_EOL . "</td> </tr>";

            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Price</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['retail'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Image</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['image'] . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Street No </td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $stret . PHP_EOL . "</td> </tr>";

            
            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>State</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $state . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>City</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $city . PHP_EOL . "</td> </tr>";


            $message .= "<tr>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>Total</td>
					<td style='border-bottom:2px solid #eee;border-top:2px solid #eee;border-left:2px solid #eee;border-right:2px solid #eee; padding:5px; color:#343333; font-size:13px;' align='left'>" . '&nbsp;' . $item['retail']*$item['qty'] . PHP_EOL . "</td> </tr>";

            $message .= "</table></div>";
            $message .= "</body></html>";
            $message .= 'Onlin Payment';
            $this->email->message($message);	
		    $qr = $this->email->send();
		     $this->cart->destroy();
            //redirect('home/payment');
            
            echo "2";
        
          }
        }
       
      }
       
    } 
    
    public function payment()
	{
	    $userid = $this->session->userdata['userid'] ;
	    $order = $this->session->userdata['ord'];

	    $data['save'] = $this->homemodel->getOrderdata($order,$userid);
		$this->load->view('payment/index',$data);
	}

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
    
    

    function c($url)
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
        $catId = $this->homemodel->getCategoryIdByUrl($url);
        
        $data['prod'] = $this->homemodel->getproductyByUrl($url);
        
        $data['catBanner'] = $this->homemodel->getMultipleCategoryImageById($catId->id); 
        
        /*$data['cartItem'] = $this->homemodel->getCartItemValues();
        $ses = $this->homemodel->getSessionId();
        $id =$this->session->session_id;
        $data['citem']=$this->homemodel->totalCartItem($id);
        $data['total'] = $this->homemodel->countTotalCart($ses->session_id);*/
        
        
        
        $this->load->view('makeup',$data);

    }
   
    
    function sb($url)
    {
    
        $urlid = $this->uri->segment(3);
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $catId = $this->homemodel->getCategoryIdByUrl($urlid);
        $data['catBanner'] = $this->homemodel->getMultipleCategoryImageById($catId->id); 
        //$data['cartItem'] = $this->homemodel->getCartItemValues();
        /*$ses = $this->homemodel->getSessionId();
        $id =$this->session->session_id;
        $data['citem']=$this->homemodel->totalCartItem($id);
        $data['total'] = $this->homemodel->countTotalCart($ses->session_id);*/
        $this->load->view('subcategory',$data);
    }
    
    function ch($url)
    {
        $urlid = $this->uri->segment(3);
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $catId = $this->homemodel->getCategoryIdByUrl($urlid);
        $data['catBanner'] = $this->homemodel->getMultipleCategoryImageById($catId->id); 
        
        $this->load->view('childcategory',$data); 
    }
    
    
    function childcategory()
    {
      $this->load->view('childcategory');   
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
        //$this->load->library('cart');
        $this->load->library('session');

        $id = $this->input->post('productID');
        $product = $this->homemodel->getsRowData($id);
        $prid = $product->id;
        $prname = preg_replace('/[^A-Za-z0-9\-\']/', '', $product->product);;
        $url = $product->product_url;
        $price = $product->mrp;
        $retail = $product->retail;
        $sku = $product->sku;
        $hsnno = $product->hsnno;
        $short = $product->short_description;
        $image = $product->fimage;
        
        $insert_data333 = array(
            'id' => $prid,
            'name' => $prname,
            'product_url' => $url,
            'price' => $price,
            'retail' => $retail,
            'short_description' => $short,
            'image' => $image,
             'qty' => 1
            
            ); 
            
            $insert_data = array(
								'id' => $prid,
								'qty' => 1,						
								'price' => $price,
								'image' => $image,
                                'retail' => $retail,
                                'sku' => $sku,
                                'hsnno' => $hsnno,
                                'short_description' => $short,
                                'product_url' => $url,
								//'diccount' => 10,
								'name' => $prname
							);
       
       
       
        
			 $this->cart->insert($insert_data);
		 
			 echo count($this->cart->contents());
			 redirect($_SERVER['HTTP_REFERER']);
			
        
    }
    
      function remove($rowid) 
		{	
			//$rowid = $this->input->post('cartid');
			// Destroy selected rowid in session.
				$data = array(
					'rowid'   => $rowid,
					'qty'     => 0
				);
						 // Update cart data, after cancle.
				$this->cart->update($data);
			//$data['msg1'] = '<div class="alert alert-danger">Product Removed Successfully.</div>';
			$this->session->set_flashdata ('<div class="alert alert-danger">Product Removed Successfully.</div>');
			//$this->session->set_flashdata('msg1',$msg);
			redirect($_SERVER['HTTP_REFERER']);	
	    }
	    
	    
	    
     function update_cart()
    {
        // Recieve post values,calcute them and update
		$cart_info = $_POST['cart'] ;
		foreach( $cart_info as $id => $cart)
		{
				$rowid = $cart['rowid'];
				$price = $cart['retail'];
				$amount = $price * $cart['qty'];
				$qty = $cart['qty'];
				
				$data = array(
				'rowid' => $rowid,
				'retail' => $price,
				'amount' => $amount,
				'qty' => $qty
				);					
				$this->cart->update($data);
				$msg = '<div class="alert alert-success">Cart Updated Successfully.</div>';
			
		}			
		$this->session->set_flashdata('msg',$msg);
		redirect($_SERVER['HTTP_REFERER']);
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

   function sendpassword()
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

        $check = $this->homemodel->checkWishListProductById($id);
        
        if($check)
        {
           echo "product already added"; 
        }
        else
        {
        $productInfo = $this->homemodel->getsRowData($id);
       
        $cartData = array(
            'product_id' => $productInfo->id,
            'product' => $productInfo->product,
            'mrp' => $productInfo->mrp,
            'retail' => $productInfo->retail,
            'product_url' => $productInfo->product_url,
            'image' => $productInfo->fimage,
        );
        $this->homemodel->saveWishlist('wishlist',$cartData);
        }


        //echo $this->show_cart();

    }

    function register()
    {
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
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
    
    function registoremail()
    {
        $email = $this->input->post('email');
        $phone = $this->input->post('email');
        
        $check = $this->homemodel->checkEmailId($email);
       $checkphone = $this->homemodel->checkPhone($phone);
        if($check)
        {
            echo 'Email id all ready exit';
            redirect('home/otp');
           // echo json_encode($check);
           //$this->load->view('otobylogin');
        } 
        elseif($checkphone)
        {
             echo 'Mobile no all ready exit ';
            //redirect($_SERVER['HTTP_REFERER']);
        }
         
        else 
        {
          echo 'Please Login register email id or mobile no click here'; 
          redirect('home/register');
          //redirect($_SERVER['HTTP_REFERER']);
        }
        
        //redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    function setuserpassword()
    {
        $id = $this->session->userdata['2'] ;
       
        $save = $this->homemodel->updateUserInfoData($id);
        
           if($save){
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['id'] = $save->id;
            $this->session->userdata['email'] = $save->email;
            $this->session->userdata['phone'] = $save->phone;
            echo "User register successfully";
            
            //redirect('home/index');
          } 
        
            
    }
    
    function checkotpindatabase()
    {
        echo $otp = $this->input->post('otp');
        
        $check = $this->homemodel->checOTP($otp);
        
        if(!empty($check))
        {
           echo "4"; 
        }
        else
        {
            echo "5";
        }
        
    }
    function loginuserbyemail()
    {
       $phone= $this->input->post('phonecheck');
        
        $arr['phone']= $this->input->post('phonecheck');
        $arr['otp']= 12345;
        
        $check = $this->homemodel->checkEmailId($phone);
        
        if(!empty($check))
        {
            echo '1';
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['userid'] = $check->id;
            $this->session->userdata['phone'] = $check->phone;
        } 
        else
        {
            
        $save = $this->homemodel->saveUserPhoneNo($arr); 
        $id = $this->db->insert_id();
        if(!empty($save)){
            echo "3";
            $getId = $this->homemodel->getSingleUserDataById($id);
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['userid'] = $getId->id;
            $this->session->userdata['phone'] = $getId->phone;
            //$this->session->userdata['email'] = $save->email;
           }  
            
            
            
        }
    
        //redirect($_SERVER['HTTP_REFERER']);

    }
    
    function loginuserbyotp()
    {
        $email= $this->input->post('phone');
        $otp = $this->input->post('otp');
        
        $checkotp = $this->homemodel->logingUserOTp($email,$otp);
        
        if($checkotp){
            
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['userid'] = $checkotp->id;
            $this->session->userdata['name'] = $checkotp->name;
            $this->session->userdata['phone'] = $checkotp->phone;
            $this->session->userdata['email'] = $checkotp->email;
            redirect('home/index');
        } 
        else
        {
            $data['error1'] = $this->session->set_flashdata('error','Invalid login. Email or Password not found');
            redirect('home/login',$data);

        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function loginuser()
    {
        $email= $this->input->post('email');
        $pass = $this->input->post('password');


        $check = $this->homemodel->logingUser($email,$pass);


        if($check){
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['userid'] = $check->id;
            $this->session->userdata['name'] = $check->name;
            $this->session->userdata['email'] = $check->email;
            redirect('home/myaccount');
        } else{
            $data['error1'] = $this->session->set_flashdata('error','Invalid login. Email or Password not found');
            redirect('home/login',$data);

        }
        redirect($_SERVER['HTTP_REFERER']);

    }
    
    function checkpincode()
    {
     $pincode = $this->input->post('pincode');
     $check = $this->homemodel->checkPincode($pincode);

     if($check){
     echo  'Pincode is valid shipping charge is /'.$check->delivery_charge;
     }
     else
     {
         echo "pincode note found";
         //$msg = '<div class="alert alert-success">Pincode note found.</div>';
     }
     
    }
    
    function addreview()
    {
       
        $arr['proid'] = $this->input->post('proid');
        $arr['user_id'] = $this->input->post('user_id');
        $arr['username'] = $this->input->post('username');
        $arr['stars'] = $this->input->post('stars');
        $arr['title'] = $this->input->post('title');
        $arr['descripton'] =$this->input->post('description');
         
       /* if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                
            }
        }*/
        
        $this->homemodel->saveReview('review',$arr);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
     
    function registeruser(){
        $arr['name'] =$this->input->post('name');
        $arr['email'] =$this->input->post('emailreg');
        $arr['phone'] =$this->input->post('mobile');
        $arr['password'] =$this->input->post('password');
        
        $id = $this->session->userdata('id');
        
        if(!empty($id)){
        $in = $this->homemodel->registerUser($id);
        }
        else
        {
          $dd = $this->homemodel->saveRegisterNewUser($arr); 
          if($dd){
              echo "Register successfully";
          }
          redirect($_SERVER['HTTP_REFERER']);
        }
        
       /* if($in)
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
	    redirect($_SERVER['HTTP_REFERER']);
        //redirect('home/login',@$data);
        }
        else

        {
        $data['error']=$this->session->set_flashdata('error','Register Successfully, Please login now ');
       redirect($_SERVER['HTTP_REFERER']);
        }*/
        
        
    }
    
    function deleteCartItemDataList()
    {
        
        $id = $this->input->post('cartid');
         $this->homemodel->deleteCartItems('cart', array("id" => $id));
       redirect($_SERVER['HTTP_REFERER']);
      //redirect('home/index');
          
    }
    
    function updateUserInfoDataListById()
    {
         $userid = $this->input->post('userid');
        
         $this->homemodel->updateUserInfoDataListByUserId($userid);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    function updateUserInfoData()
    {
         $userid = $this->input->post('userid');
        
         $this->homemodel->updateUserInfoDataList($userid);
        redirect($_SERVER['HTTP_REFERER']);
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
        
         //$ins =  $this->homemodel->saveOrder('tbl_order',$data);
           
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
        redirect('home/index');
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
       
            
        
        error_reporting(0);
        
        //$data['testi'] = $this->homemodel->getTestimonial();*/
        
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();

        $data['cartItems'] =$this->cart->contents();
        $userid=$this->session->userdata('userid');

        $data['user']= $this->homemodel->getUserDataById($userid);
        
        $this->load->view('checkout',$data);
       


    }

    function updateQty()
    {
        
        $cart_info = $_POST['cart'] ;			
			foreach( $cart_info as $id => $cart)
			{
					$rowid = $cart['rowid'];
					$price = $cart['price'];
					$amount = $price * $cart['qty'];
					$qty = $cart['qty'];
					
					$data = array(
					'rowid' => $rowid,
					'price' => $price,
					'retail' => $amount,
					'qty' => $qty
					);					
					$this->cart->update($data);
					$msg = '<div class="alert alert-success">Cart Updated Successfully.</div>';
		
			}			
			$this->session->set_flashdata('msg',$msg);
			redirect('home/cart');
        
    }

   /* function cart()
    {
       // error_reporting(0);
        $data['cartItem'] = $this->homemodel->getCartItemValues();
        $ses = $this->homemodel->getSessionId();
        //$id =$this->session->session_id;
        $data['citem']=$this->homemodel->totalCartItem();
        $data['total'] = $this->homemodel->countTotalCart();
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();

        $data['cartItems'] =$this->cart->contents();

        $this->load->view('cart',$data);
    }*/

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
        
        $url = 'beauty-gate';
        $data['m'] = $this->homemodel->getMenuId($url);
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


        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['product'] =$this->homemodel->getAllProductByClass($url);
        $proid = $this->homemodel->getProductCategoryIdBYUrl($url);
        $data['reproduct'] =$this->homemodel->getAllRelatedProduct($proid->id);
        

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
    
    function loginuserform()
    {
      $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $this->load->view('loginuser',$data);  
    }
    
    function otp()
    {
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $this->load->view('otpbylogin',$data);
    }

    
    function login()
    {
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['cat'] =$this->homemodel->getCategory();
        $data['subcat'] =$this->homemodel->getSubCategory();
        $this->load->view('login',$data);
    }

    function singlepage()
    {
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('singlepage',$data);

    }
    
    function sign()
    {
        $data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['pro'] =$this->homemodel->getAllProductList();
        $this->load->view('login',$data);

    }

    function profile()
    { error_reporting(0);
        //$data['productInfo'] = $this->homemodel->getCartItemValues();
        $data['testi'] = $this->homemodel->getTestimonial();
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['pro'] =$this->homemodel->getAllProductList();
        $data['wish'] =$this->homemodel->getAllWishListProductList();
        $id = $this->session->userdata('userid');
        $data['user'] =$this->homemodel->getAllUserList($id);
        $data['order'] = $this->homemodel->getAllOrderDataList($id);
        $this->load->view('profile',$data);

    }

    function help()
    {
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('help',$data);

    }
    function giftcard()
    {
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('giftcard',$data);
    }
    function store()
    {
        $data['testi'] = $this->homemodel->getTestimonial();
        $this->load->view('store',$data);
    }
    function cart1()
    {
         $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $this->load->view('cart1',$data);
    }
    
    function checkcoupon()
    {
        $coupon = $this->input->post('code');
      
       $check = $this->homemodel->checkCouponCode($coupon);
       
       if($check)
       {
           
         $this->session->userdata['coupon_value'] = $check->coupon_value;
         $this->session->userdata['amount'] = $check->amount;
       }
       else
       {
           echo "Coupon code not valid";
       }
    }

}