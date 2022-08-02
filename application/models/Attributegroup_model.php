<?php

class Attributegroup_model extends CI_Model
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
        $arr['attributegroup'] = $this->input->post('attributegroup');
        $arr['modifydate'] = date("Y-m-d H:i:s");

        $this->db->where(array('has_very' => $id));
        $this->db->update('attribute_group', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('attribute_group');
    }



    function allAttributegroup()
    {

        $query = $this->db->query("SELECT category.category,Attribute_Group.has_very,Attribute_Group.createdate,subcategory.subcategory,Attribute_Group.attributegroup FROM Attribute_Group INNER JOIN category ON category.id=Attribute_Group.category INNER JOIN subcategory ON subcategory.id=Attribute_Group.subcategory ORDER BY Attribute_Group.id");
        return $query->result();
    }


    function getAttributeGroupById($id)
    {

        return $this->db->get_where('attribute_group', array('has_very' => $id))->row();

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
        return $this->db->get('attribute_group')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('attribute_group')->num_rows();
    }


}