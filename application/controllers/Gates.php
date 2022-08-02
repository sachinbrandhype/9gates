<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gates extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HomeModel','homemodel',true);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('email');
        $this->load->helper('string');
        $this->load->helper('array');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->helper('text');
        $this->load->library('cart');

    }


    function index($category='',$cat='')
    {
        $arr['page']='Category';
        
        if($cat!='')
            $category= $cat;
        else
            $category= $category;

         $category = explode('.',$category);
         
         
         
        
        $mid = $this->homemodel->getMenuId($category[0]);
        
        $data['m'] = $this->homemodel->getMenuIdByUrl($category[0]);
                            
         $data['cat'] = $this->homemodel->getBotumCatIdByMenu($data['m']->id);
        
        
        $data['banner'] =$this->homemodel->getAllBannerCat($mid->id);

        $data['position1'] = $this->homemodel->getBannerPosition1();
        $data['position2'] = $this->homemodel->getBannerPosition2Menu($mid->id);
        $data['position3'] = $this->homemodel->getBannerPosition3();
        $data['position4'] = $this->homemodel->getBannerPosition4();
        $data['position5'] = $this->homemodel->getBannerPosition5Menu($mid->id);
        $data['position6'] = $this->homemodel->getBannerPosition6();
        $data['position7'] = $this->homemodel->getBannerPosition7();
        $data['position8'] = $this->homemodel->getBannerPosition8();
        $data['position9'] = $this->homemodel->getBannerPosition9();
        $data['position11'] = $this->homemodel->getBannerPosition11();
        $data['position10'] = $this->homemodel->getBannerPosition10();
        $data['position12'] = $this->homemodel->getBannerPosition12ByMenu($mid->id);
        $data['position13'] = $this->homemodel->getBannerPosition13();
        $data['position14'] = $this->homemodel->getBannerPosition14();
        $data['position15'] = $this->homemodel->getBannerPosition15();
        $data['position16'] = $this->homemodel->getBannerPosition16();
        $data['position17'] = $this->homemodel->getBannerPosition17();
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategoryByMenu($mid->id);
        $data['pro'] =$this->homemodel->getAllProductListByMenu($mid->id);
        
        $this->load->view('vwlisting',$data);

        
    }
    
    
    function ccat($category='',$cat='',$scat='',$ccat='')
    {
        
        $arr['page']='Sub Category';
        
        if($cat!='')
            $category= $cat;
            
            elseif($scat!='')
            
            $category = $scat;
            
            elseif($ccat!='')
            
            $category = $ccat;
            
        else
            $category= $category;

         $category = explode('.',$category);
         
         $url = $this->uri->segment(1);
         $caturl = $this->uri->segment(2);
         $scaturl = $this->uri->segment(3);
         $url1 = $this->uri->segment(4);
         $category1 = explode('-chcat.html',$url1);
        
        $cat = $this->homemodel->getMenuByCatData($caturl);
        
        
        $cccat = $this->homemodel->getMenuCategorySubByChild($category1[0]);
        
        
        $scat = $this->homemodel->getMenuCategoryBySub($scaturl);
        
        
         
        
        $mid = $this->homemodel->getMenuId1($url);
        
        $data['pro'] = $this->homemodel->getProductByMenuIdCategoryIdChildData($cccat->id);
        
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategoryByMenu($mid->id);
        
        $mid = $this->homemodel->getMenuId($url);
        
        $data['m'] = $this->homemodel->getMenuIdByUrl($url);
                            
         $data['cat'] = $this->homemodel->getBotumCatIdByMenu($data['m']->id);
         $data['catBanner'] = $this->homemodel->getMultipleCategoryImageById($data['m']->id);
        
        $this->load->view('subcategory',$data);
    }
    
    
    function scat($category='',$cat='',$scat='')
    {
        
        $arr['page']='Sub Category';
        
        if($cat!='')
            $category= $cat;
            elseif($scat!='')
            $category = $scat;
        else
            $category= $category;

         $category = explode('.',$category);
         
         $url = $this->uri->segment(1);
         $caturl = $this->uri->segment(2);
         $url1 = $this->uri->segment(3);
         $category1 = explode('-scat.html',$url1);
        
        $cat = $this->homemodel->getMenuByCatData($caturl);
        
        $scat = $this->homemodel->getMenuCategoryBySub($category1[0]);
        
         
        
        $mid = $this->homemodel->getMenuId1($url);
        
        $data['pro'] = $this->homemodel->getProductByMenuIdCategoryIdData($scat->id);
        
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategoryByMenu($mid->id);
        
        $mid = $this->homemodel->getMenuId($url);
        
        $data['m'] = $this->homemodel->getMenuIdByUrl($url);
                            
         $data['cat'] = $this->homemodel->getBotumCatIdByMenu($data['m']->id);
         $data['catBanner'] = $this->homemodel->getMultipleCategoryImageById($data['m']->id);
        
        $this->load->view('subcategory',$data);
    }
    
    
    
    function cat($category='',$cat='')
    {
        
        $arr['page']='Sub Category';
        
        if($cat!='')
            $category= $cat;
        else
            $category= $category;

         $category = explode('.',$category);
         
         $url = $this->uri->segment(1);
         $url1 = $this->uri->segment(2);
        $category1 = explode('-cat.html',$url1);
        
        $data['mcat'] = $this->homemodel->getMenuCategory($category1[0]);
        
        
        
        $data['mid'] = $this->homemodel->getMenuId1($url);
        
        
        
        
        $data['pro'] = $this->homemodel->getProductByMenuIdCategoryId($data['mid']->id,$data['mcat']->id);
        
        $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategoryByMenu($data['mid']->id);
        
        $mid = $this->homemodel->getMenuId($url);
        
        $data['m'] = $this->homemodel->getMenuIdByUrl($url);
                            
         $data['cat'] = $this->homemodel->getBotumCatIdByMenu($data['m']->id);
         $data['catBanner'] = $this->homemodel->getMultipleCategoryImageById($data['m']->id);
         
        
        $this->load->view('makeup',$data);
    }
    
    function giftcard()
    {
       $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $data['gift'] =$this->homemodel->getGiftCard();
        $this->load->view('giftcard',$data);

    }
    
    function help()
    {
       $data['topcat'] =$this->homemodel->getTopCategory();
        $data['botcat'] =$this->homemodel->getBottomCategory();
        $this->load->view('help',$data);

    }



}