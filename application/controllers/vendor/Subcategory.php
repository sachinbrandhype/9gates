<?php
class Subcategory extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Subcategory_model','submodel',true);
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
                    $subcategory= $this->input->post('subcategory');
                    $chars = array ("!", "\"", "#", "$", "%", "&", "/", "(", ")", "?", "*", "+", "-", ".", ",", ";", ":", "_", " ", "--","=","'","-" );
                    $subcategory = str_replace ( $chars, "-", $importdata[1]);
                    $subcategory = strtolower(str_replace ( $chars, "-", $importdata[1] ));
                    $data = array(
                        'has_very' => $has_very,
                        'url' => $subcategory,
                        'createdate' => $createdate,
                        'category' =>$importdata[0],
                        'subcategory' =>$importdata[1],
                        'description' => $importdata[2],
                        'image' => $importdata[3],
                        'bannerimage' => $importdata[4]

                    );
                    $insert = $this->submodel->insertCSV($data);
                }
                fclose($file);
                $this->session->set_flashdata('message', 'Data are imported successfully..');
                redirect('admin/subcategory/index');
            }else{
                $this->session->set_flashdata('message', 'Something went wrong..');
                redirect('admin/subcategory/index');
            }
        }
    }

    function bulk()
    {
        $this->load->view('admin/subcategory/bulk_upload');
    }
    function delete($id)
    {
        $this->submodel->delete($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('admin/subcategory/index');
    }


    function update($id)
    {


        $this->submodel->update($id);
        $this->session->set_flashdata('success','sub Category updated successfully');
        redirect('admin/subcategory/index');

    }



    function edit($id)
    {

        $data['subcat'] =$this->submodel->getSubcatewryDataById($id);
        $data['cat'] =$this->submodel->getAllCategroy();
        $data['menu'] =$this->submodel->getAllMenu();
        $this->load->view('admin/subcategory/edit-subcategory',$data);
    }


    function saveSubCategory()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['menu'] = $this->input->post('menu');
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
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
        /*if(isset($_FILES['bannerimage']['name']))
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

        $this->submodel->save('subcategory',$arr);

        $id = $this->db->insert_id();

/*        $count = count($_FILES['bannerimage']['name']);

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
                    $sql2 = "insert into bannerimage(subcategory,image) values(?,?)";
                    $values2 = array($id,$filename);
                    $this->submodel->iud_data($sql2,$values2);
                }
            }

        }*/


        $this->session->set_flashdata('success','Category saved successfully');
        redirect('admin/subcategory/index');

    }


    function index($offset=0)
    {

        $this->load->library('pagination');
        $config['base_url'] = site_url('admin/subcategory/index');
        $config['total_rows'] = $this->submodel->countAll();
        $config['per_page'] = 10;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['sub'] =$this->submodel->allSubcategory();

        $this->load->view('admin/subcategory/index',$data);
    }


    function add()
    {
        $data['cat'] =$this->submodel->getAllCategroy();
         $data['menu'] =$this->submodel->getAllMenu();
        $this->load->view('admin/subcategory/add-subcategory',$data);
    }
    
     function categorybymenu()
      {

        $name=$this->input->post('menu');
        if($name)
        {
            echo $this->submodel->fetch_CategoryByMenu($this->input->post('menu'));

        }
    }


}