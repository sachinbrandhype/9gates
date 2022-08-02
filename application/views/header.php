<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Bumaco</title>
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/main.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />

   </head>
   <body> 
      <!-- header -->
      <div class="container-fluid navbar-me">
         <div class="row top-bg">
            <div class="col-md-4">
               <div class="lft-tp">
                  <ul>
                     <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> +91 - 9999-999-999 </a></li>
                     <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> sales@domain.com </a></li>
                  </ul>
               </div>
            </div>
            <div class="col-md-2">
               <div class="scl-tp">
                  <a href="#" class="fa fa-facebook scl-top"></a>
                  <a href="#" class="fa fa-twitter scl-top"></a>
                  <a href="#" class="fa fa-linkedin scl-top"></a>
                  <a href="#" class="fa fa-youtube scl-top"></a>
               </div>
            </div>
           <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <div class="col-md-6">
                
               <div class="rgt-tp">   
                  <ul> 
                     <li><a href="#"><i class="icon-mobile-phone"></i> Get App </a></li>
                     <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Store & Events </a></li>
                     <li><a href="<?php echo base_url('giftcard')?>"><i class="fa fa-gift" aria-hidden="true"></i> Gift Card </a></li>
                     <li><a href="<?php echo base_url('help')?>"><i class="fa fa-question-circle" aria-hidden="true"></i> Help </a></li>
                     <?php $userid = $this->session->userdata('userid');?>
                     <?php if(!empty($userid)){?>
                     <li><a href="<?=base_url()?>home/profile"><i class="fa fa-user sk-t-ic"></i>Welcome, <?php echo $this->session->userdata('email');?>Account</a></li>
                     <li><a href="<?php echo base_url('home/logout');?>">Logout</a></li>
                     <?php } else{ ?>
                    <!-- <li><a href="<?=base_url()?>home/profile"><i class="fa fa-user sk-t-ic"></i>Account</a></li>-->
                     <?php } ?>
                     <!-- <li><a href="#" data-toggle="modal" data-target="#myModal81">Test </a></li> -->
                  </ul>
               </div>
            </div>
         </div>
         <div class="row skmn1">
            <div class="col-md-12">
               <nav class="navbar navbar-default sk1nv">
                  <div class="container-fluid" style="padding:0px;" id="menu">
                     <div class="navbar-header">
                        <a class="navbar-brand sk-lgos" href="<?=base_url()?>"><img src="<?=base_url()?>public/img/logo1.png" alt="" class="img-fluid"></a>
                     </div>
                     <ul class="nav navbar-nav sk-nv2">
                        <?php if(!empty($topcat)){
                           $count = 1;
                           foreach($topcat as $tc){
                           
                           
                           
                           $url = $this->uri->segment(1);
                           
                           $category=explode('.html',$url);
                           ?>
                           
                        <li class="<?php if($category[0] == $tc->url){ ?> active <?php }?>"><a href="<?=base_url().$tc->url?>.html"><?=$tc->menu?> </a></li>
                        <?php $count++;}} ?>
                     </ul>
                  </div>
               </nav>
            </div>

         </div>
         <div class="row skmn2">
            <div class="col-md-9">
               <nav class="navbar navbar-default skt-nav">
                  <div class="container-fluid">
                     <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                     </div>
                     <div id="navbar2 navbar-primary-collapse" class="navbar-collapse collapse sk2-nv">
                        <ul class="nav navbar-nav navbar-center sk-nv3">
                            <?php 
                            
                            
                          /*  $url = $this->uri->segment(1);
                           
                           $category=explode('.',$url);*/
                           
                           
                           
                           
                            
                            if(!empty($cat)){
                              $count=1;
                              foreach($cat as $bc){
                              
                              
                              ?> 
                            <li class="dropdown mega-dropdown"> 
                        		<a href="<?=base_url().$m->url.'/'.$bc->url?>-cat.html" class="dropdown-toggle"><?=$bc->category?> </a>
                             	<ul class="dropdown-menu mega-dropdown-menu">
                                 
                                 <?php $sub = $this->homemodel->getsuibCategoryByCatId($bc->id);
                                        if($sub){
                                            foreach($sub as $s){?>
                                 <li class="col-md-2">
                                    <ul> 
                                       <li class="dropdown-header"><a href="<?=base_url().$m->url.'/'.$bc->url.'/'.$s->url?>-scat.html"><?=$s->subcategory?></a></li>
                                       <?php $child = $this->homemodel->getChildCategoryBySubCategoryId($s->id);
                                            if($child){
                                             foreach($child as $c){?>
                                       <li><a target="_blank" href="<?=base_url().$m->url.'/'.$bc->url.'/'.$s->url.'/'.$c->url?>-chcat.html"><?=$c->childcategory?></a></li>
                                       <?php } } ?>
                                       <li class="divider"></li>
                                    </ul>
                                 </li>
                                  
                                 <?php }} ?>
                                 
                              </ul>
                           </li>
                           
                           <?php }} ?>
                          
                          
                        </ul>
                     </div>
                  </div>
               </nav>
            </div>
            <div class="col-md-2">
               <div class="srch-tp">
                   <form action="<?php echo base_url('home/searchalldata');?>" method="post">
                  <div class="input-group custom-search-form">
                     <input type="text" class="form-control sksrch1" name="search_key" required="required" placeholder="Search on Bumaco">
                     <span class="input-group-btn">
                     <button class="btn btn-default srch-btnk" type="submit">
                     <span class="glyphicon glyphicon-search"></span>
                     </button>
                     </span>
                  </div>
                  </form> 
               </div>
            </div> 
            <div class="col-md-1">
               <div class="myact">
                  <ul class="ab-actwi">
                     <li><a href="<?=base_url()?>cart" id="OpenFormokok"><i id="cart" class="fa fa-shopping-bag crt-ic" aria-hidden="true" ><?php echo count($this->cart->contents()); ?></i> </a></li>
                     
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- end -->

