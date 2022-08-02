<?php
class Size extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Size_model','sizemodel',true);
    }


    function delete($id)
    {
        $this->sizemodel->delete($id);
        $this->session->set_flashdata('success','size deleted successfully');
        redirect('admin/size/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->sizemodel->update($id);
        $this->session->set_flashdata('success','Child Category updated successfully');
        redirect('admin/size/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['size'] =$this->sizemodel->getSizeById($id);
        $data['cat'] =$this->sizemodel->getAllCategroy();
        $data['sub'] =$this->sizemodel->getAllSubCategroy();
        $this->load->view('admin/size/edit-size',$data);
    }


    function saveColor()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['size'] = $this->input->post('size');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->sizemodel->save('size',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','size saved successfully');
        redirect('admin/size/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['size'] =$this->sizemodel->allSize();

        $this->load->view('admin/size/index',$data);
    }


    function add()
    {
        $data['cat'] =$this->sizemodel->getAllCategroy();
        $data['sub'] =$this->sizemodel->getAllSubCategroy();
        $this->load->view('admin/size/add-size',$data);
    }

    function subcategoryBycategory()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('category');
        if($name)
        {
            echo $this->sizemodel->fetch_Subcategory($this->input->post('category'));

        }
    }


}