<?php

class ProductAPI_model extends CI_Model
{
    protected $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
     
    function getCouponDiscount($code)
    {
     /* $query = $this->db->query("select * from coupon where coupon_code='$code' ");
        return $query->result(); */
        return $this->db->get_where('coupon', array('coupon_code' => $code))->row();
    }
    
    function getProductById($pid)
    {
        
          return $this->db->get_where('product', array('id' => $pid))->row();
      /*$query = $this->db->query("select * from product where id='$pid' ");
        return $query->result(); */ 
    }
    
    function getAllColor()
    {
      $query = $this->db->query("select * from color ");
        return $query->result();  
    }
    
    function getAllSize()
    {
      $query = $this->db->query("select * from size ");
        return $query->result();  
    }
    
    function getAllAtributes()
    {
      $query = $this->db->query("select * from attribute_group ");
        return $query->result();  
    }
    
    function getProductShareUrl($url)
    {
        $query = $this->db->query("select * from product where  product_url!= '$url'");
        return $query->result();
    }
    
    function getCancellOrder($id)
    {
        $delete=$this->db->delete('tbl_order',array('orderid'=>$id));
        return $delete?true:false;
    }
    
    
    function getProductFilter($mid,$cid)
    {
        $query = $this->db->query("SELECT color.color,color.color_code,size.size,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description FROM `product` INNER JOIN color ON color.id =product.color INNER JOIN size ON size.id = product.size WHERE product.menu ='$mid' AND product.category='$cid'");
        return $query->result();
    }
    
     function getRelatedProduct($url)
    {
        $query = $this->db->query("select * from product where  product_url!= '$url' order by category DESC");
        return $query->result();
    }
    
    
    function getReturnPolicy()
    {
        $type = 'returnspolicy';
        $query = $this->db->query("select * from pages where type='$type'");
        return $query->result();
    }
    
    function getTermsofuse()
    {
        $type = 'termsofuse';
        $query = $this->db->query("select * from pages where type='$type'");
        return $query->result();
    }
    
    function getPrivacyPolicy()
    {
        $type = 'privacypolicy';
        $query = $this->db->query("select * from pages where type='$type'");
        return $query->result();
    }
    
    
    function getOrderCancellation()
    {
        $type = 'ordercancelation';
        $query = $this->db->query("select * from pages where type='$type'");
        return $query->result();
    }
    
    function deleteCartlist($id)
    {
        $delete=$this->db->delete('cart',array('id'=>$id));
        return $delete?true:false;
    }
    
    
    function saveCartList($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
    
    function deletewishlist($id)
    {
        $delete=$this->db->delete('wishlist',array('id'=>$id));
        return $delete?true:false;
    }
    
    function getAllWishList($id)
    {
        $query = $this->db->query("select * from wishlist where user_id='$id'");
        return $query->result();
    }    
    
    function getNotification()
    {
        $query = $this->db->query("select * from notification where status='1'");
        return $query->result();
    }
    
    
    function saveAppToken($arr)
    {
        $insert = $this->db->insert("appnoti",$arr);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }
       
   function getCouponList()
    {
        
        $query = $this->db->query("select * from coupon");
        return $query->result();
    }
    
    function getChildCategoryListById($mid,$cid,$s)
    {
        $query = $this->db->query("select * from child_category where menu='$mid' OR (category='$cid' AND subcategory='$s')");
        return $query->result();
    }
    
    
    function getSubCategoryListById($mid,$cid)
    {
        $query = $this->db->query("select * from subcategory where menu='$mid' AND category='$cid'");
        return $query->result();
    }
    
    function getCategoryListById($mid)
    {
        $query = $this->db->query("select * from category where menu='$mid'");
        return $query->result();
    }
    
     function getProductFataList($mid,$cid)
    {
        $query = $this->db->query("select * from product where menu='$mid' AND category='$cid'");
        return $query->result();
    }
    
    
    function saveNewAddress($add)
    {
        $insert = $this->db->insert("tbl_address",$add);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
    function updateNewAddress($arr,$userid)
    {
        if(!empty($arr) && !empty($userid))
        {
          

            /*$update=$this->db->update('tbl_address',$arr,array('user_id'=>$userid));
            return $update?true:false;*/
            
            $this->db->where(array('user_id' => $userid));
        $this->db->update('tbl_address', $arr);

        }
        else
        {
            return false;
        }
    }
    
    
     function updateUserInfoData($arr,$userid)
    {
        if(!empty($userid) && !empty($arr))
        {
          

            /*$update=$this->db->update('user',$arr,array('id'=>$userid));
            return $update?true:false;*/
            
            $this->db->where(array('id' => $userid));
        $this->db->update('user', $arr);

        }
        else
        {
            return false;
        }
    }
    
    function getProductOrderHistory($id)
    {
        $query = $this->db->query("select * from tbl_order where userid='$id' ");
        return $query->result();
    }
    
    function getProductOrder($id)
    {
        $query = $this->db->query("select * from tbl_order where orderid='$id' ");
        return $query->result();
    }
    
     
     function saveWishList($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
    
    
    function saveReviewInsert($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
    
    
    
    function getOfferProduct()
    {
        $query = $this->db->query("select * from product where set_offer!='' ");
        return $query->result();
    }
    
    
    
    function getReview()
    {
        $query = $this->db->query("select * from review");
        return $query->result();
    }
    
    
    function checkNewAddress($id,$address)
    {
        return $this->db->get_where('tbl_address', array('user_id' => $id, 'address' =>$address ))->row();
    }
    
    
    function getCouponCodeCheck($id)
    {
        return $this->db->get_where('coupon', array('coupon_code' => $id))->row();
    }
    
   /* function saveOrder($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }*/
    
    
    function saveOrder($data){

    $this->db->insert('tbl_order', $data);
    return $this->db->insert_id();
    }
    
    
    function getHomeProduct()
    {
        $query = $this->db->query("select * from product");
        return $query->result();
    }
    function insert()
    {
        $insert = $this->db->insert("user",$arr);
        if($insert)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
    function getCategoryIdByUrl($url)
    {
        return $this->db->get_where('category', array('url' => $url))->row();
    }
    
    function getProductByurl($id)
    {
        $query = $this->db->query("select * from product where id='$id' ");
        return $query->result();
    } 
    
    function getProductMultipleImage($id)
    {
        $query = $this->db->query("select * from productimage where pro_id='$id' ");
        return $query->result();
    } 
    
    function searchAllData($id)
    {

        $this->db->where("(`product` LIKE '%$id%'");
        $this->db->or_where("`mrp` LIKE '%$id%')");
        $query = $this->db->get('product');

        return $query->result();
    }
    
    function getAllProductById($id)
    {
        $this->db->select('category.category,subcategory.subcategory,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
        $this->db->from('product');
        $this->db->join('category', 'product.category = category.id ', 'inner');
        $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
        /*$this->db->join('child_category', 'product.childcategory = child_category.id ', 'inner');*/
        $this->db->where('product.id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    function getAll($id = "")
    {
        if (!empty($id)) {
            $this->db->select('category.category,subcategory.subcategory,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
            $this->db->from('product');
            $this->db->join('category', 'product.category = category.id ', 'inner');
            $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
            /*$this->db->join('child_category', 'product.childcategory = child_category.id ', 'inner');*/
            $this->db->where('product.id',$id);
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select('category.category,subcategory.subcategory,product.id,product.has_very,product.product,product.brand,product.product_url,product.mrp,product.has_very,product.createdate,product.fimage,product.short_description,product.description');
            $this->db->from('product');
            $this->db->join('category', 'product.category = category.id ', 'inner');
            $this->db->join('subcategory', 'product.subcategory  = subcategory.id', 'inner');
            /*$this->db->join('child_category', 'product.childcategory = child_category.id ', 'inner');*/
            $query = $this->db->get();
            return $query->result();
        }
    }

    function getAllSub($id = "")
    {
        if (!empty($id)) {
            $query = $this->db->query("select category.category,subcategory.subcategory,subcategory.image,subcategory.url,subcategory.description,subcategory.bannerimage from subcategory inner join category on category.id = subcategory.category where subcategory.id='$id'");
            return $query->result();
        } else {
            $query = $this->db->query('select category.category,subcategory.subcategory,subcategory.image,subcategory.url,subcategory.description,subcategory.bannerimage from subcategory inner join category on category.id = subcategory.category');
            return $query->result();
        }
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