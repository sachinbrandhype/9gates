<?php
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		/*if($this->session->userdata('admin'))
			redirect('admin/dashboard');*/
        $this->load->model('Admin','admin_model', true);
	}
	function index()
	{
		$this->load->view('admin/login');
	}

    function dashboard()
    {
        $this->load->view('admin/index');
    }

    public function check_login(){

        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $res=$this->admin_model->islogin();
        if($res){
            $this->session->set_userdata('id',$data['username']);
            echo base_url()."admin/login/dashboard";
        }
        else{
            echo 0;
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        header('location:'.base_url()."admin/login/index");

    }


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
}