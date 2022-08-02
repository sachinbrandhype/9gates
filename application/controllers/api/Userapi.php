<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Userapi extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model','user_model', true);
    } 
    
    function editprofile_put()
    {
        //$arr[] = array();
        $id=$this->put('user_id');
       // $arr['user_id'] = $this->put('user_id');
        $arr['address'] = $this->put('address');
        $arr['fname'] = $this->put('fname');
        $arr['lname'] = $this->put('lname');
        $arr['email'] = $this->put('email');
        $arr['phone'] = $this->put('phone');
        $arr['country'] = $this->put('country');
        $arr['state'] = $this->put('state');
        $arr['city'] = $this->put('city');
        $arr['pincode'] = $this->put('pincode');
        $arr['gender'] = $this->put('gender');
        $arr['longitude'] = $this->put('longitude');
        $arr['latitude'] = $this->put('latitude');
        $arr['geo_location'] = $this->put('geo_location');

        
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
    
    
    function useraddress_post()
    {
        $arr['user_id'] = $this->post('user_id');
        $arr['address'] = $this->post('address');
        $arr['fname'] = $this->post('fname');
        $arr['lname'] = $this->post('lname');
        $arr['email'] = $this->post('email');
        $arr['phone'] = $this->post('phone');
        $arr['country'] = $this->post('country');
        $arr['state'] = $this->post('state');
        $arr['city'] = $this->post('city');
        $arr['pincode'] = $this->post('pincode');
        $arr['gender'] = $this->post('gender');
        $arr['longitude'] = $this->post('longitude');
        $arr['latitude'] = $this->post('latitude');
        $arr['geo_location'] = $this->post('geo_location');
        $save = $this->user_model->saveUserAddress($arr);

        if($save)
        {
           $this->response([
                    'Address'=>'New save  address',
                    'data' => $save
                ],REST_Controller::HTTP_OK);
        }

        else
        {
           $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
        }

    }
    
    function addresslist_get()
    {
        $users = $this->user_model->getAllAddress();

        if($users)
        {
            $this->response($users, 200);
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    function useraddress1111_post()
    {
        $arr['user_id'] = $this->post('user_id');
        $arr['address'] = $this->post('address');
        $arr['fname'] = $this->post('fname');
        $arr['lname'] = $this->post('lname');
        $arr['email'] = $this->post('email');
        $arr['phone'] = $this->post('phone');
        $arr['country'] = $this->post('country');
        $arr['state'] = $this->post('state');
        $arr['city'] = $this->post('city');
        $arr['pincode'] = $this->post('pincode');
        $arr['gender'] = $this->post('gender');
        $arr['longitude'] = $this->post('longitude');
        $arr['latitude'] = $this->post('latitude');
        $arr['geo_location'] = $this->post('geo_location');
        $save = $this->user_model->saveUserAddress($arr);

        if($save)
        {
           $this->response([
                    'Address'=>'New save  address',
                    'data' => $save
                ],REST_Controller::HTTP_OK);
        }

        else
        {
           $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
        }

    }
    
    
    function useraddressremove_delete()
    {
        $id = $this->post('id');
        if($id)
        {
            $delete=$this->user_model->removeAddress($id);
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
    
    
    public function googleapi_post()
    {
        $data = array();
        $google_id = $this->post('google_id');
        $email = $this->post('email');
        $data['fname'] = $this->post('first_name');
        $data['lname'] = $this->post('last_name');
        $data['email'] = $this->post('email');
        $data['google_id'] = $this->post('google_id');
       $data['image'] = $this->post('image');

        $check = $this->user_model->checkGoogleId($google_id);


        if($check)
        {
            $logingoogleData = $this->user_model->loginbygoogleId($email,$google_id);

            if($logingoogleData)
            {
                $this->response([
                    'message'=>'Login successfully'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
            }

 
        }
        else
        {
            $googleData = $this->user_model->insertGoogleData($data);

            if($googleData)
            {
                $this->response([
                    'message'=>'Data insert successfully'
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
            }
        }

    }
    function user_get($id = 0)
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $user = $this->user_model->getAll( $this->get('id') );

        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }



    function userreg_post()
    {
       
        $arr['email']= $this->post('email');
        //$arr['pkey'] =random_string('nozero', 4);

        if(!empty($arr['email'])  && !empty($arr['pkey']) )
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
        
        
        
        /*$data = array(
           'email' => $this->input->post('email')
           );
           $r = $this->user_model->insert($data);
           $this->response($r); 
        */   
         
        
        
        
        
        
    }
    
    
    
    public function registration_post() {
        // Get the post data
        $name = strip_tags($this->post('name'));
        $email = strip_tags($this->post('email'));
        $password = $this->post('password');
        $phone = strip_tags($this->post('phone'));
         
        // Validate the post data
        if(!empty($name) && !empty($email) && !empty($password) && !empty($phone)){
            
            
                // Insert user data
                $userData = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => md5($password),
                    'phone' => $phone
                );
                $insert = $this->user_model->insert($userData);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'The user has been added successfully.',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
      
    }
    
    

    



    /*function user_post()
    {
        $result = $this->user_model->update( $this->post('id'), array(
            'name' => $this->post('name'),
            'email' => $this->post('email')
        ));

        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }

        else
        {
            $this->response(array('status' => 'success'));
        }

    }*/


    function testapi_get($id = 0)
    {
      $user=$this->user_model->getUserData($id);
        if(!empty($user))
        {
            $this->response($user,REST_Controller::HTTP_OK);
        }
        else{
            $this->response([
                'status'=>FALSE,
                'message'=>'No user found.'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }


    function users_get()
    {
        $users = $this->user_model->get_all();

        if($users)
        {
            $this->response($users, 200);
        }

        else
        {
            $this->response(NULL, 404);
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