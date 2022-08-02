<?php

class Childcategory_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }
    
     function fetch_MenucategoryData($category)
    {
        $this->db->where('menu', $category);
        $query = $this->db->get('category');
        $output = '<option value="">Select Category</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->category.'</option>';
        }
        return $output;
    }

    function fetch_category($category)
    {
        $this->db->where('menu', $category);
        $query = $this->db->get('category');
        $output = '<option value="">Select Category</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->category.'</option>';
        }
        return $output;
    }

    function fetch_Subcategory($category)
    {
        $this->db->where('category', $category);
        $query = $this->db->get('subcategory');
        $output = '<option value="">Select Subcategory</option>';
        foreach($query->result() as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->subcategory.'</option>';
        }
        return $output;
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['menu'] = $this->input->post('menu');
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['childcategory'] = $this->input->post('childcategory');
        $arr['description'] = $this->input->post('description');
        $arr['url'] = $this->input->post('url');
        $arr['modifydate'] = date("Y-m-d H:i:s");

        if (isset($_FILES['image']['name'])) {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                //$arr['image'] =
            }
        }

        $this->db->where(array('has_very' => $id));
        $this->db->update('child_category', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('child_category');
    }



    function allChildcategory()
    {

        $query = $this->db->query("SELECT menu.id,menu.menu,category.category,child_category.has_very,child_category.createdate,subcategory.subcategory,subcategory.url,child_category.childcategory FROM child_category INNER JOIN category ON category.id=child_category.category INNER JOIN subcategory ON subcategory.id=child_category.subcategory INNER JOIN menu ON menu.id = child_category.menu ORDER BY child_category.id");
        return $query->result();
    }


    function getChildCategoryById($id)
    {

        return $this->db->get_where('child_category', array('has_very' => $id))->row();

    }

    function  getAllMenu()
    {
        $this->db->order_by('id ASC');
        return $this->db->get('menu')->result();
    }

    function  getAllCategroy()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('category')->result();
    }

    function  getAllSubCategroy()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('subcategory')->result();
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
        return $this->db->get('child_category')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('child_category')->num_rows();
    }


}