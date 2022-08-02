<?php include("header.php"); ?>
<div class="container-fluid pp1">
   <div class="container">
      <div class="row">
         <div class="col-md-5">
            <div class="pdt-img">
               <img src="<?=base_url('uploads/'.$product->fimage)?>" alt="" class="img-responsive">
            </div>
         </div>
         <div class="col-md-7">
            <div class="pdt-tx">
               <div class="ttle">
                  <h3><?=$product->product?> </h3>
                  <p><?=$product->short_description?>.</p>
               </div>
               <div class="ratings">
                  <div class="rating-box">
                     <div class="rating">
                        <div class="rating-box"> 
                           <span class="fa fa-stack"><i class="fa fa-star-o"></i></span> 
                           <span class="fa fa-stack"><i class="fa fa-star-o"></i></span> 
                           <span class="fa fa-stack"><i class="fa fa-star-o"></i></span> 
                           <span class="fa fa-stack"><i class="fa fa-star-o"></i></span> 
                           <span class="fa fa-stack"><i class="fa fa-star-o"></i></span> 
                        </div>
                     </div>
                  </div>
                  <p class="rating-links"> 
                     <a href="#">1 Review(s)</a> 
                     <a href="#">Add Your Review</a> 
                  </p>
               </div>
               <div class="dv-prce">
                  <p><a href="#">MRP : $<?=$product->mrp?> </a></p>
                  <span>inclusive of all taxes</span>
               </div>
               <div class="quantity" style="padding-bottom:20px;">
                  <div>
                     <div class="btn-minus" id="decrease" onclick="decreaseValue()"><span class="glyphicon glyphicon-minus"></span></div>
                     <input value="1" />
                     <div class="btn-plus" id="increase" onclick="increaseValue()"><span class="glyphicon glyphicon-plus"></span></div>
                  </div>
               </div>
               <div class="catgry" style="display: none">
                  <p><span>Categories:</span> Hair Care, Hair Fall, Sesderma, Sesderma, Seskavel</p>
               </div>
               <div class="sku-cdo">
                  <p><span>SKU:</span> <?=$product->sku?></p>
               </div>
               <div class="by-btns">
                  <button type="button"  class="btn sk-adcrt item-add-to-cart" data-productid="<?= $product->id ?>">Add to Cart</button>

                   <button type="button" class="btn sk-buy">Buy Now</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <!-- Nav tabs -->
            <div class="card tb-txst">
               <ul class="nav nav-tabs " role="tablist">
                  <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab"><i class="fa fa-home"></i> <span>  Description </span></a></li>
                  <li role="presentation"><a href="#reviews" aria-controls="reviewse" role="tab" data-toggle="tab"><i class="fa fa-user"></i> <span>Product Reviews</span></a></li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content pdt-p">
                  <div role="tabpanel" class="tab-pane active" id="description">
                     <p><?=$product->description?> </p>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="reviews">
                     <p><?=$product->description?></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="container-fluid">
	<div class="container">
		<div class="hdng-s">
			<h2>Related Products </h2>
		</div>
		<div class="row">

            <?php
            $related= $this->homemodel->getRelatedProductBYId($product->category);

                    if(!empty($related)){
                        foreach($related as $rel){?>
			<div class="col-md-3">
				<div class="catgry-bxs">
                     <figure class="effect-hera">
                        <img src="<?=base_url('uploads/'.$rel->fimage)?>" alt="img17" class="img-responsive" />
                        <figcaption>
                           <p>
                              <a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                              <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                           </p>
                        </figcaption>
                     </figure>
                     <h3><a href="#"><?=$rel->product?> </a></h3>
                     <p>$<?=$rel->mrp?> </p>
                  </div>
			</div>

            <?php }} ?>


		</div>
	</div>
</div>
<?php include("footer.php"); ?>