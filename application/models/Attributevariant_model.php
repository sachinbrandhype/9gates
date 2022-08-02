<?php

class Attributevariant_model extends CI_Model
{
    function getAllAttributeGroup()
    {

        $this->db->order_by('id DESC');
        return $this->db->get('attribute_group')->result();
    }
    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['attributevariant'] = $this->input->post('attributevariant');
        $arr['attributegroup'] = $this->input->post('attributegroup');
        $arr['modifydate'] = date("Y-m-d H:i:s");

        $this->db->where(array('has_very' => $id));
        $this->db->update('attribute_variant', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('attribute_variant');
    }



    function allAttributeVariant()
    {

        $query = $this->db->query("SELECT Attribute_variant.has_very,Attribute_variant.createdate,Attribute_variant.attributevariant,Attribute_group.attributegroup FROM Attribute_variant INNER JOIN Attribute_group ON Attribute_group.id=Attribute_variant.attributegroup  ORDER BY Attribute_variant.id");
        return $query->result();
    }


    function getAttributeVariantById($id)
    {

        return $this->db->get_where('attribute_variant', array('has_very' => $id))->row();

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
        return $this->db->get('attribute_variant')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('attribute_variant')->num_rows();
    }


}