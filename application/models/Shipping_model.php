<?php

class Shipping_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['weight_from'] = $this->input->post('weight_from');
        $arr['weight_in'] = $this->input->post('weight_in');
        $arr['delivery_charge'] = $this->input->post('delivery_charge');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('shipping', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('shipping');
    }



    function allShipping()
    {

        $query = $this->db->query("SELECT * from shipping");
        return $query->result();
    }


    function getShippingById($id)
    {

        return $this->db->get_where('shipping', array('has_very' => $id))->row();

    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('shipping')->num_rows();
    }


}