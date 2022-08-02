  <?php include'header.php'; ?>
<!--page wrapper start-->
<div class="container">
  <!--page navigation start-->
  <div class="row">
    <div class="col-xs-12">
      <ol class="breadcrumb breadcrumb-arrow">
        <li><a href="#">Seller Registration</a></li>
        <li><a href="#">Upload Document</a></li>
        <li class="active"><a href="<?php echo base_url('seller/business-bank-details'); ?>">Business/Bank Details</a></li>
      </ol>
    </div>
  </div>
  <!--page navigation end-->
  <!--content section start-->
  <form method="post" action="<?php echo base_url('seller/business-bank-details'); ?>" onSubmit="return valid();" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-12">
      <div class="list-group">
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-5 control-label">Account Holder's Name</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="ac_name" required>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-5 control-label">Account Number</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="ac_no" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-5 control-label">Account Type</label>
                <div class="col-sm-7">
                  <label class="radio-inline">
                    <input type="radio" name="ac_type" id="inlineRadio1" value="Saving" checked>
                    Saving </label>
                  <label class="radio-inline">
                    <input type="radio" name="ac_type" id="inlineRadio2" value="Current">
                    Current </label>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-5 control-label">Bank Name</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="bank_name" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-5 control-label">Bank Branch Name</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="bank_branch" required>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-5 control-label">IFSC CODE</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="ifsc_code" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-5 control-label">Cancelled cheque</label>
                <div class="col-sm-7">
                  <input type="file" class="form-control" name="cheque_file" required>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal"> <strong>upload? (Upload scanned copy of cancelled cheque)</strong> </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 text-right"> <strong>I accept the memorandum of Undertaking</strong>&nbsp;&nbsp;&nbsp;&nbsp;
              <label class="checkbox-inline">
                <input type="checkbox" id="mem" value="1" name="memorandum">
                <strong>Click here to see?</strong></label>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!--content section end-->
</div>
<!--page wrapper end-->
<br>
<br>
<?php include'footer.php'; ?>