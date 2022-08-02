<?php

class Pincode_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['pincode'] = $this->input->post('pincode');
        $arr['delivery_charge'] = $this->input->post('delivery_charge');
        $arr['modifydate'] = date("Y-m-d H:i:s");


        $this->db->where(array('has_very' => $id));
        $this->db->update('pincode', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('pincode');
    }



    function allPincode()
    {

        $query = $this->db->query("SELECT * from pincode");
        return $query->result();
    }


    function getPackageById($id)
    {

        return $this->db->get_where('pincode', array('has_very' => $id))->row();

    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('pincode')->num_rows();
    }


}