<?php $this->load->view('seller/header'); ?>
<!--page wrapper start-->
<div class="container">
  <!--page navigation start-->
  <div class="row">
    <div class="col-xs-12">
      <ol class="breadcrumb breadcrumb-arrow">
        <li><a href="#">Seller Registration</a></li>
        <li class="active"><a href="<?php echo base_url('seller/upload-document'); ?>">Upload Document</a></li>
        <li><a href="<?php echo base_url('seller/business-bank-details'); ?>">Business/Bank Details</a></li>
      </ol>
    </div>
  </div>
  <!--page navigation end-->
  <!--content section start-->
  <form action="<?php echo base_url('seller/upload-document'); ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-12">
      <h4>It is compulsory to upload documents and fill their details. (Upload scans copy only)</h4>
      <div class="list-group">
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0 MB-0">
                <label class="col-sm-4 control-label">PAN NO</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="pan_no" required>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">UPLOAD</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="pan_file" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">TIN NO</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="tin_no">
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">UPLOAD</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="tin_file">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">TAN NO</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="tan_no">
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">UPLOAD</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="tan_file">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">ADDRESS PROOF</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="address_no" required>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">UPLOAD</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="address_file" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">ID PROOF</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="id_no" required>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">UPLOAD</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" name="id_file" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group-item no-round">
          <div class="row">
            <div class="col-sm-6 col-xs-12 form-horizontal">
              <div class="form-group MB-0">
                <label class="col-sm-4 control-label">&nbsp;</label>
                <div class="col-sm-8">
                  <button type="submit" class="btn btn-primary">Save and Continue</button>
                </div>
              </div>
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
<?php $this->load->view('seller/footer');  ?>