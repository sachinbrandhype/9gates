<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
	/**
	 * This function loads the registration form
	 */
	 
	 
	 public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel','homemodel',true);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('cart');
        $this->load->library('email');
        $this->load->helper('string');      
        $this->load->helper('array');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper('text');
        
   
    }
	  
	 
	public function index()
	{
	    $userid = $this->session->userdata['userid'] ;
	    $order = $this->session->userdata['ord'];
	    $data['save'] = $this->homemodel->getOrderdata($order,$userid);
		$this->load->view('payment/index',$data);
	}
}