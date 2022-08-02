<?php $this->load->view("header"); 

$url = $this->uri->segment(2);
$data = $this->homemodel->getproductIdByUrl($url);

?>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12" style="padding: 0px;">
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
               <?php if(!empty($catBanner)){
                  $count=0;
                  foreach($catBanner as $ctBanner){?>
               <li data-target="#myCarousel" data-slide-to="<?php echo $count ?>" class="<?php if($count==0){?>active <?php } ?>"></li>
               <?php $count++; }} ?>
            </ol>
            <div class="carousel-inner">
               <?php if(!empty($catBanner)){
                  $count = 1;
                  
                  foreach($catBanner as $ctBanner){?>
               <div class="item <?php if($count == 1){?> active <?php } ?>">
                  <img src="<?=base_url('uploads/'.$ctBanner->image)?>" alt="fashion" class="img-responsive" style="width:100%;">
               </div>
               <?php $count++; }} ?>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
   </div>
</div> 
<div class="container-fluid sngle-wp">
   <div class="container">
      <div class="row">
         <div class="col-md-3 pd8">
            <div class="cat-mns">
               <div class="menu">
                  <div class="mini-menu">
                     <ul>
                        <li class="sub sbp9">
                            <?php $url = $this->uri->segment(4);
                            $category = explode('-scat.html',$url);
                            $catid = $this->homemodel->getChildCategorySingleIdByUrl($category[0]);?>
                           <a href="#">Sort By : Popularity</a> 
                           <ul>
                              <li><a href="javascript:void(0)" class="filter" id="sortby" dataid= "Popularity">Popularity</a></li>
                              <li><a href="javascript:void(0)" class="filter" id="discountby" dataid ="Discount">Discount</a></li>
                              <li><a href="javascript:void(0)" class="filter" id="rating" dataid= "DESC">Customer Top Rated</a></li>
                              <li><a href="javascript:void(0)" class="filter" id="newarrivals" dataid= "New Arrivals">New Arrivals</a></li>
                              <li><a href="javascript:void(0)" class="filter" id="high" dataid= "<?php echo $catid->id?>">Price: High</a></li>
                              <li><a href="javascript:void(0)" class="filter" id="low" dataid= "<?php echo $catid->id?>">Price: Low</a></li>
                           </ul>
                        </li>
                        
                        <?php if(!empty($botcat)){
                           foreach($botcat as $c){?>
                        <li class="sub">
                           <a href="#"><?=$c->category?></a>
                           <ul>
                               <?php
                                 $subcat = $this->homemodel->getSubcategoryById($c->id);
                                  if(!empty($subcat)){
                                      foreach($subcat as $s){?>
                               
                              <li class="sub">
                                 <a href="#"><?=$s->subcategory?>  </a>
                                 <ul> 
                                    <?php $child = $this->homemodel->getchildCategoryById($s->id);
                                        foreach($child as $ch){ 
                                    ?>
                                    <li>
                                       <div class="form-check">
                                          <label for="flexCheckIndeterminate">
                                          <?=$ch->childcategory?>
                                          </label>
                                          <input class="form-check-input child" type="checkbox" name="childcategory" id="childcategory" value="<?=$ch->id?>">
                                       </div>
                                    </li>
                                    <?php } ?>
                                    
                                 </ul>
                              </li>
                              
                              <?php }} ?>
                             
                           </ul>
                        </li>
                        
                        <?php }} ?>
                        
                        
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-9">
            <div class="row grid skctrgy">
                
                <div id="product_filter">
                <h3>Product Sorting Filter</h3>
                
                <div id="filter"></div>
                
                </div>
                
                
                <div id="product_filter1">
                <h3>Product Filter</h3>
                
                <div id="productfilter"></div>
                
                </div>
                
                
                
                <div id="maindiv">
                <div id="lowfilter"></div>
               <?php $url = $this->uri->segment(4);
                  $catid = $this->homemodel->getChildCategorySingleIdByUrl($url);
                  
                  $product =$this->homemodel->getProductByChildCategoryurl($catid->id);
                   
                  if(!empty($product)){
                  
                      foreach($product as $p){?>
                      
               <div class="col-md-4 itm1" id="maindiv">
                  <a href="<?=base_url()?>home/productdetail/<?=$p->product_url?>">
                     <div class="catgry-bxs">
                        <figure class="effect-hera">
                           <img src="<?=base_url('uploads/'.$p->fimage)?>" alt="img17" class="img-responsive" />
                           <figcaption>
                              <p> 
                                  <?php  $userid = $this->session->userdata('userid');
                                   if(!empty($userid)){ ?> 
                                  <a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="<?= $p->id?>"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                  <?php } else {?>
                                  <a href="javascript:void(0)" class="item-add-to-wish-list"><i class="fa fa-heart-o " aria-hidden="true"></i> </a>
                                  <?php } ?>
                                  <a href="javascript:void(0)" class="item-add-to-cart" data-productid="<?= $p->id ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                              </p>
                            </figcaption>
                        </figure>
                        <h3><?=$p->product?> </h3>
                        <p><span class="dl-pp"><del>$<?=$p->mrp?></del></span><span class="prc1">$<?=$p->retail?></span> <span class="css-prqx0k"><?=$p->set_offer?></span></p>
                        <div class="rating-box-mn">
                          <!--<i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star" aria-hidden="true"></i>
                          <i class="fa fa-star-half-o" aria-hidden="true"></i>-->
                          <span>(0)</span>
                        </div>
                  </div>
                  </a>
               </div>
               
               <?php }} ?>
               
               </div>
               
               
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view("footer.php"); ?>