<?php
class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('admin'))
            redirect('admin');
        $this->load->model('Product_Model','product_model',true);
    }


    function index($offset=0)
    {
        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/product/index');
        $config['total_rows'] = $this->product_model->countAll();
        $config['per_page'] = 3;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->product_model->getAll($config['per_page'],$offset);
        $data['all'] =$this->product_model->getAllData();
        $this->load->view('admin/product/index',$data);
    }
    function schooldata()
    {
        $name=$this->input->post('school_name');
        if($name)
        {
            echo $this->product_model->fetch_School($this->input->post('school_name'));

        }
    }
    function classdata()
    {
        $name=$this->input->post('class_name');
        if($name)
        {
            echo $this->product_model->fetch_Class($this->input->post('class_name'));

        }
    }
    function  filtergropdataname()
    {
        $name=$this->input->post('filtergroup');
        if($name)
        {
            echo $this->product_model->fetchFilterGroupDataName($this->input->post('filtergroup'));

        }
    }



    function filtergropdata()
    {
        $name=$this->input->post('subject');
        if($name)
        {
            echo $this->product_model->fetchFilterGroup($this->input->post('subject'));

        }
    }





    function addproduct()
    {


        $fltrgid=$this->product_model->getAllFilterGroupId();


        foreach($fltrgid as $flt){
            $gpid=$flt->id;


            }
        $data['fltrn'] =$this->product_model->getAllFilterGroupName($gpid);

        $data['cl'] =$this->product_model->getAllClass();
        $data['school'] =$this->product_model->getAllSchoolClass();
        $data['state'] =$this->product_model->getAllState();
        $data['lang'] =$this->product_model->getAllLanguage();
        $data['str'] =$this->product_model->getAllStreming();
        $data['fltrg'] =$this->product_model->getAllFilterGroup();


        $data['st'] =$this->product_model->getStateList();


        $this->load->view('admin/product/addproduct',$data);
    }

    function save()
    {
        $arr['school_name'] = $this->input->post('school_name');
        $arr['class_name'] = $this->input->post('class_name');
        $arr['price'] = $this->input->post('price');
        $arr['product'] = $this->input->post('product');
        $arr['product_url'] = $this->input->post('product_url');
        $arr['short_description'] = $this->input->post('short_description');
        $arr['description'] = $this->input->post('description');
        $arr['state'] = $this->input->post('state');


        /*$fileg = $this->input->post('filtergroup');
        $arr['filtergroup']=implode(",", $fileg);

        $filename = $this->input->post('subcategory');
        $arr['subcategory']=implode(",", $filename);*/




        $arr['shipping_charge'] = $this->input->post('shipping_charge');
        if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = APPPATH.'../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                $this->resize_image(APPPATH.'../uploads/'.$arr['image'],900);
                $this->createThumbnail(PPPATH.'../uploads/'.$arr['image'],APPPATH.'../uploads/thumbnail/'.$arr['image'],400,300);
                //$arr['image'] =
            }
        }

        $this->product_model->save('product',$arr);

        //$this->product_model->save('product',$arr);
        $id = $this->db->insert_id();

        /*$name=$this->input->post('name');
        $price=$this->input->post('price1');
        $i = 0;
        foreach($name as $row){
            $data['product_name'] = $name[$i];
            $data['price'] = $price[$i];
            $data['product'] = $id;
            $this->product_model->saveMulti('multipro',$data);
            $i++;
        }*/

        $filename = $this->input->post('subcategory');
        $f = 0;
        foreach($filename as $row){
            $data['productid'] = $id;
            $data['subcategory'] = $filename[$f];
            $this->product_model->saveMultiCo('multico',$data);
            $f++;
        }

        $fileg = $this->input->post('filtergroup');


        $i = 0;
        foreach($fileg as $row){
            $data['productid'] = $id;
            $data['filtergroup'] = $fileg[$i];
            $this->product_model->saveMulti('multipro',$data);
            $i++;
        }


        /*$name=$this->input->post('name');
        $price=$this->input->post('price1');

        $basic_data['product'] =$id ;
        $basic_data['product_name'] =implode(",", $name); ;
        $basic_data['price'] =implode(",",$price) ;
        $this->product_model->saveMulti('multipro',$basic_data);*/


        $this->session->set_flashdata('success','Product saved successfully');
        redirect('admin/product/index');
    }

    function edit($id)
    {
        $data['cl'] =$this->product_model->getAllClass();
        $data['school'] =$this->product_model->getAllSchoolClass();
        $data['subject'] =$this->product_model->getAllSubject();
        $data['state'] =$this->product_model->getAllState();
        $data['sbcll'] = $this->product_model->getProductById($id);
        $data['st'] =$this->product_model->getStateList();
        $this->load->view('admin/product/editproduct',$data);
    }

    function update($id)
    {
        $this->product_model->update($id);
        $this->session->set_flashdata('success','SubClass updated successfully');
        redirect('admin/product/index');
    }

    function delete($id)
    {
        $this->product_model->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('admin/product/index');
    }

    function resize_image($source,$width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;

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

}