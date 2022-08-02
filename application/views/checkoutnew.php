<?php include("header.php"); ?>
<div class="container-fluid crtp">
   <div class="container">
   	<div class="row">
   		<div class="col-md-12">
   			<div class="rtn-lgn">
   				<div class="returning-info">
                  <i class="fa fa-window-maximize" aria-hidden="true"></i>
                  Returning customer? <a href="#" class="showlogin">Click here to login</a>  
                </div>
                <div class="returning-info">
                  <i class="fa fa-window-maximize" aria-hidden="true"></i>
                  Have a coupon?  <a href="#coupon-code" class="showlogin"> Click here to enter your code</a> 
               </div>
   			</div>
   		</div>
   	</div>
      <div class="row">
         <div class="col-md-6">
            <h3 class="bdlsp">Billing details</h3>
            <div class="account-box left-side">
               <form>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>First Name *</label>
                        <input id="Name" type="text" class="form-control crt-sdr-frs" placeholder="Full Name">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Last Name *</label>
                        <input id="pass" type="text" class="form-control crt-sdr-frs" placeholder="Password">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Company name (optional) </label>
                        <input id="text" type="text" class="form-control crt-sdr-frs" placeholder="Company name">
                     </div>
                  </div>
                  <!-- <p>Country / Region *<br>
                     <strong>India</strong>
                  </p> -->
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Street address *</label>
                        <input id="Name" type="text" class="form-control crt-sdr-frs" placeholder="House number and street name">
                     </div>
                  </div>
                  <div class="col-md-6 add">
                     <div class="form-group">
                        <label>&nbsp;</label>
                        <input id="pass" type="text" class="form-control crt-sdr-frs" placeholder="Apartment, suite, unit, etc. (optional)">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Town / City *</label>
                        <input id="Name" type="text" class="form-control crt-sdr-frs" placeholder="Town / City">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>State  * </label>
                        <input id="pass" type="text" class="form-control crt-sdr-frs" placeholder="State">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Pin code *</label>
                        <input id="text" type="text" class="form-control crt-sdr-frs" placeholder="Pin code">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Phone *</label>
                        <input id="Name" type="text" class="form-control crt-sdr-frs" placeholder="Phone">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Email address * </label>
                        <input id="pass" type="text" class="form-control crt-sdr-frs" placeholder="Email address">
                     </div>
                  </div>
                  <div class="form-group">
                     <p><input id="create-acc" type="checkbox">Create an account?</p>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-6 ">
            <h3 class="bdlsp">Your order</h3>
            <div class="account-boxl you-order">
               <div id="order_review" class="checkout-review-order">
                  <table class="shop_table checkout-review-order-table">
                     <thead>
                        <tr class="crt-tle">
                           <th>Product</th>
                           <th>Subtotal</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr class="cart_item">
                           <td>Sesderma Hidradermin Body Milk for instant Hydration 250ML × 1</td>
                           <td>₹1,000.00 (incl. VAT)</td>
                        </tr>
                     </tbody>
                     <tfoot>
                        <tr class="cart-subtotal">
                           <th>Subtotal</th>
                           <td>₹1,000.00 (incl. VAT)</td>
                        </tr>
                        <tr class="cart-subtotal" id="coupon-code">
                           <th>Have A Promo Code?</th>
                           <td>
                           <form>
                              <input type="text" name="promo" class="procde" placholder="Enter Code">
                              <a href="#" class="btnprm"></a>
                           </form></td>
                        </tr>
                        <tr class="order-total">
                           <th>Total</th>
                           <td>₹1,000.00 (includes ₹76.27 9% CGST, ₹76.27 9% SGST)</td>
                        </tr>
                     </tfoot>
                  </table>
                  <div id="payment" class="checkout-payment">
                     <ul class="payment_methods payment_methods methods">
                        <li class="payment_method payment_method_paytm">
                           <input id="payment_method_paytm" type="radio" class="input-radio" name="payment_method" value="paytm" checked="checked" data-order_button_text="">
                           <label for="payment_method_paytm">
                           Paytm <img src="/bumaco/uploads/paytm_logo.png" alt="Paytm">   </label>
                           <div class="payment_box payment_method_paytm">
                              <p><img src="/bumaco/uploads/payment-mode.jpg" alt="paytm payment gateway"><br>
                                 Pay securely by Credit or Debit card or net banking through Paytm payment gateway.
                              </p>
                           </div>
                        </li>
                        <li class="wc_payment_method payment_method_sezzlepay">
                           <input id="payment_method_sezzlepay" type="radio" class="input-radio" name="payment_method" value="sezzlepay" data-order_button_text="">
                           <label for="payment_method_sezzlepay">
                           Sezzle <img src="/bumaco/uploads/sezzel.webp" alt="Sezzle"> </label>
                           <div class="payment_box payment_method_sezzlepay" style="display:none;">
                              <p>Buy now, Pay later in 4 installments. 0% interest.</p>
                           </div>
                        </li>
                     </ul>
                     <div class="form-row place-order">
                        <noscript>
                           Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.        <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                        </noscript>
                        <div class="terms-and-conditions-wrapper">
                           <div class="privacy-policy-text">
                              <p>Your personal data will be used to process your order, support your experience throughout this website, 
                                 and for other purposes described in our <a href="privacy-policy.html" class="privacy-policy-link" target="_blank">privacy policy</a>.
                              </p>
                           </div>
                        </div>
                        <button type="submit" class="button alt" name="checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>
                        <input type="hidden" id="process-checkout-nonce" name="process-checkout-nonce" value="b5d57df8c3"><input type="hidden" name="_wp_http_referer" value="/?wc-ajax=update_order_review">  
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include("footer.php"); ?>