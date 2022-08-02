<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Ready Shipment <p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong>View Ready Shipment</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>
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
			   $cus = $this->db_model->getAlldata("select cus_id,payment_mode from om_orders where order_id='$order_id'");
			   $cus_id = $cus[0]->cus_id;
			   $ct = $this->db_model->getAlldata("select city_name from city where city_id=(select city_id from customers where cus_id='$cus_id')");
			   $cus_name = $this->db_model->getAlldata("select cus_name from customers where cus_id='$cus_id'");
			   if($os[0]->product_status == 'Processed') { 
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
              <?php } else { ?>
                  <label class="label label-success"><?php echo $os[0]->product_status; ?></label>
              <?php } ?>
              </td>
              <td><a href="<?php echo base_url('seller/order-details').'/'.$o->order_id; ?>" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a> <?php /*?><a href="<?php echo base_url('seller/edit-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit fa-2x"></i></a><?php */?> <a href="<?php echo base_url('seller/delete-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a></td>
            </tr>
           <?php } } } else { ?>
           <tr><td colspan="6">No Order Yet</td></tr>
           <?php } ?>
            
          </tbody>
        </table>
      </div>
      
      <?php echo $links; ?>
      
    </div>
  </div>
 <!--page content end-->
 
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>