<?php

class Wallet_model extends CI_Model
{

    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }

    function update($id)
    {

        $arr['has_very'] = uniqid().''.strtotime(date("ymdhis"));
        $arr['username'] = $this->input->post('username');
        $arr['password'] = md5($this->input->post('password'));
        $arr['name'] = $this->input->post('name');
        $arr['email'] = $this->input->post('email');
        $arr['mobile'] = $this->input->post('mobile');
        $arr['address'] = $this->input->post('address');
        $arr['modifydate'] = date("Y-m-d H:i:s");
        $this->db->where(array('has_very' => $id));
        $this->db->update('admin', $arr);
    }



    function delete($id)
    {
        $this->db->where(array('has_very' => $id));
        $this->db->delete('admin');
    }

    function allCredit()
    {

        $query = $this->db->query("SELECT * from wallet where data_type='credit' ");
        return $query->result();
    }

    function allDebit()
    {

        $query = $this->db->query("SELECT * from wallet where data_type='debit' order by id DESC");
        return $query->result();
    }

    function allUser()
    {

        $query = $this->db->query("SELECT * from user ");
        return $query->result();
    }


    function getUserById($id)
    {

        return $this->db->get_where('admin', array('has_very' => $id))->row();

    }


    function countAll()
    {
        $keyword = $this->input->get('keyword');
        if ($keyword) {
            $this->db->like(array('title' => $keyword));
            $this->db->or_like(array('description' => $keyword));
            $this->db->or_like(array('author' => $keyword));
        }
        return $this->db->get('admin')->num_rows();
    }


}