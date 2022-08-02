<?php

class Noti_model extends CI_Model
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

    function SendNoti($id)
    {
        $arr['name'] = $this->input->post('name');
        $arr['message'] = $this->input->post('message');
        $this->db->where(array('appid' => $id));
        $this->db->update('notification', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('child_category');
    }



    function allChildcategory()
    {

        $query = $this->db->query("SELECT category.category,child_category.has_very,child_category.createdate,subcategory.subcategory,subcategory.url,child_category.childcategory FROM child_category INNER JOIN category ON category.id=child_category.category INNER JOIN subcategory ON subcategory.id=child_category.subcategory ORDER BY child_category.id");
        return $query->result();
    }


    function getNotiIdById($id)
    {

        return $this->db->get_where('appnoti', array('appid' => $id))->row();

    }

    function  allNoti()
    {
        $this->db->order_by('id ASC');
        return $this->db->get('appnoti')->result();
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