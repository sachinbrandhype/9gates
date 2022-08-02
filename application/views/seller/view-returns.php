<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Returns <p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong>Returns</strong></p>
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
             <th>Total Amount ( <i class="fa fa-inr"></i> ) </th> 
             <th>Customer Name </th>
             <th>City </th>
             <th>Payment Status</th>
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
              <td><?php if(!empty($ct)) echo $ct[0]->city_name; else echo "-"; ?></td>
              <td>-</td>
              <td>
              <?php if(!empty($s)){echo $s[0]->name;}else{echo 'Pending';} ?>
              </td>
              <td><a href="<?php echo base_url('seller/return-details').'/'.$o->return_id.'/'.$o->order_id.'/'.$o->order_item_id; ?>" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a> <?php /*?><a href="<?php echo base_url('seller/edit-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit fa-2x"></i></a><?php */?> <?php /*?><a href="<?php echo base_url('seller/delete-order').'/'.$o->order_id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a><?php */?></td>
            </tr>
            <?php } } else { ?>
                          <tr>
                            <td colspan="9">No Return Yet.</td>
                            
                          </tr>
                   
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