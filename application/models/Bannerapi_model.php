<?php

class Bannerapi_model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
    
    function getbannerByMenuCategory($mid,$cid)
    {
        $query = $this->db->query("select * from product where menu ='$mid' AND category='$cid' ");
        return $query->result();

    }
     
    function getFeaturedProductByMenu($id)
    {
        $query = $this->db->query("select * from product where menu ='$id' order by id desc limit 0,16");
        return $query->result();

    }
    
    function getOfferForYou($id)
    {
        $type = 'Position12';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' AND menu='$id'");
        return $query->result();
    }
    
    function getShopByBrand($id)
    {
        $type = 'Position2';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' AND menu='$id'");
        return $query->result();
    }
    
    function getHomeCategory($id)
    {
        $query = $this->db->query("select * from category where menu='$id' ");
        return $query->result();
    }
    
    function getAllBannerByMenuId($id)
    {
        $query = $this->db->query("select * from banner where menu ='$id'");
        return $query->result();
        
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

    function getAllBanner($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('banner', array('id' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('banner');
            return $query->result();
        }
    }

    function getAllBannerPosition1()
    {
            $query = $this->db->query('select * from bannerslider');
            return $query->result();
        
    }

    function getAllBannerPosition2($id2)
    {
        
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id2));
            return $query->result();
        
    }

    function getAllBannerPosition3($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition4($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition5($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition6($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }
    function getAllBannerPosition7($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }
    function getAllBannerPosition8($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition9($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition10($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition11($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition12($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition13($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition14($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }

    function getAllBannerPosition15($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }
    function getAllBannerPosition16($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
            return $query->result();
        }
    }
    function getAllBannerPosition17($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->get_where('bannerslider', array('banner_position' => $id));
            return $query->result();
        } else {
            $query = $this->db->get('bannerslider');
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