<?php

class OrderModel extends CI_Model
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
        return $this->db->get('tbl_order')->result();
    }

    function getVendorGstDetail($state)
    {
        return $this->db->get('vendor', array('state' => $state))->row();
    }


    function getInvoiceDataById($id)
    {
        
         $query = $this->db->query("select * from tbl_order where product_id='$id' ");
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
        return $this->db->get('tbl_order')->num_rows();
    }


    function getAllOrder()
    {
        $this->db->select('tbl_order.id,tbl_order.firstname,tbl_order.state,tbl_order.city,tbl_order.firstname,user.name,user.phone,user.street_address,tbl_order.product_url,tbl_order.product,tbl_order.price,tbl_order.shipping_charge,tbl_order.image');
        $this->db->from('tbl_order');
        $this->db->join('user', 'tbl_order.userid =user.id ', 'inner');
        $query = $this->db->get();
        return $query->result();
    }


}