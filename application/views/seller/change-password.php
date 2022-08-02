<?php include'header.php'; ?>
  <!--page wrapper start-->
  <div class="container">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Change Password <p class="pageNav"><a href="<?php echo base_url('seller/dashboard'); ?>">Home</a><span class="separator"></span><strong>Change Password</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    <?php echo $this->session->flashdata('msg'); ?>
    <!--page content start-->
    <div class="row">
      <div class="col-sm-12">
      <form action="<?php echo base_url();?>seller/password-changed" method="post">
        
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Change Password</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              
              
              <div class="col-sm-6">
              <div class="cleafix"></div>
                <table class="table table-user-information noBoredr">
                  <tbody>

                    <tr>
                      <td>Old Password (?):</td>
                      <td><input class="form-control" name="old" placeholder="Old Password" type="text" required></td>
                    </tr>

                    <tr>
                      <td>New Password (?):</td>
                      <td><input class="form-control" name="pass" placeholder="New Password" type="text" required></td>
                    </tr>
                    
                    <tr>
                      <td>Confirm Password (?):</td>
                      <td><input class="form-control" name="cpass" placeholder="Confirm Password" type="text" required></td>
                    </tr>    

                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="submit" class="btn btn-primary">Submit</button></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
    <!--page content end-->
  </div>
  <!--page wrapper end-->
  <?php include'footer.php'; ?>