<?php $this->load->view("hvwheader"); ?>
<div class="container-fluid prfl-wps">
   <div class="container">
      <ul class="nav nav-pills nav-stacked col-md-3 bhoechie-tab-menu">
         <li class="active"><a href="#tab_a" data-toggle="pill"><i class="fa fa-user sk-t-ic"></i> My Profile</a></li>
         <li><a href="#tab_b" data-toggle="pill"><i class="fa fa-google-wallet sk-t-ic"></i> My Wallet</a></li>
         <li><a href="#tab_c" data-toggle="pill"><i class="fa fa-car sk-t-ic"></i> My Orders</a></li>
         <li><a href="#tab_f" data-toggle="pill"><i class="fa fa-car sk-t-ic"></i> Cancell Orders</a></li>
         <li><a href="#tab_g" data-toggle="pill"><i class="fa fa-car sk-t-ic"></i> Return Orders</a></li>
         <li><a href="#tab_d" data-toggle="pill"><i class="fa fa-heart sk-t-ic"></i> My Wishlist</a></li>
         <li><a href="#tab_e" data-toggle="pill"><i class="fa fa-credit-card sk-t-ic"></i> My Saved Payment</a></li>
         <li><a href="#" data-toggle="modal" data-target="#myModal71"><i class="fa fa-power-off sk-t-ic"></i> Log Out</a></li>
      </ul>
      <div class="tab-content col-md-9 ssko-tbsd">
         <div class="tab-pane active" id="tab_a">
            <div class="ssd-bx">
               <div class="prfil-dv row bhoechie-tab-content">
                  <div class="col-md-8 col-md-offset-2">
                     <div class="prfl-dvs">
                        <div class="prfl-pctr">
                           <img src="/bumaco/uploads/default_avatar.svg" alt="" class="img-responsive">
                        </div>
                        <div class="prf-ttx">
                           <h3><?=$user->name?> </h3>
                           <ul>
                              <li><span>Email :</span> <?=$user->email?> </li>
                              <li><span>Phone Number :</span> <?=$user->phone?> </li>
                           </ul>
                        </div>
                        <div class="edt-pf">
                           <a href="#" data-toggle="modal" data-target="#myModal42"><i class="fa fa-pencil" aria-hidden="true" ></i><input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit"/></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row dtls3">
                  <div class="col-md-8">
                     <div class="prf-addrs">
                        <h3><i class="fa fa-home" aria-hidden="true"></i> My Addresses </h3>
                        <div class="crds-vews">
                           <!--<h6>New Delhi </h6>-->
                           <h4><?=$user->fname?>  <?= $user->lname?> </h4>
                           <p class="addq">Adress : <?=$user->street_no?></p>
                           <p class="ppn"><?=$user->email?></p>
                           <p class="ppn">State : <?=$user->state?></p>
                           <p class="ppn">City : <?=$user->city?></p>
                           <p class="ppn">+91-<?=$user->phone?></p>
                           <p class="ppn">+91-<?=$user->pincode?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="edt-adrs">
                        <a href="#" data-toggle="modal" data-target="#myModal42"><i class="fa fa-pencil" aria-hidden="true"></i><input type="submit" class="edit-adrs-btn" value="Add New Address"/></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_b">
            <div class="ssd-bx">
               <div class="row">
                  <div class="col-md-12">
                     <div class="wwwl1">
                        <div class="wwl-iccn">
                           <i class="fa fa-google-wallet" aria-hidden="true"></i>
                        </div>
                        <div class="bum-wlt">
                           <h3>Nykaa Wallet</h3>
                           <p>A purse you carry to shop Beauty</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 spc-tp">
                     <div class="vlt-bln">
                        <h4>Wallet Balance </h4>
                        <p>₹ 20 </p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="vlt-s2">
                        <div class="csh-ss">
                           <p>Nykaa Cash</p>
                        </div>
                        <div class="csh-ss1">
                           <p><span>₹ 0</span> History</p>
                        </div>
                     </div>
                     <div class="vlt-s2">
                        <div class="csh-ss">
                           <p>Reward Points <span>(2000)</span></p>
                        </div>
                        <div class="csh-ss1">
                           <p><span>₹ 20</span> History</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6"></div>
                  <div class="col-md-12">
                     <div class="wlxt-12s">
                        <a href="#"><img src="/bumaco/uploads/wallet_banner_3.png" alt="" class="img-responsive"></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_c">
            <div class="ssd-bx">
               <div class="row">
                  <div class="col-md-12 mdrs-bdrs">
                     <div class="bum-wlt">
                        <h3><i class="fa fa-arrow-left" aria-hidden="true"></i> My Order </h3>
                     </div>
                  </div>
                   
                  <?php  
                   $id = $this->session->userdata('userid');
                  $order = $this->homemodel->getAllOrderDataList($this->session->userdata('userid'));
                
                  ?>
                   
                   
                   <div class="col-md-12">
				<div class="table-responsive table-borderless">
				    <table class="table">
				        <thead class="tbl-th">
				            <tr>
				                <th>Order #</th>
				                <th>Product name</th>
				                <th>Image</th>
				                <th>Qty</th>
				                <th>Price</th>
				                <th>Date</th>
				                <th>Payment Receipt</th>
				                <th>Status</th>
				                <th>Cancel</th>
				                <th>Return</th>
				            </tr>
				        </thead>
				        <tbody class="table-body">
				            <?php if(!empty($order)){
                            foreach($order as $or){?>
				            <tr>
				                <td><?=$or->orderid?></td>
				                <td><?=$or->product?></td>
				                <td><span class="pdut-imgs"><img src="<?=base_url('uploads/'.$or->image)?>" alt="" class="img-responsive"></span></td>
				                <td><?=$or->qty?></td>
				                <td><?=$or->total_price?></td>
				                <td><?=$or->cancel_date?></td>
				                <td><?=$or->payment_method?></td>
				                <td><?=$or->status?></td>
				                <th><a class="cncl-odrs" href="<?=base_url()?>home/canceledproduct/<?=$or->orderid?>">Cancel </a></th>
				                 <th><a class="cncl-odrs" href="<?=base_url()?>home/returnproduct/<?=$or->orderid?>">Return </a></th>
				            </tr>
				            <?php }} ?>
				        </tbody>
				    </table>
				</div>
			</div>
			
                  <div class="col-md-12 odrs-bx">
                   
                     <div class="row">
                        <div class="col-md-12">
                           <div class="trk-odrs">
                              <p><a href="#">Track <span><i class="fa fa-angle-right"></i></span></a></p>
                           </div>
                        </div>
                     </div>
                     <div class="row shop-tracking-status">
                        <div class="order-status">
                            <div class="order-status-timeline">
                    <!-- class names: c0 c1 c2 c3 and c4 -->
                    <div class="order-status-timeline-completion c3"></div>
                </div>

                <div class="image-order-status image-order-status-new active img-circle">
                    <span class="status">Accepted</span>
                    <div class="icon"></div>
                </div>
<!--                 <div class="image-order-status image-order-status-active active img-circle">
                    <span class="status">In progress</span>
                    <div class="icon"></div>
                </div> -->
                <div class="image-order-status image-order-status-intransit active img-circle">
                    <span class="status">Shipped</span>
                    <div class="icon"></div>
                </div>
                <!-- <div class="image-order-status image-order-status-delivered active img-circle">
                    <span class="status">Delivered</span>
                    <div class="icon"></div>
                </div> -->
                <div class="image-order-status image-order-status-completed active img-circle">
                    <span class="status">Delivered</span>
                    <div class="icon"></div>
                </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
         <div class="tab-pane" id="tab_f">
            <div class="ssd-bx">
               <div class="row">
                  <div class="col-md-12 mdrs-bdrs">
                     <div class="bum-wlt">
                        <h3><i class="fa fa-arrow-left" aria-hidden="true"></i> Cancell Order </h3>
                     </div>
                  </div>
                   
                  <?php  
                   $id = $this->session->userdata('userid');
                  $order = $this->homemodel->getAllCancellOrderDataList($this->session->userdata('userid'));
                
                  ?>
                   
                   
                   <div class="col-md-12">
				<div class="table-responsive table-borderless">
				    <table class="table">
				        <thead class="tbl-th">
				            <tr>
				                <th>Order #</th>
				                <th>Product name</th>
				                <th>Image</th>
				                <th>Qty</th>
				                <th>Price</th>
				                <th>Cancel Date</th>
				                <th>Payment Receipt</th>
				                <th>Status</th>
				            </tr>
				        </thead>
				        <tbody class="table-body">
				            <?php if(!empty($order)){
                            foreach($order as $or){?>
				            <tr>
				                <td><?=$or->orderid?></td>
				                <td><?=$or->product?></td>
				                <td><span class="pdut-imgs"><img src="<?=base_url('uploads/'.$or->image)?>" alt="" class="img-responsive"></span></td>
				                <td><?=$or->qty?></td>
				                <td><?=$or->price?></td>
				                <td><?=$or->cancel_date?></td>
				                <td><?=$or->payment_method?></td>
				                <td><?=$or->status?></td>
				            </tr>
				            <?php }} ?>
				        </tbody>
				    </table>
				</div>
			</div>
               </div>
            </div>
         </div>
         
         
         <div class="tab-pane" id="tab_g">
            <div class="ssd-bx">
               <div class="row">
                  <div class="col-md-12 mdrs-bdrs">
                     <div class="bum-wlt">
                        <h3><i class="fa fa-arrow-left" aria-hidden="true"></i> Return Order </h3>
                     </div>
                  </div>
                   
                  <?php  
                   $id = $this->session->userdata('userid');
                  $order = $this->homemodel->getAllReturnOrderDataList($this->session->userdata('userid'));
                
                  ?>
                   
                   
                   <div class="col-md-12">
				<div class="table-responsive table-borderless">
				    <table class="table">
				        <thead class="tbl-th">
				            <tr>
				                <th>Order #</th>
				                <th>Product name</th>
				                <th>Image</th>
				                <th>Qty</th>
				                <th>Price</th>
				                <th>Return Date</th>
				                <th>Payment Receipt</th>
				                <th>Status</th>
				            </tr>
				        </thead>
				        <tbody class="table-body">
				            <?php if(!empty($order)){
                            foreach($order as $or){?>
				            <tr>
				                <td><?=$or->orderid?></td>
				                <td><?=$or->product?></td>
				                <td><span class="pdut-imgs"><img src="<?=base_url('uploads/'.$or->image)?>" alt="" class="img-responsive"></span></td>
				                <td><?=$or->qty?></td>
				                <td><?=$or->price?></td>
				                <td><?=$or->cancel_date?></td>
				                <td><?=$or->payment_method?></td>
				                <td><?=$or->status?></td>
				            </tr>
				            <?php }} ?>
				        </tbody>
				    </table>
				</div>
			</div>
               </div>
            </div>
         </div>
         
         
         
         <div class="tab-pane" id="tab_d">
            <div class="ssd-bx">
               <div class="row ">
                  <?php if(!empty($wish)){
                     foreach($wish as $wishlist){
                     ?>
                  <div class="col-md-4">
                     <a href="<?=base_url()?>home/productdetail/<?=$wishlist->product_url?>">
                     </a>
                     <div class="nwd-pdt wstlst">
                        <a href="<?=base_url()?>home/removewishlist/<?=$wishlist->id?>" class="close" data-dismiss="nwd-pdt">&times;</a>
                        <a href="<?=base_url()?>home/productdetail/<?=$wishlist->product_url?>">
                        </a>
                        <div class="catgry-bxs">
                           <a href="<?=base_url()?>home/productdetail/<?=$wishlist->product_url?>">
                           </a>
                           <figure class="effect-hera">
                              <a href="<?=base_url()?>home/productdetail/<?=$wishlist->product_url?>">
                              <img src="<?=base_url('uploads/'.$wishlist->image)?>" alt="img17" class="img-responsive">
                              </a>
                              <figcaption>
                                 <a href="<?=base_url()?>home/productdetail/<?=$wishlist->product_url?>">
                                 </a>
                                 <p>
                                    <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                 </p>
                              </figcaption>
                           </figure>
                           <h3><a href="<?=base_url()?>home/productdetail/<?=$wishlist->product_url?>"><?=$wishlist->product?> </a></h3>
                           <p><span class="dl-pp"><del>$<?=$wishlist->mrp?></del></span><span class="prc1">$<?=$wishlist->retail?></span> <span class="css-prqx0k">20% Off</span></p>
                           <div class="rating-box-mn" style="display:none"> 
                              <!--<i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star" aria-hidden="true"></i>
                              <i class="fa fa-star-half-o" aria-hidden="true"></i>-->
                              <span>(0)</span> 
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <?php }} ?>
               </div>
            </div>
         </div>
         <div class="tab-pane" id="tab_e">
            <div class="ssd-bx">
               <div class="row">
                  <div class="col-md-12">
                     <div class="bum-wlt">
                        <h3><i class="fa fa-arrow-left" aria-hidden="true"></i> My Sved Payments </h3>
                     </div>
                  </div>
               </div>
               <div class="row cds-sv-spp">
                  <div class="col-md-6">
                     <div class="svc-crds">
                        <a href="#">
                           <p>45984XXXXXXXXX7304 </p>
                           <h3>Credit Card </h3>
                           <img class="img-responsive" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" />
                        </a>
                        <div class="rmv-bt">
                           <a href="#">Remove card</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="svc-crds">
                        <a href="#">
                           <p>carddemo78@okaxis </p>
                           <h3>Google Pay </h3>
                           <img class="img-responsive" src="/bumaco/uploads/g-pay.png" />
                        </a>
                        <div class="rmv-bt">
                           <a href="#">Remove card</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="svc-crds">
                        <a href="#">
                           <p>7997979785@ybl </p>
                           <h3>BHIM </h3>
                           <img class="img-responsive" src="/bumaco/uploads/g-pay.png" />
                        </a>
                        <div class="rmv-bt">
                           <a href="#">Remove card</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view("footer.php"); ?>
<!-- Modal -->
<div class="modal fade" id="myModal71" role="dialog">
   <div class="modal-dialog prf-out">
      <div class="modal-content">
         <div class="modal-header lgt-scrn">
            <h4>Are you sure you want to logout? </h4>
         </div>
         <div class="modal-body">
            <div class="logout-options-section">
               <ul>
                  <li><a href="<?=base_url()?>home/logout">Logout </a></li>
                  <li><a href="#">Logout from all devices</a></li>
                  <li><a href="#" data-dismiss="modal">Close</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="myModal42" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header pfl-imgs">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <img src="img/default_avatar.svg" alt="" class="img-responsive">
        </div>
        <div class="modal-body">
          <div class="prfl-frms">
          	<form method="post" action="<?=base_url()?>home/updateprofile/<?=$user->id?>" enctype='multipart/form-data'>
          		<div class="row">
          			<div class="col-md-12">
		              <div class="form-group">
		                 <input id="Name" type="text" name="fname" class="form-control sdr-frs" value="<?=$user->fname?>">
		              </div>
	          		</div>
          		</div>
          		<div class="row">
          			<div class="col-md-6">
		              <div class="form-group">
		                 <input id="Phone Number" type="text" name="phone" class="form-control sdr-frs" value="<?=$user->phone?>">
		              </div>
	          		</div>
	          		<div class="col-md-6">
		              <div class="form-group">
		                 <input id="Email" type="text" name="email" class="form-control sdr-frs" value="<?=$user->email?>">
		              </div>
	          		</div>
          		</div>
          		<div class="row">
          			<div class="col-md-12">
		              <div class="form-group">
		                 <input id="Address" type="text" name="street_no" class="form-control sdr-frs" value="<?=$user->street_no?>">
		              </div>
	          		</div>
          		</div>
          		<div class="row">
          			<div class="col-md-6">
		              <div class="form-group">
		                 <input id="State" type="text" name="state" class="form-control sdr-frs" value="<?=$user->state?>">
		              </div>
	          		</div>
	          		<div class="col-md-6">
		              <div class="form-group">
		                 <input id="City" type="text" name="city" class="form-control sdr-frs" value="<?=$user->city?>">
		              </div>
	          		</div>
	          		
	          		<div class="col-md-6">
		              <div class="form-group">
		                  <img src="<?=base_url()?>uploads/<?=$user->image?>" style="width:57px;height:57px;">
		                 <input type="file" name="image" class="form-control sdr-frs">
		              </div>
	          		</div>
	          		
	          		<div class="col-md-6">
		              <div class="form-group">
		                 <input type="text" name="pincode" class="form-control sdr-frs" value="<?=$user->pincode?>">
		              </div>
	          		</div>
	          		
          		</div>
              

              
              <div class="form-group">
                 <input type="submit" id="submit-btn" class="btn btn-green ftr-btn1" value="Update Details">
              </div>
           </form>
          </div>
        </div>
      </div>      
    </div>
  </div>