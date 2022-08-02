<?php
class Replacement extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Replacement_model','replacementmodel',true);
    }


    function delete($id)
    {
        $this->replacementmodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/replacement/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->replacementmodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/replacement/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['rep'] =$this->replacementmodel->getReplacementById($id);
        $this->load->view('admin/replacement/edit-replacement',$data);
    }


    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['replace'] = $this->input->post('replace');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->replacementmodel->save('replacement',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success',' saved successfully');
        redirect('admin/replacement/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/replacement/index');
        $config['total_rows'] = $this->replacementmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['rep'] =$this->replacementmodel->allReplacement();

        $this->load->view('admin/replacement/index',$data);
    }


    function add()
    {
        $this->load->view('admin/replacement/add-replacement');
    }



}