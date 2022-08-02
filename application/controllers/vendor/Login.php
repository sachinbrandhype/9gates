<?php
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		/*if($this->session->userdata('admin'))
			redirect('admin/dashboard');*/
        $this->load->model('Vendor','vendor_model', true);
	}
	function index()
	{
        $sql = "select * from states";
        $data['s'] = $this->vendor_model->getAlldata($sql);
		$this->load->view('vendor/login',$data);
	}

    function profile()
    {

        $this->load->view('vendor/profile');
    }

    function landing()
    {

        $this->load->view('vendor/index');
    }

    function business()
    {

        $this->load->view('vendor/business-bank-details');
    }


    public function list_search1()
    {
        $id = $this->input->post('term');
        $sql="select * from city where state='$id'";
        $r =$this->vendor_model->getAlldata($sql);
        echo "$r";
        echo '<option>Select City</option>';
        foreach($r as $i=>$v)
        {
            echo '<option value='.$v->id.'>'.$v->city.'</option>';
        }
    }

    public function list_search2()
    {
        $id=$this->input->post('term');
        $sql="select * from area where city='$id' order by id asc";
        $r =$this->vendor_model->getAlldata($sql);
        echo '<option>Select Area</option>';
        foreach($r as $i=>$v)
        {
            echo '<option value='.$v->id.'>'.$v->area.'</option>';
        }
    }

//    function dashboard()
//    {
//        $this->load->view('vendor/index');
//    }

    public function check_login(){

        $data['username'] = $this->input->post('username');
        /*$data['password'] = md5($this->input->post('password'));*/

        $res = $this->vendor_model->islogin();

        if($res){
            $this->session->set_userdata('vid',$data['username']);
            echo base_url()."vendor/login/landing";
        }
        else{
            echo 0;
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

        $sql3 = "select * from seller where seller_email='$email'";
        $r = $this->vendor_model->getAlldata($sql3);
        if(empty($r))
        {
            if($password == $cpassword)
            {
                $pass = md5($password);
                $sql = "insert into seller (seller_name,seller_business,seller_phone,seller_email,seller_password,state,city,area) values(?,?,?,?,?,?,?,?)";
                $val1 = array($name,$store,$phone,$email,$pass,$state,$city,$area);
                $seller_id = $this->vendor_model->iud_data_id($sql,$val1);
                $url = $store_url.'-'.$seller_id;
                $sql2 = "update seller set seller_url=? where seller_id=?";
                $val2 = array($url,$seller_id);
                $this->vendor_model->iud_data($sql2,$val2);

                $val = "<div class=\"alert alert-success\" role=\"alert\">Registration successfully. Please login with your username and password</div>";
                $this->session->set_flashdata('msg1',$val);
                echo "<script>window.location.href='".base_url()."vendor/'</script>";
            }
            else
            {
                $val = "<div class=\"alert alert-danger\" role=\"alert\">Password not matched.</div>";
                $this->session->set_flashdata('msg1',$val);
                echo "<script>window.location.href='".base_url()."vendor/'</script>";
            }
        }
        else
        {
            $val = "<div class=\"alert alert-danger\" role=\"alert\">Email allready registered with us.</div>";
            $this->session->set_flashdata('msg1',$val);
            echo "<script>window.location.href='".base_url()."vendor/'</script>";
        }

    }


    public function login()
    {

        $user = $this->input->post('email');

        $pass = md5($this->input->post('password'));
        $sql = "select * from seller where seller_email='$user'";
        $r = $this->vendor_model->getAlldata($sql);

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
                $this->vendor_model->iud_data($sql12,$values2);

                $sql2 = "SELECT * FROM `seller_document` where seller_id='$seller_id'";
                $sell_doc = $this->vendor_model->getAlldata($sql2);


                if(empty($sell_doc))
                {

                    redirect('vendor/login/profile');
                }
                else
                {
                    $sql3 = "SELECT * FROM `seller_bank_details` where seller_id='$seller_id'";
                    $sell_bank = $this->vendor_model->getAlldata($sql3);
                    if(empty($sell_bank))
                    {

                        redirect('vendor/login/business');
                    }
                    else
                    {
                        echo "<script>window.location.href='".base_url()."vendor/login/landing'</script>";
                    }

                }


            }
            else
            {
                $val = "<span class='text-danger' style='margin-right:135px;'>Invalid Username or Password.</span>";
                $this->session->set_flashdata('msg2', $val);

                echo "<script>window.location.href='".base_url()."vendor/login/'</script>";
            }

        }
        else
        {
            $val = "<span class='text-danger' style='margin-right:135px;'>Invalid Username or Password.</span>";
            $this->session->set_flashdata('msg2', $val);

            echo "<script>window.location.href='".base_url()."vendor/login/'</script>";
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

            $config["total_rows"] = $this->vendor_model->check($sql);
            $per = 12;
            $config["per_page"] = $per;
            $page2 = 0;
            if($page)
            {
                $page2 = $page * $per - $per;
            }
            $this->pagination->initialize($config);

            $sql .= " order by com_paid_date desc limit $page2, $per";
            $data['order'] = $this->vendor_model->getAlldata($sql);
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
            $sell_doc = $this->vendor_model->getAlldata($sql2);
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
                        $pan_doc = $this->upload_image('./uploads/','pan_file','jpg|png|jpeg','100000');
                        if($pan_doc)
                        {
                            $pan_path = 'uploads/'.$pan_doc;
                        }
                        else
                        {
                            $pan_path = '';
                        }
                    }

                    if($_FILES['tin_file']['name']!='')
                    {
                        $tin_doc = $this->upload_image('./uploads/','tin_file','jpg|png|jpeg','100000');
                        if($tin_doc)
                        {
                            $tin_path = 'uploads/'.$tin_doc;
                        }
                        else
                        {
                            $tin_path = '';
                        }
                    }

                    if($_FILES['tan_file']['name']!='')
                    {
                        $tan_doc = $this->upload_image('./uploads/','tan_file','jpg|png|jpeg','100000');
                        if($tan_doc)
                        {
                            $tan_path = 'uploads/'.$tan_doc;
                        }
                        else
                        {
                            $tan_path = '';
                        }
                    }

                    if($_FILES['address_file']['name']!='')
                    {
                        $address_doc = $this->upload_image('./uploads/','address_file','jpg|png|jpeg','100000');
                        if($address_doc)
                        {
                            $address_path = 'uploads/'.$address_doc;
                        }
                        else
                        {
                            $address_path = '';
                        }
                    }

                    if($_FILES['id_file']['name']!='')
                    {
                        $id_doc = $this->upload_image('./uploads/','id_file','jpg|png|jpeg','100000');
                        if($id_doc)
                        {
                            $id_path = 'uploads/'.$id_doc;
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
                    $this->vendor_model->iud_data($sql,$val);
                    echo "<script>window.location.href='".base_url()."vendor/login/business'</script>";


                }
                else
                {
                    $this->load->view('vendor/login/profile');
                }

            }
            else
            {
                redirect('vendor/login/business');
            }
        }
        else
        {
            redirect('vendor/login/');
        }
    }

    public function business_bank_details()
    {
        if($this->session->userdata('sellerLogin') == TRUE && $this->session->userdata('seller_status') == 0)
        {
            $seller_id = $this->session->userdata('seller_id');
            $sql2 = "SELECT * FROM `seller_document` where 	seller_id='$seller_id'";
            $sell_doc = $this->vendor_model->getAlldata($sql2);

            if(empty($sell_doc))
            {
                redirect('vendor/login/profile');
            }
            else
            {
                $sql3 = "SELECT * FROM `seller_bank_details` where 	seller_id='$seller_id'";
                $sell_bank = $this->vendor_model->getAlldata($sql3);
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
                            $cheque_doc = $this->upload_image('./uploads/','cheque_file','jpg|png|jpeg','100000');
                            if($cheque_doc)
                            {
                                $cheque_path = 'uploads/'.$cheque_doc;
                            }
                            else
                            {
                                $cheque_path = '';
                            }
                        }

                        $sql = "INSERT INTO `seller_bank_details`(`seller_id`, `ac_name`, `ac_number`, `ac_type`,
								`bank_name`, `bank_branch_name`, `bank_ifsc`, `bank_cheque`, `memorandum`) VALUES (?,?,?,?,?,?,?,?,?)";
                        $val = array($seller_id,$ac_name,$ac_no,$ac_type,$bank_name,$bank_branch,$ifsc_code,$cheque_path,'yes');

                        $res = $this->vendor_model->iud_data($sql,$val);

                        if($res)
                        {

                            redirect('vendor/login/landing');
                        }

                    }
                    else
                    {
                        $this->load->view('vendor/login/business');
                    }
                }
                else
                {
                    $this->load->view('vendor/login/landing');
                }
            }
        }
        else
        {
            redirect('vendor/login/');
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
            $data['order'] = $this->vendor_model->getAlldata($sql);
            $sql2 = "SELECT * FROM `om_return` as r join om_order_item as o on r.order_item_id = o.order_item_id WHERE r.seller_id='$id'";
            $data['return'] = $this->vendor_model->getAlldata($sql2);
            $this->load->view('vendor/index',$data);
        }
        else
        {
            echo "<script>window.location.href='".base_url()."vendor/login/'</script>";
        }
    }

    public function logout()
    {
        $sql2 = "update seller set seller_on_off=? where seller_id=?";
        $user_id = $this->session->userdata('seller_id');
        $values2 = array(0,$user_id);
        $this->vendor_model->iud_data($sql2,$values2);
        $this->session->unset_userdata('seller_id');
        $this->session->unset_userdata('seller_name');
        $this->session->unset_userdata('seller_business');
        $this->session->unset_userdata('seller_email');
        $this->session->unset_userdata('seller_phone');
        $this->session->unset_userdata('seller_status');
        $this->session->unset_userdata('sellerLogin');
        $val = "<span class='text-danger' style='margin-right:135px;'>Logout successfully.</span>";
        $this->session->set_flashdata('msg2',$val);
        echo "<script>window.location.href='".base_url()."vendor/login/'</script>";
    }



//    public function logout(){
//        $this->session->sess_destroy();
//        header('location:'.base_url()."vendor/login/index");
//    }


	/*function verify()
	{
		//username:admin password:123456
		$this->load->model('admin');
		$check = $this->admin->validate();
		if($check)
		{
			$this->session->set_userdata('admin','1');
			redirect('admin/dashboard');
		}
		else
		{
			redirect('admin');
		}
	}*/


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
}