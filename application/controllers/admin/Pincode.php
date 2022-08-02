<?php
class Pincode extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Pincode_model','pincodemodel',true);
    }


    function delete($id)
    {
        $this->pincodemodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/pincode/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->pincodemodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/pincode/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['pin'] =$this->pincodemodel->getPackageById($id);
        $this->load->view('admin/pincode/edit-pincode',$data);
    }


    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['pincode'] = $this->input->post('pincode');
        $arr['delivery_charge'] = $this->input->post('delivery_charge');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->pincodemodel->save('pincode',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','saved successfully');
        redirect('admin/pincode/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['pin'] =$this->pincodemodel->allPincode();

        $this->load->view('admin/pincode/index',$data);
    }


    function add()
    {
        $this->load->view('admin/pincode/add-pincode');
    }



}