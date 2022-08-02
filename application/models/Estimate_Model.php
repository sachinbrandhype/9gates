<?php

class Estimate_Model extends CI_Model
{
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
        return $this->db->get('estimate_delivery')->result();
    }


    function getStateList()
    {
        return $this->db->get('estimate_delivery')->result();
    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('estimate_delivery')->num_rows();
    }

    function getById($id)
    {
        return $this->db->get_where('estimate_delivery', array('has_very' => $id))->row();
    }

    function save()
    {
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['delv_day'] = $this->input->post('delv_day');
        $this->db->insert('estimate_delivery', $arr);
    }


    function update($id)
    {
        $arr['delv_day'] = $this->input->post('delv_day');
        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('estimate_delivery', $arr);
    }

    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('estimate_delivery');
    }
}