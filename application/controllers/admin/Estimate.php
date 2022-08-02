<?php
class Estimate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Estimate_Model','estimate_model',true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/estimate/index');
        $config['total_rows'] = $this->estimate_model->countAll();
        $config['per_page'] = 3;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['estimate'] = $this->estimate_model->getAll($config['per_page'],$offset);
        $this->load->view('admin/estimate/index',$data);
    }

    function add()
    {
        //$data['st'] =$this->estimate_model->getStateList();
        $this->load->view('admin/estimate/add-estimate');
    }

    function save()
    {
        $this->estimate_model->save();
        $this->session->set_flashdata('success','Estimate saved successfully');
        redirect('admin/estimate/index');
    }

    function edit($id)
    {
        $data['estimate'] = $this->estimate_model->getById($id);
        $this->load->view('admin/estimate/edit-estimate',$data);
    }

    function update($id)
    {
        $this->estimate_model->update($id);
        $this->session->set_flashdata('success','State updated successfully');
        redirect('admin/estimate/index');
    }

    function delete($id)
    {
        $this->estimate_model->delete($id);
        $this->session->set_flashdata('success','Estimate deleted successfully');
        redirect('admin/estimate/index');
    }

}