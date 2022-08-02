<?php
class Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('OrderModel','order_model', true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/order/index');
        $config['total_rows'] = $this->order_model->countAll();
        $config['per_page'] = 3;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->order_model->getAll($config['per_page'],$offset);
        $data['order'] =$this->order_model->getAllOrder();
        $this->load->view('admin/order/index',$data);
    }


    function invoice($id)
    {
        $data['invoice'] = $this->order_model->getInvoiceDataById($id);
        $state = $data['invoice']->product_state;
        
        if(!empty($state)){
        $data['vendor'] = $this->order_model->getVendorGstDetail($state);
        }
        else
        {
            
        }
        $this->load->view('admin/order/invoice',$data);
    }



}