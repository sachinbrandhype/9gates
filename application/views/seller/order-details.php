<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Order Details<p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a>
        <span class="separator"></span><strong><a href="<?php echo base_url('seller/view-orders'); ?>">View Order</a></strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
   
    <div class="col-sm-6">
     
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Order History</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/update-personal-details" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <tr>
                      <th>Sl No.</th>
                      <th>Date Added</th>
                      <th>Status</th>
                      <th>Comment</th>
                    </tr>
                    
                    <?php $sl =1 ;
					 
					foreach($oh as $h) { 
					
					?>
                    <tr>
                    <td><?php echo $sl.'.'; ?></td>
                     <td><?php echo date('d-M-Y',strtotime($h->added_date)); ?></td>
                     <td><?php echo $h->product_status; ?></td>
                     
                     <td><?php echo $h->comments; ?></td>
                     
                    </tr>
                    <?php 
					$sl++;} 
					?>
                    
                    
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    
   <?php
	  echo $id = $this->session->userdata('seller_id');
	  echo $cus_id = $c[0]->order_id;
	  
				//$sql5 = "SELECT * FROM `customers_info` where seller_id='$id' and seller_shipping_from='own'";
				//$order1 = $this->db_model->getAlldata($sql5);
				?>
    
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Add Order History</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/add-order-history" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    
                    <tr>
                      <td>Order Status</td>
                      <td><select class="form-control" name="order_status" id="area" required>
                        	<option value="">Select Status</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Canceled Reversal">Canceled Reversal</option>
                            <option value="Chargeback">Chargeback</option>
                            <option value="Complete">Complete</option>
                            <option value="Denied">Denied</option>
                            <option value="Expired">Expired</option>
                            <option value="Failed">Failed</option>
                            <option value="Pending">Pending</option>
                            <option value="Processed">Processed</option>
                            <option value="Processing">Processing</option>
                            <option value="Refunded">Refunded</option>
                            <option value="Reversed">Reversed</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Voided">Voided</option>
                           </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Comments </td>
                        <td>
                            <textarea name="comments" class="form-control" placeholder="Comments"></textarea>
                        </td>
                    </tr>
                    
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="submit" class="btn btn-primary">Add History</button></td>
                    </tr>
                   
                   
                    
                  </tbody>
                </table>
                <input type="hidden" name="order_id" value="<?php echo $c[0]->order_id; ?>" />
                
              </form>
            </div>
          </div>
        </div>
      </div>
      
      
      
      <div class="clearfix"></div>
    
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Customer Details</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="#">
                <table class="table table-user-information noBoredr">
                  <tbody>
                  
                    <tr>
                    <td>Order ID</td>
                     <td><?php echo $c[0]->order_id; ?></td>
                    </tr>
                    
                    <tr>
                    <td>Customer Name</td>
                     <td><?php echo $c[0]->cus_name; ?></td>
                    </tr>
                    
                    <tr>
                    <td>Email</td>
                     <td><?php echo $c[0]->cus_email; ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td>Mobile No.</td>
                     <td><?php echo $c[0]->cus_mobile; ?></td>
                    </tr>
                    
                   
                    
                    
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    
    
    
    
    
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Order Details</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/update-personal-details" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <tr>
                      <th>Sl No.</th>
                      <th width="30%">Product Name</th>
                      <th width="10%">Quantity</th>
                      <th>Product Price</th>
                      <th>Total</th>
                    </tr>
                    
                    <?php 
					$sl =1 ;
					$subtotal = $oc[0]->total_order_price;
					$ship_charge = $oc[0]->total_ship_charge + ($oc[0]->minus_ship_charge);
					$ad_ship_charge = $oc[0]->additional_ship_charge;
					foreach($od as $d) { 
					//$subtotal = $subtotal + $d->total_product_price;
					?>
                    <tr>
                    <td><?php echo $sl.'.'; ?></td>
                     <td><a href="<?php echo base_url().$d->product_name_url; ?>" target="_blank"><?php echo $d->product_name; ?></a></td>
                     <td><?php echo $d->product_qty; ?></td>
                     <td><?php echo 'Rs '.$d->product_price; ?></td>
                     <td><?php echo 'Rs '.$d->total_product_price; ?></td>
                    </tr>
                    <?php 
					$sl++;} 
					?>
                    
                    <tr>
                    <td colspan="4" align="right"><storng>Subtotal :</storng></td>
                    <td><?php echo 'Rs '.$subtotal; ?></td>
                    </tr>
                    
                    <tr>
                    <td colspan="4" align="right"><storng>Total Shipping Charge:</storng></td>
                    <td><?php if($ship_charge != 0){echo 'Rs '.$ship_charge;}else{echo 'FREE';} ?></td>
                    </tr>
                    
                    <tr>
                    <td colspan="4" align="right"><storng>Subtotal :</storng></td>
                    <td><?php echo 'Rs '.$ad_ship_charge; ?></td>
                    </tr>
                    
                   
                    
                     <?php $grand_total = $subtotal + $ship_charge + $ad_ship_charge; ?>
                    <tr>
                    <td colspan="4" align="right"><storng>Grand Total :</storng></td>
                    <td><?php echo 'Rs '.$grand_total; ?></td>
                    </tr>
                    
                    
                    
                    
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    
    
     <div class="clearfix"></div>
    
    
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Billing Address</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/update-personal-details" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    
                    <tr>
                        <td>Bill Name :</td>
                        <td><?php echo $b[0]->bill_name; ?></td>
                      </tr>
                      
                      <tr>
                        <td>Mobile</td>
                        <td><?php echo $b[0]->bill_mobile; ?></td>
                      </tr>
                      
                        <tr>
                        <td>Address</td>
                        <td><?php if($b[0]->bill_address != ''){ echo $b[0]->bill_address;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>Country</td>
                        <td><?php if($b[0]->bill_country != 0){ echo $b[0]->country_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>State</td>
                        <td><?php if($b[0]->bill_state != 0){ echo $b[0]->state_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      
                      <tr>
                        <td>City</td>
                        <td><?php if($b[0]->bill_city != 0){ echo $b[0]->city_name;} else { echo '-';} ?></td>
                      </tr>
                      
                       <tr>
                        <td>Area</td>
                        <td><?php if($b[0]->bill_area != 0){ echo $b[0]->area_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>Pincode</td>
                        <td><?php if($b[0]->bill_pincode != 0){ echo $b[0]->bill_pincode;} else { echo '-';} ?></td>
                      </tr>
                    
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    
    
    
    
  
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Shipping Address</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/update-personal-details" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    
                    <?php if(empty($s)) { ?>
                    <tr>
                        <td>Ship Name :</td>
                        <td><?php echo $b[0]->bill_name; ?></td>
                      </tr>
                      
                      <tr>
                        <td>Mobile</td>
                        <td><?php echo $b[0]->bill_mobile; ?></td>
                      </tr>
                      
                        <tr>
                        <td>Address</td>
                        <td><?php if($b[0]->bill_address != ''){ echo $b[0]->bill_address;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>Country</td>
                        <td><?php if($b[0]->bill_country != 0){ echo $b[0]->country_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>State</td>
                        <td><?php if($b[0]->bill_state != 0){ echo $b[0]->state_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      
                      <tr>
                        <td>City</td>
                        <td><?php if($b[0]->bill_city != 0){ echo $b[0]->city_name;} else { echo '-';} ?></td>
                      </tr>
                      
                       <tr>
                        <td>Area</td>
                        <td><?php if($b[0]->bill_area != 0){ echo $b[0]->area_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>Pincode</td>
                        <td><?php if($b[0]->bill_pincode != 0){ echo $b[0]->bill_pincode;} else { echo '-';} ?></td>
                      </tr>
                    <?php } else { ?>
                    
                    <tr>
                        <td>Ship Name :</td>
                        <td><?php echo $s[0]->ship_name; ?></td>
                      </tr>
                      
                      <tr>
                        <td>Mobile</td>
                        <td><?php echo $s[0]->ship_mobile; ?></td>
                      </tr>
                      
                        <tr>
                        <td>Address</td>
                        <td><?php if($s[0]->ship_address != ''){ echo $s[0]->ship_address;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>Country</td>
                        <td><?php if($s[0]->ship_country != 0){ echo $s[0]->country_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>State</td>
                        <td><?php if($s[0]->ship_state != 0){ echo $s[0]->state_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      
                      <tr>
                        <td>City</td>
                        <td><?php if($s[0]->ship_city != 0){ echo $s[0]->city_name;} else { echo '-';} ?></td>
                      </tr>
                      
                       <tr>
                        <td>Area</td>
                        <td><?php if($s[0]->ship_area != 0){ echo $s[0]->area_name;} else { echo '-';} ?></td>
                      </tr>
                      
                      <tr>
                        <td>Pincode</td>
                        <td><?php if($s[0]->ship_pincode != 0){ echo $s[0]->ship_pincode;} else { echo '-';} ?></td>
                      </tr>
                    
                    <?php } ?>
                    
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
   
    </div>
    
    <!--page content end-->
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>