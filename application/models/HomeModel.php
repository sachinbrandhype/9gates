<?php

class HomeModel extends CI_Model
{
    
    function getVouchers1()
    {
        $type="Special Promotions";
        $query = $this->db->query("select * from promotion_vouchers where type='$type' ");
        return $query->result();
        
    }
    
    
     function getVouchers()
    {
        $type="Discount coupons";
        $query = $this->db->query("select * from promotion_vouchers where type='$type' ");
        return $query->result();
        
    }
    
    function getProductNameByCartId($id)
    {
        return $this->db->get_where('product', array('id' => $id))->row();
    }
    
    function checkCouponCode($code)
    {

        return $this->db->get_where('coupon',array('coupon_code'=>$code))->row();

    }
    
    function updateProfileData($id)
    {
       $arr['fname'] = $this->input->post('fname');
       $arr['phone']= $this->input->post('phone'); 
       $arr['email']= $this->input->post('email');
       $arr['street_no']= $this->input->post('street_no');
       $arr['state']= $this->input->post('state');
       $arr['city']= $this->input->post('city');
       
       
       
       if(isset($_FILES['image']['name']))
        {
            $this->load->library('upload');
            $config['upload_path'] = 'uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = date('YmdHms').'_'.rand(1,999999);
            $this->upload->initialize($config);
            if($this->upload->do_upload('image'))
            {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
            }
        }
        
        $this->db->where(array('id' => $id));
        $this->db->update('user', $arr);
    }
    
    
    function returnOrderByOderId($id)
    {
     
     $arr['status']  = 'return';
     $arr['return_date']  = date("Y-m-d H:i:s");;
        $this->db->where(array('orderid'=>$id));
        $this->db->update('tbl_order',$arr);   
    }
    
    
    function cancelProductByOderId($id)
    {
     
     $arr['status']  = 'cancel';
     $arr['cancel_date']  = date("Y-m-d H:i:s");;
        $this->db->where(array('orderid'=>$id));
        $this->db->update('tbl_order',$arr);   
    }
    
    
    function updatePaymentStatus()
    {
        $arr['payment_id'] = $this->input->post('payment_id');
       $orderid = $this->input->post('orderid');
       $arr['status'] = 'complete'; 
        $this->db->where(array('orderid' => $orderid));
        $this->db->update('tbl_order', $arr);
    }
     
    
    function updateOrderItem()
    {
        $arr['product'] = $this->input->post('name');
       $arr['total'] = $this->input->post('amt');
       $orderid = $this->input->post('orderid');
        $this->db->where(array('orderid' => $orderid));
        $this->db->update('tbl_order', $arr);
    }
    
    
    function getOrderdata($order,$userid)
    {
        $query = $this->db->get_where('tbl_order', array('userid'=>$userid, 'orderid'=>$order));
        return $query->row();

    }
    
    public function insert($table,$data)
     {
     	$this->db->insert($table, $data);
     }
    
    
     function getProductName($id)
    {
        return $this->db->get('product', array('id' => $id,'status'=>1))->row();
    }
    
    
    function getUserInfoDetails($id)
    {
        return $this->db->get('user', array('id' => $id,'status'=>1))->row();
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

    public function get_ip()
		 {

			//Just get the headers if we can or else use the SERVER global
			if ( function_exists( 'apache_request_headers' ) ) {
	
				$headers = apache_request_headers();
	
			} else {
	
				$headers = $_SERVER;
	
			}
	
			//Get the forwarded IP if it exists
			if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
	
				$the_ip = $headers['X-Forwarded-For'];
	
			} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
			) {
	
				$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
	
			} else {
				
				$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
	
			}
	
			return $the_ip;

	}
	
	
	public function saveOrderPayment($data)
     {
     	
        $this->db->insert('tbl_order', $data);
        return $this->db->insert_id();
    
     }
	
	
    function saveSubscribe($arr)
    {
        $this->db->insert('enquiry', $arr);
        return $this->db->insert_id();
    }
    
    function getSingleUserDataById($id)
    {
       return $this->db->get_where('user', array('id' => $id))->row(); 
    }
    
    function getGiftCard()
    {
        $query = $this->db->query("select * from gift");
        return $query->result();
        
    }
    
    function category($cat_type='',$cat_name='')
    {
        $cat_name=str_replace(' ','-',$cat_name);
        
        if($cat_type=='cat'){
            $sql="select id ,category from category where url='".$cat_name."'";
            $query = $this->db->query($sql); 

		return $query->result();
        }
        
        
        
        //return $this->db->get_where('category', array('id' => $id,'menu' => $m))->row();
        
    }
    
    function getMenuId1($id)
    {
      return $this->db->get_where('menu', array('url' => $id))->row();  
    }
    
    function getMenuCategory($id)
    {
      return $this->db->get_where('category', array('url' => $id))->row();  
    }
    
    function getMenuIdByUrl($id)
    {
      return $this->db->get_where('menu', array('url' => $id))->row();  
    }
    
    
    function getProductByMenuIdCategoryIdChildData($ccid)
    {
        $query = $this->db->query("select * from product where childcategory='$ccid'");
        return $query->result();
        
    }
    
    function getProductByMenuIdCategoryIdData($sid)
    {
        $query = $this->db->query("select * from product where subcategory='$sid'");
        return $query->result();
        
    }
    
    function getProductByMenuIdCategoryId($mid,$cid)
    {
        $query = $this->db->query("select * from product where menu='$mid' AND category='$cid'");
        return $query->result();
        
    }
    
    
    
    function getBotumCatIdByMenu($id)
    {
        $query = $this->db->query("select * from category where menu='$id' ");
        return $query->result();
        
    }
    

    function getRatingData($id)
    {
        $query = $this->db->query("select * from review ORDER BY stars $id ");
        return $query->result();
    }
    
    
    function getBannerPosition12ByMenu($id)
    {
        $type = 'Position12';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' AND menu ='$id'");
        return $query->result();
    }
    
    public  function getAlldata($sql)
    {
	$qr = $this->db->query($sql);
	return $qr->result();
    }
    
    function ratingDataList($id)
    {
        
        $query = $this->db->query("SELECT *,product.product,product.product_url,product.retail,product.mrp,product.fimage,product.set_offer FROM review INNER JOIN product ON review.proid = product.id ORDER BY review.stars $id");
        $output = '<div id="productfilter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><span>(3)</span></div></div></a></div>';
        }
        return $output;
    }
    
    
    
    
     
    
    
    function fetchlowDataListCat($id)
    {
        $query = $this->db->query("select * from product where category in ($id) ORDER BY retail ASC ");
        $output = '<div id="lowfilter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
        }
        return $output;
    }
    
    function fetchhighDataListCat($id)
    {
         
        $query = $this->db->query("select * from product where category in ($id) ORDER BY retail DESC ");
        $output = '<div id="lowfilter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
        }
        return $output;
    }
    
    
    
    function fetchlowDataList($id)
    {
        $query = $this->db->query("select * from product where childcategory in ($id) ORDER BY retail ASC ");
        $output = '<div id="lowfilter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
        }
        return $output;
    }
    
    function fetchhighDataList($id)
    {
         
        $query = $this->db->query("select * from product where childcategory in ($id) ORDER BY retail DESC ");
        $output = '<div id="lowfilter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
        }
        return $output;
    }
    
    function fetchFilterDataListByChiltCategory($brand_filter)
    {
        //$this->db->where('id', $id);
        $query = $this->db->query("select * from product where childcategory IN('".$brand_filter."') ");
        $output = '<div id="productfilter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
        }
        return $output;
    }
    
    function getchildCategoryById($id)
    {
        $query = $this->db->query("select * from child_category where subcategory='$id' ");
        return $query->result();
        
    }
    
    
    function fetchPopularDataList()
    {
        //$this->db->where('id', $id);
        $query = $this->db->query("select * from tbl_order");
        $output = '<div id="filter"></div>';
        foreach($query->result() as $p)
        {
            
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->image.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->orderid.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->orderid.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->retail.'</del></span><span class="prc1">$'.$p->price.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
       
        
        }
        return $output;
    }
   
    function fetchFilterDataList($id)
    {
        //$this->db->where('id', $id);
        $query = $this->db->query("select * from product where offer='$id' ");
        $output = '<div id="filter"></div>';
        foreach($query->result() as $p)
        {
            $output .= '<div class="col-md-4 itm1"><a href="'.base_url().'home/productdetail/'.$p->product_url.'"><div class="catgry-bxs"><figure class="effect-hera"><img src="'.base_url().'uploads/'.$p->fimage.'" alt="img17" class="img-responsive" /><figcaption><p><a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="'.$p->id.'"><i class="fa fa-heart" aria-hidden="true"></i></a><a href="javascript:void(0)" class="item-add-to-cart" data-productid="'.$p->id.' "><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></p></figcaption></figure><h3>'.$p->product.' </h3><p><span class="dl-pp"><del>$'.$p->mrp.'</del></span><span class="prc1">$'.$p->retail.'</span> <span class="css-prqx0k">'.$p->set_offer.'</span></p><div class="rating-box-mn"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><span>(49856)</span></div></div></a></div>';
        }
        return $output;
    }
    
     function getId($url)
    {
        return $this->db->get('product', array('product_url' => $url))->row();
    }
    
    function getproductIdByUrl($url)
    {
        return $this->db->get('product', array('product_url' => $url))->row();
    }
    
    
    function getReviewById($id)
    {
        $query = $this->db->query("select sum(stars) AS Total from review where proid='$id' ");
        return $query->result();
        
    }
    
    function getAllReviewImageById($id)
    {
        $query = $this->db->query("select * from review where proid='$id' ");
        return $query->result();
        
    }
    
    function checkPincode($ct)
	{
		return $this->db->get_where('pincode',array('pincode'=>$ct))->row();
	}
    
    function getProductId($url)
    {
        return $this->db->get('product', array('product_url' => $url))->row();
    }
    
    function getMultipleCategoryImageById($id)
    {
        $query = $this->db->query("select * from bannerimage where category='$id' ");
        return $query->result();
    }
    
    function getProductMultipleImagesByProductId($id)
    {
        $query = $this->db->query("select * from productimage where pro_id='$id' ");
        return $query->result();
    }
    
    function getproctFilterByGroup($prid)
    {
        $query = $this->db->query("SELECT * from product where id ='$prid'");
        $output = '<div id="srch"></div>';
        foreach ($query->result() as $p) {
            $output .= '<div class="product_column"><div class="product_img"><a href="' . home / productdetail . '/' . $p->product_url . '"> <img src="' . base_url('uploads/' . $p->image) . '" alt="Product"> </a> </div><div class="product_content"> <div class="content"> <h4><i class="fas fa-book"></i><a href="' . home / productdetail . '/' . $p->product_url . '">' . $p->product . '</a></h4> </div><div class="price_area"> <ul class="pricing"> <li class="price"><span class="symbol">&#8377;</span> <span class="cost">' . $p->price . '</span></li><li class="addto"> <div class="addtoCart"> <a href="javascript:void(0)" data-bs-toggle="tooltip" class="item-add-to-cart" data-productid="' . $p->id . '" data-bs-html="true" title="Add to Cart"> <i class="fas fa-shopping-cart"></i> Add to cart </a> </div> </li></ul> </div></div></div>';
        }
        return $output;

    }


    function  getDataByFilterId($key)
    {
        return $this->db->get('group2', array('id' => $key))->row();
    }

    function  getDataByFilterId111($key)
    {
        return $this->db->get('group3', array('id' => $key))->row();
    }


    function  getDataByFilterId11($key)
    {
        return $this->db->get('multico', array('id' => $key))->row();
    }


    function filterGroupDataByNameGroupTable($id)
    {
        $this->db->select('multico.subcategory,multico.id,fitergroup.filtergroup');
        $this->db->from('multico');
        $this->db->join('product', 'product.id = multico.productid');
        $this->db->join('fitergroup', 'fitergroup.id = multico.filtergroup');
        $this->db->group_by('multico.filtergroup');
        $this->db->where('product.id', $id);

        return $query = $this->db->get()->result();


    }


    function filterGroupDataById($id)
    {
        $this->db->select('multico.subcategory,multico.id,fitergroup.filtergroup');
        $this->db->from('multico');
        $this->db->join('product', 'product.id = multico.productid');
        $this->db->join('fitergroup', 'fitergroup.id = multico.filtergroup');
        $this->db->where('product.id', $id);

        return $query = $this->db->get()->result();


    }


    function filterGroupDataByNameGroupTable2($id)
    {
        $query = $this->db->query("SELECT product.id,fitergroup.filtergroup FROM group2 INNER JOIN product ON product.id=group2.productid INNER JOIN fitergroup ON fitergroup.id=group2.filtergroup2 WHERE group2.productid='$id' GROUP BY group2.productid ");
        return $query->result();


    }


    function filterGroupDataById2($id)
    {
        $this->db->select('group2.filtername2,group2.filtergroup2,group2.id,fitergroup.filtergroup');
        $this->db->from('group2');
        $this->db->join('product', 'product.id = group2.productid');
        $this->db->join('fitergroup', 'fitergroup.id = group2.filtergroup2');
        $this->db->where('product.id', $id);
        return $query = $this->db->get()->result();
    }


    function filterGroupDataByNameGroupTable3($id)
    {

        $query = $this->db->query("SELECT product.id,fitergroup.filtergroup FROM group3 INNER JOIN product ON product.id=group3.productid INNER JOIN fitergroup ON fitergroup.id=group3.filtergroup3 WHERE group3.productid='$id' GROUP BY group3.productid");
        return $query->result();

    }


    function filterGroupDataById3($id)
    {
        $this->db->select('group3.filtername3,group3.id,fitergroup.filtergroup');
        $this->db->from('group3');
        $this->db->join('product', 'product.id = group3.productid');
        $this->db->join('fitergroup', 'fitergroup.id = group3.filtergroup3');
        $this->db->where('product.id', $id);

        return $query = $this->db->get()->result();


    }

    function searchAllSchoolData($keyword)
    {
        $this->db->where("(`school_name` LIKE '%$keyword%'");
        $this->db->or_where("`state` LIKE '%$keyword%')");
        $query = $this->db->get('school');

        return $query->result();
    }


    function searchAllData($keyword)
    {

        $this->db->where("(`product` LIKE '%$keyword%')");
        /*$this->db->or_where("`price` LIKE '%$keyword%'");
        $this->db->or_where("`state` LIKE '%$keyword%')");*/
        $query = $this->db->get('product');

        return $query->result();
    }
    
    function updateCheckoutData($userid, $arr)
    {
       $this->db->where(array('id' => $userid));
        $this->db->update('user', $arr); 
    }

    function updateUserInfo($userid)
    {

        $arr['fname'] = $this->input->post('firstname');
        $arr['lname'] = $this->input->post('lastname');
        $arr['email'] = $this->input->post('email');
        $arr['phone'] = $this->input->post('phone');
        $arr['school_name'] = $this->input->post('school_name');
        $arr['school_address'] = $this->input->post('school_address');
        $arr['student_addmission'] = $this->input->post('student_addmission');
        $arr['city'] = $this->input->post('street_address');
        $arr['fname'] = $this->input->post('city');
        $arr['city'] = $this->input->post('city');
        $arr['shipp_state'] = $this->input->post('state');
        $arr['pincode'] = $this->input->post('pincode');
        $arr['des'] = $this->input->post('des');

        $this->db->where(array('id' => $userid));
        $this->db->update('user', $arr);
    }


    function getAboutUs()
    {
        $type = 'About';
        return $this->db->get_where('about', array('type' => $type))->row();
    }

    function getBannerPosition1()
    {
        $type = 'Position1';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }


    function getBannerPosition2Menu($id)
    {
        $type = 'Position2';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' AND menu='$id'");
        return $query->result();
    }



    function getBannerPosition2()
    {
        $type = 'Position2';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition3()
    {
        $type = 'Position3';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition4()
    {
        $type = 'Position4';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }


    function getBannerPosition5Menu($id)
    {
        $type = 'Position5';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' AND menu ='$id'");
        return $query->result();
    }
    
    
    
    function getBannerPosition5()
    {
        $type = 'Position5';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition6()
    {
        $type = 'Position6';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition7()
    {
        $type = 'Position7';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition8()
    {
        $type = 'Position8';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition9()
    {
        $type = 'Position9';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition10()
    {
        $type = 'Position10';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition11()
    {
        $type = 'Position11';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition12()
    {
        $type = 'Position12';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition13()
    {
        $type = 'Position13';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition14()
    {
        $type = 'Position14';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition15()
    {
        $type = 'Position15';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition16()
    {
        $type = 'Position16';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition17()
    {
        $type = 'Position17';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }
    
    
    function getMenuCategorySubByChild($url)
    {
        return $this->db->get_where('child_category', array('url' => $url))->row();
    }
    
    function getMenuCategoryBySub($url)
    {
        return $this->db->get_where('subcategory', array('url' => $url))->row();
    }  
      
    function getMenuByCatData($url)
    {
        return $this->db->get_where('category', array('url' => $url))->row();
    }
    
    
    function getChildCategorySingleIdByUrl($url)
    {
        return $this->db->get_where('child_category', array('url' => $url))->row();
    }
    
    function getCategoryIdByUrl($url)
    {
        return $this->db->get_where('category', array('url' => $url))->row();
    }
    
    function getSubCategoryIdByUrl($url)
    {
        return $this->db->get_where('category', array('url' => $url))->row();
    }
    
    function getSubCategoryIdByUrlDataListByFilter($url)
    {
        return $this->db->get_where('subcategory', array('url' => $url))->row();
    }
    
    function getSubCategoryIdByUrlDataList($url)
    {
        return $this->db->get_where('subcategory', array('url' => $url))->row();
    }
    
    function getChildCategoryIdByUrl($url)
    {
        return $this->db->get_where('child_category', array('url' => $url))->row();
    }
    
    function getCategoryChildIdByUrl($url)
    {
        return $this->db->get_where('child_category', array('url' => $url))->row();
    }

    function getMenuId($url)
    {
        return $this->db->get_where('menu', array('url' => $url))->row();
    }

    function getAllBannerCat($id)
    {

        $query = $this->db->query("select * from banner where menu='$id' ");
        return $query->result();
    }

    function getAllBanner()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('banner')->result();
    }

    function getCategory()
    {
        $this->db->order_by('id ASC');
        return $this->db->get('category')->result();
    }
    
    
    function getProductBySubcategoryurl($id)
    {
        $query = $this->db->query("select * from product where childcategory='$id' ");
        return $query->result();
    }
    
    
    function getProductByChildCategoryurl($id)
    {
        $query = $this->db->query("select * from product where childcategory='$id' ");
        return $query->result();
    }
    
    function getProductByurl($id)
    {
        $query = $this->db->query("select * from product where category='$id' ");
        return $query->result();
    }
    
    
    function getRelatedProductBYId($url)
    { 
        $query = $this->db->query("select * from product where  product_url!= '$url' order by category DESC ");
        return $query->result(); 
    }
    
    function userinfodetail($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row();
    }
    
    function checOTP($id)
    {
        return $this->db->get_where('user', array('otp' => $id))->row();
    }
     
     function checkWishListProductById($id)
    {
        return $this->db->get_where('wishlist', array('product_id' => $id))->row();
    }
     
    function getBottomCategoryByUrl($url)
    {
        /*$query = $this->db->query("select * from category where cat_type='$type' ");
        return $query->result();*/
        return $this->db->get_where('category', array('url' => $url))->row();
    }



    function getBottomCategoryByMenu($id)
    {
       // $type = 'Bottum';
        $query = $this->db->query("select * from category where menu='$id' ");
        return $query->result();
    }


    function getCategoryDataById($id)
    {
        
        $query = $this->db->query("select * from category where menu='$id' ");
        return $query->result();
    }

    function getBottomCategory()
    {
        $type = 'Bottum';
        $query = $this->db->query("select * from category where cat_type='$type' ");
        return $query->result();
    }
    
    function getMenu()
    {
        
        $query = $this->db->query("select * from menu ");
        return $query->result();
    }
    
    

    function getTopCategory()
    {
        
        $query = $this->db->query("select * from menu ");
        return $query->result();
    }

    function getSubCategory()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('subcategory')->result();
    }

    function getBlog()
    {
        $this->db->order_by('id DESC');
        $this->db->limit('3');
        return $this->db->get('offer')->result();
    }

    function getTestimonial()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('testimonial')->result();
    }


    function getWishLishData()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('wishlist')->result();
    }


    function fetchFilterGroupDataName($filtergroup)
    {
        $this->db->where('groupname', $filtergroup);
        $query = $this->db->get('subcategory');
        $output = '<option value="">Select Filter Name</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->filtername . '</option>';
        }
        return $output;
    }


    function  getGroupFilter()
    {
        $query = $this->db->query("select * from product ");
        return $query->result();

    }

    function getsRowData($proId)
    {
        /*$query = $this->db->query("select * from product where id='$proId'");
        return $query->result();*/

        return $this->db->get_where('product', array('id' => $proId))->row();

    }

    function getProduct($id)
    {
        $query = $this->db->query("select * from product where category='$id' limit 0,12");
        return $query->result();

    }

    function getSingleProduct()
    {
        $query = $this->db->query("select * from product order by id DESC limit 1");
        return $query->result();

    }



    function getAllProductListByMenu($id)
    {
        $query = $this->db->query("select * from product where menu ='$id' order by id desc limit 0,16");
        return $query->result();

    }




    function getAllProductList()
    {
        $query = $this->db->query("select * from product order by id DESC limit 0,16");
        return $query->result();

    }



    function getCartValeu($id)
    {
        $query = $this->db->query("SELECT cart.id,cart.session_id,product.product,product.price,product.image,cart.qty FROM `cart`INNER JOIN product ON cart.product_id=product.id where cart.session_id='$id' ");
        return $query->result();

    }


    function getCategoryByUrl($url)
    {

        return $this->db->get_where('category', array('url' => $url))->row();

    }

    function getproductyByUrl($url)
    {
        /*$query = $this->db->query("select * from product where product_url='$url'");
        return $query->result();*/
        return $this->db->get_where('product', array('product_url' => $url))->row();


    }

    function getProductByCategoryId($id)
    {
        $query = $this->db->query("select * from product where category='$id'");
        return $query->result();

    }

    function getRelatedProduct($id)
    {
        $query = $this->db->query("select * from product where category='$id'");
        return $query->result();

    }

    function getProductImages($id)
    {
        $query = $this->db->query("select * from productimage where pro_id='$id'");
        return $query->result();

    }

    function getProductBySubcategoryId($id)
    {
        $query = $this->db->query("select * from product where subcategory='$id'");
        return $query->result();

    }

    function getSubCategoryByUrl($url)
    {

        return $this->db->get_where('subcategory', array('url' => $url))->row();

    }
    
    function getIUserInfoDataList($id)
    {

        return $this->db->get_where('user', array('id' => $id))->row();

    }

    function getSubCategoryById($id)
    {
        $query = $this->db->query("select * from subcategory where category='$id'");
        return $query->result();

    }


    function getAlllCategory()
    {
        $query = $this->db->query("select * from category");
        return $query->result();

    }

    function getOrderByid($userid)
    {

        $this->db->select('tbl_order.firstname,tbl_order.state,tbl_order.firstname,user.name,user.phone,user.street_address,tbl_order.product_url,tbl_order.product,tbl_order.price,tbl_order.shipping_charge,tbl_order.image');
        $this->db->from('tbl_order');
        $this->db->where('tbl_order.status', 1);
        $this->db->join('user', 'tbl_order.userid =user.id ', 'inner');
        $query = $this->db->get();
        return $query->result();

        /*  return $query = $this->db->get()->result();*/


    }
    
    function saveEmailPhone()
    {
        $arrphone['phone']= $this->input->post('email');
        $arremail['email']= $this->input->post('email');
        
        if(!empty($arremail)){
         $this->db->insert('user', $arremail);
        return $this->db->insert_id();  
        }
        elseif(!empty($arrphone))
        {
        $this->db->insert('user', $arrphone);
        return $this->db->insert_id(); 
        }
        else
        {
            echo "No Data Found";
        }
        
    }
    
    function saveUserEmailId($arr)
    {
       $this->db->insert('user', $arr);
        return $this->db->insert_id(); 
    }
    
    function saveUserPhoneNo($arr)
    {
       $this->db->insert('user', $arr);
        return $this->db->insert_id(); 
    }
    
    function saveRegisterNewUser($arr)
    {
        $this->db->insert('user', $arr);
        return $this->db->insert_id(); 
    }
    
    function updateCartItem($id)
    {
        $arr['qty'] = $this->input->post('qty');

        $this->db->where(array('id' => $id));
        $this->db->update('cart', $arr);
    }
    
    function updateUserInfoDataListByUserId($id)
    {
        
        $arr['street_no'] = $this->input->post('street_no');
        $arr['state'] = $this->input->post('state');
        $arr['city'] = $this->input->post('city');
        $arr['pincode']  = $this->input->post('pincode');
        
        $this->db->where(array('id' => $id));
        $this->db->update('user', $arr);
    }
    
    
    function updateUserInfoDataList($id)
    {
        
        $arr['fname'] = $this->input->post('fname');
        $arr['gender'] = $this->input->post('gender');
        $arr['email'] = $this->input->post('email');
        $arr['phone']  = $this->input->post('phone');
        
        $this->db->where(array('id' => $id));
        $this->db->update('user', $arr);
    }
    
    
    
    function updateUserInfoData($id)
    {
        
        $arr['email']= $this->input->post('email');
        $arr['password']= $this->input->post('password');
        
        $this->db->where(array('id' => $id));
        $this->db->update('user', $arr);
    }
    
    function registerUser($id)
    {
        $insert['name'] =$this->input->post('name');
        $insert['email'] =$this->input->post('emailreg');
        $insert['phone'] =$this->input->post('mobile');
        $insert['password'] =$this->input->post('password');
        
        $this->db->where(array('id' => $id));
        $this->db->update('user', $insert);
    }

    function updateAccountDetail($id)
    {
        $arr['fname'] = $this->input->post('fname');
        $arr['lname'] = $this->input->post('lname');
        $arr['name'] = $this->input->post('name');
        $arr['email'] = $this->input->post('email');
        $arr['phone'] = $this->input->post('phone');
        $arr['street_address'] = $this->input->post('street_address');

        $arr['state'] = $this->input->post('state');

        $arr['city'] = $this->input->post('city');

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = APPPATH . '../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                $this->resize_image(APPPATH . '../uploads/' . $arr['image'], 900);
                $this->createThumbnail(PPPATH . '../uploads/' . $arr['image'], APPPATH . '../uploads/thumbnail/' . $arr['image'], 400, 300);
                //$arr['image'] =
            }
        }
        $this->db->where(array('id' => $id));
        $this->db->update('user', $arr);
    }

    function resize_image($source, $width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    function createThumbnail($source, $destination, $width, $height)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    
    public function checkotp($otp)
    {
        $query = $this->db->get_where('user', array('otp' => $otp));
        return $query->row();
    }
    
    public function checkPhone($phone)
    {
        $query = $this->db->get_where('user', array('phone' => $phone));
        return $query->row();
    }
    
    public function checkEmailId($phone)
    {
        $query = $this->db->query("SELECT * FROM user WHERE  phone='$phone'");
        return $query->row();
    }
     
    public function logingUserByMobile($phone, $pass)
    {
        $query = $this->db->get_where('user', array('phone' => $phone, 'password' => $pass, 'status' => 1));
        return $query->row();
    }
    
    public function logingUserByEmailData($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        return $query->row();
    }
    
    public function logingUserByEmailMobile($phone,$otp,$password)
    {
        /*$otp= $this->input->post('otp');
        $password= $this->input->post('password');*/
        
        $query = $this->db->get_where('user', array('phone' => $phone, 'password' => $password, 'otp' => $otp));
        return $query->row();
    }
    
    public function logingUserOTp($email, $pass)
    {
        $query = $this->db->get_where('user', array('phone' => $email, 'otp' => $pass, 'status' => 1));
        return $query->row();
    }
    
    function getAllOrderDataList($id)
    {
         $query = $this->db->query("SELECT * FROM tbl_order where userid ='$id' AND status='pending'");
        return $query->result();
    }
    
    function getAllCancellOrderDataList($id)
    {
         $query = $this->db->query("SELECT * FROM tbl_order where userid ='$id' AND status='cancel'");
        return $query->result();
    }

    
    function getAllReturnOrderDataList($id)
    {
         $query = $this->db->query("SELECT * FROM tbl_order where userid ='$id' AND status='return'");
        return $query->result();
    }
    
    
    public function logingUser($email, $pass)
    {
        $query = $this->db->get_where('user', array('email' => $email, 'password' => $pass, 'status' => 1));
        return $query->row();
    }
    
    function getAllUserList($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row();
    }
    function getUserDataById($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row();
    }

    function checkUser($email)
    {
        return $this->db->get_where('user', array('email' => $email))->row();

    }


    function getEmailPassword($email)
    {
        return $this->db->get_where('user', array('email' => $email))->row();
    }


    function getWishList()
    {
        return $this->db->get('wishlist')->result();
    }


    function checkCartItems()
    {
        return $this->db->get('temp_cart')->result();
    }

    function deleteCartItem($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('cart');
    }

    function deleteWishItem($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wishlist');
    }

    function getCartItemValues()
    {
        /*$this->db->order_by('id DESC');
        return $this->db->get('cart')->result();*/
         $query = $this->db->query("SELECT * FROM cart limit 2");
        return $query->result();
    }

    function countTotalCart()
    {
        $query = $this->db->query("SELECT SUM(retail) AS Total FROM cart");
        return $query->result();
    }






    function  getSessionId()
    {
        return $this->db->get('cart', array('status' => 0))->row();
    }


    function totalCartItem()
    {
        $query = $this->db->query("SELECT count(id) AS Total FROM cart");
        $output = '<div id="cart"></div>';
        foreach ($query->result() as $v) {

            $output .= '<span class="notification_count" id="go-to-basket">' . $v->Total . '</span>';
        }
        return $output;
    }

    function deleteWishList($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wishlist');
    }
    
    function deleteWishListDataList($table_name,$where_array){        
        $result = $this->db->delete($table_name,$where_array);
        return $result;
    }
    
    
    function deleteCartItems($table_name,$where_array){        
        $result = $this->db->delete($table_name,$where_array);
        return $result;
    }
 
    /*function deleteCartItems($id)
    {
        $this->db->where('orderid', $id);
        $this->db->delete('tbl_order');
    }*/


    /*function deleteCartItemsEmpty($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('temp_cart');
    }*/


    function finalOrder()
    {
        /* return $this->db->get('cart')->result();*/

        $this->db->select('tbl_order.firstname,tbl_order.state,tbl_order.firstname,user.name,user.phone,user.street_address,tbl_order.product_url,tbl_order.product,tbl_order.price,tbl_order.shipping_charge,tbl_order.image');
        $this->db->from('tbl_order');
        $this->db->where('tbl_order.status', 1);
        $this->db->join('user', 'tbl_order.userid =user.id ', 'inner');
        /*  $this->db->join ( 'product', 'tbl_order.orderid  = product.id' , 'inner' );*/
        $query = $this->db->get();
        return $query->result();


    }


    function matchPriceByState($state)
    {
        $this->db->where('state', $state);
        $query = $this->db->get('product');

        $output = '<div id="shipp"></div>';


        foreach ($query->result() as $pro) {

            $output .= '<p>' . $pro->state . '</p>';

        }
        return $output;
    }
    
    function saveRegisterUser($tablename,$data)
    {
      $this->db->insert($tablename, $data);
        return $this->db->insert_id();  
    }
    
    function savePhone($tablename,$data)
    {
      $this->db->insert($tablename, $data);
        return $this->db->insert_id();  
    }
    
    function saveEmail($tablename,$data)
    {
      $this->db->insert($tablename, $data);
        return $this->db->insert_id();  
    }
     
    function saveReview($tablename,$data)
    {
       $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    } 
    
    function saveCheckoutData($tablename,$data)
    {
         $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }

    function saveOrder($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveWishlist($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveCartItem($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveCart($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }

    function  getAllStreming()
    {
        return $this->db->get('streming')->result();
    }

    function  getAllClass()
    {
        return $this->db->get('classes')->result();
    }

    function  getAllLanguage()
    {
        return $this->db->get('language')->result();
    }

    function  getAllSubject()
    {
        return $this->db->get('subject')->result();
    }

    function  getAllRelatedProduct($id)
    {
        $query = $this->db->query("select * from product where id!='$id' order by id");
        return $query->result();

    }

    function  getAllProduct($id)
    {
        $query = $this->db->query("select * from product where class_name='$id' order by id");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }


        //return $query->result();

    }

    function  getProductCategoryIdBYUrl($url)
    {
        return $this->db->get_where('product', array('product_url' => $url))->row();
    }

    function  getAllClassNameByProduct($id)
    {
        return $this->db->get_where('classes', array('class_name' => $id))->row();
    }

    function  getAllProductByClass($url)
    {
        return $this->db->get_where('product', array('product_url' => $url))->row();
    }

    function  getsuibCategoryByCatId($id)
    {
        $query = $this->db->query("select * from subcategory where category='$id' ");
        return $query->result();
    }
    
    function  getChildCategoryBySubCategoryId($id)
    {
        $query = $this->db->query("select * from child_category where subcategory='$id' ");
        return $query->result();
    }
 

    function getproId($id)
    {
        return $this->db->get_where('product', array('class_name' => $id))->row();
    }


    function getproIdByUrl($id)
    {
        return $this->db->get_where('product', array('product_url' => $id))->row();
    }

    function getAllWishListProductList()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('wishlist')->result();
         /*$query = $this->db->query("SELECT * FROM cart limit 2");
        return $query->result();*/
    }
    
    
}