<?php

class CartApiModel extends CI_Model
{

function saveCartList($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
    
}
