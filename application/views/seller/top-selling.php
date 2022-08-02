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
    <form action="#" id="target2">
    <div class="col-sm-4">
    <label>Start Date</label>
    <input type="text" class="form-control" value="<?php echo date('Y-m-01'); ?>" id="datePicker" name="start_date"/>
    </div>
    <div class="col-sm-4">
    <label>End Date</label>
    <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="datePicker2" name="end_date"/></div>
    
    
    
    <div class="col-sm-4" style="margin-top:35px;">
    
    <button type="button" class="btn btn-primary" id="total_sell"><span class="glyphicon glyphicon-search"></span> &nbsp;Filter</button></div>
    
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
             <th>Image</th>
             <th>Product Name</th> 
             <th>Model</th>
             <th>Quantity</th>
             <th>Total</th>
             
            </tr>
          </thead>
          <tbody>
           <?php
		   if(!empty($sell)){
			   
			   foreach($sell as $s){ 
			   
		   ?>
            <tr>
             <td><img src="<?php echo base_url().'includes/uploads/product_image/'.$s->featured_image; ?>" width="75" height="75" /></td>
              <td><a href="<?php echo base_url().$s->product_name_url; ?>" target="_blank"><?php echo $s->product_name; ?></a></td>
              <td><?php echo $s->model; ?></td>
              <td><?php echo $s->qty; ?></td>
              <td><i class="fa fa-inr"></i> <?php echo $s->total; ?>/-</td>
              
            </tr>
           <?php } } else { ?>
           <tr><td colspan="7">Data not found.</td></tr>
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