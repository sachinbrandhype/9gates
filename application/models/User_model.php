<?php

class User_Model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }

    function getAllAddress()
    {
        $query = $this->db->query("select * from tbl_address");
        return $query->result();
    }
    
    public function loginbygoogleId($email,$google_id)
    {
        $query = $this->db->get_where('user', array('email' => $email,'google_id' =>$google_id));
        return $query->row();
    }

    public function insertGoogleData($data)
    {
        $insert = $this->db->insert('user', $data);
        return $insert?$this->db->insert_id():false;
    }

    public function checkGoogleId($google_id)
    {
        /*$query = $this->db->get_where('user', array('google_id' => $google_id));
        return $query->row();*/

        return $this->db->get_where('user', array('google_id' => $google_id))->row();
    }


    public function checkEmailId($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row();
    }
    
    
    public function saveUserAddress($data)
    {
        $insert = $this->db->insert('tbl_address', $data);
        return $insert?$this->db->insert_id():false;
    }
    
    function removeAddress($id)
    {
        $delete=$this->db->delete('tbl_address',array('user_id'=>$id));
        return $delete?true:false;
    }
    
    public function insert($data)
    {
        $insert = $this->db->insert('user', $data);
        return $insert?$this->db->insert_id():false;
    }

    function update($arr ,$id)
    {
        
          

            $update=$this->db->update('tbl_address',$arr,array('user_id'=>$id));
            return $update?true:false;

    }

    function getAll($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('user', array('id' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('user');
            return $query->result();
        }
    }

    function getUserData($id = "")
    {
        if(!empty($id))
        {
            $query=$this->db->get_where('user',array('id'=>$id));
            return $query->result();
        }
        else
        {
            $query=$this->db->get('user');
            return $query->result();
        }

    }

    function delete($id)
    {
        $delete=$this->db->delete('user',array('id'=>$id));
        return $delete?true:false;
    }

}

?>