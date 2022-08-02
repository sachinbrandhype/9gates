<?php
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Usermodel','usermodel',true);
    }


    function delete($id)
    {
        $this->usermodel->delete($id);
        $this->session->set_flashdata('success','deleted successfully');
        redirect('admin/user/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->usermodel->update($id);
        $this->session->set_flashdata('success','updated successfully');
        redirect('admin/user/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['user'] =$this->usermodel->getUserById($id);
        $this->load->view('admin/user/edit-user',$data);
    }


    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['username'] = $this->input->post('username');
        $arr['password'] = md5($this->input->post('password'));
        $arr['name'] = $this->input->post('name');
        $arr['email'] = $this->input->post('email');
        $arr['mobile'] = $this->input->post('mobile');
        $arr['address'] = $this->input->post('address');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->usermodel->save('admin',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','saved successfully');
        redirect('admin/user/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['user'] =$this->usermodel->allUser();

        $this->load->view('admin/user/index',$data);
    }


    function add()
    {
        $this->load->view('admin/user/add-user');
    }



}