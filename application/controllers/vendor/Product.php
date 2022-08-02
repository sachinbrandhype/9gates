<?php
class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('seller_id'))
            redirect('vendor');
        $this->load->model('Product_Model','product_model',true);
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
                    $product = $this->input->post('product');
                    $chars = array ("!", "\"", "#", "$", "%", "&", "/", "(", ")", "?", "*", "+", "-", ".", ",", ";", ":", "_", " ", "--","=","'","-" );
                    $urlValue = str_replace ( $chars, "-", $importdata[3]);
                    $product_url = strtolower(str_replace ( $chars, "-", $urlValue ));
                    $data = array(
                        'has_very' => $has_very,
                        'product_url' =>$product_url,
                        'category' =>$importdata[0],
                        'subcategory' => $importdata[1],
                        'childcategory' =>$importdata[2],
                        'product' =>$importdata[3],
                        'sku' =>$importdata[4],
                        'hsnno' =>$importdata[5],
                        'color' =>$importdata[6],
                        'attributegroup' =>$importdata[7],
                        'size' =>$importdata[8],
                        'retail' =>$importdata[9],
                        'mrp' =>$importdata[10],
                        'stock' =>$importdata[11],
                        'minqty' =>$importdata[12],
                        'maxqty' =>$importdata[13],
                        'meta_title' =>$importdata[14],
                        'meta_description' =>$importdata[15],
                        'meta_tag' =>$importdata[16],
                        'brand' =>$importdata[17],
                        'replacement' =>$importdata[18],
                        'description' =>$importdata[19],
                        'fimage' =>$importdata[20],
                        'estimate' =>$importdata[21],
                        'short_description' =>$importdata[22]
                    );
                    $insert = $this->product_model->insertCSV($data);
                }
                fclose($file);
                $this->session->set_flashdata('message', 'Data are imported successfully..');
                redirect('vendor/product/index');
            }else{
                $this->session->set_flashdata('message', 'Something went wrong..');
                redirect('vendor/product/index');
            }
        }
    }
    function bulk()
    {
        $this->load->view('vendor/product/bulk_upload');
    }
    function index($offset=0)
    {
        $id = $this->session->userdata('seller_id');
        $this->load->library('pagination');
        $config['base_url'] = site_url('vendor/product/index');
        $config['total_rows'] = $this->product_model->countAll();
        $config['per_page'] = 50;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['cl'] = $this->product_model->getAll($config['per_page'],$offset);
        $data['all'] =$this->product_model->getAllVendorData($id);
        $this->load->view('vendor/product/index',$data);
    }
    function subcategoryBycategory()
    {
        $name=$this->input->post('category');
        if($name)
        {
            echo $this->product_model->fetch_Subcategory($this->input->post('category'));

        }
    }

    function subcategoryBychildcategory()
    {
        $name=$this->input->post('subcategory');
        if($name)
        {
            echo $this->product_model->fetch_Childcategory($this->input->post('subcategory'));

        }
    }

    function subcategoryBycolor()
    {
        $name=$this->input->post('subcategory');
        if($name)
        {
            echo $this->product_model->fetch_Color($this->input->post('subcategory'));

        }
    }

    function subcategoryBysize()
    {
        $name=$this->input->post('subcategory');
        if($name)
        {
            echo $this->product_model->fetch_Size($this->input->post('subcategory'));

        }
    }








    function subcategoryByattributegroup()
    {
        $name=$this->input->post('subcategory');
        if($name)
        {
            echo $this->product_model->fetch_AttributeGroup($this->input->post('subcategory'));

        }
    }

    function add()
    {

        $data['cat'] =$this->product_model->getAllCategory();
        $data['sub'] =$this->product_model->getAllSubcategory();
        $data['replace'] =$this->product_model->getAllReplacement();
        $data['child'] =$this->product_model->getAllChildcategory();
        $data['brand'] =$this->product_model->getAllbrand();
        $data['estimate'] =$this->product_model->getAllestimate();
        $this->load->view('vendor/product/add-product',$data);
    }

    function save()
    {
        $arr['seller_id'] = $this->session->userdata('seller_id');
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['childcategory'] = $this->input->post('childcategory');
        $arr['product'] = $this->input->post('product');
        $arr['sku'] = $this->input->post('sku');
        $arr['hsnno'] = $this->input->post('hsnno');
        $arr['color'] = $this->input->post('color');
        $arr['attributegroup'] = $this->input->post('attributegroup');
        $arr['size'] = $this->input->post('size');
        $arr['retail'] = $this->input->post('retail');
        $arr['mrp'] = $this->input->post('mrp');
        $arr['stock'] = $this->input->post('stock');
        $arr['minqty'] = $this->input->post('minqty');
        $arr['maxqty'] = $this->input->post('maxqty');
        $arr['meta_title'] = $this->input->post('meta_title');
        $arr['meta_description'] = $this->input->post('meta_description');
        $arr['meta_tag'] = $this->input->post('meta_tag');
        $arr['brand'] = $this->input->post('brand');
        $arr['replacement'] = $this->input->post('replacement');
        $arr['brand'] = $this->input->post('brand');
        $arr['brand'] = $this->input->post('brand');
        $arr['estimate']=$this->input->post('estimate');
        $arr['short_description'] = $this->input->post('short_description');
        $arr['description'] = $this->input->post('description');
        $arr['image_description'] = $this->input->post('image_description');
        $arr['status'] = 0;

        $product = $this->input->post('product');
        $chars = array ("!", "\"", "#", "$", "%", "&", "/", "(", ")", "?", "*", "+", "-", ".", ",", ";", ":", "_", " ", "--","=","'","-" );
        $urlValue = str_replace ( $chars, "-", $product);
        $arr['product_url'] = strtolower(str_replace ( $chars, "-", $urlValue ));

        if(isset($_FILES['fimage']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            //$config['max_size']      = 1024;
            $this->upload->initialize($config);
            if($this->upload->do_upload('fimage'))
            {
                $uploaded = $this->upload->data();
                $arr['fimage'] = $uploaded['file_name'];
                /*$this->resize_image(APPPATH.'uploads/'.$arr['fimage'],900);
                $this->createThumbnail(APPPATH.'uploads/'.$arr['fimage'],APPPATH.'uploads/thumbnail/'.$arr['fimage'],400,300);*/
                //$arr['image'] =
            }
        }

        $this->product_model->save('product',$arr);

        $id = $this->db->insert_id();

        $count = count($_FILES['image']['name']);

        for($i=0;$i<$count;$i++){

            if(!empty($_FILES['image']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['image']['name'][$i];
                $_FILES['file']['type'] = $_FILES['image']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['image']['error'][$i];
                $_FILES['file']['size'] = $_FILES['image']['size'][$i];

                //$path3 = "./uploads/product_gallery/";

                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = $_FILES['image']['name'][$i];

                $this->load->library('upload',$config);

                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $sql2 = "insert into productimage(pro_id,image) values(?,?)";
                    $values2 = array($id,$filename);
                    $this->product_model->iud_data($sql2,$values2);
                }
            }

        }

        $this->session->set_flashdata('success','Product saved successfully');
        redirect('vendor/product/index');
    }

    function edit($id)
    {
        $seller_id = $this->session->userdata('seller_id');
        $data['cat'] =$this->product_model->getAllCategory();
        $data['sub'] =$this->product_model->getAllSubcategory();
        $data['child'] =$this->product_model->getAllChildcategory();
        $data['color'] =$this->product_model->getAllColor();
        $data['size'] =$this->product_model->getAllSize();
        $data['attr'] =$this->product_model->getAllAttr();
        $data['brand'] =$this->product_model->getAllBrand();
        $data['replace'] =$this->product_model->getAllReplacement();
        $data['estimate'] =$this->product_model->getAllEstimate();
        $data['pro'] = $this->product_model->getSellerProductById($id,$seller_id);
        $prid = $data['pro']->id;
        $data['product'] = $this->product_model->getProductMultipleById($prid);
        $this->load->view('vendor/product/edit-product',$data);
    }

    function update($id)
    {
        $this->product_model->update($id);
        $this->session->set_flashdata('success','SubClass updated successfully');
        redirect('vendor/product/index');
    }

    function deleteVendor($id)
    {
        $this->product_model->deleteVendor($id);
        $this->session->set_flashdata('success','Subclass deleted successfully');
        redirect('vendor/product/index');
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