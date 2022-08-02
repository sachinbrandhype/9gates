<?php
class Package extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Package_model','packagemodel',true);
    }


    function delete($id)
    {
        $this->packagemodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/package/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->packagemodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/package/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['package'] =$this->packagemodel->getPackageById($id);
        $this->load->view('admin/package/edit-package',$data);
    }


    function savePackage()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['package'] = $this->input->post('package');
        $arr['discount'] = $this->input->post('discount');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->packagemodel->save('package',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','package saved successfully');
        redirect('admin/package/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['package'] =$this->packagemodel->allPackage();

        $this->load->view('admin/package/index',$data);
    }


    function add()
    {
        $this->load->view('admin/package/add-package');
    }



}