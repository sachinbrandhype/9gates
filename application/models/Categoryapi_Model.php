<?php

class Categoryapi_Model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
    function save($tablename, $basic_data)
    {
        $this->db->insert($tablename, $basic_data);
        return $this->db->insert_id();
    }
    function insert($arr = array())
    {
        if(!array_key_exists("create_date",$arr))
        {
            $arr["create_date"]= date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modifi_date",$arr))
        {
            $arr["modifi_date"] = date("Y-m-d H:i:s");
        }
        $insert = $this->db->insert("$this->table",$arr);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }

    function update($arr ,$id)
    {
        if(!empty($arr) && !empty($id))
        {
            if(!array_key_exists("modifi_date",$arr))
            {
                $arr["modifi_date"] = date("Y-m-d H:i:s");
            }

            $update=$this->db->update('user',$arr,array('id'=>$id));
            return $update?true:false;

        }
        else
        {
            return false;
        }
    }
    
    
    function getAllCategoryByMenu($id)
    {
        $query = $this->db->query("SELECT * FROM `category` where menu ='$id' ");
        return $query->result();
    }
    
    
    function getAllMenu()
    {
        $query = $this->db->query("SELECT * FROM `menu` ");
        return $query->result();
    }
    
    
     function getAllMenuCategory($id)
    {
        $query = $this->db->query("SELECT * FROM `category` where menu ='$id' ");
        return $query->result();
    }
    
    
     function getAllMenuSubCategory($id)
    {
        $query = $this->db->query("SELECT * FROM `subcategory` where category ='$id'");
        return $query->result();
    }
    
    function getAllMenuChildCategory($id)
    {
        $query = $this->db->query("SELECT * FROM `child_category` where subcategory ='$id'");
        return $query->result();
    }
    
    function getAllGates()
    {
        $query = $this->db->get('category');
            return $query->result();
    }
    
    function getAllCat()
    {
      
        
        
        $query = $this->db->query("SELECT * FROM `category` INNER JOIN subcategory ON subcategory.category =category.id INNER JOIN child_category ON child_category.subcategory = subcategory.id INNER JOIN menu ON menu.id =category.menu");
            return $query->result();
            
    }

    function getAll()
    {
      
        $query = $this->db->query("SELECT * FROM `category` ");
            return $query->result();
            
    }
    
    function getAllChildCategoryList($mid,$id,$sbid)
    {
       $query = $this->db->query("select * from child_category where menu = '$mid' OR (category ='$id' AND subcategory ='$sbid')");
            return $query->result(); 
    }
     
    function getAllSubCategory($mid,$id)
    {
       $query = $this->db->query("select * from subcategory where menu = '$mid' AND category ='$id'");
            return $query->result(); 
    }
    
    function getAllChildCategory($id)
    {
       $query = $this->db->query("select * from child_category where subcategory ='$id'");
            return $query->result(); 
    }
    
    
    function getAllSub($id)
    {
       
            $query = $this->db->query("select category.category,subcategory.subcategory,subcategory.id,subcategory.image,subcategory.url,subcategory.description,subcategory.bannerimage from subcategory inner join category on category.id = subcategory.category where subcategory.category='$id'");
            return $query->result();
        
    }

    function getAllChild($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->query("select child_category.childcategory,category.category,subcategory.subcategory,child_category.image,child_category.url,child_category.description from child_category inner join category on category.id = child_category.category inner join subcategory on subcategory.id = child_category.subcategory where child_category.id='$id'");
            return $query->result();
        } else {
            $query = $this->db->query('select child_category.childcategory,category.category,subcategory.subcategory,child_category.image,child_category.url,child_category.description from child_category inner join category on category.id = child_category.category inner join subcategory on subcategory.id = child_category.subcategory');
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