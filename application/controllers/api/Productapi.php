<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Productapi extends REST_Controller
{
    
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('ProductAPI_model','productAPI_model', true);
    }
    
    
    function attribute_get()
    {
        
     $check = $this->productAPI_model->getAllAtributes(); 
     $color = $this->productAPI_model->getAllColor();
     $size = $this->productAPI_model->getAllSize();
        
         if(!empty($check)){
            
        $this->response([
            'Attribute ' => $check,
            'Color ' => $color,
            'Size ' => $size
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }   
    }
    
    function producturlshare_post()
    {
         $url = $this->input->post('url');
        $check = $this->productAPI_model->getProductShareUrl($url); 
        
         if(!empty($check)){
            
        $this->response([
            'Product Share url ' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function productfilter_post()
    {
         $mid = $this->input->post('mid');
         $cid = $this->input->post('cid');
        $check = $this->productAPI_model->getProductFilter($mid,$cid); 
        
         if(!empty($check)){
            
        $this->response([
            'Product Filter' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    
    function relatedproduct_post()
    {
         $url = $this->input->post('url');
        $check = $this->productAPI_model->getRelatedProduct($url); 
        
         if(!empty($check)){
            
        $this->response([
            'Related Product' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
     
     
    
    function retunspolicy_get()
     {
        $check = $this->productAPI_model->getReturnPolicy(); 
        
         if(!empty($check)){
            
        $this->response([
            'Returns Policy' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
     }
    
     function termsofuse_get()
     {
        $check = $this->productAPI_model->getTermsofuse(); 
        
         if(!empty($check)){
            
        $this->response([
            'Terms Of Use' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
     }
     
    
    function privacypolicy_get()
     {
        $check = $this->productAPI_model->getPrivacyPolicy(); 
        
         if(!empty($check)){
            
        $this->response([
            'Privacy Policy' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
     }
     
     
     function ordercancellation_get()
     {
        $check = $this->productAPI_model->getOrderCancellation(); 
        
         if(!empty($check)){
            
        $this->response([
            'Order Cancellation' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
     }
     
    function removecart_delete($id)
    {
       
       if($id)
        {
            $delete=$this->productAPI_model->deleteCartlist($id);
            if($delete)
            {
                $this->response([
                    'status'=>TRUE,
                    'message'=>'Cart list data has been removed successfully.'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Some problems occurred,please try again ",
                    REST_Controller::HTTP_BAD_REQUEST);

            }
        }
        else
        {
            $this->response([
                'status'=>FALSE,
                'message'=>'cart list data not found.'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    function addtocart_post()
    {
        
        
        $datapro['product_id'] = $this->input->post('proid');
        $datapro['user_id'] = $this->input->post('userid');
        $datapro['product'] = $this->input->post('product');
        $datapro['retail'] = $this->input->post('retail');
        $datapro['price'] = $this->input->post('price');
        $datapro['image'] = $this->input->post('image');
        $datapro['qty'] = $this->input->post('qty');
        $datapro['product_url'] = $this->input->post('product_url');
        $datapro['shipping_charge'] = $this->input->post('shipping_charge');
        $addcartlist = $this->productAPI_model->saveCartList('cart',$datapro);
        if($addcartlist)
        {
            $this->response([
                'Product Add Cart List' => 'ok'
            ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    function removewishlist_delete($id)
    {
       
       if($id)
        {
            $delete=$this->productAPI_model->deletewishlist($id);
            if($delete)
            {
                $this->response([
                    'status'=>TRUE,
                    'message'=>'wish list has been removed successfully.'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Some problems occurred,please try again ",
                    REST_Controller::HTTP_BAD_REQUEST);

            }
        }
        else
        {
            $this->response([
                'status'=>FALSE,
                'message'=>'wish list not found.'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    function addwishlist_post()
    {
        $datapro['product_id'] = $this->input->post('proid');
        $datapro['user_id'] = $this->input->post('userid');
        $datapro['product'] = $this->input->post('product');
        $datapro['retail'] = $this->input->post('retail');
        $datapro['mrp'] = $this->input->post('mrp');
        $datapro['image'] = $this->input->post('image');
    
        $addwishlist = $this->productAPI_model->saveWishList('wishlist',$datapro);
        if($addwishlist)
        {
            $this->response([
                'Add Wish List' => 'ok'
            ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    function wishlist_post()
    {
       $id = $this->input->post('userid');
        $product =$this->productAPI_model->getAllWishList($id);
        
        if($product)
        {
            $this->response([
                    'wish list' => $product
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
     
    function notification_get()
     {
        $check = $this->productAPI_model->getNotification(); 
        
         if(!empty($check)){
            
        $this->response([
            'Notification' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
     }
     
     
    function apptoken_post()
    {
        $arr['appid'] = $this->post('token_id');
        
        $check = $this->productAPI_model->saveAppToken($arr);
        
        if($check){
            
        $this->response([
            'Token inserted' => $check
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
         
    }
    
    
    
    function productv_post()
    {
        $mid = $this->post('mid');
        $cid = $this->post('cid');
        
        if(!empty($mid) && !empty($cid)){
            
        $check = $this->productAPI_model->getProductFataList($mid,$cid);

        $this->response($check, 200);
        }
        
         
        /*    
        $cat = $this->productAPI_model->getCategoryListById($mid);
        
            $ress = array('Category'=>$cat);
        $status  = json_encode($ress);
        echo $status;
        
        
        
        $scat = $this->productAPI_model->getSubCategoryListById($mid,$cid);
        
            $sress = array('Sub Category'=>$scat);
        $sstatus  = json_encode($sress);
        echo $sstatus;
       
       
       
       foreach($scat as $s){
           
            $chcat = $this->productAPI_model->getChildCategoryListById($mid,$cid,$s->id);
        
            $cress = array('Child Category'=>$chcat);
        $cstatus  = json_encode($cress);
        echo $cstatus;
       }*/
         
        
    }
    
    function offerproduct_get()
    {

        $check = $this->productAPI_model->getOfferProduct();

        if($check)
        {
            $this->response([
                'Offer' => $check
            ], REST_Controller::HTTP_OK);
        }


        else
        {
            $this->response(NULL, 404);
        }

    }
     
     
     
     function cancellorder_post()
    {
         $orderid = $this->post('orderid');
        
        $product =$this->productAPI_model->getCancellOrder($orderid);
        
        if(!empty($product))
        {
            $this->response([
                    'Cancell Order' => 'Success'
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
        
    }
     
     
     function orderhistory_post()
    {
         $orderid = $this->post('userid');
        
        $product =$this->productAPI_model->getProductOrderHistory($orderid);
        
        if($product)
        {
            $this->response([
                    'Order History' => $product
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
        
    }
    
    function orderdetail_post()
    {
         $orderid = $this->post('orderid');
        
        $product =$this->productAPI_model->getProductOrder($orderid);
        
        if($product)
        {
            $this->response([
                    'Order Details' => $product
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
        
    }
 

    function reviewinsert_post()
    {
        $datapro['proid'] = $this->input->post('proid');
        $datapro['descripton'] = $this->input->post('descripton');
        $datapro['title'] = $this->input->post('title');
        $datapro['user_id'] = $this->input->post('user_id');
        $datapro['stars'] = $this->input->post('stars');
   
        $order = $this->productAPI_model->saveReviewInsert('review',$datapro);
        if($order)
        {
            $this->response([
                'Review insert' => 'ok'
            ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function review_get()
    {

        $check = $this->productAPI_model->getReview();

        if($check)
        {
            $this->response([
                'Review' => $check
            ], REST_Controller::HTTP_OK);
        }

        /*$ress = array('homeproduct'=>$product);
        $status  = json_encode($ress);
        echo $status;*/


        else
        {
            $this->response(NULL, 404);
        }

    }

    
    
    function productorder_old_post()
    {
            
        $datapro['product_id'] = $this->input->post('product_id');
        $datapro['retail'] = $this->input->post('retail');
        $datapro['total_price'] = $this->input->post('total_price');
        $datapro['userid'] = $this->input->post('userid');
        $datapro['status'] = 0;
   
        $order = $this->productAPI_model->saveOrder('tbl_order',$datapro);
        if($order)
        {
            $this->response('ok', 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function orderbook_post()
    {
        $pid = $this->post('product_id');
        $userid = $this->post('user_id');
        
        $get = $this->productAPI_model->getProductById($pid);
        
        $code = $this->post('coupon_code');
        
        $getDiscount = $this->productAPI_model->getCouponDiscount($code);
        
         $value = $get->retail * $getDiscount->coupon_value/100;
        
      
        
        $orderid = random_int(100000, 999999);
        $data=array('orderid'=>$orderid,
                'product_id'=>$get->id,
                'retail'=>$value,
                'userid'=>$userid
                );
                
        $order = $this->productAPI_model->saveOrder($data);
        if($order)
        {
            $this->response([
                    'Order' => 'Order Successfully',
                    'data' => $order,
                    'Discount' => $getDiscount->coupon_value,
                    'Total price' => $value
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function productorder_post()
    {
         $userid = $this->post('user_id');
        $arr['fname'] = $this->post('fname');
        $arr['lname'] = $this->post('lname');
        $arr['email'] = $this->post('email');
        $arr['street_no'] = $this->post('address');
        $arr['city'] = $this->post('city');
        $arr['state'] = $this->post('state');
        //$arr['password'] = $this->post('password');
        $arr['pincode'] = $this->post('pincode');
        
        /*$address = $this->post('address2');
        if($address=='')
        {
            
         $this->productAPI_model->updateUserInfoData($userid, $arr);
        
        }
        else 
        {
        
        $user_id = $this->post('user_id');
        $address = $this->post('address2');
        
        $chk = $this->productAPI_model->checkNewAddress($user_id,$address);
        
        if(!empty($chk)){*/
        $add['user_id'] = $this->post('user_id');
        $add['fname'] = $this->post('fname');
        $add['lname'] = $this->post('lname');
        $add['email'] = $this->post('email');
        $add['phone'] = $this->post('phone');
        $add['city'] = $this->post('city');
        $add['state'] = $this->post('state');
        $add['country'] = $this->post('country');
        $add['pincode'] = $this->post('pincode');
        $add['address'] = $this->post('address2');
        $add['gender'] = $this->post('gender');
         $this->productAPI_model->saveNewAddress($add);
    
       /* }
        else
        {
        $user_id = $this->post('user_id');
        $arr['address'] = $this->post('address2');
        
        $this->productAPI_model->updateNewAddress($arr,$user_id);
        
        
        }
       
        }*/
         $orderid = random_int(100000, 999999);
        //$datapro['product'] = $this->post('product');
        /*$firstname = $this->post('fname');
        $lastname = $this->post('lname');*/
        
        //$datapro['sku'] = $this->post('sku');
        //$datapro['hsnno'] = $this->post('hsnno');
            
        $product_id = $this->post('product_id');
        $retail = $this->post('retail');
        $total_price = $this->post('total_price');
        $userid = $this->post('user_id');
        //$datapro['status'] = $this->post('status');
        $qty = $this->post('qty');
        
         
         
         $code = $this->post('coupon_code');
        
        $getDiscount = $this->productAPI_model->getCouponDiscount($code);
       
        
         //$value = $total_price * $getDiscount->coupon_value/100;
         
         
         
         
        $data=array('orderid'=>$orderid,
                'product_id'=>$product_id,
                'retail'=>$retail,
                'total_price'=>$total_price,
                'discount'=>$getDiscount->coupon_value,
                'userid'=>$userid,
                'qty'=>$qty
                );
        
        
       
        $order = $this->productAPI_model->saveOrder($data);
        if($order)
        {
            $this->response([
                    'Order' => 'Order Successfully',
                    'data' => $order,
                    'Discount'=>$data
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
    
    }
    
    
    
      function couponcodelist_get()
    {
       
      $check = $this->productAPI_model->getCouponList(); 
      
      if($check)
        {
            $this->response([
                    'Coupon' => 'Couponcode List',
                    'data' => $check
                ], REST_Controller::HTTP_OK);
        }

        else
        {
            $this->response(NULL, 404);
        }
  
     /*$ress = array('Coupon Code List'=>$check);
      $status  = json_encode($ress);
      echo $status;*/
      
     
        
    }
    
    
    
    
    function couponcode_post()
    {
      $cod = $this->input->post('coupon_code');
       
      $check = $this->productAPI_model->getCouponCodeCheck($cod); 
      
      if($check)
      {
         $this->response([
                    'status' => TRUE,
                    'message' => 'Coupon Code is verify.',
                    'data' => $check->coupon_code
                ], REST_Controller::HTTP_OK); 
      }
  
      /*$ress = array('homeproduct'=>$product);
      $status  = json_encode($ress);
      echo $status;*/
      
      if($check)
        {
            $this->response($check, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
        
    }
    
    
    
    
    function homeproduct_get()
    {
      $product = $this->productAPI_model->getHomeProduct();  
  
      /*$ress = array('homeproduct'=>$product);
      $status  = json_encode($ress);
      echo $status;*/
      
      if($product)
        {
            $this->response($product, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
        
    }
    function productdetails_post()
    {
    
        $id = $this->input->post('id');
        $product =$this->productAPI_model->getProductByurl($id);
        
        $pm =$this->productAPI_model->getProductMultipleImage($id); 
        
        
        $check = $this->productAPI_model->getAllAtributes(); 
         $color = $this->productAPI_model->getAllColor();
         $size = $this->productAPI_model->getAllSize();
        
        if($product)
        {
            $this->response([
                    'Details' => $product,
                    'Mulptiple Image' => $pm,
                    'Attribute' => $check,
                    'Color' => $color,
                    'Size' => $size
                ], REST_Controller::HTTP_OK);     
        }

        else
        {
            $this->response(NULL, 404);
        }
        
        
        
    }
    
    function searchproduct_get($id)
    {
       

        $search = $this->productAPI_model->searchAllData($id);
        if($search)
        {
            $this->response($search, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function productdata_get($id)
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $product = $this->productAPI_model->getAllProductById($id);

        if($product)
        {
            $this->response($product, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    function product_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $user = $this->productAPI_model->getAll( $this->get('id') );

        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function subcategory_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $user = $this->catapi_model->getAllSub( $this->get('id') );

        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function childcategory_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $user = $this->catapi_model->getAllChild( $this->get('id') );

        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }



    public function login_post() 
    {
        // Get the post data
        $email = $this->post('email');
        $password = $this->post('password');
       
        // Validate the post data
       
            
            // Check if any user exists with the given credentials
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => $password,
                'status' => 1
            );
           
            $user = $this->productAPI_model->getRows($con);
         
            if($user){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }
              
            
            else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
            }
    }


    function user_post()
    {
        //$arr[] = array();
        $arr['name']=$this->post('name');
        $arr['email']=$this->post('email');
        $arr['phone']=$this->post('phone');
        $arr['address']=$this->post('address');
        $arr['password']=$this->post('password');
        $arr["create_date"]= date("Y-m-d H:i:s");
        $arr["modifi_date"] = date("Y-m-d H:i:s");

        if(!empty($arr['name']) && !empty($arr['email']) && !empty($arr['phone']) && !empty($arr['address']) && !empty($arr['password']) )
        {
            $insert = $this->productAPI_model->insert($arr);
            if($insert)
            {
                $this->response([
                    'status'=>TRUE,
                    'message'=>'Data insert successfully'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    function user_put()
    {
        //$arr[] = array();
        $id=$this->put('id');
        $arr['name']=$this->put('name');
        $arr['email']=$this->put('email');
        $arr['phone']=$this->put('phone');
        $arr['address']=$this->put('address');
        $arr['password']=$this->put('password');

        if(!empty($arr['name']) && !empty($arr['email']) && !empty($arr['phone']) && !empty($arr['address']) && !empty($arr['password']) )
        {
            $update = $this->user_model->update($arr,$id);
            if($update)
            {
                $this->response([
                    'status'=>TRUE,
                    'message'=>'Data updated successfully'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    function user_delete($id)
    {
        if($id)
        {
            $delete=$this->user_model->delete($id);
            if($delete)
            {
                $this->response([
                    'status'=>TRUE,
                    'message'=>'User has been removed successfully.'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Some problems occurred,please try again ",
                    REST_Controller::HTTP_BAD_REQUEST);

            }
        }
        else
        {
            $this->response([
                'status'=>FALSE,
                'message'=>'User not found.'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
?>