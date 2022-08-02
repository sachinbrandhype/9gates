<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Order Details<p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a>
        <span class="separator"></span><strong><a href="<?php echo base_url('seller/returns'); ?>">View Returns</a></strong></p>
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
            <h3 class="panel-title">Return History</h3>
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
                    </tr>
                    
                    <?php $sl =1 ;
					 
					foreach($oh as $h) { 
					
					?>
                    <tr>
                    <td><?php echo $sl.'.'; ?></td>
                     <td><?php echo date('d-M-Y',strtotime($h->date_added)); ?></td>
                     <td><?php echo $h->name; ?></td>
                     
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
    
    
    
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Add Return History</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/add-return-history" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    
                    <tr>
                      <td>Return Status</td>
                      <td><select class="form-control" name="order_status" required>
                        	<option value="">Select Status</option>
                             <?php foreach($rs as $rss){?>
                             <option value="<?php echo $rss->return_status_id; ?>"><?php echo $rss->name; ?></option>
                             <?php } ?>
                           </select>
                        </td>
                    </tr>
                    <tr>
                      <td>Comment</td>
                      <td>
                      <textarea class="form-control" name="comment" ></textarea>
                        </td>
                    </tr>
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="submit" class="btn btn-primary">Add Return History</button></td>
                    </tr>
                   
                  </tbody>
                </table>
                <input type="hidden" name="return_id" value="<?php echo $this->uri->segment(3); ?>" />
                <input type="hidden" name="order_id" value="<?php echo $this->uri->segment(4); ?>" />
                <input type="hidden" name="order_item_id" value="<?php echo $this->uri->segment(5); ?>" />
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
                     <td><?php echo $od[0]->order_id; ?></td>
                    </tr>
                    
                    <tr>
                    <td>Customer Name</td>
                     <td><?php echo $od[0]->name; ?></td>
                    </tr>
                    
                    <tr>
                    <td>Email</td>
                     <td><?php echo $od[0]->email; ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td>Mobile No.</td>
                     <td><?php echo $od[0]->mobile; ?></td>
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
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Product Price</th>
                      <th>Total</th>
                    </tr>
                    
                    <?php 
					$sl =1 ;
					 $subtotal = 0;
					foreach($od as $d) { 
					$subtotal = $subtotal + ($d->qty * $d->product_price);
					?>
                    <tr>
                    <td><?php echo $sl.'.'; ?></td>
                     <td><?php echo $d->product_name; ?></td>
                     <td><?php echo $d->qty; ?></td>
                     <td><?php echo $d->product_price; ?></td>
                     <td><?php echo $d->qty * $d->product_price; ?></td>
                    </tr>
                    <?php 
					$sl++;} 
					?>
                    
                    <tr>
                    <td colspan="4" align="right"><storng>Grand Total :</storng></td>
                    <td><?php echo $subtotal; ?></td>
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
                        <td><?php if($s[0]->ship_pincode != 0){ echo $s[0]->bill_pincode;} else { echo '-';} ?></td>
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