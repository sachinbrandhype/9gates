<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Edit Order <p class="pageNav"><a href="index.php">Home</a><span class="separator"></span><strong>Edit Order</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <div class="row">
      <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Edit Or Update Order Details</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/update-personal-details" method="post">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <tr>
                      
                    </tr>
                    
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