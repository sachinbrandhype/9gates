<?php

class Replacement_Model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['replace'] = $this->input->post('replace');
        $arr['modifydate'] = date("Y-m-d H:i:s");

        $this->db->where(array('has_very' => $id));
        $this->db->update('replacement', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('replacement');
    }

    function getReplacementById($id)
    {

        return $this->db->get_where('replacement', array('has_very' => $id))->row();

    }



    function  allReplacement()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('replacement')->result();
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
        return $this->db->get('replacement')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('replacement')->num_rows();
    }


}