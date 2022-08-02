<?php
class Shipping extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Shipping_model','shippingmodel',true);
    }


    function delete($id)
    {
        $this->shippingmodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/shipping/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->shippingmodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/shipping/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['ship'] =$this->shippingmodel->getShippingById($id);
        $this->load->view('admin/shipping/edit-shipping',$data);
    }


    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['weight_from'] = $this->input->post('weight_from');
        $arr['weight_in'] = $this->input->post('weight_in');
        $arr['delivery_charge'] = $this->input->post('delivery_charge');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->shippingmodel->save('shipping',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','saved successfully');
        redirect('admin/shipping/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['ship'] =$this->shippingmodel->allShipping();

        $this->load->view('admin/shipping/index',$data);
    }


    function add()
    {
        $this->load->view('admin/shipping/add-shipping');
    }



}