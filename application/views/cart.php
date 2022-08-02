<?php $this->load->view("header.php"); ?>
<div class="container-fluid crt-wp">
   <div class="container">
      <div class="row">
         <div class="col-md-5">
            <div class="crt-sks">
               
 
                <?php echo $this->session->flashdata('msg1'); ?>
                     <?php          
                        $cart = $this->cart->contents();
                        if(!empty($cart)) 
                        {
                        ?>
                     <div class="mdl-bdyp">
                        <div class="crt-sks9">
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
                              $s['total'] = $s['total'] + ($item['price']*$item['qty']);
                              
                              echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                              echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                              echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                              echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                              echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                              
                              ?>

            	<div class="crt-pdtcs">
		            <div class="row spcctr">
		               <div class="col-md-3"><img src="<?=base_url('uploads/'.$c->image)?>" alt="..." class="img-responsive"/></div>
		               <div class="col-md-8">
		                  <div class="crt-dtls">
		                     <h4 class="nomargin"><?=$c->product?></h4>
		                     <p><?=$c->short_description?></p>
		                  </div>
		               </div>
		               <div class="col-md-1">
		                  <div class="sk-acns">
		                     <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
		                     <button class="btn btn-danger btn-sm remove" id="<?=$c->product_id?>"><i class="fa fa-trash-o"></i></button>
		                  </div>
		               </div>
		            </div>
		            <div class="row spcctr">
		               <div class="col-md-6">
		                  <div class="qutys">
                              <tr>
                              <td><input type="hidden"  name="proid" id="proid" value="<?=$c->product_id?>"></td>

                              <p>Quantity : <input type="text" id="proid" class="qty-frm itemQty" name="proid" value="<?=$c->qty?>"></p>
                              </tr>
		                  </div>
		               </div>

                     
		               <div class="col-md-6">
		                  <div class="sk-prc">
		                     <ul>
		                        <li><del>$1</del></li>
		                        <li>$1</li>
		                     </ul>
		                  </div>
		               </div>
		            </div>
	        	</div>

                 <?php } ?>
              
                  
                  
                  <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $this->load->view("footer.php"); ?>