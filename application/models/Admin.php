<?php

class Admin extends CI_Model
{

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