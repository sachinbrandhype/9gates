<?php
class Classes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('Classes_Model','classes_model',true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/classes/index');
        $config['total_rows'] = $this->classes_model->countAll();
        $config['per_page'] = 3;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->classes_model->getAll($config['per_page'],$offset);
        $data['all'] =$this->classes_model->getAllData();
        $this->load->view('admin/classes/index',$data);
    }

    function addclass()
    {
        $data['cl'] =$this->classes_model->getAllClass();
        $this->load->view('admin/classes/addclass',$data);
    }

    function save()
    {
        $this->classes_model->save();
        $this->session->set_flashdata('success','Class saved successfully');
        redirect('admin/classes/index');
    }

    function edit($id)
    {

        $data['sbcll'] = $this->classes_model->getById($id);
        $data['cl'] =$this->classes_model->getAllClass();
        $this->load->view('admin/classes/editclass',$data);
    }

    function update($id)
    {
        $this->classes_model->update($id);
        $this->session->set_flashdata('success','Class updated successfully');
        redirect('admin/classes/index');
    }

    function delete($id)
    {
        $this->classes_model->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        rredirect('admin/classes/index');
    }

}