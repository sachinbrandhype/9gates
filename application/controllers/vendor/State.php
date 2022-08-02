<?php
class State extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('State_Model','state_model',true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/state/index');
        $config['total_rows'] = $this->state_model->countAll();
        $config['per_page'] = 3;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['state'] = $this->state_model->getAll($config['per_page'],$offset);
        $this->load->view('admin/state/index',$data);
    }

    function addstate()
    {
        $data['st'] =$this->state_model->getStateList();
        $this->load->view('admin/state/addstate',$data);
    }

    function save()
    {
        $this->state_model->save();
        $this->session->set_flashdata('success','State saved successfully');
        redirect('admin/state/index');
    }

    function edit($id)
    {
        $data['st'] = $this->state_model->getById($id);
        $data['state'] =$this->state_model->getStateList();
        $this->load->view('admin/state/editstate',$data);
    }

    function update($id)
    {
        $this->state_model->update($id);
        $this->session->set_flashdata('success','State updated successfully');
        redirect('admin/state/index');
    }

    function delete($id)
    {
        $this->state_model->delete($id);
        $this->session->set_flashdata('success','State deleted successfully');
        redirect('admin/state/index');
    }

}