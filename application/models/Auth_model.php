<?php

class Auth_model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
    function updateProfile( $data ,$id)
    {
      /*$this->db->where(array('id' => $id));
        $this->db->update('user', $data); */ 
        
        $update = $this->db->update('user',$data,array('id'=>$id));
        return $update?true:false;
    }
    
    function insertEmail($tablename,$data)
    {
      $this->db->insert($tablename, $data);
        return $this->db->insert_id();   
    }
    
    
    function insertmobile($tablename,$data)
    {
      $this->db->insert($tablename, $data);
        return $this->db->insert_id();   
    }
    public function checkEmail($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row();
    }
    
    public function checkPhone($phone)
    {
        $query = $this->db->get_where('user', array('phone' => $phone));
        return $query->row();
    }
    
    public function insertokokok($data){
       
       $this->name    = $data['name']; // please read the below note
       $this->password  = $data['password'];
       $this->email = $data['email'];
       $this->email = $data['email'];
       if($this->db->insert('user',$data))
       {    
           return 'Data is inserted successfully';
       }
         else
       {
           return "Error has occured";
       }
   } 
   
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }

        //return fetched data
        return $result;
    }
    
}
    ?>