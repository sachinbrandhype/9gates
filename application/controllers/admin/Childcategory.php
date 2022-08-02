<?php
class Childcategory extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('ChildCategory_model','childmodel',true);
    }


    function delete($id)
    {
        $this->childmodel->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('admin/childcategory/index');
    }


    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');

        $this->childmodel->update($id);
        $this->session->set_flashdata('success','Child Category updated successfully');
        redirect('admin/childcategory/index');

    }



    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['child'] =$this->childmodel->getChildCategoryById($id);
        $data['cat'] =$this->childmodel->getAllCategroy();
        $data['sub'] =$this->childmodel->getAllSubCategroy();
        $data['menu'] =$this->childmodel->getAllMenu();
        $this->load->view('admin/childcategory/edit-childcategory',$data);
    }


    function saveChildCategory()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['menu'] = $this->input->post('menu');
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['childcategory'] = $this->input->post('childcategory');
        /*$arr['description'] = $this->input->post('description');*/
        $arr['url'] = $this->input->post('url');
        $arr['createdate'] = date("Y-m-d H:i:s");

/*
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
*/

        $this->childmodel->save('child_category',$arr);

        $id = $this->db->insert_id();

        $this->session->set_flashdata('success','Category saved successfully');
         redirect($_SERVER['HTTP_REFERER']);
        redirect('admin/childcategory/index');

    }


    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subcategory/index');
        $config['total_rows'] = $this->childmodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['sub'] =$this->childmodel->allChildcategory();

        $this->load->view('admin/childcategory/index',$data);
    }


    function add()
    {
        $data['cat'] =$this->childmodel->getAllCategroy();
        $data['menu'] =$this->childmodel->getAllMenu();
        $this->load->view('admin/childcategory/add-childcategory',$data);
    }


    function categoryBymenu()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('menu');
        if($name)
        {
            echo $this->childmodel->fetch_category($this->input->post('menu'));

        }
    }

    function subcategoryBycategory()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('category');
        if($name)
        {
            echo $this->childmodel->fetch_Subcategory($this->input->post('category'));

        }
    }
    
    function menuBycategory()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $name=$this->input->post('menu');
        if($name)
        {
            echo $this->childmodel->fetch_MenucategoryData($this->input->post('menu'));

        }
    }


}