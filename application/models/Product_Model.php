<?php

class Product_Model extends CI_Model
{
    public function insertCSV($data)
    {
        $this->db->insert('product', $data);
        return TRUE;
    }

    public function iud_data($sql,$value)
    {
        $qr=$this->db->query($sql,$value);

        if($qr)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    function getAllOrder()
    {
        $query = $this->db->query("select * from tbl_order where status='complete'");
        return $query->result();
    }

    function getAllReturn()
    {
        $query = $this->db->query("select * from tbl_order where status='return'");
        return $query->result();
    }
    
    function getAllCancel()
    {
        $query = $this->db->query("select * from tbl_order where status='cancel'");
        return $query->result();
    }
    function getAllestimate()
    {
        $query = $this->db->query("select * from estimate_delivery");
        return $query->result();
    }


    function getAllMenu()
    {
        $query = $this->db->query("select * from menu");
        return $query->result();
    }


    function getAllCategory()
    {
        $query = $this->db->query("select * from category");
        return $query->result();
    }

    function getAllBrand()
    {
        $query = $this->db->query("select * from brand");
        return $query->result();
    }

    function getAllSize()
    {
        $query = $this->db->query("select * from size");
        return $query->result();
    }

    function getAllAttr()
    {
        $query = $this->db->query("select * from attribute_group");
        return $query->result();
    }

    function getAllReplacement()
    {
        $query = $this->db->query("select * from replacement");
        return $query->result();
    }

    function  getAllSubcategory()
    {
        $query = $this->db->query("select * from subcategory");
        return $query->result();
    }
    function  getAllChildcategory()
    {
        $query = $this->db->query("select * from child_category");
        return $query->result();
    }

    function  getProductMultipleById($prid)
    {
        $query = $this->db->query("select * from productimage where pro_id='$prid'");
        return $query->result();
    }

    function  getAllColor()
    {
        $query = $this->db->query("select * from color");
        return $query->result();
    }

    function getAll($limit, $offset)
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('id DESC');
        return $this->db->get('product')->result();
    }

    function data_post_update($tablename, $data, $where)
    {
        $this->db->where($where);
        return $this->db->update($tablename, $data);
    }

    public function getAllProductImageData($sql)
    {
        $qr = $this->db->query($sql);
        return $qr->result();
    }

    function getAllVendorData($id)
    {
        /*$this->db->select('child_category.childcategory,category.category,subcategory.subcategory,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
        $this->db->from('product');
        $this->db->join('category', 'product.category = category.id ', 'inner');
        $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
        $this->db->join('child_category', 'product.childcategory = child_category.id ', 'inner');*/
        $this->db->select('category.category,subcategory.subcategory,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
        $this->db->from('product');
        $this->db->join('category', 'product.category = category.id ', 'inner');
        $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
        $this->db->where('product.seller_id', $id,'product.trash',0);
        $query = $this->db->get();
        return $query->result();
    }

    function getAllData()
    {
        /*$this->db->select('child_category.childcategory,category.category,subcategory.subcategory,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
        $this->db->from('product');
        $this->db->join('category', 'product.category = category.id ', 'inner');
        $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
        $this->db->join('child_category', 'product.childcategory = child_category.id ', 'inner');*/
        $this->db->select('category.category,subcategory.subcategory,product.id,product.stock,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
        $this->db->from('product');
        $this->db->join('category', 'product.category = category.id ', 'inner');
        $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
        $query = $this->db->get();
        return $query->result();
    }


    function fetch_Subcategory($category)
    {
        $this->db->where('category', $category);
        $query = $this->db->get('subcategory');
        $output = '<option value="">Select Subcategory</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->subcategory . '</option>';
        }
        return $output;
    }

    function fetch_Childcategory($subcategory)
    {
        $this->db->where('subcategory', $subcategory);
        $query = $this->db->get('child_category');
        $output = '<option value="">Select Childcategory</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->childcategory . '</option>';
        }
        return $output;
    }

    function fetch_Color($subcategory)
    {
        $this->db->where('subcategory', $subcategory);
        $query = $this->db->get('color');
        $output = '<option value="">Select Color</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->color . '</option>';
        }
        return $output;
    }

    function fetch_Size($subcategory)
    {
        $this->db->where('subcategory', $subcategory);
        $query = $this->db->get('size');
        $output = '<option value="">Select size</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->size . '</option>';
        }
        return $output;
    }

    function fetch_AttributeGroup($subcategory)
    {
        $this->db->where('subcategory', $subcategory);
        $query = $this->db->get('attribute_group');
        $output = '<option value="">Select attributegroup</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->attributegroup . '</option>';
        }
        return $output;
    }

    function  getAllClass()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('classes')->result();
    }

    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('product')->num_rows();
    }

    function getProductById($id)
    {
        return $this->db->get_where('product', array('has_very' => $id))->row();
    }

    function getSellerProductById($id,$seller_id)
    {
        return $this->db->get_where('product', array('has_very' => $id,'seller_id'=>$seller_id))->row();
    }

    function save($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveMulti($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function saveMultiCo($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {
        $seller_id = $this->session->userdata('seller_id');
        $pid= $this->input->post('id');
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
        $arr['offer'] = $this->input->post('offer');
        $arr['set_offer'] = $this->input->post('set_offer');

        $product = $this->input->post('product');
        $chars = array ("!", "\"", "#", "$", "%", "&", "/", "(", ")", "?", "*", "+", "-", ".", ",", ";", ":", "_", " ", "--","=","'","-" );
        $urlValue = str_replace ( $chars, "-", $product);
        $arr['product_url'] = strtolower(str_replace ( $chars, "-", $urlValue ));

        if (isset($_FILES['fimage']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            //$config['max_size']      = 1024;
            $this->upload->initialize($config);
            if($this->upload->do_upload('fimage'))
            {
                $uploaded = $this->upload->data();
                $arr['fimage'] = $uploaded['file_name'];
                $this->resize_image(APPPATH.'uploads/'.$arr['fimage'],900);
                $this->createThumbnail(APPPATH.'uploads/'.$arr['fimage'],APPPATH.'uploads/thumbnail/'.$arr['fimage'],400,300);
                //$arr['image'] =
            }
        }

        $this->db->where(array('has_very' => $id));
        $this->db->update('product', $arr);

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
                $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
                $config['max_size'] = '5000';
                $config['file_name'] = $_FILES['image']['name'][$i];

                $this->load->library('upload',$config);

                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $sql2 = "insert into productimage(pro_id,image) values(?,?)";
                    $values2 = array($pid,$filename);
                    $this->product_model->iud_data($sql2,$values2);
                }
            }

        }
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

    function deleteVendor($id)
    {
        $arr['trash'] = 1;
        $this->db->where(array('has_very' => $id));
        $this->db->update('product', $arr);
        /*$this->db->where(array('has_very' => $id));
        $this->db->delete('product');*/
    }
}