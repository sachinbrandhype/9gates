<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once APPPATH."/third_party/PHPExcel.php";
class Seller extends CI_Controller 
{
       public function __construct()
       {
            parent::__construct();
            $this->load->helper('url');
			$this->load->library('session');
			$this->load->model('db_model');
			$this->load->library("pagination");
			$this->load->helper('date');
			$this->load->helper('file');
			//$this->load->helper('image_helper');
	        $this->load->library('upload');
			$this->load->helper('form');
			//$this->load->helper('ckeditor');
			$this->load->library('cart');
			//$this->load->library('encrypt');
			$this->load->library('email');
	  }
	  
	  public function index()
	  {	
		if($this->session->userdata('sellerLogin') == TRUE )
		{ 
			      
		  redirect('seller/dashboard');	
					
		}
		else
		{
			$sql = "select * from states";
			$data['s'] = $this->db_model->getAlldata($sql);
			
			/*$sql1 = "select * from menu where menu_status = '1'";
			$data['c'] = $this->db_model->getAlldata($sql1);*/
			$this->load->view('seller/index',$data);
		}
	  }
	  
	  public function sign_up()
	  {	
		$name = $this->input->post('name');
		$store = $this->input->post('store');
		$store_url = strtolower( preg_replace("![^a-z0-9]+!i", "-", $store));
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$cpassword = $this->input->post('cpassword');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$area = $this->input->post('area');
		/*$menu = $this->input->post('menu_name');
		$cat_name = $this->input->post('cat_name');	
		echo $cat = implode(',',$cat_name);*/
		$sql3 = "select * from seller where seller_email='$email'";
		$r = $this->db_model->getAlldata($sql3);
		if(empty($r))
		{
			if($password == $cpassword)
			{
				$pass = md5($password);
				$sql = "insert into seller (seller_name,seller_business,seller_phone,seller_email,seller_password,state,city,area) values(?,?,?,?,?,?,?,?)";
				$val1 = array($name,$store,$phone,$email,$pass,$state,$city,$area);
				$seller_id = $this->db_model->iud_data_id($sql,$val1);
				$url = $store_url.'-'.$seller_id;
				$sql2 = "update seller set seller_url=? where seller_id=?";
				$val2 = array($url,$seller_id);
				$this->db_model->iud_data($sql2,$val2);
				$val = "<div class=\"alert alert-success\" role=\"alert\">Registration successfully. Please login with your username and password</div>";
				$this->session->set_flashdata('msg1',$val);
				echo "<script>window.location.href='".base_url()."seller'</script>";
			}
			else
			{
				$val = "<div class=\"alert alert-danger\" role=\"alert\">Password not matched.</div>";
				$this->session->set_flashdata('msg1',$val);
				echo "<script>window.location.href='".base_url()."seller'</script>";
			}
		}
		else
		{
			    $val = "<div class=\"alert alert-danger\" role=\"alert\">Email allready registered with us.</div>";
				$this->session->set_flashdata('msg1',$val);
				echo "<script>window.location.href='".base_url()."seller'</script>";
		}
		
	  }
	   
	   
	  public function login()
	  {		
	  	
		$user = $this->input->post('email');
		
		$pass = md5($this->input->post('pass'));
		$sql = "select * from seller where seller_email='$user'";
		$r = $this->db_model->getAlldata($sql);
		
		if(!empty($r))
		{
				if($r[0]->seller_password == $pass)
				{	
					
					$newdata = array(
					  'seller_id'       => $r[0]->seller_id,
                      'seller_name'      => $r[0]->seller_name,
					  'seller_business'      => $r[0]->seller_business,
                      'seller_email'       => $r[0]->seller_email,
                      'seller_phone'          => $r[0]->seller_phone,
					  'seller_status'       => $r[0]->seller_status,
					  'shipping_from'       => $r[0]->shipping_from,
                      'sellerLogin'        => TRUE
				   );
				    $this->session->set_userdata($newdata);
				    $sql12 = "update seller set seller_on_off=? where seller_id=?";
					$seller_id = $r[0]->seller_id;
					$values2 = array(1,$seller_id);
					$this->db_model->iud_data($sql12,$values2);
					
					$sql2 = "SELECT * FROM `seller_document` where seller_id='$seller_id'";
					$sell_doc = $this->db_model->getAlldata($sql2);
					
					
					if(empty($sell_doc))
					{
						
						redirect('seller/upload-document');	
					}
					else
					{
						$sql3 = "SELECT * FROM `seller_bank_details` where seller_id='$seller_id'";
						$sell_bank = $this->db_model->getAlldata($sql3);
					    if(empty($sell_bank))
						{
							
							redirect('seller/business-bank-details');
						}
						else
						{
							echo "<script>window.location.href='".base_url()."seller/dashboard'</script>";
						}
							
					}
					
					
				}
				else
				{
					$val = "<span class='text-danger' style='margin-right:135px;'>Invalid Username or Password.</span>";
					$this->session->set_flashdata('msg2', $val);
					
					echo "<script>window.location.href='".base_url()."seller'</script>";
				}
				
			}
			else
			{
				$val = "<span class='text-danger' style='margin-right:135px;'>Invalid Username or Password.</span>";
				$this->session->set_flashdata('msg2', $val);
				
				echo "<script>window.location.href='".base_url()."seller'</script>";
			}	
	  } 

	  public function transaction()
		 {
		 	if($this->session->userdata('sellerLogin') == TRUE)
		     {
				$seller_id = $this->session->userdata('seller_id');
				$sql = "SELECT * FROM  `commission_paid` where seller_id='$seller_id' ";
			   
			    $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
				
				$config["base_url"] = base_url().'seller/transaction';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 12;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
			   
			   $sql .= " order by com_paid_date desc limit $page2, $per";
			   $data['order'] = $this->db_model->getAlldata($sql);
			   $data["links"] = $this->pagination->create_links(); 
			   $this->load->view('seller/transaction',$data);
			 }
			 else
			 {
				 $this->load->view("seller");
			 }
		 }
	  
	  public function upload_document()
	  {
		   if($this->session->userdata('sellerLogin') == TRUE && $this->session->userdata('seller_status') == 0)
			{
				$seller_id = $this->session->userdata('seller_id');
				$sql2 = "SELECT * FROM `seller_document` where 	seller_id='$seller_id'";
				$sell_doc = $this->db_model->getAlldata($sql2);
				if(empty($sell_doc))
				{
				    if($this->input->post())
				   {
				  	$pan_no = $this->input->post('pan_no');	
					$tin_no = $this->input->post('tin_no');	
					$tan_no = $this->input->post('tan_no');	
					$address_no = $this->input->post('address_no');	
					$id_no = $this->input->post('id_no');	
					
									
					if($_FILES['pan_file']['name']!='')
		            {
					  $pan_doc = $this->upload_image('./includes/uploads/sellerdoc/','pan_file','jpg|png|jpeg','100000');
					  if($pan_doc)
					  {
					   $pan_path = 'includes/uploads/sellerdoc/'.$pan_doc;
					  }
					  else
					  {
						  $pan_path = '';
					  }
					}
					
					if($_FILES['tin_file']['name']!='')
		            {
					  $tin_doc = $this->upload_image('./includes/uploads/sellerdoc/','tin_file','jpg|png|jpeg','100000');
					  if($tin_doc)
					  {
					   $tin_path = 'includes/uploads/sellerdoc/'.$tin_doc;
					  }
					  else
					  {
						  $tin_path = '';
					  }
					}
					
					if($_FILES['tan_file']['name']!='')
		            {
					  $tan_doc = $this->upload_image('./includes/uploads/sellerdoc/','tan_file','jpg|png|jpeg','100000');
					  if($tan_doc)
					  {
					   $tan_path = 'includes/uploads/sellerdoc/'.$tan_doc;
					  }
					  else
					  {
						  $tan_path = '';
					  }
					}
					
					if($_FILES['address_file']['name']!='')
		            {
					  $address_doc = $this->upload_image('./includes/uploads/sellerdoc/','address_file','jpg|png|jpeg','100000');
					  if($address_doc)
					  {
					   $address_path = 'includes/uploads/sellerdoc/'.$address_doc;
					  }
					  else
					  {
						  $address_path = '';
					  }
					}
					
					if($_FILES['id_file']['name']!='')
		            {
					  $id_doc = $this->upload_image('./includes/uploads/sellerdoc/','id_file','jpg|png|jpeg','100000');
					  if($id_doc)
					  {
					   $id_path = 'includes/uploads/sellerdoc/'.$id_doc;
					  }
					  else
					  {
						  $id_path = '';
					  }
					}
					
					$sql = "INSERT INTO `seller_document`(`seller_id`, `pan_no`, `pan_path`, `tin_no`, 
					`tin_path`, `tan_no`, `tan_path`, `address_no`, `address_path`, `id_no`, `id_path`)
					 VALUES (?,?,?,?,?,?,?,?,?,?,?)";
					 $val = array($seller_id,$pan_no,$pan_path,$tin_no,$tin_path,$tan_no,$tan_path,$address_no,$address_path,$id_no,$id_path);
					 $this->db_model->iud_data($sql,$val);
					 echo "<script>window.location.href='".base_url()."seller/business-bank-details'</script>";
					 
				  
					}
					else
					{
					  $this->load->view('seller/upload-document');
					}
				
				}
				else
				{
					redirect('seller/business-bank-details');
				}
			}
			else
			{
				redirect('seller');	
			}
	  }
	  
	  public function business_bank_details()
	  {
		   if($this->session->userdata('sellerLogin') == TRUE && $this->session->userdata('seller_status') == 0)
			{
				    $seller_id = $this->session->userdata('seller_id');
					$sql2 = "SELECT * FROM `seller_document` where 	seller_id='$seller_id'";
					$sell_doc = $this->db_model->getAlldata($sql2);
					
					if(empty($sell_doc))
					{
						redirect('seller/upload-document');	
					}
					else
					{
						$sql3 = "SELECT * FROM `seller_bank_details` where 	seller_id='$seller_id'";
					    $sell_bank = $this->db_model->getAlldata($sql3);
						if(empty($sell_bank))
						{ 
						    if($this->input->post())
							{
								$ac_name = $this->input->post('ac_name');
								$ac_no = $this->input->post('ac_no');
								$ac_type = $this->input->post('ac_type');
								$bank_name = $this->input->post('bank_name');
								$bank_branch = $this->input->post('bank_branch');
								$ifsc_code = $this->input->post('ifsc_code');
								
								if($_FILES['cheque_file']['name']!='')
								{
								  $cheque_doc = $this->upload_image('./includes/uploads/sellerbankdoc/','cheque_file','jpg|png|jpeg','100000');
								  if($cheque_doc)
								  {
								   $cheque_path = 'includes/uploads/sellerbankdoc/'.$cheque_doc;
								  }
								  else
								  {
									  $cheque_path = '';
								  }
								}
								
								$sql = "INSERT INTO `seller_bank_details`(`seller_id`, `ac_name`, `ac_number`, `ac_type`, 
								`bank_name`, `bank_branch_name`, `bank_ifsc`, `bank_cheque`, `memorandum`) VALUES (?,?,?,?,?,?,?,?,?)";
								$val = array($seller_id,$ac_name,$ac_no,$ac_type,$bank_name,$bank_branch,$ifsc_code,$cheque_path,'yes');
								
								$res = $this->db_model->iud_data($sql,$val);
								if($res)
								{
									
									redirect('seller/dashboard');
								}
								
							}
							else
							{
				                $this->load->view('seller/business-bank-details');
							}
						}
						else
						{
							$this->load->view('seller/dashboard');
						}
					}
			}
			else
			{
				redirect('seller');	
			}
	  }
	   
	  public function dashboard()
	  {	
		if($this->session->userdata('sellerLogin') == TRUE )
		{
			$id = $this->session->userdata('seller_id');
			$sql = "SELECT order_id,order_item_added_date as order_date,SUM(total_product_price) as total_price FROM `om_order_item` as oi join 
			   seller as s on oi.seller_id = s.seller_id where oi.seller_id='$id' 
			   and oi.is_deleted='no' group by oi.order_id,oi.seller_id order by order_item_id desc limit 5";
			$data['order'] = $this->db_model->getAlldata($sql);
			$sql2 = "SELECT * FROM `om_return` as r join om_order_item as o on r.order_item_id = o.order_item_id WHERE r.seller_id='$id'";
			$data['return'] = $this->db_model->getAlldata($sql2);
			$this->load->view('seller/dashboard',$data);
		}
		else
		{
			echo "<script>window.location.href='".base_url()."seller'</script>";
		}
	  } 
	   
	   public function logout()
	  {
		$sql2 = "update seller set seller_on_off=? where seller_id=?";
		$user_id = $this->session->userdata('seller_id');
		$values2 = array(0,$user_id);
		$this->db_model->iud_data($sql2,$values2);
		$this->session->unset_userdata('seller_id');
		$this->session->unset_userdata('seller_name');
		$this->session->unset_userdata('seller_business');
        $this->session->unset_userdata('seller_email');
        $this->session->unset_userdata('seller_phone');
		$this->session->unset_userdata('seller_status');
        $this->session->unset_userdata('sellerLogin');
		$val = "<span class='text-danger' style='margin-right:135px;'>Logout successfully.</span>";
		$this->session->set_flashdata('msg2',$val);
		echo "<script>window.location.href='".base_url()."seller'</script>";
	  }
	  
	  public function reset_password()
	  {
		  $email = $this->input->post('email');
		  $sql = "select * from seller where seller_email='$email'";
		  $sdata = $this->db_model->getAlldata($sql);
		  if(!empty($sdata))
		  {
			  $name = $sdata[0]->seller_name;
			  $pass = $this->random_password();
			  $enpass = md5($pass);
			  $sql2 = "update seller set seller_password=? where seller_email=?";
			  $values = array($enpass,$email);
			  $r = $this->db_model->iud_data($sql2,$values);;
			  if($r)
			  {
				        $this->load->library('email');
                        $sql3 = "SELECT * FROM `om_email_setting` where email_id='1'";
						$e = $this->db_model->getAlldata($sql3);
						
						$config = Array(
							'protocol' => 'smtp',
						    'smtp_host' => $e[0]->smtp_host,
						    'smtp_user' => $e[0]->smtp_user,
						    'smtp_pass' => $e[0]->smtp_pass,
						    'smtp_port' => $e[0]->smtp_port,
							'mailtype'  => 'html', 
							'charset'   => 'iso-8859-1'
						);
						$this->load->library('email', $config);
						$this->email->set_mailtype("html");
						$this->email->set_newline("\r\n");
										
						
						$this->email->from($e[0]->smtp_user, 'EHomeBazaar');
						$this->email->to($email);
						//$this->email->cc('another@another-example.com');
						//$this->email->bcc('them@their-example.com');
						$this->email->subject('Forgot Password');
					    $msg = '<html>
									<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
									
									<title>View Your Order</title>
									</head>
									<body style="margin:0px;padding:0px;font-family:Verdana, Geneva, sans-serif;font-size:13px;">
									<div style="margin:50px auto 0;width:680px;">
									  
									  <table style="border-collapse:collapse;width:100%;border-top:1px solid #dddddd;border-left:1px solid #dddddd;margin-bottom:2px">
									  <tbody>
										  <tr>
											<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px">
											<img src="'.base_url().'front/images/logo.png">
											</td>
											
										  </tr>
										  </tbody>
									   </table>
									
									  <table style="border-collapse:collapse;width:100%;border-top:1px solid #dddddd;border-left:1px solid #dddddd;margin-bottom:20px">
										<thead>
										  <tr>
											<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;background-color:#efefef;font-weight:bold;text-align:left;padding:7px;color:#222222" colspan="2">Password Details</td>
										  </tr>
										</thead>
										<tbody>
										  <tr>
											<td style="font-size:12px;border-right:1px solid #dddddd;border-bottom:1px solid #dddddd;text-align:left;padding:7px"><b>Hello, '.$name.'</b><br><br>
											
											  <span tabindex="0" class="aBn" data-term="goog_736921536"><span class="aQJ">
											  Your password is: <b>'.$pass.'</b>
											  </span></span>
											  
											   <br><br><br>
											  <b>Regards</b><br>
											   EHomeBazaar<br>
											   
											   <span tabindex="0" class="aBn" data-term="goog_736921536"><span class="aQJ">This is computer generated email, Please do not reply to this message. </span></span></td>
											
										  </tr>
										  </tbody>
									  </table>
									  
									</div>
									</body>
									</html>';
					  $this->email->message($msg);	
					  $qr = $this->email->send();
					  
					  $val = "<span class='text-success' style='margin-right:135px;'>Password sent to your Email.</span>";
		              $this->session->set_flashdata('msg2',$val);
		              echo "<script>window.location.href='".base_url()."seller'</script>";
			  }
			  else
			  {
				 $val = "<span class='text-danger' style='margin-right:145px;'>Error!! Please try again.</span>";
				  $this->session->set_flashdata('msg2',$val);
				  echo "<script>window.location.href='".base_url()."seller'</script>";  
			  }
		  }
		  else
		  {
			  $val = "<span class='text-danger' style='margin-right:190px;'>Invalid Email</span>";
			  $this->session->set_flashdata('msg2',$val);
		      echo "<script>window.location.href='".base_url()."seller'</script>";
		  }
		  
	  }
	  
	   public function random_password( $length = 8 )
	   {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
		}
	   
	   
	public function list_search1()
	{
			$id=$this->input->post('term');
			$sql="select * from city where state_id='$id'";
			$r =$this->db_model->getAlldata($sql);	  	
			echo '<option>Select City</option>';
			foreach($r as $i=>$v)
			{
				echo '<option value='.$v->city_id.'>'.$v->city_name.'</option>';
			}
	}
	
	public function cat_type()
	{
			$id=$this->input->post('term');
			$sql="select * from category where menu_id='$id' and parent_cat_id='0'";
			$r =$this->db_model->getAlldata($sql);
			//print_r($r);
			foreach($r as $i=>$v)
			{
			echo "<input type='checkbox' name='cat_name[]' value=".$v->category_id.">&nbsp;".$v->category_name."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
	}
	
	  public function list_search2()
	  {
	  	$id=$this->input->post('term');		
	  	$sql="select * from area where city_id='$id' order by area_id asc";
	  	$r =$this->db_model->getAlldata($sql);
	  	echo '<option>Select Area</option>';
	  	foreach($r as $i=>$v)
	  	{
	  		echo '<option value='.$v->area_id.'>'.$v->area_name.'</option>';
		}
	  }
	  
	  public function choose_size()
	  {
		    $menu = $this->input->post('menu');	
			$cat = $this->input->post('cat');	
			$sub = $this->input->post('subcat');		
			$sql = "select * from `option` where `menu_id`='$menu' and `category_id`='$cat' and `subcategory_id`='$sub' order by `option_id` asc";
			$r =$this->db_model->getAlldata($sql);
			echo '<option>Select Size</option>';
			foreach($r as $i=>$v)
			{
				echo '<option value='.$v->option_id.'>'.$v->option_name.'</option>';
			}
	  }
	   
	  public function add_product()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			/*$sql = "SELECT * FROM `menu` where  menu_status='1' ORDER BY `menu_id` ASC";
			$data['m'] = $this->db_model->getAlldata($sql);*/
			$sql1 = "SELECT * FROM `color`";
			$data['c'] = $this->db_model->getAlldata($sql1);
			$sql2 = "SELECT * FROM `brand`";
			$data['b'] = $this->db_model->getAlldata($sql2);
			$sql9 = "SELECT * FROM `replacement`";
			$data['rg'] = $this->db_model->getAlldata($sql9);
			//$sql3 = "SELECT * FROM `attribute` order by attribute_name asc";
		    //$data['atr'] = $this->db_model->getAlldata($sql3);
			$data['ckeditor'] = array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'js/ckeditor',
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
			
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Blue',
						'font-weight' 		=> 	'bold'
					)
				),
				
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 		=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		    );
			$this->load->view('seller/add-product',$data);
		 }
		 else
		 {
			redirect('seller');
		 }
		  
	  }
	  
	  public function manage_product()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
		        $id = $this->session->userdata('seller_id');			
		        $sql = "select * from product where seller_id='$id' ";
				
			    $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
			
			
			    $config["base_url"] = base_url().'seller/manage-product';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 12;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
				
			    $sql .= " order by createdate desc limit $page2, $per";
			    $data['pro'] = $this->db_model->getAlldata($sql);		
			    $data["links"] = $this->pagination->create_links(); 
			    $this->load->view('seller/manage-product',$data);
		 }
		 else
		 {
			redirect('seller');
		 }
		  
	  }
	  
	  public function add_suc_product()
	  {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
				$id = $this->session->userdata('seller_id');							
				$p_name = $this->input->post('productname');
				$model = $this->input->post('model');
				$p_url = $this->input->post('urlname');
				
				$menu = $this->input->post('menu');
				$category = $this->input->post('category');
				$subcategory = $this->input->post('subcategory');
				$mrp = $this->input->post('mrp');
				$retail = $this->input->post('retail');
				$desc = $this->input->post('product_details');
				$status = $this->input->post('status');
								
				$minqty = $this->input->post('minqty');
				$maxqty = $this->input->post('maxqty');	
				$offer = $this->input->post('offer');			
								
				$type= $this->input->post('type');
				$wminqty = $this->input->post('wminqty');
				$wprice = $this->input->post('wprice');
				
				  /* Code added by Manoj Kumar */
				  
				//$short_desc = $this->input->post('short_desc');
				$short_desc = '';
				$stock = $this->input->post('stock');
				$meta_title = $this->input->post('meta_title');
				$meta_key = $this->input->post('meta_key');
				$meta_des = $this->input->post('meta_des');
				
				
				$brand_id = $this->input->post('brand_id');
				$attr_group = $this->input->post('attr_group_id');
				$rg_id = $this->input->post('rg_id');
				
				$delv_day = $this->input->post('delv_day');
				$cod = $this->input->post('cod');
				
				$weight = $this->input->post('weight');
				
				
				$project_imagepath = '';
				$project_gallarypath = '';
				
				$attr_group_id = implode(',',(array)$attr_group);
				
				$product_color = $this->input->post('product_color');
				$product_size = $this->input->post('product_size');
				
				$p_color = implode(',',(array)$product_color);
				$p_size = implode(',',(array)$product_size);
				
				$sql3 = "select * from `om_product` where product_name_url = '$p_url'";
				$p_b = $this->db_model->getAlldata($sql3);
				if($p_b)
				{
					$msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Product Name is already added in database.</div>";
					$this->session->set_flashdata('msg', $msg);
					echo "<script>window.location.href='".base_url()."seller/add-product'</script>";
				}
				else
				{	
					if(isset($_FILES['userfile']))
					{
							 $path2 = "./includes/uploads/product_image/";
							 $path111 = "./includes/uploads/product_image/thumb/";
							  if(!is_dir($path2)) //create the folder if it's not already exists
							  {
								mkdir($path2,0755,TRUE);
							  } 
							  
							  if(!is_dir($path111)) //create the folder if it's not already exists
							  {
								mkdir($path111,0755,TRUE);
							  } 
				
							//$config['file_name']     = 'img_'.date('d-m-Y').'_'.time();
							$config['encrypt_name'] =TRUE;
							$config['upload_path'] =$path2;
							$config['allowed_types'] = '*';
							$config['max_size']	= '2000000';
							$config['overwrite']     = FALSE;
							$this->upload->initialize($config);
							if($this->upload->do_upload('userfile'))
							{
								$file_data = $this->upload->data();
								$project_imagepath = $file_data['file_name'];
								$project_imagepath2 ='includes/uploads/product_image/'.$file_data['file_name'];
								//image_thumb($project_imagepath2,'./includes/uploads/product_image/',250,250);
								//image_thumb($project_imagepath2,'./includes/uploads/product_image/thumb/',200,150);
							}
							
					}
					
					$sql = "INSERT INTO `om_product`(`seller_id`, `model`,`product_name`, `product_name_url`, `menu_id`, `category_id`, `subcategory_id`, `mrp`, `retail_price`, `offer_id`, `short_desc`, `description`, `minqty`, `maxqty`, `p_status`, `featured_image`, `product_sale_type`, `ws_quantity`, `ws_price`, `stock`, `meta_title`, `meta_key`, `meta_des`, `brand_id`, `attr_group_id`, `delv_day`, `cod`,`rg_id`,`weight`,`product_color`,`product_size`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";					
					$values = array($id,$model,$p_name,$p_url,$menu,$category,$subcategory,$mrp,$retail,$offer,$short_desc,$desc,$minqty,$maxqty,$status,$project_imagepath,$type,$wminqty,$wprice,$stock,$meta_title,$meta_key,$meta_des,$brand_id,$attr_group_id,$delv_day,$cod,$rg_id,$weight,$p_color,$p_size);	
					$max_id = $this->db_model->iud_data_id($sql,$values);
					
					if($max_id)
					{						
						$count_file = count($_FILES['uploadfile']['name']);
						$path3 = "./includes/uploads/product_gallery/";
						$path4 = "./includes/uploads/product_gallery/thumb/";
						if(!is_dir($path3)) 
						{
						 mkdir($path3,0755,TRUE);
						}
						 if(!is_dir($path4)) 
						{
						 mkdir($path4,0755,TRUE);
						} 
						
						for($i=0; $i<$count_file; $i++)
						{
							 $_FILES['userfile']['name']    = $_FILES['uploadfile']['name'][$i];
							 $_FILES['userfile']['type']    = $_FILES['uploadfile']['type'][$i];
							 $_FILES['userfile']['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
							 $_FILES['userfile']['error']       = $_FILES['uploadfile']['error'][$i];
							 $_FILES['userfile']['size']    = $_FILES['uploadfile']['size'][$i];
							 
							 $config['encrypt_name'] =TRUE;
							 $config['upload_path'] =$path3;
							 $config['allowed_types'] = 'jpg|jpeg|gif|png';
							 $config['max_size']	= '20000000000000';
							 $config['overwrite']     = FALSE;
	
							 $this->upload->initialize($config);
	
							 if($this->upload->do_upload())
							 {
								$file_data2 = $this->upload->data();
								$pg_path = $file_data2['file_name'];
								$pg_path2 = 'includes/uploads/product_gallery/'.$file_data2['file_name'];
								//image_thumb($pg_path2,'./includes/uploads/product_gallery/',1200,1200);
								//image_thumb($pg_path2,'./includes/uploads/product_gallery/thumb/',82,82);
								$sql2 = "insert into om_product_gallery(product_id,product_gallery_path) values(?,?)";
								$values2 = array($max_id,$pg_path);
								$this->db_model->iud_data($sql2,$values2);								
							}				  
						}					  
					  
					  $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Added Successfully...</div>";
					  $this->session->set_flashdata('msg', $msg);
					echo "<script>window.location.href='".base_url()."seller/add-product'</script>";
					}
					else
					{
						$msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to add.Please try again..</div>";
						$this->session->set_flashdata('msg', $msg);
						echo "<script>window.location.href='".base_url()."seller/add-product'</script>";
					}
				}
				
				
			}			
	  }
	  
	  public function update_product($id)
	  {
		  
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			/*$sql = "SELECT * FROM `menu` where  menu_status='1' ORDER BY `menu_id` ASC";
			$data['m'] = $this->db_model->getAlldata($sql);*/
			
			/*$sql1 = "SELECT * FROM `colour`";
			$data['c'] = $this->db_model->getAlldata($sql1);*/
			
			$sql2 = "SELECT * FROM `brand`";
			$data['b'] = $this->db_model->getAlldata($sql2);
			
			$sql9 = "SELECT * FROM `replacement_guarantee`";
			$data['rg'] = $this->db_model->getAlldata($sql9);
			//$sql3 = "SELECT * FROM `attribute` order by attribute_name asc";
		   // $data['atr'] = $this->db_model->getAlldata($sql3);
			/*$sql4 = "SELECT * FROM `offer`";
			$data['of'] = $this->db_model->getAlldata($sql4);*/
			
			$sql5 = "select * from om_product where product_id='$id'";		  
			$data['product'] = $this->db_model->getAlldata($sql5);
			
			$menu_id = $data['product'][0]->menu_id;
			$cat_id = $data['product'][0]->category_id;
			$subcat_id = $data['product'][0]->subcategory_id;
			
			$sql6 = "SELECT * FROM `category` where parent_cat_id=0";
			$data['cat'] = $this->db_model->getAlldata($sql6);
			
			
			$sql7 = "select category_id,category_name from category where  parent_cat_id =$cat_id";
			$data['subcat'] = $this->db_model->getAlldata($sql7);
			
			$sql8 = "SELECT * FROM `attribute_group` where menu_id='$menu_id' ";
			if($cat_id != 0)
			{
				$sql8 .= " and cat_id='$cat_id'  ";
			}
			if($subcat_id != 0)
			{
				$sql8 .= " and subcat_id='$subcat_id' ";
			}
			$data['atr'] = $this->db_model->getAlldata($sql8);
			
			
			
			
			$data['ckeditor'] = array(
		
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'js/ckeditor',
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
			
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Blue',
						'font-weight' 		=> 	'bold'
					)
				),
				
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 		=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		    );
			$this->load->view('seller/update-product',$data);
		 }
		 else
		 {
			redirect('seller');
		 }
		  
	  }
	  
	  public function product_update()
	  {
		  
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
				$id = $this->session->userdata('seller_id');							
				$p_name = $this->input->post('productname');
				$model = $this->input->post('model');
				$p_url = $this->input->post('urlname');
				
				$menu = $this->input->post('menu');
				$category = $this->input->post('category');
				$subcategory = $this->input->post('subcategory');
				$mrp = $this->input->post('mrp');
				$retail = $this->input->post('retail');
				$desc = $this->input->post('product_details');
				$status = $this->input->post('status');
								
				$minqty = $this->input->post('minqty');
				$maxqty = $this->input->post('maxqty');	
				$offer = '';			
								
				$type= $this->input->post('type');
				$wminqty = $this->input->post('wminqty');
				$wprice = $this->input->post('wprice');
				
				/*code added by Manoj Kumar */
				//$short_desc = $this->input->post('short_desc');
				$short_desc = '';
				$stock = $this->input->post('stock');
				$meta_title = $this->input->post('meta_title');
				$meta_key = $this->input->post('meta_key');
				$meta_des = $this->input->post('meta_des');
				
				
				$brand_id = $this->input->post('brand_id');
				$attr_group = $this->input->post('attr_group_id');
				$rg_id = $this->input->post('rg_id');
				
				$delv_day = $this->input->post('delv_day');
				$cod = $this->input->post('cod');
				
				$pid = $this->input->post('id');
				$project_imagepath = $this->input->post('path');
				
				$weight = $this->input->post('weight');
				
				$project_gallarypath = '';
				
				$attr_group_id = implode(',',(array)$attr_group);
				
				$product_color = $this->input->post('product_color');
				$product_size = $this->input->post('product_size');
				
				$p_color = implode(',',(array)$product_color);
				$p_size = implode(',',(array)$product_size);
				
				if(isset($_FILES['userfile']))
				{
							 $path2 = "./includes/uploads/product_image/";
							 $path111 = "./includes/uploads/product_image/thumb/";
							  if(!is_dir($path2)) //create the folder if it's not already exists
							  {
								mkdir($path2,0755,TRUE);
							  } 
							  
							  if(!is_dir($path111)) //create the folder if it's not already exists
							  {
								mkdir($path111,0755,TRUE);
							  } 
				
							//$config['file_name']     = 'img_'.date('d-m-Y').'_'.time();
							$config['encrypt_name'] =TRUE;
							$config['upload_path'] =$path2;
							$config['allowed_types'] = '*';
							$config['max_size']	= '2000000';
							$config['overwrite']     = FALSE;
							$this->upload->initialize($config);
							if($this->upload->do_upload('userfile'))
							{
								$file_data = $this->upload->data();
								$project_imagepath = $file_data['file_name'];
								$project_imagepath2 ='includes/uploads/product_image/'.$file_data['file_name'];
								//image_thumb($project_imagepath2,'./includes/uploads/product_image/',1200,1200);
								//image_thumb($project_imagepath2,'./includes/uploads/product_image/thumb/',200,150);
							}
							
					}
					
					$sql = "update `om_product` set `seller_id`=?, `model`=?,`product_name`=?, `product_name_url`=?, `menu_id`=?, `category_id`=?, `subcategory_id`=?, `mrp`=?, `retail_price`=?, `offer_id`=?, `short_desc`=?, `description`=?, `minqty`=?, `maxqty`=?, `p_status`=?, `featured_image`=?, `product_sale_type`=?, `ws_quantity`=?, `ws_price`=?, `stock`=?, `meta_title`=?, `meta_key`=?, `meta_des`=?, `brand_id`=?, `attr_group_id`=?, `delv_day`=?, `cod`=?,`rg_id`=?,`weight`=?,`product_color`=?,`product_size`=? where `product_id`=?";					
					$values = array($id,$model,$p_name,$p_url,$menu,$category,$subcategory,$mrp,$retail,$offer,$short_desc,$desc,$minqty,$maxqty,$status,$project_imagepath,$type,$wminqty,$wprice,$stock,$meta_title,$meta_key,$meta_des,$brand_id,$attr_group_id,$delv_day,$cod,$rg_id,$weight,$p_color,$p_size,$pid);	
					$max_id = $this->db_model->iud_data($sql,$values);
					if($max_id)
					{					
						$count_file = count($_FILES['uploadfile']['name']);
						$path3 = "./includes/uploads/product_gallery/";
						$path4 = "./includes/uploads/product_gallery/thumb/";
						if(!is_dir($path3)) 
						{
						 mkdir($path3,0755,TRUE);
						}
						 if(!is_dir($path4)) 
						{
						 mkdir($path4,0755,TRUE);
						} 
						
						for($i=0; $i<$count_file; $i++)
						{
							 $_FILES['userfile']['name']    = $_FILES['uploadfile']['name'][$i];
							 $_FILES['userfile']['type']    = $_FILES['uploadfile']['type'][$i];
							 $_FILES['userfile']['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
							 $_FILES['userfile']['error']       = $_FILES['uploadfile']['error'][$i];
							 $_FILES['userfile']['size']    = $_FILES['uploadfile']['size'][$i];
							 
							 $config['encrypt_name'] =TRUE;
							 $config['upload_path'] =$path3;
							 $config['allowed_types'] = 'jpg|jpeg|gif|png';
							 $config['max_size']	= '20000000000000';
							 $config['overwrite']     = FALSE;
	
							 $this->upload->initialize($config);
	
							 if($this->upload->do_upload())
							 {
								$file_data2 = $this->upload->data();
								$pg_path = $file_data2['file_name'];
								$pg_path2 = 'includes/uploads/product_gallery/'.$file_data2['file_name'];
								//image_thumb($pg_path2,'./includes/uploads/product_gallery/',1200,1200);
								//image_thumb($pg_path2,'./includes/uploads/product_gallery/thumb/',82,82);
								$sql2 = "insert into om_product_gallery(product_id,product_gallery_path) values(?,?)";
								$values2 = array($pid,$pg_path);
								$this->db_model->iud_data($sql2,$values2);								
							}				  
						}					  
					  
					  $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Update Successfully...</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/manage-product'</script>";
					}
					else
					{
						$msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to add.Please try again..</div>";
						$this->session->set_flashdata('msg', $msg);
						echo "<script>window.location.href='".base_url()."seller/manage-product'</script>";
					}			
				
			}			
	  
	  }


	  public function delete_product_image($gid,$pid)
	  {
	  	if($this->session->userdata('sellerLogin') == TRUE)
		 {
		 	$gal = $this->db->query("select * from om_product_gallery where product_gallery_id='$gid'")->result();
		 	unlink('includes/uploads/product_gallery/'.$gal[0]->product_gallery_path);
		 	$this->db->where('product_gallery_id', $gid);
  			$this->db->delete('om_product_gallery');
		 	redirect('seller/update-product/'.$pid);
		 }
		 else
		 {
		 	redirect('seller');
		 }
	  }
	  
	  
	  public function pincode()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			    $s_id = $this->session->userdata('seller_id');
			    $sql = "select * from pincode where seller_id='$s_id' "; 
			
			    $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
			
			
			    $config["base_url"] = base_url().'seller/pincode';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 20;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
				
			    $sql .= " order by pincode_id desc limit $page2, $per";
			    	
			    $data["links"] = $this->pagination->create_links(); 
			    $data['p'] = $this->db_model->getAlldata($sql);
			    $this->load->view('seller/pincode',$data);
		 }
		 else
		 {
			redirect('seller');
		 }		  
	  }
	  
	  public function update_shipping_charges($id)
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			  if($this->input->post())
			  {
				   $pincode = $this->input->post('pincode');
				   $delv_charge = $this->input->post('delv_charge');
				   $id = $this->input->post('id');
				   $sql = "update `pincode` set `pincode`=?,`delivery_charge`=? where pincode_id=?";
					   $values = array($pincode,$delv_charge,$id);
					   $r = $this->db_model->iud_data($sql,$values);
					   if($r)
					   {
						   $msg = '<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Pincode updated successfully.</div>';
						  $this->session->set_flashdata('msg',$msg);
						  redirect('seller/pincode');
					   }
					   else
					   {
						   $msg = '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Unable to update.Please try again!!</div>';
						  $this->session->set_flashdata('msg',$msg);
						  redirect('admin/view-all-shipping-charges');
					   }
			  }
			  $sql = "SELECT * FROM `pincode` where pincode_id='$id'";
			  $p = $this->db_model->getAlldata($sql);
			  
			  echo '<div class="form-group">
												<label for="exampleInputPassword1">Pincode</label>
												<input type="text" name="pincode" class="form-control" placeholder="Enter Pincode" value="'.$p[0]->pincode.'" required>
											</div>
											
											<div class="form-group">
												<label for="exampleInputPassword1">Delivery Charge</label>
												<input type="text" name="delv_charge" class="form-control"  placeholder="Enter Delivery Charge" value="'.$p[0]->delivery_charge.'">
											</div>
											<input type="hidden" name="id" value="'.$id.'">';
		  }
		  else
		  {
			redirect('seller');
		  }
	  }
	  
	  public function import_excel()
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			  $s_id = $this->session->userdata('seller_id');
			  if($_FILES['userfile']['name']!='')
			  {
				  if($this->session->userdata('sellerLogin') == FALSE)
				  {
					$this->load->view('seller');
				  }
				  else
				  {				 
					$path = "./includes/";
					if(!is_dir($path)) 
					{
					 mkdir($path,0755,TRUE);
					} 
			
					$config['file_name']     = 'pincode_'.$s_id.'_'.date();
					$config['encrypt_name'] = TRUE;
					$config['upload_path'] = $path;
					$config['allowed_types'] = '*';
					$config['max_size']	= '20000';
					$config['overwrite'] = TRUE;
					$this->upload->initialize($config);
					if($this->upload->do_upload())
					{
						$file_data = $this->upload->data();
						$file ='./includes/'.$file_data['file_name'];
						
						$this->load->library('excel');
						$objPHPExcel = PHPExcel_IOFactory::load($file);
						$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
						$arrayCount = count($sheetData);
						
						for($i=2;$i<=$arrayCount;$i++)
						{
								$pincode = $sheetData[$i]["A"];
								$charge = $sheetData[$i]["B"];
						 
								$sql = "select * from pincode where pincode = '$pincode' and seller_id='$s_id'";
								$r = $this->db_model->getAlldata($sql);
								if(empty($r))
								{								
									$sql2 = "insert into pincode(pincode,delivery_charge,seller_id) values(?,?,?)";	
									$values = array($pincode,$charge,$s_id);
									$shipment_id =$this->db_model->iud_data($sql2,$values);
								}
								else
								{
									$sql2 = "update pincode set delivery_charge=? where pincode=? and seller_id=?";	
									$values = array($charge,$pincode,$s_id);
									$shipment_id =$this->db_model->iud_data($sql2,$values);
								}
						   }
						   
						   $msg ="<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Imported Successfully...</div>";
							$this->session->set_flashdata('item', $msg);
							echo "<script>window.location.href='".base_url()."seller/pincode';</script>";		
					}
				}
			 }
	    }
		 else
		 {
			redirect('seller');
		 }
	  }
	  
	  
	  public function export_pincode()
	  {
		  if($this->session->userdata('sellerLogin') == FALSE)
	      {
			redirect('seller');
		  }
		  else
		  {
			    $s_id = $this->session->userdata('seller_id');
			    $sql = "SELECT * FROM `pincode` where seller_id='$s_id'";
				$pin = $this->db_model->getAlldata($sql);
				
				//load our new PHPExcel library
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('pincode');
				// Field names in the first row
				$this->excel->getActiveSheet()->setCellValue('A1', 'Pincode');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Delivery Charge');
				
				$row = 2;
				foreach($pin as $p)
				{
					
					$this->excel->getActiveSheet()->setCellValue('A'.$row, $p->pincode);
					$this->excel->getActiveSheet()->setCellValue('B'.$row, $p->delivery_charge);
		 
					$row++;
				}
				
				$filename='pincodes.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
							
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');

		  }
	  }
	  
	  
	  public function delete_pincode($id)
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			     $s_id = $this->session->userdata('seller_id');
			     $sql = "delete from pincode where pincode_id=? and seller_id=?";
				 $val = array($id,$s_id);
				 $res = $this->db_model->iud_data($sql,$val);
				 if($res)
				 {
					 $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> Deleted successfully.</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/pincode';</script>";
				 }
				 else
				 {
					 $msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to delte.Please try again.</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/pincode';</script>";
				 }
		  }
		  else
		  {
			  redirect('seller');
		  }
	  }
	  
	  
	  public function weight()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			    $s_id = $this->session->userdata('seller_id');
			    $sql = "select * from seller_weight where seller_id='$s_id' "; 
			
			    $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
			
			
			    $config["base_url"] = base_url().'seller/weight';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 20;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
				
			    $sql .= " limit $page2, $per";
			    	
			    $data["links"] = $this->pagination->create_links(); 
			    $data['p'] = $this->db_model->getAlldata($sql);
			    $this->load->view('seller/weight',$data);
		 }
		 else
		 {
			redirect('seller');
		 }		  
	  }
	  
	  public function import_weight_excel()
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			  $s_id = $this->session->userdata('seller_id');
			  if($_FILES['userfile']['name']!='')
			  {
				  if($this->session->userdata('sellerLogin') == FALSE)
				  {
					$this->load->view('seller');
				  }
				  else
				  {				 
					$path = "./includes/";
					if(!is_dir($path)) 
					{
					 mkdir($path,0755,TRUE);
					} 
			
					$config['file_name']     = 'weight_'.$s_id.'_'.date('d-m-Y');
					$config['encrypt_name'] = TRUE;
					$config['upload_path'] = $path;
					$config['allowed_types'] = '*';
					$config['max_size']	= '20000';
					$config['overwrite'] = TRUE;
					$this->upload->initialize($config);
					if($this->upload->do_upload())
					{
						$file_data = $this->upload->data();
						$file ='./includes/'.$file_data['file_name'];
						
						$this->load->library('excel');
						$objPHPExcel = PHPExcel_IOFactory::load($file);
						$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
						$arrayCount = count($sheetData);
						
						for($i=2;$i<=$arrayCount;$i++)
						{
								$weight_from = $sheetData[$i]["A"];
								$weight_to = $sheetData[$i]["B"];
								$charge = $sheetData[$i]["C"];
						 
								$sql = "select * from seller_weight where weight_from = '$weight_from' and weight_to ='$weight_to' and seller_id='$s_id'";
								$r = $this->db_model->getAlldata($sql);
								if(empty($r))
								{								
									$sql2 = "insert into seller_weight(weight_from,weight_to,delv_charge,seller_id) values(?,?,?,?)";	
									$values = array($weight_from,$weight_to,$charge,$s_id);
									$shipment_id =$this->db_model->iud_data($sql2,$values);
								}
								else
								{
									$sql2 = "update seller_weight set delv_charge=? where weight_from=? and weight_to=? and seller_id=?";	
									$values = array($charge,$weight_from,$weight_to,$s_id);
									$shipment_id =$this->db_model->iud_data($sql2,$values);
								}
						   }
						   
						   $msg ="<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Imported successfully...</div>";
							$this->session->set_flashdata('item', $msg);
							echo "<script>window.location.href='".base_url()."seller/weight';</script>";		
					}
				}
			 }
	    }
		 else
		 {
			redirect('seller');
		 }
	  }
	  
	  
	  public function export_weight()
	  {
		  if($this->session->userdata('sellerLogin') == FALSE)
	      {
			redirect('seller');
		  }
		  else
		  {
			    $s_id = $this->session->userdata('seller_id');
			    $sql = "SELECT * FROM `seller_weight` where seller_id='$s_id'";
				$pin = $this->db_model->getAlldata($sql);
				
				//load our new PHPExcel library
				$this->load->library('excel');
				//activate worksheet number 1
				$this->excel->setActiveSheetIndex(0);
				//name the worksheet
				$this->excel->getActiveSheet()->setTitle('weight');
				// Field names in the first row
				$this->excel->getActiveSheet()->setCellValue('A1', 'Weight From(in grms)');
				$this->excel->getActiveSheet()->setCellValue('B1', 'Weight To(in grms)');
				$this->excel->getActiveSheet()->setCellValue('C1', 'Delivery Charge');
				
				$row = 2;
				foreach($pin as $p)
				{
					
					$this->excel->getActiveSheet()->setCellValue('A'.$row, $p->weight_from);
					$this->excel->getActiveSheet()->setCellValue('B'.$row, $p->weight_to);
					$this->excel->getActiveSheet()->setCellValue('C'.$row, $p->delv_charge);
		 
					$row++;
				}
				
				$filename='weight.xlsx'; //save our workbook as this file name
				header('Content-Type: application/vnd.ms-excel'); //mime type
				header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
				header('Cache-Control: max-age=0'); //no cache
							
				//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
				//if you want to save it as .XLSX Excel 2007 format
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
				//force user to download the Excel file without writing it to server's HD
				$objWriter->save('php://output');

		  }
	  }
	  
	  
	  public function delete_weight($id)
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			     $s_id = $this->session->userdata('seller_id');
			     $sql = "delete from seller_weight where weight_id=? and seller_id=?";
				 $val = array($id,$s_id);
				 $res = $this->db_model->iud_data($sql,$val);
				 if($res)
				 {
					 $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> Deleted successfully.</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/weight';</script>";
				 }
				 else
				 {
					 $msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to delte.Please try again.</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/weight';</script>";
				 }
		  }
		  else
		  {
			  redirect('seller');
		  }
	  }
	  
	  public function update_weight_charges($id)
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			  if($this->input->post())
			  {
					   $weight_from = $this->input->post('weight_from');
					   $weight_to = $this->input->post('weight_to');
					   $delv_charge = $this->input->post('delv_charge');
					   $id = $this->input->post('id');
					   $sql = "UPDATE `seller_weight` SET `weight_from`=?,`weight_to`=?,`delv_charge`=? WHERE `weight_id`=?";
						   $values = array($weight_from,$weight_to,$delv_charge,$id);
						   $r = $this->db_model->iud_data($sql,$values);
						   if($r)
						   {
							   $msg = '<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>&nbsp;Weight updated successfully.</div>';
							  $this->session->set_flashdata('msg',$msg);
							  redirect('seller/weight');
						   }
						   else
						   {
							   $msg = '<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>&nbsp;Unable to update.Please try again!!</div>';
							  $this->session->set_flashdata('msg',$msg);
							  redirect('seller/weight');
						   }
				  }
				  $sql = "SELECT * FROM `seller_weight` where weight_id='$id'";
				  $p = $this->db_model->getAlldata($sql);
				  
				  echo '<div class="form-group">
													<label for="exampleInputPassword1">Weight From</label>
													<input type="text" name="weight_from" class="form-control" placeholder="Enter Pincode" value="'.$p[0]->weight_from.'" required>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Weight To</label>
													<input type="text" name="weight_to" class="form-control" placeholder="Enter Pincode" value="'.$p[0]->weight_to.'" required>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Delivery Charge</label>
													<input type="text" name="delv_charge" class="form-control"  placeholder="Enter Delivery Charge" value="'.$p[0]->delv_charge.'">
												</div>
												<input type="hidden" name="id" value="'.$id.'">';
			
		  }
		  else
		  {
			   redirect('seller');
		  }
	  }
	  
	  public function personal_details()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			$id = $this->session->userdata('seller_id'); 
			$sql_s = "select * from seller where seller_id='$id'";
			$cd = $this->db_model->getAlldata($sql_s);
			
			  $sql = "select * from seller as se " ;
			  if($cd[0]->state != 0)
			  {
				  $sql .= " join state as s on se.state = s.state_id ";
			  }
			  if($cd[0]->city != 0)
			  {
				  $sql .= " join city as ct on se.city = ct.city_id ";
			  }
			  if($cd[0]->area != 0)
			  {
				  $sql .= " join area as a on se.area = a.area_id ";
			  }
			  if($cd[0]->market != 0)
			  {
				  $sql .= " join market as m on se.market = m.market_id ";
			  }
			  $sql .= " where seller_id='$id'";
			  $data['s'] = $this->db_model->getAlldata($sql);
			  $this->load->view('seller/personal-details',$data);
		 }
		 else
		 {
			redirect('seller');
		 }		  
	  }
	  
	  
	  public function bank_details()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			$id = $this->session->userdata('seller_id'); 
			if($this->input->post())
			{
				$ac_name = $this->input->post('ac_name');
				$ac_no = $this->input->post('ac_no');
				$ac_type = $this->input->post('ac_type');
				$bank_name = $this->input->post('bank_name');
				$bank_branch = $this->input->post('bank_branch');
				$ifsc_code = $this->input->post('ifsc_code');
				
				$sql = "UPDATE `seller_bank_details` SET  `ac_name`=?,`ac_number`=?,
				`ac_type`=?,`bank_name`=?,
				`bank_branch_name`=?,`bank_ifsc`=? WHERE seller_id=?";
				 $val = array($ac_name,$ac_no,$ac_type,$bank_name,$bank_branch,$ifsc_code,$id);
				 $res = $this->db_model->iud_data($sql,$val);
				 if($res)
				 {
					 $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> Updated Successfully.</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/bank-details'</script>";
				 }
				 else
				 {
					 $msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to update.Please try again.</div>";
					  $this->session->set_flashdata('msg', $msg);
					  echo "<script>window.location.href='".base_url()."seller/bank-details'</script>";
				 }
			}
			$sql = "SELECT * FROM `seller_bank_details` where seller_id='$id'";
			$data['b'] = $this->db_model->getAlldata($sql);
			$this->load->view('seller/bank-details',$data);
		 }
		 else
		 {
			redirect('seller');
		 }		  
	  }
	  
	  
	  public function personal_details_edit()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			$id = $this->session->userdata('seller_id'); 
			$sql = "select * from seller where seller_id='$id'"; 
			$data['s'] = $this->db_model->getAlldata($sql);
			
			  $state_id = $data['s'][0]->state;
			  $city_id = $data['s'][0]->city;
			  $area_id = $data['s'][0]->area;
			  
			  $data['state'] = $this->db_model->getAlldata("select * from state");
			  $data['city'] = $this->db_model->getAlldata("select * from city where state_id='$state_id'");
			  $data['area'] = $this->db_model->getAlldata("select * from area where state_id='$state_id' and city_id='$city_id'");
			  $data['market'] = $this->db_model->getAlldata("select * from market where state_id='$state_id' and city_id='$city_id' and area_id='$area_id'");
			  $this->load->view('seller/personal-details-edit',$data);
		 }
		 else
		 {
			redirect('seller');
		 }		  
	  }
	  
	  public function update_personal_details()
	  {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			$id = $this->session->userdata('seller_id'); 
			
			$pname = $this->input->post('pname');
			$pinfo = $this->input->post('pinfo');
			$surl = $this->input->post('surl');
			$mobile = $this->input->post('mobile');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$area = $this->input->post('area');
			$market = $this->input->post('market');
			
			$logo = $this->input->post('logo');
			$banner = $this->input->post('banner');
			
			    if($_FILES['userfile']['name']!='')
		        {
		 	      $path = "./includes/uploads/SellerLogo/";
	              if(!is_dir($path)) 
	              {
	                mkdir($path,0755,TRUE);
	              } 	
					$config['encrypt_name'] =TRUE;
					$config['upload_path'] =$path;
			        $config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= '20000000';					
			        $config['overwrite'] = FALSE;
					$this->upload->initialize($config);
			        if($this->upload->do_upload())
					{
						$file_data = $this->upload->data();
					    $logo = 'includes/uploads/SellerLogo/'.$file_data['file_name'];
					}
				}
				
				if($_FILES['userfile2']['name']!='')
		        {
		 	      $path = "./includes/uploads/SellerBanner/";
	              if(!is_dir($path)) 
	              {
	                mkdir($path,0755,TRUE);
	              } 	
					$config['encrypt_name'] =TRUE;
					$config['upload_path'] =$path;
			        $config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= '20000000';					
			        $config['overwrite'] = FALSE;
					$this->upload->initialize($config);
			        if($this->upload->do_upload('userfile2'))
					{
						$file_data = $this->upload->data();
					    $banner = 'includes/uploads/SellerBanner/'.$file_data['file_name'];
					}
				}
			
				$sql ="UPDATE `seller` SET `seller_name`=?,`seller_phone`=?,`state`=?,`city`=?,`area`=?,
				`market`=?,seller_logo=?,seller_banner=?,seller_info=? WHERE seller_id=?";
				$values = array($pname,$mobile,$state,$city,$area,$market,$logo,$banner,$pinfo,$id);
				
				$res = $this->db_model->iud_data($sql,$values);
				
				if($res)
				{
					  $sql2 = "select * from seller where seller_url='$surl'";
					  $r = $this->db_model->getAlldata($sql2);
					  if(empty($r))
					  {
						  $sql3 = "update seller set seller_url=? where seller_id='$id'";
						  $values2 = array($surl,$id);
						  $r2 = $this->db_model->iud_data($sql3,$values2);
						  if($r2)
						  {
							   $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Updated Successfully...</div>";
							 $this->session->set_flashdata('msg', $msg);
							echo "<script>window.location.href='".base_url()."seller/personal-details'</script>";
						  }
						  else
						  {
							   $msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Unable to update seller URL.Please try again..</div>";
					           $this->session->set_flashdata('msg', $msg);
					           echo "<script>window.location.href='".base_url()."seller/personal-details'</script>";
						  }
					  }
					  else
						  {
							  $msg = "<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Updated Successfully...</div>";
							   $this->session->set_flashdata('msg', $msg);
							   echo "<script>window.location.href='".base_url()."seller/personal-details'</script>";
						  }
					  }
					  else
					  {
						  $msg = "<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button> Store URL not available.</div>";
						  $this->session->set_flashdata('msg', $msg);
						  echo "<script>window.location.href='".base_url()."seller/personal-details'</script>";
					  }
							
				}		
			
		 else
		 {
			redirect('seller');
		 }		  
	  }
	  
	  
	  /*Order details code by Manoj*/
	   public function view_orders()
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $sql = "SELECT order_id,order_item_added_date as order_date,SUM(total_product_price) as total_price FROM `om_order_item` as oi join 
			   seller as s on oi.seller_id = s.seller_id where oi.seller_id='$id' 
			   and oi.is_deleted='no' group by oi.order_id,oi.seller_id ";
			   
			   $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
				
				$config["base_url"] = base_url().'seller/view-orders';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 12;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
			   
			   $sql .= " order by order_item_id desc limit $page2, $per";
			   $data['order'] = $this->db_model->getAlldata($sql);
			   $data["links"] = $this->pagination->create_links(); 
			   $this->load->view('seller/view-order',$data);
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }

	   public function view_completed_orders()
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $sql = "SELECT order_id,order_item_added_date as order_date,SUM(total_product_price) as total_price FROM `om_order_item` as oi join 
			   seller as s on oi.seller_id = s.seller_id where oi.seller_id='$id' 
			   and oi.is_deleted='no' group by oi.order_id,oi.seller_id ";
			   
			    $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
				
				$config["base_url"] = base_url().'seller/view-completed-orders';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 12;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
			   
			   $sql .= " order by order_item_id desc limit $page2, $per";
			   $data['order'] = $this->db_model->getAlldata($sql);
			   $data["links"] = $this->pagination->create_links(); 
			   $this->load->view('seller/view-completed-order',$data);
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }

	   public function view_pending_orders()
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $sql = "SELECT order_id,order_item_added_date as order_date,SUM(total_product_price) as total_price FROM `om_order_item` as oi join 
			   seller as s on oi.seller_id = s.seller_id where oi.seller_id='$id' 
			   and oi.is_deleted='no' group by oi.order_id,oi.seller_id ";
			   
			    $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
				
				$config["base_url"] = base_url().'seller/view-completed-orders';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 12;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
			   
			   $sql .= " order by order_item_id desc limit $page2, $per";
			   $data['order'] = $this->db_model->getAlldata($sql);
			   $data["links"] = $this->pagination->create_links(); 
			   $this->load->view('seller/view-pending-order',$data);
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }
	  
	   /*End of order details code*/
	   
	   public function edit_order($id='')
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $this->load->view('seller/edit-order');
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }
	   
	   
	   public function order_details($order_id='')
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   
			   $id = $this->session->userdata('seller_id');
			   
			   $sql3 = "SELECT * FROM `om_order_item` as oi join seller as s on oi.seller_id = s.seller_id join om_product as p on oi.product_id = p.product_id where oi.seller_id='$id' and oi.order_id='$order_id' and oi.is_deleted='no' order by order_item_id desc";
			   $data['od'] = $this->db_model->getAlldata($sql3);
			   
			   $sql6 = "SELECT `total_order_price`, `total_ship_charge`, `minus_ship_charge`, `additional_ship_charge` FROM `om_order_ship_charge` WHERE order_id='$order_id' and seller_id ='$id'";
			   $data['oc'] = $this->db_model->getAlldata($sql6);
			   
			   
			   $sql4 = "SELECT c.cus_name,c.cus_email,c.cus_mobile,o.order_id FROM `customers` as c join om_orders as o on c.cus_id = o.cus_id where o.order_id='$order_id'";
			   
			   $data['c'] = $this->db_model->getAlldata($sql4);
			   
			   $sql5 = "SELECT * FROM `om_order_status` where seller_id='$id' and order_id='$order_id' order by added_date desc";
			   $data['oh'] = $this->db_model->getAlldata($sql5);
			   
			   $sql_c = "select * from om_order_bill_address where order_id='$order_id'";
			   $cd = $this->db_model->getAlldata($sql_c);
			  
			   $sql = "select * from om_order_bill_address as c ";
			   if($cd[0]->bill_country != 0)
			   {
				  $sql .= " join country as cn on c.bill_country = cn.country_id ";
			   }
			   if($cd[0]->bill_state != 0)
			   {
				  $sql .= " join state as s on c.bill_state = s.state_id ";
			   }
			   if($cd[0]->bill_city != 0)
			   {
				  $sql .= " join city as ct on c.bill_city = ct.city_id ";
			   }
			   if($cd[0]->bill_area != 0)
			   {
				  $sql .= " join area as a on c.bill_area = a.area_id ";
			   }
			   $sql .= " where c.order_id='$order_id'";
			   $data['b'] = $this->db_model->getAlldata($sql);
			   
			   
			   $sql_s = "select * from om_order_ship_address where order_id='$order_id'";
			   $cd2 = $this->db_model->getAlldata($sql_s);
			  
			   if(!empty($cd2))
			   {
				   $sql2 = "select * from om_order_ship_address as c ";
				   if($cd2[0]->ship_country != 0)
				   {
					  $sql2 .= " join country as cn on c.ship_country = cn.country_id ";
				   }
				   if($cd2[0]->ship_state != 0)
				   {
					  $sql2 .= " join state as s on c.ship_state = s.state_id ";
				   }
				   if($cd2[0]->ship_city != 0)
				   {
					  $sql2 .= " join city as ct on c.ship_city = ct.city_id ";
				   }
				   if($cd2[0]->ship_area != 0)
				   {
					  $sql2 .= " join area as a on c.ship_area = a.area_id ";
				   }
				   $sql2 .= " where c.order_id='$order_id'";
				   $data['s'] = $this->db_model->getAlldata($sql2);
			   }
			   
			   else
			   {
				   $data['s'] = '';
			   }
			   
			  $this->load->view('seller/order-details',$data);
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }
	   
	    public function return_details($return_id='',$order_id='',$order_item_id='')
	    {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   
			   $id = $this->session->userdata('seller_id');
			  
			   $sql3 = "SELECT * FROM `om_return` as r join om_order_item as o on r.order_item_id = o.order_item_id where return_id='$return_id' and r.seller_id='$id'";
			   $data['od'] = $this->db_model->getAlldata($sql3);
			   
			   $sql5 = "SELECT * FROM `om_return_history` as rh join `om_return_status` as rs on rh.return_status_id = rs.return_status_id  where return_id='$return_id' order by date_added desc";
			   $data['oh'] = $this->db_model->getAlldata($sql5);
			   
			   $sql_c = "select * from om_order_bill_address where order_id='$order_id'";
			   $cd = $this->db_model->getAlldata($sql_c);
			  
			   $sql = "select * from om_order_bill_address as c ";
			   if($cd[0]->bill_country != 0)
			   {
				  $sql .= " join country as cn on c.bill_country = cn.country_id ";
			   }
			   if($cd[0]->bill_state != 0)
			   {
				  $sql .= " join state as s on c.bill_state = s.state_id ";
			   }
			   if($cd[0]->bill_city != 0)
			   {
				  $sql .= " join city as ct on c.bill_city = ct.city_id ";
			   }
			   if($cd[0]->bill_area != 0)
			   {
				  $sql .= " join area as a on c.bill_area = a.area_id ";
			   }
			   $sql .= " where c.order_id='$order_id'";
			   $data['b'] = $this->db_model->getAlldata($sql);
			   
			   
			   $sql_s = "select * from om_order_ship_address where order_id='$order_id'";
			   $cd2 = $this->db_model->getAlldata($sql_s);
			  
			   if(!empty($cd2))
			   {
				   $sql2 = "select * from om_order_ship_address as c ";
				   if($cd2[0]->ship_country != 0)
				   {
					  $sql2 .= " join country as cn on c.ship_country = cn.country_id ";
				   }
				   if($cd2[0]->ship_state != 0)
				   {
					  $sql2 .= " join state as s on c.ship_state = s.state_id ";
				   }
				   if($cd2[0]->ship_city != 0)
				   {
					  $sql2 .= " join city as ct on c.ship_city = ct.city_id ";
				   }
				   if($cd2[0]->ship_area != 0)
				   {
					  $sql2 .= " join area as a on c.ship_area = a.area_id ";
				   }
				   $sql2 .= " where c.order_id='$order_id'";
				   $data['s'] = $this->db_model->getAlldata($sql2);
			   }
			   
			   else
			   {
				   $data['s'] = '';
			   }
			  $sql6 = "SELECT * FROM `om_return_status`";
			  $data['rs'] =  $this->db_model->getAlldata($sql6);
			  $this->load->view('seller/return-details',$data);
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }
	   
	   public function add_return_history()
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $return_id = $this->input->post('return_id');
			   $order_id = $this->input->post('order_id');
			   $order_item_id = $this->input->post('order_item_id');
			   $order_status = $this->input->post('order_status');
			   $comment = $this->input->post('comment');
			   
			   $sql2 = "select * from `om_return_history` where return_id='$return_id' and return_status_id='$order_status'";
			   $st = $this->db_model->getAlldata($sql2);
			   if(empty($st))
			   {
				   $sql = "INSERT INTO `om_return_history`(`return_id`, `return_status_id`,`comment`) VALUES (?,?,?)";
				   $values = array($return_id,$order_status,$comment);
				   $res = $this->db_model->iud_data($sql,$values);
				   
				   if($res)
				   {
					   $msg = '<div class="alert alert-success" role="alert">Return status added successfully.</div>';
					   $this->session->set_flashdata('msg',$msg);
					   redirect('seller/return-details/'.$return_id.'/'.$order_id.'/'.$order_item_id);
				   }
				   else
				   {
					   $msg = '<div class="alert alert-danger" role="alert">Unable to add return status.Please try again.</div>';
					   $this->session->set_flashdata('msg',$msg);
					   redirect('seller/return-details/'.$return_id.'/'.$order_id.'/'.$order_item_id);
				   }
			   }
			   else
			   {
				   $msg = '<div class="alert alert-danger" role="alert">Return status already added for this Return ID.</div>';
					   $this->session->set_flashdata('msg',$msg);
					   redirect('seller/return-details/'.$return_id.'/'.$order_id.'/'.$order_item_id);
			   }
			   
		   }
		   else
		   {
			    redirect('seller');
		   }
	   }
	   
	   
	   
	   public function add_order_history()
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $order_id = $this->input->post('order_id');
			   $order_status = $this->input->post('order_status');
			   $comments = $this->input->post('comments');
			   $sql = "INSERT INTO `om_order_status`(`order_id`, `seller_id`, `product_status`,`comments`) VALUES (?,?,?,?)";
			   $values = array($order_id,$id,$order_status,$comments);
			   $res = $this->db_model->iud_data($sql,$values);
			   

			    $trnx = $this->db->query('SELECT * FROM  `om_orders` where order_id="'.$order_id.'"')->result();
			    if($order_status == 'Complete' && $trnx[0]->payment_mode == 'COD')
			   	{
			   		$csmdt = $this->db->query('SELECT * FROM  `customers` where cus_id="'.$trnx[0]->cus_id.'"')->result();
			   		if($csmdt[0]->package_id != '1')
			   		{
			   			$discount = '0';
						$pckg = $this->db->query('SELECT * FROM  `package` where package_id="'.$csmdt[0]->package_id.'"')->result();

						$shpamt = $this->db->query('SELECT * FROM  `om_order_ship_charge` where order_id="'.$order_id.'"')->result();

						$discount = ($shpamt[0]->total_order_price / 100) * $pckg[0]->package_dis;

						$ehtrnx2 = $this->db->query("select * from ehome_trnx where txn_cus='".$trnx[0]->cus_id."' order by trnx_id DESC limit 1")->result();
		   				if($ehtrnx2)
		   				{
							$sql3 = "INSERT INTO `ehome_trnx`(`txn_cus`, `txn_order`, `txn_opbal`, `txn_crdt`, `txn_clbal`, `txn_date`, `txn_type`, `txn_ip`) VALUES (?,?,?,?,?,?,?,?)";
							$val3 = array($ehtrnx2[0]->txn_cus,$order_id,$ehtrnx2[0]->txn_clbal,$discount,$ehtrnx2[0]->txn_clbal+$discount,DATE('Y-m-d h:i:s'),'discount',$this->input->ip_address());
							$this->db_model->iud_data($sql3,$val3);	

		   				}
		   				else
		   				{
							$sql3 = "INSERT INTO `ehome_trnx`(`txn_cus`, `txn_order`, `txn_opbal`, `txn_crdt`, `txn_clbal`, `txn_date`, `txn_type`, `txn_ip`) VALUES (?,?,?,?,?,?,?,?)";
							$val3 = array($trnx[0]->cus_id,$order_id,'0',$discount,$discount,DATE('Y-m-d h:i:s'),'discount',$this->input->ip_address());
							$this->db_model->iud_data($sql3,$val3);
		   				}
			   		}				    
			   	}


			   if($res)
			   {
				   $msg = '<div class="alert alert-success" role="alert">Order status added successfully.</div>';
				   $this->session->set_flashdata('msg',$msg);
				   redirect('seller/order-details/'.$order_id);
			   }
			   else
			   {
				   $msg = '<div class="alert alert-success" role="alert">Unable to add order status.Please try again.</div>';
				   $this->session->set_flashdata('msg',$msg);
				   redirect('seller/order-details/'.$order_id);
			   }
			   
		   }
		   else
		   {
			    redirect('seller');
		   }
	   }
	   
	   
	   
	    public function delete_order($order_id)
	    {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $sql = "UPDATE `om_order_item` SET `is_deleted`=? WHERE seller_id=? and order_id=?";
			   $values = array('yes',$id,$order_id);
			   $res = $this->db_model->iud_data($sql,$values);
			   
			   if($res)
			   {
				   $msg = '<div class="alert alert-success" role="alert">Order deleted successfully.</div>';
				   $this->session->set_flashdata('msg',$msg);
				   redirect('seller/view-orders');
			   }
			   else
			   {
				   $msg = '<div class="alert alert-success" role="alert">Unable to delete order.Please try again.</div>';
				   $this->session->set_flashdata('msg',$msg);
				   redirect('seller/view-orders');
			   }
		   }
		   else
		   {
			   redirect('seller');
		   }
		}
		
		
		public function upload_image($path,$filename='userfile',$type='*',$size='1000')
		{
			      
	              if(!is_dir($path)) 
	              {
	                mkdir($path,0755,TRUE);
	              } 	
					$config['encrypt_name'] =TRUE;
					$config['upload_path'] =$path;
			        $config['allowed_types'] = $type;
					$config['max_size']	= $size;					
			        $config['overwrite'] = FALSE;
					$this->upload->initialize($config);
			        if($this->upload->do_upload($filename))
					{
						$file_data = $this->upload->data();
					    return $file_data['file_name'];
					}
					else
					{
						return 0;
					}
		}
		
		public function commission()
		{
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   
			   $sql = "select * from commission where commission_id=(select commission_id from seller where seller_id='$id')";
			   $data['c'] = $this->db_model->getAlldata($sql);
			   if(!empty($data['c']))
			   {
			   $com_id = $data['c'][0]->commission_id;
			   $sql2 = "select * from commission_rate as cr join category as c on cr.category_id = c.category_id where cr.commission_id='$com_id' and c.parent_cat_id='0'";
			   $data['cr'] = $this->db_model->getAlldata($sql2);
			   }
			   else
			   {
				   $data['cr'] = '';
			   }
			   $this->load->view('seller/commission',$data);			   
			   
		   }
		   else
		   {
			   redirect('seller');
		   }
		}
		
		public function returns()
		{
			if($this->session->userdata('sellerLogin') == TRUE)
		    {
				 $seller_id = $this->session->userdata('seller_id');
			     $sql = "SELECT * FROM `om_return` as r join om_order_item as o on r.order_item_id = o.order_item_id WHERE r.seller_id='$seller_id' ";
				 
				$config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
				
				$config["base_url"] = base_url().'seller/returns';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 12;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
				 
				$sql .= " order by date_added desc limit $page2, $per";
			    $data['return'] = $this->db_model->getAlldata($sql);
				$data["links"] = $this->pagination->create_links(); 
				$this->load->view('seller/view-returns',$data);
				
			}
			else
			{
				redirect('seller');
			}
		}
		
		
		
		public function shipping_charge_by_order()
	  {
		   if($this->session->userdata('sellerLogin') == FALSE)
			{
				redirect('seller');
			}
			else
			{
				$seller_id = $this->session->userdata('seller_id');
				if($this->input->post())
				{
					$below_order = $this->input->post('below_order');
					$below_order_charge = $this->input->post('below_order_charge');
					$above_order = $this->input->post('above_order');
					$above_order_charge = $this->input->post('above_order_charge');
					
					if($below_order < $above_order)
					{
						$sql = "UPDATE `seller` SET `below_order`=?,`below_order_charge`=?,`above_order`=?,`above_order_charge`=? WHERE seller_id=?";
					$val = array($below_order,$below_order_charge,$above_order,$above_order_charge,$seller_id);
					$r = $this->db_model->iud_data($sql,$val);
					   
					   if($r)
					   {
						   $msg = '<div class="alert alert-success" role="alert">Updated successfully.</div>';
						   $this->session->set_flashdata('msg',$msg);
						   redirect('seller/shipping-charge-by-order');
					   }
					   else
					   {
						   $msg = '<div class="alert alert-danger" role="alert">Unable to update.Please try again.</div>';
						   $this->session->set_flashdata('msg',$msg);
						   redirect('seller/shipping-charge-by-order');
					   }
					}
					else
					{
						$msg = '<div class="alert alert-info" role="alert">Above order price must be greater than below order price.</div>';
						$this->session->set_flashdata('msg',$msg);
						redirect('seller/shipping-charge-by-order');
					}
				}
				$sql = "select below_order,below_order_charge,above_order,above_order_charge from seller where seller_id='$seller_id'";
				$data['r'] = $this->db_model->getAlldata($sql);
				$this->load->view('seller/shipping-charge-by-order',$data);
			}
	  }
	  
	  public function total_orders()
	  {
		    if($this->session->userdata('sellerLogin') == TRUE)
			{
				    $seller_id = $this->session->userdata('seller_id');
				    $date_from = date('Y-m-01');
					$date_to = date('Y-m-d');
					
					$sql = "SELECT count(order_id) as total_order,SUM(product_qty) as qty,SUM(total_product_price) as total_price,DATE_FORMAT(order_item_added_date ,'%d/%m/%Y') as date_from,DATE_FORMAT(order_item_added_date,'%d/%m/%Y') as date_to FROM `om_order_item` where seller_id='$seller_id' and is_deleted='no' and is_canceled='0' and DATE(order_item_added_date) between '$date_from' and '$date_to' group by seller_id,DATE(order_item_added_date) ";
					
					$config = array();
					$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
					$config['full_tag_close'] = '</ul>';
					$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
					$config['prev_tag_open'] = '<li>';
					$config['prev_tag_close'] = '</li>';
					$config['next_link'] = '<i class="fa fa-caret-right"></i>';
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '</li>';
					$config['cur_tag_open'] = '<li class="active"><a href="#">';
					$config['cur_tag_close'] = '</a></li>';
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
					$config['first_tag_open'] = '<li>';
					$config['first_tag_close'] = '</li>';
					$config['last_tag_open'] = '<li>';
					$config['last_tag_close'] = '</li>';
					$config['use_page_numbers'] = TRUE;
					
					$config["base_url"] = base_url().'seller/total-orders';
					$config["uri_segment"] = 3;
					$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
					
					$config["total_rows"] = $this->db_model->check($sql);
					$per = 12;
					$config["per_page"] = $per;
					$page2 = 0;
					if($page)
					{
						$page2 = $page * $per - $per;
					}
					$this->pagination->initialize($config);
					 
					$sql .= " order by order_item_added_date desc limit $page2, $per";
					$data['order'] = $this->db_model->getAlldata($sql);
					$data["links"] = $this->pagination->create_links(); 
					$this->load->view('seller/total-orders',$data);
			}
			else
			{
				redirect('seller');
			}
	  }

	  public function auto_product_list()
	  {
			$term = $this->input->post('term',TRUE);
            $match = '%'.$term.'%';
				
			$id = $this->session->userdata('seller_id');			
		    $sql = "select product_name,model,product_id from om_product where seller_id='$id' and (product_name like '$match' or model like '$match')";
			$rows = $this->db_model->getAlldata($sql);
			
			$json_array = array();
			if(!empty($rows))
			{
				foreach ($rows as $r)
				{
					array_push($json_array, array("value"=>$r->product_name.'-'.$r->model ,"lable"=>$r->product_id));
				}
			    echo json_encode($json_array);
			}
			else
			{
				echo json_encode(array('No result'));
			}        
		}
	  
	  public function filter_manage_product()
		{
			$id = $this->session->userdata('seller_id');
			$product_id = $this->input->post('product_id');
			$status = $this->input->post('status');
		    $sql = "select * from om_product where seller_id='$id' and product_id='$product_id' ";
			if($status != '')
			{
				$sql .= " and p_status='$status'";
			}
			$pro = $this->db_model->getAlldata($sql);
			echo '<div class="row">
				<div class="col-sm-12">
				
				  <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
					  <thead>
						<tr>
						  <th>Image</th>
						  <th>Name</th>
						  <th>SKU(Model No.)</th>
						  <th>Quantity</th>
						  <th>MRP ( <i class="fa fa-inr"></i> )</th>
						  <th>Selling Price ( <i class="fa fa-inr"></i> )</th>
						  <th>Status</th>
						  <th width="12%">Action</th>
						</tr>
					  </thead>
					  <tbody>';
			if(!empty($pro)) { 
		              foreach($pro as $p) {
						echo '<tr>
						  <td><img src="'.base_url().'includes/uploads/product_image/'.$p->featured_image.'" width="75" height="75" alt="" /></td>
						  <td>'.$p->product_name.'</td>
						  <td>'.$p->model.'</td>
						  <td>'.$p->stock.'</td>
						  <td>';
						  if($p->mrp != 0){echo '<i class="fa fa-inr"></i> '.$p->mrp.' /-'; }else{echo '-';}
                          
                          echo '</td>
						  <td>';
						  if($p->retail_price != 0){echo '<i class="fa fa-inr"></i> '.$p->retail_price.' /-';}else{echo '-';} 
						  echo '</td>
						  <td>';
						  if($p->p_status == 1) {echo '<label class="label label-success">Active</label>';}else { echo '<label class="label label-danger">Inactive</label>';}
						  echo '</td>
						  <td><!--<a href="#myModal" id="openBtn" data-toggle="modal" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a> --><a href="'.base_url().'seller/update-product/'.$p->product_id.'" class="btn btn-xs btn-success"><i class="fa fa-edit fa-2x"></i></a> <a onClick="return confirm("Are you sure?")" href="'. base_url().'seller/delete-product/'.$p->product_id.'" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a></td>
						</tr>';
						
						} 			
			}
			else
			{ 
            echo '<tr><td colspan="10">Product not found...</td></tr>';
             } 
            
            
          echo '</tbody>
			</table>
			  </div></div>
		  </div>';
			
		}
	  
		public function filter_view_orders()
		{
			if($this->session->userdata('sellerLogin') == TRUE)
		    {
			  $order_id = $this->input->post('order_id');
			  $cus_name = $this->input->post('cus_name');
			  $order_date = $this->input->post('order_date');
			  $order_status = $this->input->post('order_status');
			  $id = $this->session->userdata('seller_id');
			  
			  $sql = "SELECT oi.order_id,c.cus_name,c.cus_id,order_item_added_date as order_date,SUM(total_product_price) as total_price,o.payment_mode,(o.total_ship_charge + o.additional_ship_charge) as ship FROM `om_order_item` as oi join seller as s on oi.seller_id = s.seller_id join om_orders as o on oi.order_id=o.order_id join customers as c on o.cus_id=c.cus_id  where oi.seller_id='$id' and oi.is_deleted='no' ";
			  
			  if($order_id != '')
			  {
				 $sql .= " and oi.order_id='$order_id' "; 
			  }
			  
			  if($cus_name != '')
			  {
				  $sql .= " and c.cus_name='$cus_name' ";
			  }
			  
			  if($order_date != '')
			  {
				  $sql .= " and DATE(o.order_added_date)='$order_date' ";
			  }
			  
			  $sql .= " group by oi.order_id,oi.seller_id order by o.order_id desc ";
			  
			  $order = $this->db_model->getAlldata($sql);
			  
			  echo '<div class="row">
						<div class="col-sm-12">
						  <div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
							  <thead>
								<tr>
								 <th>Order No. </th> 
								 <th>Order Date </th>
								 <th> Total Amount ( <i class="fa fa-inr"></i> ) </th> 
								 <th> Total Shipping Charge ( <i class="fa fa-inr"></i> ) </th> 
								 <th>Customer Name </th>
								 <th>City </th>
								 <th>Payment Mode</th>
								 <th>Order Status</th>
								 <th width="12%"> Action</th>
								 
								</tr>
							  </thead>
							  <tbody>';
							  if(!empty($order)){
								  if($order_status == 'All'){
									  
								   foreach($order as $o){ 
								       $order_id = $o->order_id;
									   $sql5 = "SELECT product_status FROM `om_order_status` where seller_id='$id' and order_id='$order_id' order by added_date desc limit 1";
									    $os = $this->db_model->getAlldata($sql5);
										$cus_id = $o->cus_id;
                                        $ct = $this->db_model->getAlldata("select city_name from city where city_id=(select city_id from customers where cus_id='$cus_id')");
										
										
			     echo '<tr><td>#'.$order_id.'</td>
							  <td>'.date("d/m/Y",strtotime($o->order_date)).'</td>
							  <td><i class="fa fa-inr"></i>'.$o->total_price.'/-</td>
							  <td><i class="fa fa-inr"></i>'.$o->ship.'/-</td>
							  <td>'.$o->cus_name.'</td>
							  <td>';
							  if(!empty($ct)) echo $ct[0]->city_name; else echo "-";
                              
                              echo '</td>
							  <td>';
							  if($o->payment_mode == 'COD')
							  {
								  echo "COD";
							  }
							  else
							  {
								  echo "Online";
							  }
							 
							  echo '</td>
							  <td>';
							  if($os[0]->product_status == 'Pending') {
								 echo '<label title="Order Status" class="label label-danger">'.$os[0]->product_status.'</label>';
							 } else { 
								  echo '<label title="Order Status" class="label label-success">'.$os[0]->product_status.'</label>';
							   } 
							 echo '</td>
							  <td><a title="View Order" href="'.base_url("seller/order-details").'/'.$o->order_id.'" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a>&nbsp;<a onClick="return confirm("Are you sure?")" title="Delete Order"  href="'. base_url("seller/delete-order").'/'.$o->order_id.'" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a>
							  <a target="_blank" href="'.base_url("seller/invoice").'/'.$o->order_id.'" title="Print Invoice" class="btn btn-xs btn-success"><i class="fa fa-print fa-2x"></i></a>
							  </td>
							</tr>';
						    } 
							
							  }
							  else
							  {
								  
								  
									  
								   foreach($order as $o){ 
								       $order_id = $o->order_id;
									   $sql5 = "SELECT product_status FROM `om_order_status` where seller_id='$id' and order_id='$order_id' order by added_date desc limit 1";
									    $os = $this->db_model->getAlldata($sql5);
										$cus_id = $o->cus_id;
                                        $ct = $this->db_model->getAlldata("select city_name from city where city_id=(select city_id from customers where cus_id='$cus_id')");
									if($order_status == $os[0]->product_status) {	
										
			     echo '<tr><td>#'.$order_id.'</td>
							  <td>'.date("d/m/Y",strtotime($o->order_date)).'</td>
							  <td><i class="fa fa-inr"></i>'.$o->total_price.'/-</td>
							  <td><i class="fa fa-inr"></i>'.$o->ship.'/-</td>
							  <td>'.$o->cus_name.'</td>
							  <td>';
							  if(!empty($ct)) echo $ct[0]->city_name; else echo "-";
                              
                              echo '</td>
							  <td>';
							  if($o->payment_mode == 'COD')
							  {
								  echo "COD";
							  }
							  else
							  {
								  echo "Online";
							  }
							 
							  echo '</td>
							  <td>';
							  if($os[0]->product_status == 'Pending') {
								 echo '<label title="Order Status" class="label label-danger">'.$os[0]->product_status.'</label>';
							 } else { 
								  echo '<label title="Order Status" class="label label-success">'.$os[0]->product_status.'</label>';
							   } 
							 echo '</td>
							  <td><a title="View Order" href="'.base_url("seller/order-details").'/'.$o->order_id.'" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a>&nbsp;<a onClick="return confirm("Are you sure?")" title="Delete Order"  href="'. base_url("seller/delete-order").'/'.$o->order_id.'" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a>
							  <a target="_blank" href="'.base_url("seller/invoice").'/'.$o->order_id.'" title="Print Invoice" class="btn btn-xs btn-success"><i class="fa fa-print fa-2x"></i></a>
							  </td>
							</tr>';
						    } 
								   }
							  
								  
							  }
							
							
							
							} else { 
							
						   echo '<tr><td colspan="10">No Order Yet</td></tr>';
						    }
							
						 echo '</tbody>
						</table>
					  </div>
					  
					</div>
				  </div>';
			  
			  
			}
		}

		public function invoice($order_id)
	    {
		 if($this->session->userdata('sellerLogin') == TRUE)
		 {
			   $id = $this->session->userdata('seller_id');
			   $sql3 = "SELECT * FROM `om_order_item` as oi join seller as s on oi.seller_id = s.seller_id join om_product as p on oi.product_id = p.product_id where oi.seller_id='$id' and oi.order_id='$order_id' and oi.is_deleted='no' order by order_item_id desc";
			   $data['od'] = $this->db_model->getAlldata($sql3);
			   
			   $sql13 = $this->db_model->getAlldata("select * from om_orders where order_id='$order_id'");
			   $cus = $sql13[0]->cus_id;

			   $data['cus'] = $this->db_model->getAlldata("select * from customers where cus_id='$cus'");

			   $sql6 = "SELECT `total_order_price`, `total_ship_charge`, `minus_ship_charge`, `additional_ship_charge` FROM `om_order_ship_charge` WHERE order_id='$order_id' and seller_id ='$id'";
			   $data['oc'] = $this->db_model->getAlldata($sql6);
			   
			   $ci = $data['od'][0]->city;
			  
			   
			   if(!empty($ci))
			   {
				   $sql7 = "select city_name from city where city_id='$ci'";
				   $cit = $this->db_model->getAlldata($sql7);
				   $data['cit'] = $cit[0]->city_name;
			   }
			   
			   
			   $sql6 = "SELECT `total_order_price`, `total_ship_charge`, `minus_ship_charge`, `additional_ship_charge` FROM `om_order_ship_charge` WHERE order_id='$order_id' and seller_id ='$id'";
			   $data['oc'] = $this->db_model->getAlldata($sql6);
			   
			   $sql4 = "SELECT c.cus_name,c.cus_email,c.cus_mobile,o.order_id FROM `customers` as c join om_orders as o on c.cus_id = o.cus_id where o.order_id='$order_id'";
			   
			   $data['c'] = $this->db_model->getAlldata($sql4);
			   
			   $sql5 = "SELECT * FROM `om_order_status` where seller_id='$id' and order_id='$order_id' order by added_date desc";
			   $data['oh'] = $this->db_model->getAlldata($sql5);
			   
			   $sql_c = "select * from om_order_bill_address where order_id='$order_id'";
			   $cd = $this->db_model->getAlldata($sql_c);
			  
			   $sql = "select * from om_order_bill_address as c ";
			   if($cd[0]->bill_country != 0)
			   {
				  $sql .= " join country as cn on c.bill_country = cn.country_id ";
			   }
			   if($cd[0]->bill_state != 0)
			   {
				  $sql .= " join state as s on c.bill_state = s.state_id ";
			   }
			   if($cd[0]->bill_city != 0)
			   {
				  $sql .= " join city as ct on c.bill_city = ct.city_id ";
			   }
			   if($cd[0]->bill_area != 0)
			   {
				  $sql .= " join area as a on c.bill_area = a.area_id ";
			   }
			   $sql .= " where c.order_id='$order_id'";
			   $data['b'] = $this->db_model->getAlldata($sql);
			   
			   
			   $sql_s = "select * from om_order_ship_address where order_id='$order_id'";
			   $cd2 = $this->db_model->getAlldata($sql_s);
			  
			   if(!empty($cd2))
			   {
				   $sql2 = "select * from om_order_ship_address as c ";
				   if($cd2[0]->ship_country != 0)
				   {
					  $sql2 .= " join country as cn on c.ship_country = cn.country_id ";
				   }
				   if($cd2[0]->ship_state != 0)
				   {
					  $sql2 .= " join state as s on c.ship_state = s.state_id ";
				   }
				   if($cd2[0]->ship_city != 0)
				   {
					  $sql2 .= " join city as ct on c.ship_city = ct.city_id ";
				   }
				   if($cd2[0]->ship_area != 0)
				   {
					  $sql2 .= " join area as a on c.ship_area = a.area_id ";
				   }
				   $sql .= " where c.order_id='$order_id'";
				   $data['s'] = $this->db_model->getAlldata($sql2);
			   }			   
			   else
			   {
				   $data['s'] = '';
			   }
			   $this->load->view('seller/invoice',$data);
		 }
		 else
		 {
			$this->load->view('seller');
		 }
	  }

	  public function filter_total_orders()
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			        $seller_id = $this->session->userdata('seller_id');
					$date_from = $this->input->post('start_date');
					$date_to = $this->input->post('end_date');
					/*$group_by = $this->input->post('group');
					$order_status = $this->input->post('order_status');
					
					if($group_by == 'Days')
					{
						$sql = "SELECT count(order_id) as total_order,SUM(product_qty) as qty,SUM(total_product_price) as total_price,DATE_FORMAT(order_item_added_date ,'%d/%m/%Y') as date_from,DATE_FORMAT(order_item_added_date,'%d/%m/%Y') as date_to FROM `om_order_item` where seller_id='$seller_id' and is_deleted='no' and is_canceled='0' and DATE(order_item_added_date) between '$date_from' and '$date_to' group by seller_id,DATE(order_item_added_date)";
					}
					if($group_by == 'Months')
					{
						$sql = "SELECT count(order_id) as total_order,SUM(product_qty) as qty,SUM(total_product_price) as total_price,DATE_FORMAT(order_item_added_date ,'%m/%Y') as date_from,DATE_FORMAT(order_item_added_date,'%m/%Y') as date_to FROM `om_order_item` where seller_id='$seller_id' and is_deleted='no' and is_canceled='0' and DATE(order_item_added_date) between '$date_from' and '$date_to' group by seller_id,MONTH(order_item_added_date)";
					}
					if($group_by == 'Years')
					{
						$sql = "SELECT count(order_id) as total_order,SUM(product_qty) as qty,SUM(total_product_price) as total_price,DATE_FORMAT(order_item_added_date ,'%Y') as date_from,DATE_FORMAT(order_item_added_date,'%Y') as date_to FROM `om_order_item` where seller_id='$seller_id' and is_deleted='no' and is_canceled='0' and DATE(order_item_added_date) between '$date_from' and '$date_to' group by seller_id,YEAR(order_item_added_date)";
					}*/
					$sql = "SELECT count(order_id) as total_order,SUM(product_qty) as qty,SUM(total_product_price) as total_price,DATE_FORMAT(order_item_added_date ,'%d/%m/%Y') as date_from,DATE_FORMAT(order_item_added_date,'%d/%m/%Y') as date_to FROM `om_order_item` where seller_id='$seller_id' and is_deleted='no' and is_canceled='0' and DATE(order_item_added_date) between '$date_from' and '$date_to' group by seller_id,DATE(order_item_added_date)";
					$order = $this->db_model->getAlldata($sql);
					
					echo '<div class="row">
					<div class="col-sm-12">
					
					  <div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
						  <thead>
							<tr>
							 <th>Date Start</th>
							 <th>Date End</th>
							 <th>No. Orders </th> 
							 <th>No. Products</th>
							 <th>Total</th>
							 
							</tr>
						  </thead>
						  <tbody>';
						   
						   if(!empty($order)){
							   
							   foreach($order as $o){ 
							
							echo '<tr>
							 <td>'.$o->date_from.'</td>
							  <td>'.$o->date_to.'</td>
							  <td>'.$o->total_order.'</td>
							  <td>'.$o->qty.'</td>
							  <td><i class="fa fa-inr"></i>'.$o->total_price.'/-</td>
							  
							</tr>';
						    } } else { 
						   echo '<tr><td colspan="5">Data not found.</td></tr>';
						 } 
							
				 echo '</tbody></table></div></div></div>';
		  }
		  else
		  {
			  echo "Session Expired";
		  }
	  }
	
	
	  public function top_selling()
	  {
		    if($this->session->userdata('sellerLogin') == TRUE)
			{
				$seller_id = $this->session->userdata('seller_id');
				$date_from = date('Y-m-01');
				$date_to = date('Y-m-d');
				
				$sql = "SELECT op.product_name_url,op.featured_image,op.product_name,op.model,SUM(oi.product_qty) as qty,SUM(oi.	total_product_price) as total FROM `om_order_item` as oi join om_product as op on oi.product_id=op.product_id where oi.seller_id='$seller_id' and oi.is_deleted='no' and oi.is_canceled='0' and DATE(oi.order_item_added_date) between '$date_from' and '$date_to' group by oi.product_id";
				$data["sell"] = $this->db_model->getAlldata($sql);
				$this->load->view('seller/top-selling',$data);
			}
			else
			{
				redirect('seller');
			}
	  }
	  
	  public function filter_top_selling()
	  {
		  if($this->session->userdata('sellerLogin') == TRUE)
		  {
			    $seller_id = $this->session->userdata('seller_id');
				$date_from = $this->input->post('start_date');
				$date_to = $this->input->post('end_date');
				
				$sql = "SELECT op.product_name_url,op.featured_image,op.product_name,op.model,SUM(oi.product_qty) as qty,SUM(oi.	total_product_price) as total FROM `om_order_item` as oi join om_product as op on oi.product_id=op.product_id where oi.seller_id='$seller_id' and oi.is_deleted='no' and oi.is_canceled='0' and DATE(oi.order_item_added_date) between '$date_from' and '$date_to' group by oi.product_id";
				$sell = $this->db_model->getAlldata($sql); 
				
				echo '<div class="row"><div class="col-sm-12"><div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
					  <thead>
						<tr>
						 <th>Image</th>
						 <th>Product Name</th> 
						 <th>Model</th>
						 <th>Quantity</th>
						 <th>Total</th>
						 </tr>
					  </thead>
					  <tbody>';
					   if(!empty($sell)){
						   
						   foreach($sell as $s){ 
						echo '<tr>
						 <td><img src="'.base_url().'includes/uploads/product_image/'.$s->featured_image.'" width="75" height="75" /></td>
						  <td><a href="'.base_url().$s->product_name_url.'" target="_blank">'.$s->product_name.'</a></td>
						  <td>'.$s->model.'</td>
						  <td>'.$s->qty.'</td>
						  <td><i class="fa fa-inr"></i>'.$s->total.'/-</td>
						  
						</tr>';
					   } } else { 
					   echo '<tr><td colspan="7">Data not found.</td></tr>';
					 } 
						
					  echo '</tbody>
					</table>
				  </div>
				  </div>
				  </div>';    
		  }
		  else
		  {
			  echo "Session Expired";
		  }
	  }
	
	
	public function ready_shipment()
	   {
		   if($this->session->userdata('sellerLogin') == TRUE)
		   {
			   $id = $this->session->userdata('seller_id');
			   $sql = "SELECT order_id,order_item_added_date as order_date,SUM(total_product_price) as total_price FROM `om_order_item` as oi join 
			   seller as s on oi.seller_id = s.seller_id where oi.seller_id='$id' 
			   and oi.is_deleted='no' group by oi.order_id,oi.seller_id ";
			   
			   $config = array();
				$config['full_tag_open'] = '<ul class="pagination pagination-large pull-right">';
				$config['full_tag_close'] = '</ul>';
				$config['prev_link'] = '<i class="fa fa-caret-left"></i>';
				$config['prev_tag_open'] = '<li>';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '<i class="fa fa-caret-right"></i>';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['use_page_numbers'] = TRUE;
				
				$config["base_url"] = base_url().'seller/ready-shipment';
				$config["uri_segment"] = 3;
				$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$config["total_rows"] = $this->db_model->check($sql);
				$per = 50;
	            $config["per_page"] = $per;
	            $page2 = 0;
			    if($page)
			    {
					$page2 = $page * $per - $per;
				}
			    $this->pagination->initialize($config);
			   
			   $sql .= " order by order_item_id desc limit $page2, $per";
			   $data['order'] = $this->db_model->getAlldata($sql);
			   $data["links"] = $this->pagination->create_links(); 
			   $this->load->view('seller/ready-shipment',$data);
		   }
		   else
		   {
			   redirect('seller');
		   }
	   }
	   
	   public function choose_color_size()
	   {
	   	 $cat_id = $this->input->post('cat_id');
	   	 $menu_id = $this->input->post('menu_id');
	   	 $sql = "select * from colour where menu_id='$menu_id' and category_id='$cat_id'";
	   	 $color = $this->db_model->getAlldata($sql);
	   	 
	   	 $sql2 = "select * from size where menu_id='$menu_id' and category_id='$cat_id'";
	   	 $size = $this->db_model->getAlldata($sql2);
	   	
		   	if(!empty($color))
		   	{
				echo '<div class="form-group">
	              <label class="col-sm-3 col-md-2 control-label">Choose Color</label>
	              <div class="col-sm-8">
	                <ul class="list-inline color-list">';
	                foreach($color as $c)
	                {
						 echo '<li><label><input style="float:left;" type="checkbox" name="product_color[]" value="'.$c->colour_id.'" /> <p style=" margin-top:6px;margin-left:5px;float:left;height:15px; width:25px;background:'.$c->colour_code.'"></p></label></li>';
						 
					}
					echo ' </ul>
	              </div>
	            </div>';
			} 
			else
			{
				echo '<input type="hidden" name="product_color[]" value="" />';
			}
		   	
		   	if(!empty($size))
		   	{
				echo '<div class="form-group">
	              <label class="col-sm-3 col-md-2 control-label">Choose Size</label>
	              <div class="col-sm-8">
	                <ul class="list-inline color-list">';
	                foreach($size as $s)
	                {
						echo '<li><input type="checkbox" name="product_size[]" value="'.$s->size_id.'" />&nbsp;'.$s->size_name.'</li>';
					}
					echo '</ul>
              </div>
            </div>';
				
			}
			else
			{
				echo '<input type="hidden" name="product_size[]" value="" />';
			}
		   	
	   }

	   public function change_password()
	   {
	   		$this->load->view('seller/change-password');
	   }

	   public function password_changed()
	   {
	   		$old = md5($this->input->post('old'));
	   		$pass = $this->input->post('pass');
			$cpass = $this->input->post('cpass');
			$id = $this->session->userdata('seller_id');
			$op = $this->db_model->getAlldata("select * from seller where seller_id='$id'");

			$oldpass = $op[0]->seller_password;

			if($pass == $cpass)
			{
				$passd = md5($pass);
				if($old == $oldpass)
				{
					$sql = "update seller set seller_password=? where seller_id=?";
					$val = array($passd,$id);
					$r = $this->db_model->iud_data($sql,$val);
					if($r)
					{
						$val = "<div class=\"alert alert-success\" role=\"alert\">Password successfully changed</div>";
						$this->session->set_flashdata('msg',$val);
						echo "<script>window.location.href='".base_url()."seller/change-password'</script>";
					}
					else
					{
						$val = "<div class=\"alert alert-danger\" role=\"alert\">Error ! please try again</div>";
						$this->session->set_flashdata('msg',$val);
						echo "<script>window.location.href='".base_url()."seller/change-password'</script>";
					}
				}
				else
				{
					$val = "<div class=\"alert alert-danger\" role=\"alert\">Please enter current old password</div>";
					$this->session->set_flashdata('msg',$val);
					echo "<script>window.location.href='".base_url()."seller/change-password'</script>";
				}
			}
			else
			{
				$val = "<div class=\"alert alert-danger\" role=\"alert\">password does not matched</div>";
				$this->session->set_flashdata('msg',$val);
				echo "<script>window.location.href='".base_url()."seller/change-password'</script>";
			}
	   }
	 
}	   