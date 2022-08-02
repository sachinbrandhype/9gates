<?php
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Category_Model','category', true);
    }

    function saveImport(){
        if(isset($_POST["import"]))
        {

            $filename=$_FILES["csv"]["tmp_name"];
            if($_FILES["csv"]["size"] > 0)
            {
                $file = fopen($filename, "r");
                while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
                {
                    $has_very = uniqid().''.strtotime(date("ymdhis"));
                    $createdate = date("Y-m-d H:i:s");
                    $product = $this->input->post('category');
                    $chars = array ("!", "\"", "#", "$", "%", "&", "/", "(", ")", "?", "*", "+", "-", ".", ",", ";", ":", "_", " ", "--","=","'","-" );
                    $urlValue = str_replace ( $chars, "-", $importdata[0]);
                    $product_url = strtolower(str_replace ( $chars, "-", $urlValue ));
                    $data = array(
                        'has_very' => $has_very,
                        'url' => $product_url,
                        'createdate' => $createdate,
                        'category' =>$importdata[0],
                        'image' => $importdata[1],
                        'bannerimage' =>$importdata[2]
                    );
                    $insert = $this->category->insertCSV($data);
                }
                fclose($file);
                $this->session->set_flashdata('message', 'Data are imported successfully..');
                redirect('admin/category/index');
            }else{
                $this->session->set_flashdata('message', 'Something went wrong..');
                redirect('admin/category/index');
            }
        }
    }

    function bulk()
    {
        $this->load->view('admin/category/bulk_upload');
    }

    function index($offset=0)
    {
        $data['cat'] = $this->category->getAll();
        $this->load->view('admin/category/index',$data);
    }

    function add()
    {
        $data['menu'] =$this->category->getAllMenu();
        $this->load->view('admin/category/add-category',$data);
    }

    function saveCategory()
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['menu'] = $this->input->post('menu');
        $arr['category'] = $this->input->post('category');
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

       /* if(isset($_FILES['bannerimage']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('bannerimage'))
            {
                $uploaded = $this->upload->data();
                $arr['bannerimage'] = $uploaded['file_name'];
                //$arr['image'] =
            }
        }*/



        $cat = $this->input->post('category');
        $checkCategory= $this->category->checkCategory($cat);

        if($checkCategory){

            $this->session->set_flashdata('success','Category Already Exits');
        }
        else
        {
            $this->category->save('category',$arr);

            $id = $this->db->insert_id();

            $count = count($_FILES['bannerimage']['name']);

            for($i=0;$i<$count;$i++){

                if(!empty($_FILES['bannerimage']['name'][$i])){

                    $_FILES['file']['name'] = $_FILES['bannerimage']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['bannerimage']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['bannerimage']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['bannerimage']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['bannerimage']['size'][$i];

                    //$path3 = "./uploads/product_gallery/";

                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = '5000';
                    $config['file_name'] = $_FILES['bannerimage']['name'][$i];

                    $this->load->library('upload',$config);

                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $sql2 = "insert into bannerimage(category,image) values(?,?)";
                        $values2 = array($id,$filename);
                        $this->category->iud_data($sql2,$values2);
                    }
                }

            }


            $this->session->set_flashdata('success','Category saved successfully');
        }
            redirect('admin/category/index');

        }

        function edit($id)
        {

            $data['cat'] = $this->category->getById($id);
            $data['menu'] =$this->category->getAllMenu();
            $this->load->view('admin/category/edit-category',$data);
        }

        function update($id)
        {
            $this->category->update($id);
            
            $id = $this->input->post('id');
            $count = count($_FILES['bannerimage']['name']);

            for($i=0;$i<$count;$i++){

                if(!empty($_FILES['bannerimage']['name'][$i])){

                    $_FILES['file']['name'] = $_FILES['bannerimage']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['bannerimage']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['bannerimage']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['bannerimage']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['bannerimage']['size'][$i];

                    //$path3 = "./uploads/product_gallery/";

                    $config['upload_path'] = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = '5000';
                    $config['file_name'] = $_FILES['bannerimage']['name'][$i];

                    $this->load->library('upload',$config);

                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $sql2 = "insert into bannerimage(category,image) values(?,?)";
                        $values2 = array($id,$filename);
                        $this->category->iud_data($sql2,$values2);
                    }
                }

            }
            
            
            $this->session->set_flashdata('success','Category updated successfully');
            redirect('admin/category/index');
        }

        function delete($id)
        {
            $this->category->delete($id);
            $this->session->set_flashdata('success','Category deleted successfully');
            redirect('admin/category/index');
        }

    }