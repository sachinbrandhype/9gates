<?php include'header.php'; ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Commission Details <p class="pageNav"><a href="index.php">Home</a><span class="separator"></span><strong>Commission Details</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    <!--page content start-->
     <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
      <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Commission Details</h3>
          </div>
          <div class="panel-body accountTable">
         
            <div class="table-responsive">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <?php if(!empty($c)) {  ?>
                    <tr>
                      <td>Commission Name</td>
                      <td><?php echo $c[0]->commission_name; ?></td>
                    </tr>
                    
                    <tr>
                      <td>Default Commission rate</td>
                      <td><?php echo $c[0]->commission_rate_default; ?></td>
                    </tr>
                    
                    <tr>
                      <td>Product Limit</td>
                      <td><?php echo $c[0]->product_limit; ?></td>
                    </tr>
                    
                    <tr>
                      <td><strong>Commission</strong></td>
                      <td>&nbsp;</td>
                    </tr>
                    
                    <?php 
					 if(!empty($cr)){
					 foreach($cr as $r) { 
					 $menu_id = $r->menu_id;
					 $m = $this->db_model->getAlldata("select menu_name from menu where menu_id='$menu_id'");
					?>
                    <tr>
                      <td><?php echo $r->category_name.'('.$m[0]->menu_name.')'; ?></td>
                      <td><?php 
					  if($r->category_rate != 0)
					  {
						  echo $r->category_rate.'%'; 
					  }
					  else
					  {
						  echo '-';
					  }
					  
					   ?></td>
                    </tr>
                    <?php } } } else { ?>
                    <tr>
                      <td colspan="2">Data not found.</td>
                    </tr>
                    <?php } ?>
                   
                    
                                        
                  </tbody>
                </table>
            </div>
          </div>
          <div class="panel-footer">
            &nbsp;
          </div>
        </div>
      </div>
    </div>
    <!--page content end-->
  </div>
  <!--page wrapper end-->
  <?php include'footer.php'; ?>