<?php

class Vendor extends CI_Model
{
    function islogin()
    {
        /*$arr['email'] = $this->input->post('email');
        $arr['password'] = $this->input->post('password');
        return $this->db->get_where('vendor',$arr)->row();*/

       /* $query = $this->db->get_where('admin', array('email' => $email, 'password' => $password, 'status' => 1));
        return $query->row();*/

        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $data['role_type'] = 'superadmin';
        $data['status'] = 1;
        $query = $this->db->get_where('admin', array('username' => $data['username'], 'password' => $data['password'], 'role_type' => $data['role_type'], 'status' => $data['status']));
        return $query->num_rows();
    }

    public function upload_image($path,$filename='userfile',$type='*',$size='1000')
    {

        if(!is_dir($path))
        {
            mkdir($path,0755,TRUE);
        }
        $config['encrypt_name'] =TRUE;
        $config['upload_path'] =$path;
        $config['allowed_types'] = $type;
        $config['max_size']	= $size;
        $config['overwrite'] = FALSE;
        $this->upload->initialize($config);
        if($this->upload->do_upload($filename))
        {
            $file_data = $this->upload->data();
            return $file_data['file_name'];
        }
        else
        {
            return 0;
        }
    }

    public  function getAlldata($sql)
    {
        $qr = $this->db->query($sql);
        return $qr->result();
    }

    public function iud_data_id($sql,$value)
    {
        $qr = $this->db->query($sql,$value);
        $r = $this->db->insert_id();
        if($qr)
        {
            return $r;
        }
        else
        {
            return 0;
        }
    }

    public function iud_data($sql,$value)
    {
        $qr=$this->db->query($sql,$value);
        $r =$this->db->insert_id();
        if($qr)
        {
            return $r;
        }
        else
        {
            return 0;
        }
    }


}