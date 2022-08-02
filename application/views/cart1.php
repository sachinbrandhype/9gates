<?php $this->load->view("hvwheader.php"); ?>
<div class="container-fluid crt-wp">
   <div class="container">
      <div class="row">
           <?php  //echo $this->session->flashdata('msg1'); ?>
                     <?php          
                        $cart = $this->cart->contents();
                        if(!empty($cart)) 
                        {
                        ?>
         <div class="col-md-12">
            
            <table id="cart" class="table table-hover table-condensed crts-sks">
               <thead>
                  <tr>
                     <th class="pdt">Product</th>
                     <th class="pdt-tle">Product Title</th>
                     <th class="pdt-prc">Price</th>
                     <th class="pdt-qbty">Quantity</th>
                     <th class="pdt-ttl">Subtotal</th>
                  </tr>
               </thead>
               <tbody>
                   
                         <?php echo form_open('home/update_cart');
                              $subtotal = 0;
                               $ship_charge = 0;
                              $s = array();
                              foreach ($cart as $item) {
                              $tPrice=$item['price'];
                              //$t=$tPrice*$tax/100;
                              $subtotal = $subtotal + ($item['retail']*$item['qty']);
                              if ( ! isset($s['total'])) {
                              $s['total'] = null;
                              }
                              $s['total'] = $s['total'] + ($item['retail']*$item['qty']);
                              
                              echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                              echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                              echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                              echo form_hidden('cart[' . $item['id'] . '][retail]', $item['retail']);
                              echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                              
                              
                              $product = $this->homemodel->getProductNameByCartId($item['id']);
                              
                              ?>
                  <tr>
                     <td data-th="Product">
                        <img src="<?=base_url('uploads/'.$item['image'])?>" alt="..." class="img-responsive"/>
                     </td>
                     <td data-th="product-totle"><h4 class="nomargin"><?php echo $product->product; ?></h4></td>
                     <td data-th="Price">$<?php echo $item['retail']; ?></td>
                     <td data-th="Quantity"><input type="text" id="cart" name="cart[<?php echo $item['id']; ?>][qty]" value="<?php echo $item['qty']; ?>" class="form-control no-round cart">
                     <div class="col-md-4">
                     <button type="submit" class="btn btn-default red" title="Update Cart"><i class="fa fa-refresh"></i></button></div>
                     </td>
                     <td data-th="Subtotal" class="text-center">$<?php echo $item['retail']*$item['qty']; ?></td>
                     <td class="trshs" data-th="">
		               <!--<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>     -->
		                <a href="<?php echo base_url().'home/remove/'.$item['rowid']; ?>" class="btn sk-btndlt btn-sm" ><i class="fa fa-trash-o"></i></a>
		            </td>
                  </tr>
                  <?php } ?>
                  
                  
               </tbody>
            </table>
         </div>
         <div class="col-md-12">
         	<tfoot>
              <div class="cart-collaterals">
				   <div class="cart_totals ">
				      <h2>Cart totals</h2>
				      <div class="dtls">
						   <div class="crts-rws">
						      <div class="bg-ttl"><span class="vernacular-string">Bag Total</span></div>
						      <div class="bg-vlue">$<?=$subtotal?></div>
						   </div>
						   <?php if(isset($this->session->userdata['coupon_value'])){  ?>
						   
						   
						   <?php $coupon = $this->session->userdata['coupon_value'];
						   
						   $amt= $this->session->userdata['amount'] ;
						   
						   if($amt <= $subtotal){
						       
						       
						       $discount = $subtotal* $coupon/100;
						       
						       
						       
						       $sbt = $subtotal-$discount;
						   
						   ?>
						   
						   <div class="crts-rws">
						      <div class="bg-ttl"><span class="vernacular-string">Bag Discount</span></div>
						      <div class="bg-vlue">$<?= $discount?></div>
						   </div>
						   <?php } } else { ?>
						   
						   <div class="crts-rws">
						      <div class="bg-ttl"><span class="vernacular-string">Bag Discount</span></div>
						      <div class="bg-vlue">No</div>
						   </div>
						   
						   <?php } ?>
						   <!--<div class="crts-rws">
						      <div class="bg-ttl"><span class="vernacular-string">Sub Total</span></div>
						      <div class="bg-vlue">$<?=$sbt?></div>
						   </div>-->
						   
						   <?php if(!empty($sbt)){?>
						   
						   <div class="ttl-d">
						   <div class="bg-ttl"><p>Grand Total: </p></div>
						   <div class="bg-vlue"><p>$<?=$sbt?></p> </div>
						</div>
						
						
						<?php } else { ?>
						
						<div class="ttl-d">
						   <div class="bg-ttl"><p>Grand Total: </p></div>
						   <div class="bg-vlue"><p>$<?=$s['total']?></p> </div>
						</div>
						
						<?php } ?>
						
						
					  </div>
						<!--<div class="ttl-d">
						   <div class="bg-ttl"><p>Grand Total: </p></div>
						   <div class="bg-vlue"><p>$<?=$s['total']?></p> </div>
						</div>-->
						<div class="sk-ckst">
						   <a href="<?=base_url()?>home/checkout" class="btn btn-cksks btn-block">Proceed to checkout <i class="fa fa-angle-right"></i></a>
						</div>
				   </div>
				</div>
            </tfoot>
         </div>
         <?php } ?>
         
         
         <div class="col-md-4">
          <form class="pr-form" id="frm">
               <span class="message" id="msgcoupon"></span>
               <br>
             <input type="text" placeholder="Coupon Code" name="coupon" id="coupon">
            
             <input type="button" id="isValidateCoupondata" value="Apply Now" name="submit">
          </form>
       </div>
         
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
     $(document).on('click','#isValidateCoupondata', function() {
   if (isValidateCouponr()) {
   //var frm1 = $("#frmcoupon").serialize();
  var code =$('#coupon').val();

   $.ajax({
   url:'<?=base_url("home/checkcoupon")?>',
   data : {code:code},
   type : 'POST',
   success : function(data) {
    window.location.href='';
   }
   });
   }
   });  
   
   function isValidateCouponr() {
   
   var valid = true;
   var coupon = $("input[name='coupon']").val();
   
   $(".message").html("&nbsp;");
   $(".message").css("color", "red");
   $(".message").css("font-size", "12px");
   $(".message").hide();
   
   if (coupon.length == 0) {
   valid = false;
   $("#msgcoupon").html("Enter coupon code");
   $("#msgcoupon").show();
   }
   
   return valid;
   }
</script>


<?php $this->load->view("footer.php"); ?>

