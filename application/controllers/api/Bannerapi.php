<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Bannerapi extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Bannerapi_model','bannerapi', true);
    }
    
    
    function bannercategory_post()
    {
        $mid = $this->input->post('mid');
        $cid = $this->input->post('cid');
        $banner =$this->bannerapi->getbannerByMenuCategory($mid,$cid);
        
        if(!empty($banner)){
            
        $this->response([
            'Banner Details' => $banner
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    
    function featureproduct_post()
    {
        $id = $this->input->post('mid');
        
        $pro =$this->bannerapi->getFeaturedProductByMenu($id);
        
        if(!empty($pro)){
            
        $this->response([
            'Featured Products' => $pro
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    function offerforyou_post()
    {
        $id = $this->input->post('mid');
        $offer = $this->bannerapi->getOfferForYou($id);
        
        if(!empty($offer)){
            
        $this->response([
            'Offer For You ' => $offer
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function shopbybrand_post()
    {
        $id = $this->input->post('mid');
        $brand = $this->bannerapi->getShopByBrand($id);
        if(!empty($brand)){
            
        $this->response([
            'Shop By Brand ' => $brand
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    } 
    
    function homecategory_post()
    {
        
    $id = $this->input->post('mid');
    $cat = $this->bannerapi->getHomeCategory($id);
    
    if(!empty($cat)){
            
        $this->response([
            'Home Category ' => $cat
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function homebanner_post()
    {
        
    $id = $this->input->post('mid');
    $banner = $this->bannerapi->getAllBannerByMenuId($id); 
    
     if(!empty($banner)){
            
        $this->response([
            'Home Slider ' => $banner
        ], REST_Controller::HTTP_OK);
        
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
    
    
    
    function homeslider_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        $banner = $this->bannerapi->getAllBanner( $this->get('id') );

        if($banner)
        {
            $this->response($banner, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }
    
    function position_get()
    { 
       
        if(!$id)
        {
            $this->response(NULL, 400);
        }
        
        
        
        $position = $this->bannerapi->getAllBannerPosition1(); 
        
        
        $ress = array( "homeslider" => $position );
        
        $satatuss = json_encode($ress);
            echo $satatuss;
        
        if($position)
        {
            $this->response($position, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position2_get()
    {
        $id ='Position2';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position2 = $this->bannerapi->getAllBannerPosition2( $id );

        if($position2)
        {
            $this->response($position2, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position3_get()
    {
        $id ='Position3';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position3 = $this->bannerapi->getAllBannerPosition3( $id );

        if($position3)
        {
            $this->response($position3, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position4_get()
    {
        $id ='Position4';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position4 = $this->bannerapi->getAllBannerPosition4( $id );

        if($position4)
        {
            $this->response($position4, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position5_get()
    {
        $id ='Position5';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position5 = $this->bannerapi->getAllBannerPosition5( $id );

        if($position5)
        {
            $this->response($position5, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position6_get()
    {
        $id ='Position6';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position6 = $this->bannerapi->getAllBannerPosition6( $id );

        if($position6)
        {
            $this->response($position6, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position7_get()
    {
        $id ='Position7';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position7 = $this->bannerapi->getAllBannerPosition7( $id );

        if($position7)
        {
            $this->response($position7, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position8_get()
    {
        $id ='Position8';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position8 = $this->bannerapi->getAllBannerPosition8( $id );

        if($position8)
        {
            $this->response($position8, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position9_get()
    {
        $id ='Position9';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position9 = $this->bannerapi->getAllBannerPosition9( $id );

        if($position9)
        {
            $this->response($position9, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position10_get()
    {
        $id ='Position10';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position10 = $this->bannerapi->getAllBannerPosition10( $id );

        if($position10)
        {
            $this->response($position10, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position11_get()
    {
        $id ='Position11';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position11 = $this->bannerapi->getAllBannerPosition11( $id );

        if($position11)
        {
            $this->response($position11, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position12_get()
    {
        $id ='Position12';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position12 = $this->bannerapi->getAllBannerPosition12( $id );

        if($position12)
        {
            $this->response($position12, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position13_get()
    {
        $id ='Position13';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position13 = $this->bannerapi->getAllBannerPosition13( $id );

        if($position13)
        {
            $this->response($position13, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position14_get()
    {
        $id ='Position14';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position14 = $this->bannerapi->getAllBannerPosition14( $id );

        if($position14)
        {
            $this->response($position14, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position15_get()
    {
        $id ='Position15';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position15 = $this->bannerapi->getAllBannerPosition15( $id );

        if($position15)
        {
            $this->response($position15, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position16_get()
    {
        $id ='Position16';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position16 = $this->bannerapi->getAllBannerPosition16( $id );

        if($position16)
        {
            $this->response($position16, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(NULL, 404);
        }
    }

    function position17_get()
    {
        $id ='Position17';
        if(!$id)
        {
            $this->response(NULL, 400);
        }

        $position17 = $this->bannerapi->getAllBannerPosition17( $id );

        if($position17)
        {
            $this->response($position17, 200); // 200 being the HTTP response code
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
            $delete=$this->bannerapi->delete($id);
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