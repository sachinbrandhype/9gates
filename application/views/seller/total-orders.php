<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Total Orders <p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong>View Total Orders</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
    <form action="#" id="target">
    <div class="col-sm-4">
    <label>Start Date</label>
    <input type="text" class="form-control" value="<?php echo date('Y-m-01'); ?>" id="datePicker" name="start_date"/>
    </div>
    <div class="col-sm-4">
    <label>End Date</label>
    <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="datePicker2" name="end_date"/></div>
    
    <!--<div class="col-sm-2">
        <label>Group By</label>
        <select class="form-control" name="group">
          <option value="Days">Days</option>
          <option value="Months">Months</option>
          <option value="Years">Years</option>
        </select>
    </div>
    <div class="col-sm-2">
    <label>Order Status</label>
                           <select class="form-control" name="order_status">
                        	<option value="All">All Status</option>
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
    </div>-->
    
    <div class="col-sm-4" style="margin-top:35px;">
    
    <button type="button" class="btn btn-primary" id="total_order"><span class="glyphicon glyphicon-search"></span> &nbsp;Filter</button></div>
    
    </form>
    </div>
    </br>
    <div id="result">
    <div class="row">
    <div class="col-sm-12">
    
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
             <th>Date Start</th>
             <th>Date End</th>
             <th>No. Orders </th> 
             <th>No. Products</th>
             <th>Total</th>
             
            </tr>
          </thead>
          <tbody>
           <?php
		   if(!empty($order)){
			   
			   foreach($order as $o){ 
			   
		   ?>
            <tr>
             <td><?php echo $o->date_from; ?></td>
              <td><?php echo $o->date_to; ?></td>
              <td><?php echo $o->total_order; ?></td>
              <td><?php echo $o->qty; ?></td>
              <td><i class="fa fa-inr"></i> <?php echo $o->total_price; ?>/-</td>
              
            </tr>
           <?php } } else { ?>
           <tr><td colspan="5">Data not found.</td></tr>
           <?php } ?>
            
          </tbody>
        </table>
      </div>
      </div>
      
      <?php if(!empty($links)) echo $links; ?>
      
    </div>
    
  </div>
 <!--page content end-->
 
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>