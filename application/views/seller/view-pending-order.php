<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">View Order <p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong>View Order</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>

    <div class="row">
    
    </div>
    
    </br>

    <div id="result">
    <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
             <th>Order No. </th> 
             <th>Order Date </th>
             <th> Total Amount ( <i class="fa fa-inr"></i> ) </th> 
             <th>Customer Name </th>
             <th>City </th>
             <th>Payment Mode</th>
             <th>Order Status</th>
             <th width="12%"> Action</th>
             
            </tr>
          </thead>
          <tbody>
           <?php
		    if(!empty($order)){
			  $id = $this->session->userdata('seller_id');
        foreach($order as $o){ 
          $order_id = $o->order_id;
          $sql5 = "SELECT product_status FROM `om_order_status` where seller_id='$id' and order_id='$order_id' order by added_date desc limit 1";
          $os = $this->db_model->getAlldata($sql5);
          $cus = $this->db_model->getAlldata("select cus_id,payment_mode,(total_ship_charge +  additional_ship_charge) as s from om_orders where order_id='$order_id'");
          $cus_id = $cus[0]->cus_id;
          $ct = $this->db_model->getAlldata("select city_name from city where city_id=(select city_id from customers where cus_id='$cus_id')");
          $cus_name = $this->db_model->getAlldata("select cus_name from customers where cus_id='$cus_id'");
                  
          $sql6 = "select is_canceled,product_id from om_order_item where seller_id='$id' and order_id='$o->order_id'";
          $t = $this->db_model->getAlldata($sql6);
          $c = count($t);
          $p_id = $t[0]->product_id;
          $sql7 = "select featured_image from om_product where product_id='$p_id'";
          $pimg = $this->db_model->getAlldata($sql7);
          if($os[0]->product_status == 'Pending') {
		   ?>
            <tr>
             
              <td>#<?php echo $o->order_id; ?></td>
              <td><?php echo date('d/m/Y',strtotime($o->order_date)); ?></td>
              <td><i class="fa fa-inr"></i> <?php echo $o->total_price; ?>/-</td>
              <td><?php echo $cus_name[0]->cus_name; ?></td>
              <td><?php if(!empty($ct)) echo $ct[0]->city_name; else echo "-"; ?></td>
              <td>
              <?php
      			  if($cus[0]->payment_mode == 'COD')
      			  {
      				  echo "COD";
      			  }
      			  else
      			  {
      				  echo "Online";
      			  }
      			  ?>
              </td>
              <td>
              <?php if($os[0]->product_status == 'Pending') { ?>
                  <label class="label label-danger"><?php echo $os[0]->product_status; ?></label>
              <?php } ?>
              </td>
              <td><a href="<?php echo base_url('seller/order-details').'/'.$o->order_id; ?>" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a> <?php /*?><a href="<?php echo base_url('seller/edit-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit fa-2x"></i></a><?php */?> <a href="<?php echo base_url('seller/delete-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a>
                <a target="_blank" href="<?php echo base_url('seller/invoice').'/'.$o->order_id; ?>" title="Print Invoice" class="btn btn-xs btn-success"><i class="fa fa-print fa-2x"></i></a>
                  <?php 
                    $cn = 0;
                    foreach ($t as $val) {
                    if ($val->is_canceled == 1) {
                      $cn++;
                    }
                  }
                  if($cn == $c )
                  {
                    echo "<br><label class='label label-danger'>Cancelled</label>";
                  }
                  elseif ($cn > $c) {
                    echo "<br><label class='label label-info'>Partially Cancelled</label>";
                  }
                  ?>
              </td>
            </tr>
           <?php 
         }
         }
         } else { ?>
           <tr><td colspan="6">No Order Yet</td></tr>
           <?php } ?>
            
          </tbody>
        </table>
      </div>
      
      <?php echo $links; ?>
      
    </div>
  </div>
  </div>
 <!--page content end-->
 
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>