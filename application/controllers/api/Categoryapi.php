<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Categoryapi extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Categoryapi_Model','catapi_model', true);
    }
    
    
    function categorylist_post()
    {
        $id = $this->input->post('mid');
        $gates = $this->catapi_model->getAllCategoryByMenu($id);
        
          
        if($gates)
        {
            
             $this->response([
                    'All Category By Gates' => $gates
                ], REST_Controller::HTTP_OK);
                
                
        }

        else
        {
            $this->response(NULL, 404);
        }
    } 
    
    
    function gates_get()
    {
        

        $gates = $this->catapi_model->getAllMenu();
        
          
        if($gates)
        {
            
             $this->response([
                    'All Gates' => $gates
                ], REST_Controller::HTTP_OK);
                
                
        }

        else
        {
            $this->response(NULL, 404);
        }
    } 
    
    
    
    function childcategory_post()
    {
        $mid = $this->input->post('mid');
        $id = $this->input->post('cid');
        $sbid = $this->input->post('sbid');

        $user = $this->catapi_model->getAllChildCategoryList($mid,$id,$sbid);

        if($user)
        {
            
             $this->response([
                    'All Subcategory' => $user
                ], REST_Controller::HTTP_OK);// 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
     function subcategory_post()
    {
        $mid = $this->input->post('mid');
        $id = $this->input->post('id');

        $user = $this->catapi_model->getAllSubCategory($mid,$id);

        if($user)
        {
            
             $this->response([
                    'All Subcategory' => $user
                ], REST_Controller::HTTP_OK);// 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    function categorygats_backup_get()
    {
        
        $user = $this->catapi_model->getAllMenu();
        
        $ress = array( "Menu" => $user );

        $satatuss = json_encode($ress);
        echo $satatuss;
        
        foreach($user as $u){
        
         $user1 = $this->catapi_model->getAllMenuCategory($u->id);
        
        $ress1 = array( "Category" => $user1 );

        $satatuss1 = json_encode($ress1);
        echo $satatuss1;
        
        
        foreach($user1 as $u1){
            
       $user2 = $this->catapi_model->getAllMenuSubCategory($u1->id);
        
        $ress2 = array( "SubCategory" => $user2 );
 
        $satatuss2 = json_encode($ress2);
        echo $satatuss2;
        
        
        
        foreach($user2 as $u2){
           
       $user3 = $this->catapi_model->getAllMenuChildCategory($u2->id);
       
       
        $ress3 = array("ChildCategory" => $user3 );
 
        $satatuss3 = json_encode($ress3);
        echo $satatuss3;
        
        }
        
        }
        
        
        
        
        }
        
    }
    
    function categoryv1_get()
    {
        

        $user = $this->catapi_model->getAllCat();
        
          
        if($user)
        {
            
             $this->response([
                    'status' => TRUE,
                    'data' => $user
                ], REST_Controller::HTTP_OK);
                
                
        }

        else
        {
            $this->response(NULL, 404);
        }
    } 

    function category_get()
    {
        

        $user = $this->catapi_model->getAll();
        
          
        if($user)
        {
            
             $this->response([
                    'status' => TRUE,
                    'data' => $user
                ], REST_Controller::HTTP_OK);
                
                
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

   

   /* function childcategory_get()
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
    }*/


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
            $insert = $this->user_model->insert($arr);
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
            $delete=$this->use_model->delete($id);
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