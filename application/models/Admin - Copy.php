<?php

class Admin extends CI_Model
{
    function validate()
    {
        $arr['username'] = $this->input->post('username');
        $arr['password'] = md5($this->input->post('password'));
        return $this->db->get_where('admins', $arr)->row();
    }

    public function islogin()
    {
        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $data['role_type'] = 'admin';
        $data['status'] = '1';
        $query = $this->db->get_where('admin', array('username' => $data['username'], 'password' => $data['password'], 'role_type' => $data['role_type'], 'status' => $data['status']));
        return $query->num_rows();
    }
}