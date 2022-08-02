<?php $this->load->view("hvwheader"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Google Maps JavaScript library -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyA2eDieYYeKw3dgRyokETYu4h7gOUs45b0"></script>
<div class="container-fluid crtp">
   <div class="container">
     
      <div class="row">
         <div class="col-md-8">
            <div class="mmnus">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingOne">
                         <?php $userEmail = $this->session->userdata('userid');?>
                         
                         <?php if($userEmail!=''){?>
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordionokok" href="#collapseOneokok" aria-expanded="true" aria-controls="collapseOne">
                          <!-- <i class="more-less glyphicon glyphicon-plus"></i>-->
                           User Login <i class="fa fa-check" style="font-size:33px;color:green;position: absolute;top: 10px;right: 20px;"></i>
                           </a>
                        </h4>
                        <?php } else { ?>
                        
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           <i class="more-less glyphicon glyphicon-plus"></i>
                           Login or Signup
                           </a>
                        </h4>
                        <?php } ?>
                     </div>
                     <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="ck-p">
                                    <div id="msglogin"></div>
                                    <form id="frm" class="mobilediv">
                                       <div class="form-group">
                                          <input type="text" name="phonecheck" class="llg"  placeholder="Mobile number">
                                          <span class="message" id="msgphonecheck"></span>
                                       </div>
                                       <input type="button" class="btn-lgn" id="isValidateLoginPhone" value="Continue">
                                    </form>
                                    <br>
                                    
                                    
                                    <div id="msgotpmobile"></div>
                                    <form id="mobileotp" class="otpdiv">
                                       <div class="form-group">
                                          <input type="text" name="otp" class="llg" placeholder="OTP">
                                          <span class="message" id="msgotp"></span>
                                       </div>
                                       <input type="button" class="btn-lgn" id="isCheckOTP" value="Check OTP">
                                    </form>
                                    <br>
                                    
                                    <div id="msgotp"></div>
                                    <form id="otp" class="logindiv">
                                       <div class="form-group">
                                          <input type="text" name="email" class="llg"  placeholder="Enter Email">
                                          <span class="message" id="msgemail"></span>
                                       </div>
                                       <div class="form-group">
                                          <input type="password" name="password" class="llg" placeholder="Password">
                                          <span class="message" id="msgpassword"></span>
                                       </div>
                                       <div class="form-group">
                                          <input type="password" name="cpassword" class="llg" placeholder="Confirm Password">
                                          <span class="message" id="msgcpassword"></span>
                                       </div>
                                     
                                       <input type="button" class="btn-lgn" id="isValidateOtpPassword" value="Login">
                                    </form>
                                    <div class="nw-usr">
                                       <p><a href="#">New to 9Gates? Create an account </a></p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="ck-rgt">
                                    <h3>Advantages of our secure login</h3>
                                    <ul>
                                       <li>Easily Track Orders, Hassle free Returns </li>
                                       <li>Get Relevant Alerts and Recommendation</li>
                                       <li>Wishlist, Reviews, Ratings and more.</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel panel-default" id="tab1">
                     <div class="panel-heading" role="tab" id="heading2">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
                           <i class="more-less glyphicon glyphicon-plus"></i>
                           Delivery Address
                           </a>
                        </h4>
                     </div>
                     <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                        <div class="panel-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="blnhg">
                                    <!-- <div class="col-md-6"> -->
                                    <div class="account-box left-side">
                                       <form id="frmcheckout" action="#" method="post" enctype="multipart/form-data">
                                          <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>First Name *</label>
                                                <input name="fname" id="fname" type="text" class="form-control crt-sdr-frs" placeholder="Name">
                                                <span class="message" id="msgfname"></span>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Last Name *</label>
                                                <input name="lname" id="lname" type="text" class="form-control crt-sdr-frs" placeholder="Name">
                                                <span class="message" id="msglname"></span>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="row">
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Phone *</label>
                                                <input name="phone" id="phone" type="text" class="form-control crt-sdr-frs" placeholder="Phone">
                                                <span class="message" id="msgphone"></span>
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Email address * </label>
                                                <input name="email" id="email" type="text" class="form-control crt-sdr-frs" placeholder="Email address">
                                                <span class="message" id="msgemail"></span>
                                             </div>
                                          </div>
                                          </div>
                                          
                                          <div class="row">
                                          <div class="col-md-12">
                                             <div class="form-group">
                                                <label>Street address *</label>
                                                <input name="street_no" id="search_input" type="text" class="form-control crt-sdr-frs" placeholder="House number and street name">
                                                
                                                
                                                <span class="message" id="msgstreet_no"></span>
                                             </div>
                                          </div>
                                          </div>
                                       


                                          <div class="row">
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <label>Town / City *</label>
                                                <input name="city" id="city" type="text" class="form-control crt-sdr-frs" placeholder="Town / City">
                                                <span class="message" id="msgcity"></span>
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <label>State  * </label>
                                                <input name="state" id="state" type="text" class="form-control crt-sdr-frs" placeholder="State">
                                                <span class="message" id="msgstate"></span>
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             <div class="form-group">
                                                <label>Pin code *</label>
                                                <input name="pincode" id="pincode" type="text" class="form-control crt-sdr-frs" placeholder="Pin code">
                                                <span class="message" id="msgpincode"></span>
                                             </div>
                                          </div>
                                          </div>
                                          
                                           
                                          <?php       
                                             $cart = $this->cart->contents();
                                             if(!empty($cart)) 
                                             {
                                                 $subtotal=0;
                                                $s = array();
                                             ?>
                                             <div class="row">
                                          <div class="col-md-12 ">
                                             <h3 class="bdlsp">Your order</h3>
                                             <div class="account-boxl you-order">
                                                <div id="order_review" class="checkout-review-order">
                                                   <table class="shop_table checkout-review-order-table">
                                                      <thead>
                                                         <tr class="crt-tle">
                                                            <th>Product</th>
                                                            <th>Qty</th>
                                                            <th>Subtotal</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <?php foreach ($cart as $item) {
                                                            $tPrice=$item['price'];
                                                            $subtotal = $subtotal + ($item['retail']*$item['qty']);
                                                            
                                                            if ( ! isset($s['total'])) {
                                                            $s['total'] = null;
                                                            }
                                                            $s['total'] = $s['total'] + ($item['retail']*$item['qty']);
                                                            
                                                             $product = $this->homemodel->getProductNameByCartId($item['id']);
                                                             
                                                              if(isset($this->session->userdata['coupon_value'])){  
						   
						   
                                    						    $coupon = $this->session->userdata['coupon_value'];
                                    						   
                                    						   $amt= $this->session->userdata['amount'] ;
                                    						   
                                    						   if($amt <= $subtotal){
                                    						       
                                    						       
                                    						       $discount = $subtotal* $coupon/100;
                                    						       
                                    						       
                                    						       
                                    						       $sbt = $subtotal-$discount;
						   
                                    						   }}
                                                            
                                                            ?>
                                                         <tr class="cart_item">
                                                            <td><?php echo $product->product; ?></td>
                                                            <td><?php echo $item['qty']; ?></td>
                                                            <td>$<?php echo $item['retail']*$item['qty']; ?> (incl. VAT)</td>
                                                         </tr>
                                                      </tbody>
                                                      <?php } ?>
                                                      
                                                      <tfoot>
                                                         <tr class="cart-subtotal">
                                                            <th>Subtotal</th>
                                                            <td>$<?=$subtotal?></td>
                                                         </tr>
                                                         
                                                         <?php if(!empty($discount)){?>
                                                         <tr class="cart-subtotal">
                                                            <th>Dicount</th>
                                                            <td>$<?=$discount?></td>
                                                         </tr>
                                                         <?php } else { ?>
                                                         
                                                         <tr class="cart-subtotal">
                                                            <th>Dicount</th>
                                                            <td>No</td>
                                                         </tr>
                                                         
                                                         <?php } ?>
                                                         
                                                         
                                                         <?php if(!empty($sbt)){?>
                                                         
                                                         <tr class="order-total">
                                                            <th>Total</th>
                                                            <td>$<?=$sbt?> </td>
                                                         </tr>
                                                         <?php } else { ?>
                                                         
                                                         
                                                         <tr class="order-total">
                                                            <th>Total</th>
                                                            <td>$<?=$s['total']?> </td>
                                                         </tr>
                                                         
                                                         <?php } ?>
                                                      </tfoot>
                                                      <?php } ?> 
                                                   </table>
                                                   <div id="payment" class="checkout-payment">
                                                      <ul class="payment_methods payment_methods methods">
                                                         <li class="payment_method payment_method_paytm">
                                                            <input id="payment_method_paytm" type="radio" class="input-radio" name="payment_method" value="Razorpay" checked="checked" data-order_button_text="">
                                                            <label for="payment_method_paytm">
                                                            Razorpay <img src="<?=base_url()?>image/razorpay.jpg" alt="razorpay" style='width: 84px;'>   </label>
                                                            
                                                         </li>
                                                         <li class="wc_payment_method payment_method_sezzlepay">
                                                            <input id="payment_method_sezzlepay" type="radio" class="input-radio" name="payment_method" value="COD" data-order_button_text="">
                                                            <label for="payment_method_sezzlepay">COD</lable>
                                                            
                                                         </li>
                                                      </ul>
                                                      <div class="form-row place-order">
                                                         <noscript>
                                                            Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.        <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                                                         </noscript>
                                                         <div class="terms-and-conditions-wrapper">
                                                            <div class="privacy-policy-text">
                                                               <p>Your personal data will be used to process your order, support your experience throughout this website, 
                                                                  and for other purposes described in our <a href="<?=base_url()?>home/privacypolicy" class="privacy-policy-link" target="_blank">privacy policy</a>.
                                                               </p>
                                                            </div> 
                                                         </div>
                                                         <?php $userid = $this->session->userdata['userid'] ;?>
                                                         <?php if(!empty($userid)){?>
                                                         <input type="button" class="button alt" name="btn" id="place_order" value="Place order" data-value="Place order"  value="Place order">
                                                         <?php } else{?>
                                                         
                                                         <input type="button" class="button alt" name="checkout_place_order" id="place_order" value="Place order" data-value="Place order" value="Place order">
                                                         <?php } ?>
                                                         <input type="hidden" id="process-checkout-nonce" name="process-checkout-nonce" value="b5d57df8c3"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review">  
                                                      </div>
                                       
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4"></div>
      </div>
      
   </div>
</div>
<?php $this->load->view("footer.php"); ?>



<script>
var searchInput = 'search_input';
 
$(document).ready(function () {
 var autocomplete;
 autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
  types: ['geocode'],
  /*componentRestrictions: {
   country: "USA"
  }*/
 });
  
 google.maps.event.addListener(autocomplete, 'place_changed', function () {
  var near_place = autocomplete.getPlace();
 });
});
</script>


<script> 
   $('.logindiv').hide();
    $('.otpdiv').hide();
       $(document).on('click','#isValidateLoginPhone', function() {
      if (isValidateLoginPhone()) {
         var frm = $("#frm").serialize(); 
         $.ajax({
            url :'<?=base_url("home/loginuserbyemail")?>',
            data : frm,
            type : 'POST',
            success : function(result) {
               
                $("#msgmobileno").html("&nbsp;");
				$("#msgmobileno").css("color", "red");
				$("#msgmobileno").css("font-size", "12px");
				$("#msgmobileno").hide();
				window.location.reload(true);
				if (result.indexOf("1") > -1) {
					$("#msgmobileno").html("Mobile no already use.");
					$("#msgmobileno").show();
					window.location.reload(true);
				}else if (result.indexOf("3") > -1) {
					$("#msgmobileotp").html("Mobile no register please enter your otp.");
					$('.otpdiv').show();
					$('.mobilediv').hide();
					getotp();
					window.location.reload(true);
				}
				else if (result.indexOf("4") > -1) {
					
					$('.otpdiv').hide();
					$('.mobilediv').hide();
					$('.logindiv').show();
					loginguser();
					window.location.reload(true);
				}
				else if (result.indexOf("5") > -1) {
					loginguser();
					$('.otpdiv').show();
					$('.mobilediv').hide();
					$('.logindiv').hide();
					window.location.reload(true);
				}
            }
         });
      }
   });   
   
   function isValidateLoginPhone() {
   
      var valid = true;
      var phonecheck = $("input[name='phonecheck']").val();
      $(".message").html("&nbsp;");
      $(".message").css("color", "red");
      $(".message").css("font-size", "12px");
      $(".message").hide();
      
      if (phonecheck.length == 0 || checkcontactnumber(phonecheck) == false ) {
         valid = false;
         $("#msgphonecheck").html("Enter valid 10 digit mobile number");
         $("#msgphonecheck").show();
      }
      
     
   
      return valid;
   }
   
   function checkcontactnumber(phonecheck) {
	var contactRegexStr = /^\d{10}$/;
	var isvalid = contactRegexStr.test(phonecheck);
	return isvalid;
}
   
     
   
   function getotp(){
      if (isValidateLoginCheckOTP()) {
         var frm = $("#mobileotp").serialize();
        alert(frm);
         $.ajax({
            url :'<?=base_url("home/checkotpindatabase")?>',
            data : frm,
            type : 'POST',
            success : function(result) {
                alert(result);
                 if (result.indexOf("4") > -1) {
					$('.otpdiv').hide();
					$('.mobilediv').hide();
					$('.logindiv').show
					loginguser();
				}
				else if (result.indexOf("5") > -1) {
					loginguser();
					$('.otpdiv').show();
					$('.mobilediv').hide();
					$('.logindiv').hide
				}
                
            }
         });
      }
   }   
       
   function isValidateLoginCheckOTP() {
   
      var valid = true;
      var otp = $("input[name='otp']").val();
       
      $(".message").html("&nbsp;");
      $(".message").css("color", "red");
      $(".message").css("font-size", "12px");
      $(".message").hide();
        
       
      if (otp.length == 0 ) {
         valid = false;
         $("#msgotp").html("Enter valid  otp");
         $("#msgotp").show();
      }
   
      return valid;
   }
   
   
  function loginguser(){
      if (isValidateOTP()) {
         var frm = $("#otp").serialize();
         alert(frm);
         $.ajax({
            url :'<?=base_url("home/setuserpassword")?>',
            data : frm,
            type : 'POST',
            success : function(result) {
                alert(result);
               //window.loaction='<?=base_url()?>home/index';
               location.reload();
            }
         });
      }
   }   
   
   function isValidateOTP() {
   
      var valid = true;
      var email = $("input[name='email']").val();
      var cpassword = $("input[name='cpassword']").val();
       var password = $("input[name='password']").val();
       
      $(".message").html("&nbsp;");
      $(".message").css("color", "red");
      $(".message").css("font-size", "12px");
      $(".message").hide();
      
      if (email.length == 0 ) {
         valid = false;
         $("#msgemail").html("Enter valid  email");
         $("#msgemail").show();
      }
      
      if (password.length == 0 ) {
         valid = false;
         $("#msgpassword").html("Enter valid details");
         $("#msgpassword").show();
      }
        else if (password.length <= 6) {
            valid = false;
            $("#msgpassword").html("Enter password to short");
            $("#msgpassword").show();
        }
        if (cpassword.length == 0) {
            valid = false;
            $("#msgcpassword").html("Please enter confirm password");
            $("#msgcpassword").show();
        } else if (password != cpassword) {
            valid = false;
            $("#msgcpassword").html("Password mis match");
            $("#msgcpassword").show();
        }
      return valid;
   }
</script>
<style type="text/css">
   .ck-p {
   padding: 15px;
   }
   .panel-group .panel {
   border-radius: 0;
   box-shadow: none;
   border-color: #EEEEEE;
   }
   .panel-default > .panel-heading {
   padding: 0;
   border-radius: 0;
   color: #fff;
   background-color: #f91e6a;
   border-color: #EEEEEE;
   }
   .panel-title {
   font-size: 17px;
   font-weight: bold;
   text-transform: uppercase;
   letter-spacing: 1px;
   }
   .panel-title > a {
   display: block;
   padding: 15px;
   text-decoration: none;
   }
   .more-less {
   float: right;
   color: #212121;
   }
   .panel-default > .panel-heading + .panel-collapse > .panel-body {
   border-top-color: #EEEEEE;
   }
</style>
<script type="text/javascript">
   function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
   }
   $('.panel-group').on('hidden.bs.collapse', toggleIcon);
   $('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>