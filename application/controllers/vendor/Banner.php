<?php
class Banner extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->load->model('banner_model','banner', true);
    }
    function index($offset=0)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['banner'] = $this->banner->getAll();
        $this->load->view('admin/banner/index',$data);
    }

    function bannerslider()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['slider'] = $this->banner->bannerslider();
        $this->load->view('admin/banner/banner',$data);
    }



    function add()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['cat'] =$this->banner->getAllCategory();
        $data['gates'] =$this->banner->getAllGates();
        $data['sub'] =$this->banner->getAllSubcategory();
        $data['child'] =$this->banner->getAllChildcategory();
        $this->load->view('admin/banner/add-banner',$data);
    }
    
    function menuBycategory()
    {
        $name=$this->input->post('menu');
        if($name)
        {
            echo $this->banner->fetch_MenuBycategory($this->input->post('menu'));

        }
    }

    function subcategoryBycategory()
    {
        $name=$this->input->post('category');
        if($name)
        {
            echo $this->banner->fetch_Subcategory($this->input->post('category'));

        }
    }

    function subcategoryBychildcategory()
    {
        $name=$this->input->post('subcategory');
        if($name)
        {
            echo $this->banner->fetch_Childcategory($this->input->post('subcategory'));

        }
    }
    function save()
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['childcategory'] = $this->input->post('childcategory');
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
                $arr['image'] = $uploaded['file_name'];/*
                $this->resize_image(APPPATH.'../uploads/'.$arr['image'],900);
                $this->createThumbnail(PPPATH.'../uploads/'.$arr['image'],APPPATH.'../uploads/thumbnail/'.$arr['image'],400,300);*/
                //$arr['image'] =
            }
        }

        $this->banner->save('banner',$arr);

        $this->session->set_flashdata('success','banner saved successfully');
        redirect('admin/banner/index');

    }
    function resize_image($source,$width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width'] =  $width;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    function createThumbnail($source,$destination,$width,$height)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = FALSE;
        $config['width']         = $width;
        $config['height'] = $height;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    function edit($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['banner'] = $this->banner->getById($id);
        $data['cat'] =$this->banner->getAllCategory();
        $data['sub'] =$this->banner->getAllSubcategory();
        $data['gates'] =$this->banner->getAllGates();
        $data['child'] =$this->banner->getAllChildcategory();
        $this->load->view('admin/banner/edit-banner',$data);
    }

    function editbanner($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $data['slider'] = $this->banner->getBannerSliderById($id);
        $data['gates'] =$this->banner->getAllGates();
        $this->load->view('admin/banner/slider-banner',$data);
    }

    function updatebanner($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->banner->updateBanner($id);
        $this->session->set_flashdata('success','banner updated successfully');
        redirect('admin/banner/bannerslider');
    }

    function update($id)
    {
        if(!$this->session->userdata('id'))
            redirect('admin');
        $this->banner->update($id);
        $this->session->set_flashdata('success','banner updated successfully');
        redirect('admin/banner/index');
    }

    function delete($id)
    {
        $this->banner->delete($id);
        $this->session->set_flashdata('success','banner deleted successfully');
        redirect('admin/banner/index');
    }

    function deletebanner($id)
    {
        $this->banner->deleteBanner($id);
        $this->session->set_flashdata('success','banner deleted successfully');
        redirect('admin/banner/bannerslider');
    }

}