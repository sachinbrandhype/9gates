<?php

class Banner_Model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'banner';
    }
    
    function getAllGates()
    {
        $query = $this->db->query("select * from menu");
        return $query->result();
    }
    
    function getAllCategory()
    {
        $query = $this->db->query("select * from category");
        return $query->result();
    }

    function  getAllSubcategory()
    {
        $query = $this->db->query("select * from subcategory");
        return $query->result();
    }
    
    function fetch_MenuBycategory($menu)
    {
        $this->db->where('menu', $menu);
        $query = $this->db->get('category');
        $output = '<option value="">Select category</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->category . '</option>';
        }
        return $output;
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

    function  getAllChildcategory()
    {
        $query = $this->db->query("select * from child_category");
        return $query->result();
    }

    function bannerslider()
    {
        $query = $this->db->query("select * from bannerslider");
        return $query->result();
    }
    function getAll()
    {

        $this->db->select('menu.id,menu.menu,child_category.childcategory,category.category,subcategory.subcategory,banner.id,banner.has_very,banner.image,banner.createdate');
        $this->db->from('banner');
        $this->db->join('category', 'banner.category = category.id ', 'inner');
        $this->db->join('subcategory', 'banner.subcategory  = subcategory.id', 'inner');
        $this->db->join('child_category', 'banner.childcategory = child_category.id ', 'inner');
        $this->db->join('menu', 'banner.menu = menu.id ', 'inner');
        $query = $this->db->get();
        return $query->result();


    }


    function class_insert($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('banner')->num_rows();
    }


    function getMenuById($id)
    {
        return $this->db->get_where('menu', array('id' => $id))->row();
    }
    
    
    function getById($id)
    {
        return $this->db->get_where('banner', array('has_very' => $id))->row();
    }

    function getBannerSliderById($id)
    {
        return $this->db->get_where('bannerslider', array('has_very' => $id))->row();
    }

    function saveShopByBrandBanner($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function saveTradingBanner($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }
 
    function saveOfferBanner($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }




    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function resize_image($source, $width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    function createThumbnail($source, $destination, $width, $height)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    function update($id)
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['menu'] = $this->input->post('menu');
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['childcategory'] = $this->input->post('childcategory');
        $arr['modifydate'] = date("Y-m-d H:i:s");

        if (isset($_FILES['image']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] ='uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                $this->resize_image('uploads/' . $arr['image'], 900);
                $this->createThumbnail('uploads/' . $arr['image'], 'uploads/thumbnail/' . $arr['image'], 400, 300);
                //$arr['image'] =
            }
        }

        $this->db->where(array('has_very' => $id));
        $this->db->update('banner', $arr);
    }

    function updateBanner($id)
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['banner_position'] = $this->input->post('banner_position');
        $arr['banner_link'] = $this->input->post('banner_link');
        $arr['banner_text'] = $this->input->post('banner_text');
        $arr['modifydate'] = date("Y-m-d H:i:s");

        if (isset($_FILES['image']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png|gif';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
              /*  $this->resize_image(APPPATH . '../uploads/' . $arr['image'], 900);
                $this->createThumbnail(PPPATH . '../uploads/' . $arr['image'], APPPATH . '../uploads/thumbnail/' . $arr['image'], 400, 300);*/
                //$arr['image'] =
            }
        }

        $this->db->where(array('has_very' => $id));
        $this->db->update('bannerslider', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('banner');
    }

    function deleteBanner($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('bannerslider');
    }
}