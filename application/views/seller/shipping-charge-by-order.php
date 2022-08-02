<?php include'header.php'; ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">Shipping Charge By Order</h1>
      </div>
    </div>
    <!--page title end-->
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
      <div class="col-sm-12">
      <a href=""></a>
        <br/>
      
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"> Delivery Charge by Order</h3>
        </div>
        
        <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/shipping_charge_by_order" method="post" enctype="multipart/form-data">
                <table class="table table-user-information noBoredr">
                  <tbody>
                  
                  
                    <tr>
                      <td>Below Order</td>
                      <td><input class="form-control" name="below_order" value="<?php echo $r[0]->below_order; ?>"  type="text" required></td>
                      <td>Shipping Charge</td>
                      <td><input class="form-control" name="below_order_charge" value="<?php echo $r[0]->below_order_charge; ?>"  type="text" required></td>
                    </tr>
                    
                    <tr>
                      <td>Above Order</td>
                      <td><input class="form-control" name="above_order" value="<?php echo $r[0]->above_order; ?>"  type="text" required></td>
                      <td>Shipping Charge</td>
                      <td><input class="form-control" name="above_order_charge" value="<?php echo $r[0]->above_order_charge; ?>"  type="text" required></td>
                    </tr>
                    
                    <tr>
                    <td colspan="4" align="right"><button type="submit" class="btn btn-primary">Update</button></td>
                    
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
  <?php include'footer.php'; ?>