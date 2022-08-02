 <?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Dashboard
          <p class="pageNav"><a href="<?php echo base_url(); ?>seller/dashboard">Home</a><span class="separator"></span><strong>Dashboard</strong></p>
        </div>
      </div>
    </div>
    <!--page title end-->
    
    <?php if($this->session->userdata('seller_status') == '0') { ?>
    
    Thanks for submitting your details. After verification your seller panel will be activate shortly and you get mail with details.
    
    <?php } else { ?>
    
    <!--four box section start-->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-div-wrapper bk-clr-one">
          <h4>Total Sales <span><i class="fa fa-caret-up"></i> 25%</span></h4>
          <i class="fa fa-shopping-cart dashboard-div-icon"></i>
          <div class="progress progress-striped active M0">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> </div>
          </div>
          <h5><a href="<?php echo base_url('seller/view-orders'); ?>">View more...</a></h5>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-div-wrapper bk-clr-two">
          <h4>Pending Orders <span><i class="fa fa-caret-up"></i> 7%</span></h4>
          <i class="fa fa-hourglass-half dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%"> </div>
          </div>
          <h5><a href="<?php echo base_url('seller/view-pending-orders'); ?>">View more...</a></h5>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-div-wrapper bk-clr-three">
          <h4>Total Orders <span><i class="fa fa-caret-up"></i> 27%</span></h4>
          <i class="fa fa-pencil-square-o dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> </div>
          </div>
          <h5><a href="<?php echo base_url('seller/view-orders'); ?>">View more...</a></h5>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-div-wrapper bk-clr-four">
          <h4>Completed Orders <span><i class="fa fa-caret-up"></i> 27%</span></h4>
          <i class="fa fa-check-square-o dashboard-div-icon"></i>
          <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"> </div>
          </div>
          <h5><a href="<?php echo base_url('seller/view-completed-orders'); ?>">View more...</a></h5>
        </div>
      </div>
    </div>
    <!--four box section end-->
    
    
  <!--table section start-->
  <div class="row">
  
    <!--left section start-->
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-cart-plus"></i> Latest Order</h3>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                 <th>Order No. </th> 
                 <th>Order Date </th>
                 <th> Total</th> 
                 <th>Customer</th>
                 <!--<th>City </th>
                 <th>Payment Status</th>-->
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
			   //echo $shipping_from = $o->shipping_from;
			   
			  $sql5 = "SELECT product_status FROM `om_order_status` where seller_id='$id' and order_id='$order_id' order by added_date desc limit 1";
			   $os = $this->db_model->getAlldata($sql5);
			   $cus = $this->db_model->getAlldata("select cus_id from om_orders where order_id='$order_id'");
			  $cus_id = $cus[0]->cus_id;
			   $ct = $this->db_model->getAlldata("select city_name from city where city_id=(select city_id from customers where cus_id='$cus_id')");
			   $cus_name = $this->db_model->getAlldata("select cus_name from customers where cus_id='$cus_id'");
		   ?>
            <tr>
             
              <td>#<?php echo $o->order_id; ?></td>
              <td><?php echo date('d/m/Y',strtotime($o->order_date)); ?></td>
              <td><i class="fa fa-inr"></i> <?php echo $o->total_price; ?>/-</td>
              <td><?php echo $cus_name[0]->cus_name; ?></td>
              <?php /*?><td><?php if(!empty($ct)) echo $ct[0]->city_name; else echo "-"; ?></td>
              <td>-</td><?php */?>
              <td>
              <?php if($os[0]->product_status == 'Pending') { ?>
                  <label class="label label-danger"><?php echo $os[0]->product_status; ?></label>
              <?php } else { ?>
                  <label class="label label-success"><?php echo $os[0]->product_status; ?></label>
              <?php } ?>
              </td>
              <td><a href="<?php echo base_url('seller/order-details').'/'.$o->order_id; ?>"class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a></td>
            </tr>
           <?php } } else { ?>
           <tr><td colspan="6">No Order Yet.</td></tr>
           <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--left section end-->
    
    <!--right section start-->
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-cart-arrow-down"></i> Return Request</h3>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
             <th>Order No. </th> 
             <th>Order Date </th>
             <th> Total</th> 
             <th>Customer</th>
             <!--<th>City </th>
             <th>Payment Status</th>-->
             <th>Return Status</th>
             <th width="12%"> Action</th>
             
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($return)){
					    foreach($return as $o) { 
						$order_id = $o->order_id;
						$seller_id = $o->seller_id;
						$sql = "SELECT rs.name FROM `om_return_history` as rh join om_return_status as rs on rh.return_status_id = rs.return_status_id where rh.return_id='$o->return_id' order by rh.date_added desc limit 1";
						$s = $this->db_model->getAlldata($sql);
					   $sql5 = "SELECT product_status FROM `om_order_status` where seller_id='$seller_id' and order_id='$order_id' order by added_date desc limit 1";
					   $os = $this->db_model->getAlldata($sql5);
					   
					  $cus_id = $o->cus_id;
					   $ct = $this->db_model->getAlldata("select city_name from city where city_id=(select city_id from customers where cus_id='$cus_id')");
					   $cus_name = $this->db_model->getAlldata("select cus_name from customers where cus_id='$cus_id'");
		  ?>
          
          <tr>
             
              <td>#<?php echo $o->order_id; ?></td>
              <td><?php echo date('d/m/Y',strtotime($o->date_order)); ?></td>
              <td><i class="fa fa-inr"></i><?php echo $o->qty * $o->product_price; ?>/-</td>
              <td><?php echo $cus_name[0]->cus_name; ?></td>
              <?php /*?><td><?php if(!empty($ct)) echo $ct[0]->city_name; else echo "-"; ?></td>
              <td>-</td><?php */?>
              <td>
              <?php if(!empty($s)){echo $s[0]->name;}else{echo 'Pending';} ?>
              </td>
              <td><a href="<?php echo base_url('seller/return-details').'/'.$o->return_id.'/'.$o->order_id.'/'.$o->order_item_id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> <?php /*?><a href="<?php echo base_url('seller/edit-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit fa-2x"></i></a><?php */?> <?php /*?><a href="<?php echo base_url('seller/delete-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a><?php */?></td>
            </tr>
            <?php } } else { ?>
                          <tr>
                            <td colspan="9">No Return Yet.</td>
                            
                          </tr>
                   
             <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--right section end-->
    
    <?php } ?>
    
    
  </div>
  <!--table section end-->
    
    
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>

