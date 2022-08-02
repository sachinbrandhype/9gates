<?php

class Color_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
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
        $arr['category'] = $this->input->post('category');
        $arr['subcategory'] = $this->input->post('subcategory');
        $arr['color'] = $this->input->post('color');
        $arr['color_code'] = $this->input->post('color_code');
        $arr['modifydate'] = date("Y-m-d H:i:s");


        $this->db->where(array('has_very' => $id));
        $this->db->update('color', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('color');
    }



    function allChildcategory()
    {

        $query = $this->db->query("SELECT category.category,child_category.has_very,child_category.createdate,subcategory.subcategory,subcategory.url,child_category.childcategory FROM child_category INNER JOIN category ON category.id=child_category.category INNER JOIN subcategory ON subcategory.id=child_category.subcategory ORDER BY child_category.id");
        return $query->result();
    }


    function getColorById($id)
    {

        return $this->db->get_where('color', array('has_very' => $id))->row();

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

    function allColor()
    {
        $query = $this->db->query("SELECT category.category,color.has_very,color.color,color.color_code,color.createdate,subcategory.subcategory,subcategory.url FROM color INNER JOIN category ON category.id=color.category INNER JOIN subcategory ON subcategory.id=color.subcategory ORDER BY color.id");
        return $query->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('color')->num_rows();
    }


}