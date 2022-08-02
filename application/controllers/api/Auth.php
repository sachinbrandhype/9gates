<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Auth extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model','auth_model', true);
    }





    public function profile_put(){
        //errer_reporting(0);
        $data = array();
           $id = $this->put('id');
           $data['name'] = $this->put('name');
           $data['password'] = $this->put('password');
           $data['email'] = $this->put('email');
           $data['phone'] = $this->put('phone');
           
           if(!empty($data['name']) &&  !empty($data['email']) && !empty($data['password']) && !empty($data['phone'])){
 
           $update = $this->auth_model->updateProfile($data,$id);
           //$this->response($update);
           if($update)
            {
                $this->response([
                    'status'=>TRUE,
                    'message'=>'Data update successfully',
                    'data' => $update
                ],REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response("Something went wrong,please try again later ",REST_Controller::HTTP_BAD_REQUEST);
            }
           
           }
           //$this->response($r); 
       }
    public function loginphone_post() {
        // Get the post data
        //$email = $this->post('email');//'sachin.panchal719@gmail.com';
        $email = $this->post('email');
        $phone = $this->post('phone');
        $password =$this->post('password');//123456;//$this->post('password');
       
        // Validate the post data
            // Check if any user exists with the given credentials
            if(!empty($email)){
            
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => $password,
                'status' => 1
            );
            }
            else {
                
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'phone' => $phone,
                'password' => $password,
                'status' => 1
            );
            }
           
            $user = $this->auth_model->getRows($con);
            
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
    
    public function userlogin_post()
    {
        $email = $this->post('email');
        $phone = $this->post('phone');
        $password =$this->post('password');
        
        $data['email'] = $this->post('email');
        $arr['phone'] = $this->post('phone');
        
        if(!empty($email)){
            
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => $password,
                'status' => 1
            );
            }
            else {
                
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'phone' => $phone,
                'password' => $password,
                'status' => 1
            );
            }
           
            $user = $this->auth_model->getRows($con);
            
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
                $this->response([
                    'status' => TRUE,
                    'message' => 'Wrong email or password.',
                    'data' => Null
                ],REST_Controller::HTTP_BAD_REQUEST); 
                //$this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
            }
    }
    
    
     public function login_post() {
        
        $email = $this->post('email');
        $phone = $this->post('phone');
        $password =$this->post('password');
        
        $data['email'] = $this->post('email');
        $arr['phone'] = $this->post('phone');
        
        
            if(!empty($data['email'])){
            $checkemail = $this->auth_model->checkEmail($email);
            
            if($checkemail){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Email id alredy exit.',
                    'data' => $checkemail
                ], REST_Controller::HTTP_OK);
            }
            else
            {
                
           $insert = $this->auth_model->insertEmail('user',$data);
           if($insert){
           $this->response([
                    'status' => TRUE,
                    'message' => 'Email id register successfully.',
                    'data' => $insert
                ], REST_Controller::HTTP_OK);
           
           //$this->response($insert);
           }
           
            }
            }
            
            
            if(!empty($arr['phone']))
            {
            $checkphone = $this->auth_model->checkPhone($phone);
            
            if($checkphone){
            $this->response([
                    'status' => TRUE,
                    'message' => 'Phone no alredy exit.',
                    'data' => $checkphone
                ], REST_Controller::HTTP_OK);
            }
            
            else
            {
                
           $insert1 = $this->auth_model->insertmobile('user',$arr);
           
           /*$ress = array( "User"=>$insert1 );
        
            $satatuss = json_encode($ress);
            echo $satatuss;*/
            
            
           if($insert1)
           {
               
           $this->response([
                    'status' => TRUE,
                    'message' => 'Phone is register successfully.',
                    'data' => $insert1
                ], REST_Controller::HTTP_OK);
           
           }
            
            }
                
            }
           
            }
            
            
            
            /*if(!empty($email)){
            
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => $password,
                'status' => 1
            );
            }
            else {
                
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'phone' => $phone,
                'password' => $password,
                'status' => 1
            );
            }
           
            $user = $this->auth_model->getRows($con);
            
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
            }*/
        
        
    }
   
    ?>