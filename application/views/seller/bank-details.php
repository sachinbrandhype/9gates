<?php include'header.php'; ?>
  <!--page wrapper start-->
  <div class="container">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Bank Details <p class="pageNav"><a href="<?php echo base_url('seller/dashboard'); ?>">Home</a><span class="separator"></span><strong>Bank Details</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    <?php echo $this->session->flashdata('msg'); ?>
    <!--page content start-->
    <div class="row">
      <div class="col-sm-12">
      <form action="<?php echo base_url();?>seller/bank-details" method="post">
        
        
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Banking Information</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              
              <blockquote style='font-size:14px;'>
                <p>Please enter your bank account information, which EHOMEBAZAAR will use to make NEFT/RTGS payments for your transactions at Ehomebazaar.com. It is important that the information you provide here is accurate so that there is no delay on receiving payments from EHOMEBAZAAR. When you are submitting your bank details EHOMEBAZAAR assume that you have read and agreed to point number 15 and 16 and other terms of Memorandum of Understanding.</p>
              </blockquote>
              <div class="col-sm-6">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <tr>
                      <td>Account Holder's Name (?):</td>
                      <td><input class="form-control" value="<?php if($b[0]->ac_name != '') echo $b[0]->ac_name; ?>" name="ac_name" placeholder="Account Name" type="text" required></td>
                    </tr>
                    <tr>
                      <td>Bank Name (?):</td>
                      <td><input class="form-control" value="<?php if($b[0]->bank_name != '') echo $b[0]->bank_name; ?>" name="bank_name" placeholder="Bank Name" type="text" required></td>
                    </tr>
                    
                    <tr>
                      <td>Bank Branch Name (?):</td>
                      <td><input class="form-control" value="<?php if($b[0]->bank_branch_name != '') echo $b[0]->bank_branch_name; ?>" name="bank_branch" placeholder="Bank branch Name" type="text" required></td>
                    </tr>
                    
                    <tr>
                      <td>Account Number (?):</td>
                      <td><input class="form-control" value="<?php if($b[0]->ac_number != '') echo $b[0]->ac_number; ?>" name="ac_no" placeholder="Account Number" type="text" required></td>
                    </tr>
                    <tr>
                      <td>Account Type:</td>
                      <td>
                      <label class="radio-inline">
                        <input type="radio" name="ac_type" id="inlineRadio1" value="Saving" <?php if($b[0]->ac_type == 'Saving') echo 'checked'; ?> >
                        Saving </label>
                      <label class="radio-inline">
                        <input type="radio" name="ac_type" id="inlineRadio2" value="Current" <?php if($b[0]->ac_type == 'Current') echo 'checked'; ?>>
                        Current </label>
                      </td>
                    </tr>
                    <tr>
                      <td>IFSC Code:</td>
                      <td><input class="form-control" value="<?php if($b[0]->bank_ifsc != '') echo $b[0]->bank_ifsc; ?>" name="ifsc_code" placeholder="IFSC Code" type="text" required></td>
                    </tr>
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="submit" class="btn btn-primary">Update</button></td>
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