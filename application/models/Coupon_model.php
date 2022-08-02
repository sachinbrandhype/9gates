<?php

class Coupon_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['coupon_code'] = $this->input->post('coupon_code');
        $arr['coupon_type'] = $this->input->post('coupon_type');
        $arr['coupon_value'] = $this->input->post('coupon_value');
        $arr['amount'] = $this->input->post('amount');
        $arr['start_date'] = $this->input->post('start_date');
        $arr['end_date'] = $this->input->post('end_date');
        $this->db->where(array('has_very' => $id));
        $this->db->update('coupon', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('coupon');
    }

    function allCoupon()
    {

        $query = $this->db->query("SELECT * from coupon ");
        return $query->result();
    }


    function getCouponById($id)
    {

        return $this->db->get_where('coupon', array('has_very' => $id))->row();

    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('coupon')->num_rows();
    }


}