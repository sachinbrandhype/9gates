<?php
class Attributevariant extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Attributevariant_model','attributevariantmodel',true);
    }


    function delete($id)
    {
        $this->attributevariantmodel->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('admin/attributevariant/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->attributevariantmodel->update($id);
        $this->session->set_flashdata('success','Attribute variant updated successfully');
        redirect('admin/attributevariant/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['attrvariant'] =$this->attributevariantmodel->getAttributeVariantById($id);
        $data['attrgroup'] =$this->attributevariantmodel->getAllAttributeGroup();
        $this->load->view('admin/attributevariant/edit-attributevariant',$data);
    }


    function saveAttributevariant()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['attributevariant'] = $this->input->post('attributevariant');
        $arr['attributegroup'] = $this->input->post('attributegroup');
        $arr['createdate'] = date("Y-m-d H:i:s");

        $this->attributevariantmodel->save('attribute_variant',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','Attributevariant saved successfully');
        redirect('admin/attributevariant/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subcategory/index');
        $config['total_rows'] = $this->attributevariantmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['attrvariant'] =$this->attributevariantmodel->allAttributeVariant();

        $this->load->view('admin/attributevariant/index',$data);
    }


    function add()
    {
        $data['attrgroup'] =$this->attributevariantmodel->getAllAttributeGroup();
        $this->load->view('admin/attributevariant/add-attributevariant',$data);
    }




}