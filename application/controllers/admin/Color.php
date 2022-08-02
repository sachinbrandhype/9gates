<?php
class Color extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Color_model','colormodel',true);
    }


    function delete($id)
    {
        $this->colormodel->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('admin/color/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->colormodel->update($id);
        $this->session->set_flashdata('success','Child Category updated successfully');
        redirect('admin/color/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['color'] =$this->colormodel->getColorById($id);
        $data['cat'] =$this->colormodel->getAllCategroy();
        $data['sub'] =$this->colormodel->getAllSubCategroy();
        $this->load->view('admin/color/edit-color',$data);
    }


    function saveColor()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['color'] = $this->input->post('color');
        $arr['color_code'] = $this->input->post('color_code');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->colormodel->save('color',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','Color saved successfully');
        redirect('admin/color/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['color'] =$this->colormodel->allColor();

        $this->load->view('admin/color/index',$data);
    }


    function add()
    {
        $data['cat'] =$this->colormodel->getAllCategroy();
        $data['sub'] =$this->colormodel->getAllSubCategroy();
        $this->load->view('admin/color/add-color',$data);
    }

    function subcategoryBycategory()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('category');
        if($name)
        {
            echo $this->colormodel->fetch_Subcategory($this->input->post('category'));

        }
    }


}