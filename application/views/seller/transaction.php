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
        <div class="col-sm-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                 <th>Date Added</th>
                 <th>Description </th> 
                 <th>Amount ( <i class="fa fa-inr"></i> ) </th> 
                 
                 
                 
                 
                 
                </tr>
              </thead>
              <tbody>
               <?php
               if(!empty($order)){
                   
                   foreach($order as $o){ 
                   
               ?>
                <tr>
                
                  <td><?php echo date('d/m/Y',strtotime($o->com_paid_date)); ?></td>
                 
                  <td><?php echo 'Order Id #'.$o->order_id.' <b>'.$o->product_name.'</b>: INR '.$o->total.'( - '.$o->com_rate.'% Commision)'; ?></td>

                  <td><i class="fa fa-inr"></i> <?php echo $o->paid_amount; ?>/-</td>

                 
                  
                </tr>
               <?php } } else { ?>
               <tr><td colspan="6">No Payment Yet...</td></tr>
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