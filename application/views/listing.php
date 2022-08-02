<?php $this->load->view("hvwheader.php"); ?>
<div class="container-fluid pp1">
   <div class="container">
      <div class="row sng-pptr">
         <div class="col-md-5">
            <div class="pdt-img">
               <div class="css-mlhxzl"> 
               <?php  $userid = $this->session->userdata('id') ;?>
                <?php if($userid){?>
                  <button type="button" class="custom-wishlist-button item-add-to-wish-list" data-productid="<?= $product->id?>"><i class="fa fa-heart-o " aria-hidden="true"></i></button>
               <?php } else {?>
               <button type="button" class="custom-wishlist-button item-add-to-wish-list"><i class="fa fa-heart-o " aria-hidden="true"></i></button>
               <?php } ?>
               </div>
               <!-- <img src="img/cost-prdut/product3.jpg" alt="" class="img-responsive"> -->
               <div class="product-gallery">
                  <div class="product-gallery-thumbnails">
                     <ol class="thumbnails-list list-unstyled">
                        <?php $productMultipleImage =$this->homemodel->getProductMultipleImagesByProductId($product->id);
                           if(!empty($productMultipleImage)){
                           
                               foreach($productMultipleImage as $productMultiple){?>
                        <li><img src="<?=base_url('uploads/'.$productMultiple->image)?>" alt="" class="img-responsive"></li>
                        <?php }} ?>
                     </ol>
                  </div>
                  <div class="product-gallery-featured">
                     <img src="<?=base_url('uploads/'.$product->fimage)?>" alt="" class="img-responsive" style='width: 100%'>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-7">
            <div class="pdt-tx">
               <div class="ttle">
                  <h2><?=$product->product?></h2>
               </div>
               <div class="ratings">
                  <div class="rating-box">
                     <div class="rating">
                         
                         <?php $review = $this->homemodel->getAllReviewImageById($product->id);
                                    foreach($review as $rev){?>
                        
                        <?php if($rev->stars < 3){?>            
                        <div class="rating-box"> 
                           <i class="fa fa-star" aria-hidden="true"></i> 
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        <?php } elseif($rev->stars==1){?>
                        <div class="rating-box"> 
                           <i class="fa fa-star" aria-hidden="true"></i> 
                           <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        <?php } elseif($rev->stars==2){?>
                        
                        <div class="rating-box"> 
                           <i class="fa fa-star" aria-hidden="true"></i> 
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        
                        <?php } elseif($rev->stars < 4){?>
                        <div class="rating-box"> 
                           <i class="fa fa-star" aria-hidden="true"></i> 
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </div>
                        <?php } elseif ($rev->stars > 5){?>
                        <div class="rating-box"> 
                           <i class="fa fa-star" aria-hidden="true"></i> 
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <?php } else { echo "Rating Found";} }?>
                        
                     </div>
                  </div>
                  <p class="rating-links"> 
                     <a href="#">0 Review(s)</a>  
                  </p>
               </div>
               <div class="dv-prce">
                  <!-- <p>MRP: <span class="dl-pr"><del>₹899.00</del></span><span class="mn-prc"><a href="#">₹309.99 </a></span><span class="s3of">20% Off!</span></p> -->
                  <p>MRP:<span class="dl-pp"><del>$<?=$product->mrp?></del></span><span class="prc1">$<?=$product->retail?></span> <span class="css-prqx0k">20% Off</span></p>
                  <p>inclusive of all taxes</p>
               </div>
               <div class="btppns">
                  <div class="by-btns">
                     <!--<button type="button" class="btn sk-adcrt">Add to Bag</button>-->
                     <button type="button" class="btn sk-adcrt"><a href="javascript:void(0)" class="item-add-to-cart" data-productid="<?= $product->id ?>" style='color:#475562;'>Add to Cart</a></button>
                  </div>
                            
                  <div class="pnd-dtls">
                      
                      <?php echo $this->session->flashdata('msg2'); ?>
                     <form action="#" method="post" id="frm">
                        <div class="input-group">
                           <label><i class="fa fa-map-marker domp" aria-hidden="true"></i> Delivery Options</label>
                           <input type="text" name="pincode" id="pincode" class="pinck" placeholder="Enter Pincode">
                           <span class="message" id="msgpincode"></span>
                           <input class="btn pnbtns" type="button" id="isValidatePincode" value="Check">
                        </div>
                        <div id="msg"></div>
                     </form> 
                  </div>
               </div>
               <!--<div class="frt3sp">
                  <ul>
                  
                     <li><a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i> genuine products </a></li>
                  
                     <li><a href="#"><i class="fa fa-undo" aria-hidden="true"></i> easy return policy </a></li>
                  
                     <li><a href="#">Nykaa E retail private limited </a></li>
                  
                  </ul>
                  
                  </div>-->
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container-fluid p23">
   <div class="container">
      <div class="row">
         <div class="col-md-9">
            <div class="pdrt-tcvs spskr">
               <div class="pdt-rrgt">
                  <div class="card tb-txst">
                     <ul class="nav nav-tabs " role="tablist">
                        <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab"><i class="fa fa-home"></i> <span>  Description </span></a></li>
                        <li role="presentation"><a href="#reviews" aria-controls="reviewse" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Product Reviews</span></a></li>
                     </ul>
                     <!-- Tab panes -->
                     <!--<div class="tab-content pdt-p">
                        <div role="tabpanel" class="tab-pane active" id="description">
                        
                           <p><?=$product->description?>  </p>
                        
                        </div>
                        
                        <div role="tabpanel" class="tab-pane" id="reviews">
                        
                           <p>Dummy Conntent For Reviews</p>
                        
                        </div>
                        
                        </div>-->
                     <div class="tab-content pdt-p">
                        <div role="tabpanel" class="tab-pane active" id="description">
                           <p> <?=$product->description?> </p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="reviews">
                           <div class="rvw-strt-bxs">
                              <div class="row">
                                 <div class="col-md-4 rwrg-bdr">
                                    <div class="rvw-rtngs">
                                       <?php $review = $this->homemodel->getReviewById($product->id); ?>
                                       <div class="rtng-num">
                                          <?php foreach($review as $rev){?>
                                          <h2><?=$rev->Total?>/5 </h2>
                                          <?php } ?>
                                       </div>
                                       <div class="rtng-ps">
                                          <p>Overall Rating </p>
                                           <?php foreach($review as $rev){?>
                                          <span><?=$rev->Total?> verified ratings</span>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="writ-rvw">
                                       <!--<p>Write a review and win 100 reward points !</p>-->
                                       <a href="#" data-toggle="modal" data-target="#myModal91">Write Review </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="rv-phto-glry">
                              <h3>Photos From Customers </h3>
                              <div class="rvw-glry portfolio-item">
                                 <?php $review = $this->homemodel->getAllReviewImageById($product->id);
                                    foreach($review as $rev){?>
                                 <img src="<?=base_url('uploads/'.$rev->image)?>" alt="" class="img-responsive">
                                 <?php } ?>
                              </div>
                           </div>
                           <div class="review-block">
                              <h3>Most Useful Review </h3>
                              <div class="row">
                                 <?php $review = $this->homemodel->getAllReviewImageById($product->id);
                                    foreach($review as $rev){?>
                                 <div class="col-sm-3">
                                    <div class="clnts-prfl">
                                       <img src="/bumaco/uploads/default_profile_image.svg" alt="" class="img-responsive">
                                    </div>
                                    <div class="clnts-dtls">
                                       <p><?php echo $rev->username?></p>
                                       <span>Verified Buyers</span>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <?php $review = $this->homemodel->getAllReviewImageById($product->id);
                                        if(!empty($review)){
                                    foreach($review as $rev){?>
                                 <div class="col-sm-9">
                                    <div class="review-block-rate">
                                       <div class="srd-str"><?=$rev->stars?> <i class="fa fa-star str-iic" aria-hidden="true"></i></div>
                                       <div class="dat"><?=$rev->date?> </div>
                                    </div>
                                    <div class="rvew-txx">
                                       <h3>"<?=$rev->title?>"</h3>
                                       <p><?=$rev->descripton?></p>
                                       <div class="rvw-lok-imgs">
                                          <img src="<?=base_url('uploads/'.$rev->image)?>" alt="" class="img-responsive">
                                       </div>
                                       <!--<div class="lkssp">
                                          <p><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Helpful</a></p>
                                       </div>
                                       <div class="lik-ppl">
                                          <p>Youand  7people found this helpful</p>
                                       </div>-->
                                    </div>
                                 </div>
                                 <?php } } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="rltd-pdt spskr">
               <div class="hdng-s">
                  <h2>Related Products </h2>
               </div>
               <div class="row slider3">
                  <?php   $url = $this->uri->segment(3);
                     $urid = $this->homemodel->getId($url);
                    
                     $related= $this->homemodel->getRelatedProductBYId($urid->product_url);
                    /* echo "<pre>";
                     print_r($related);
                     die();*/
                     if(!empty($related)){
                     
                         foreach($related as $rel){?>
                  <div class="col-md-4">
                     <div class="catgry-bxs">
                        <a href="<?=base_url()?>home/productdetail/<?=$rel->product_url?>">
                        <figure class="effect-hera">
                           <img src="<?=base_url('uploads/'.$rel->fimage)?>" alt="" class="img-responsive">
                           <figcaption>
                              <p>
                                 <!---->
                                 <?php  $userid = $this->session->userdata('id') ;?>
                                <?php if($userid){?>
                                <a href="#" data-productid="<?= $product->id?>" class="item-add-to-wish-list"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                  
                               <?php } else {?>
                               <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                               
                               <?php } ?>
                                 <a href="javascript:void(0)" class="item-add-to-cart" data-productid="<?= $rel->id ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                              </p>
                           </figcaption>
                        </figure>
                        <h3><a href="#"><?=$rel->product?> </a></h3>
                        <p><span class="dl-pp"><del>$<?=$rel->mrp?></del></span><span class="prc1">$<?=$rel->retail?></span> <span class="css-prqx0k">20% Off</span></p>
                        <div class="rating-box-mn" style="display:none"> 
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star-half-o" aria-hidden="true"></i>
                           <span>(49859)</span> 
                        </div>
                     </a>
                     </div>
                  </div>
                  <?php }} ?>
               </div>
            </div>
            
         </div>
          
          <h2 style="text-align: center;">Latest Product</h2>
          
          <?PHP  $url = $this->uri->segment(3);
          $pr = $this->homemodel->getSingleProduct();
          foreach($pr as $p){
          ?>
          
         <div class="col-md-3 lr-stick">
            <a href="<?=base_url()?>home/productdetail/<?=$p->product_url?>">
            <div class="nwd-pdt">
               <div class="catgry-bxs">
                  <figure class="effect-hera">
                     <img src="<?=base_url('uploads/')?><?=$p->fimage?>" alt="img17" class="img-responsive" />
                     <figcaption>
                        <p>
                          <?php  $userid = $this->session->userdata('id') ;?>
                                  <?php if($userid){?> 
                                  <a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="<?= $p->id?>"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                  <?php } else {?>
                                  <a href="javascript:void(0)" class="item-add-to-wish-list"><i class="fa fa-heart-o " aria-hidden="true"></i></a>
                                  <?php } ?>
                                  <a href="javascript:void(0)" class="item-add-to-cart" data-productid="<?= $p->id ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </p>
                     </figcaption>
                  </figure>
                  <h3><a href="#"><?=$p->product?> </a></h3>
                  <p><span class="dl-pp"><del>$<?=$p->mrp?></del></span><span class="prc1">$<?=$p->retail?></span> <!--<span class="css-prqx0k">20% Off</span>--></p>
                  <!--<div class="rating-box-mn"> 
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star" aria-hidden="true"></i>
                     <i class="fa fa-star-half-o" aria-hidden="true"></i>
                     <span>(49859)</span> 
                  </div>-->
               </div>
            </div>
         </a>
         </div>
         
         <?php } ?>
         
      </div>
   </div>
</div>



<div class="modal fade" id="myModal91" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><i class='fa fa-arrow-left'></i></button>
            <h4 class="modal-title rv-tles">Review Product</h4>
         </div>
         <div class="modal-body">
            <div class="rviw-frmsa">
               <form action="<?=base_url()?>home/addreview" method="post" enctype="multipart/form-data">
                  <?php    $url = $this->uri->segment(3);
                     $proid = $this->homemodel->getProductId($url);
                     $user = $this->session->userdata('userid');
                     ?>
                  <input type="hidden" name="proid" value="<?=$product->id?>">
                  <input type="hidden" name="user_id" value="<?=$user?>">
                  <input type="hidden" name="username" value="sachin panchal">
                  <div class="form-group rating">
                     <!-- <div id="stars-existing" class="starrr" data-rating='4'></div>   -->
                     <label>
                     <input type="radio" name="stars" value="1" />
                     <span class="icon">★</span>
                     </label>
                     <label>
                     <input type="radio" name="stars" value="2" />
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     </label>
                     <label>
                     <input type="radio" name="stars" value="3" />
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     <span class="icon">★</span>   
                     </label>
                     <label>
                     <input type="radio" name="stars" value="4" />
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     </label>
                     <label>
                     <input type="radio" name="stars" value="5" />
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     <span class="icon">★</span>
                     </label>
                  </div>
                  <div class="form-group">
                     <input name="title" type="text" class="form-control sdr-rvw" placeholder="Review Title" required>
                  </div>
                  <div class="form-group">
                     <textarea id="txt_Message_7" name="description" class="form-control sdr-rvw" placeholder="Review Description" required></textarea>
                  </div>
                 
                  <div class="form-group">
                     <input type="submit" id="submit-btn" class="btn btn-green ftr-btn1" value="Submit">
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<?php $this->load->view("footer.php"); ?>
<script type="text/javascript">
   // select all thumbnails
   
   const galleryThumbnail = document.querySelectorAll(".thumbnails-list li");
   
   // select featured
   
   const galleryFeatured = document.querySelector(".product-gallery-featured img");
   
   
   
   // loop all items
   
   galleryThumbnail.forEach((item) => {
   
   item.addEventListener("mouseover", function () {
   
    let image = item.children[0].src;
   
    galleryFeatured.src = image;
   
   });
   
   });
   
   
   
   // show popover
   
   $(".main-questions").popover('show');
   
   $(document).on('click','#isValidatePincode', function() {
	if (isValidatePin()) {
		var frm = $("#frm").serialize();
		$.ajax({
			url :'<?=base_url()?>home/checkpincode',
			data : frm,
			type : 'POST',
			success : function(result) {
			$("#msg").html(result);
			//window.location='';
			}
		});
	}
	
	
});	

function isValidatePin() {

	var valid = true;
	var pincode = $("input[name='pincode']").val();

	$(".message").html("&nbsp;");
	$(".message").css("color", "red");
	$(".message").css("font-size", "12px");
	$(".message").hide();

	
	if ('pincode'==false) {
		valid = false;
		$("#msgpincode").html("Enter valid 5 or 6 digit code");
		$("#msgpincode").show();
	}
	return valid;
}

/*function checkPincode(pincode) {
	var contactRegexStr = /^\d{5}$/;
	var contactRegexStr2 = /^\d{7}$/;
	var isvalid = contactRegexStr.test(pincode) || contactRegexStr2.test(pincode);
	return isvalid;
}*/
   
</script>

