<?php
class Brand extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('Brand_model','brandmodel',true);
    }


    function delete($id)
    {
        $this->brandmodel->delete($id);
        $this->session->set_flashdata('success','Brand deleted successfully');
        redirect('admin/brand/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->brandmodel->update($id);
        $this->session->set_flashdata('success','Brand updated successfully');
        redirect('admin/brand/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['brand'] =$this->brandmodel->getBrandDataById($id);
        $this->load->view('admin/brand/edit-brand',$data);
    }


    function saveBrand()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['name'] = $this->input->post('brand');
        $arr['description'] = $this->input->post('description');
        $arr['url'] = $this->input->post('url');
        $arr['createdate'] = date("Y-m-d H:i:s");


        if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                //$arr['image'] =
            }
        }
        $this->brandmodel->save('brand',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','Brand saved successfully');
        redirect('admin/brand/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subcategory/index');
        $config['total_rows'] = $this->brandmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['brand'] =$this->brandmodel->allbrand();

        $this->load->view('admin/brand/index',$data);
    }


    function add()
    {
        //$data['cat'] =$this->brandmodel->getAllBrand();
        $this->load->view('admin/brand/add-brand');
    }



}