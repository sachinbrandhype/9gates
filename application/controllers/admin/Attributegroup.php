<?php
class Attributegroup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Attributegroup_model','attributegroupmodel',true);
    }


    function delete($id)
    {
        $this->attributegroupmodel->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('admin/attributegroup/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->attributegroupmodel->update($id);
        $this->session->set_flashdata('success','Child Category updated successfully');
        redirect('admin/attributegroup/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['attrgroup'] =$this->attributegroupmodel->getAttributeGroupById($id);
        $data['cat'] =$this->attributegroupmodel->getAllCategroy();
        $data['sub'] =$this->attributegroupmodel->getAllSubCategroy();
        $this->load->view('admin/attributegroup/edit-attributegroup',$data);
    }


    function saveAttributegroup()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['attributegroup'] = $this->input->post('attributegroup');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->attributegroupmodel->save('attribute_group',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','Attributegroup saved successfully');
        redirect('admin/attributegroup/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subcategory/index');
        $config['total_rows'] = $this->attributegroupmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['attrgroup'] =$this->attributegroupmodel->allAttributegroup();

        $this->load->view('admin/attributegroup/index',$data);
    }


    function add()
    {
        $data['cat'] =$this->attributegroupmodel->getAllCategroy();
        $this->load->view('admin/attributegroup/add-attributegroup',$data);
    }

    function subcategoryBycategory()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('category');
        if($name)
        {
            echo $this->attributegroupmodel->fetch_Subcategory($this->input->post('category'));

        }
    }


}