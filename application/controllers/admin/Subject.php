<?php
class Subject extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('Subject_Model','subject_model',true);
    }
    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subject/index');
        $config['total_rows'] = $this->subject_model->countAll();
        $config['per_page'] = 3;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->subject_model->getAll($config['per_page'],$offset);
        $data['all'] =$this->subject_model->getAllData();
        $this->load->view('admin/subject/index',$data);
    }
    function schooldata()
    {
        $name=$this->input->post('school_name');
        if($name)
        {
            echo $this->subject_model->fetch_School($this->input->post('school_name'));

        }
    }
    function addsubject()
    {
        $data['cl'] =$this->subject_model->getAllClass();
        $data['scl'] =$this->subject_model->getAllSchool();
        $this->load->view('admin/subject/addsubject',$data);
    }

    function save()
    {
        $this->subject_model->save();
        $this->session->set_flashdata('success','Subject saved successfully');
        redirect('admin/subject/index');
    }

    function edit($id)
    {

        $data['sub'] = $this->subject_model->getSubjectById($id);
        $data['cl'] =$this->subject_model->getAllClass();
        $data['cls'] =$this->subject_model->getAllClassSchool();
        $this->load->view('admin/subject/editsubject',$data);
    }

    function update($id)
    {
        $this->subject_model->update($id);
        $this->session->set_flashdata('success','Subject updated successfully');
        redirect('admin/subject/index');
    }

    function delete($id)
    {
        $this->subject_model->delete($id);
        $this->session->set_flashdata('success','Subject deleted successfully');
        rredirect('admin/subject/index');
    }

}