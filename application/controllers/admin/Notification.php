<?php
class Notification extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Noti_model','notimodel',true);
    }



    function sendnoti($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
            
        $arr['appid'] = $id;    
         $arr['name'] = $this->input->post('name');
        $arr['message'] = $this->input->post('message');
        $this->notimodel->save('notification',$arr);
          
       /* $this->notimodel->SendNoti($id);*/
        redirect('admin/notification/index');

    }



    function send($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['noti'] =$this->notimodel->getNotiIdById($id);
       
        $this->load->view('admin/notification/send',$data);
    }



    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subcategory/index');
        $config['total_rows'] = $this->notimodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['noti'] =$this->notimodel->allNoti();

        $this->load->view('admin/notification/index',$data);
    }

/*
    function add()
    {
        $data['cat'] =$this->childmodel->getAllCategroy();
        $data['menu'] =$this->childmodel->getAllMenu();
        $this->load->view('admin/childcategory/add-childcategory',$data);
    }*/


}