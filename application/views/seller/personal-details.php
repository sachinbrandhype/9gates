<?php include'header.php'; ?>
  <!--page wrapper start-->
  <div class="container">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Business Information <p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong>Business Information</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    <!--page content start-->
     <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Business Information</h3>
          </div>
          <div class="panel-body accountTable">
         
            <div class="table-responsive">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td><?php echo $s[0]->seller_name; ?></td>
                    </tr>
                    <tr>
                      <td>Store Name</td>
                      <td><?php echo $s[0]->seller_business; ?></td>
                    </tr>
                    <tr>
                      <td>Email Id</td>
                      <td><?php echo $s[0]->seller_email; ?></td>
                    </tr>
                    <tr>
                      <td>Mobile No</td>
                      <td><?php echo $s[0]->seller_phone; ?></td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td><?php if($s[0]->state != 0){echo $s[0]->state_name; } else {echo "-";} ?></td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td><?php if($s[0]->city != 0){echo $s[0]->city_name; } else {echo "-";} ?></td>
                    </tr>
                    <tr>
                      <td>Area</td>
                      <td><?php if($s[0]->area != 0){ echo $s[0]->area_name; } else {echo "-";} ?></td>
                    </tr>
                    <tr>
                      <td>Market</td>
                      <td><?php if($s[0]->market != 0){ echo $s[0]->market_name;} else { echo "-"; } ?></td>
                    </tr>
                    
                    <tr>
                      <td>Logo</td>
                      <td>
                      <?php if($s[0]->seller_logo == '') { ?>
                      <img class="img-thumbnail img-responsive" src="<?php echo base_url().'front/images/noimage.png'; ?>"/>
                      <?php } else { ?>
                      <img class="img-thumbnail img-responsive" src="<?php echo base_url().$s[0]->seller_logo; ?>"/>
                      <?php } ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Banner</td>
                      <td>
                      <?php if($s[0]->seller_banner == '') { ?>
                      <img class="img-thumbnail img-responsive" src="<?php echo base_url().'front/images/noimage.png'; ?>"/>
                      <?php } else { ?>
                      <img class="img-thumbnail img-responsive" src="<?php echo base_url().$s[0]->seller_banner; ?>"/>
                      <?php } ?>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
            </div>
          </div>
          <div class="panel-footer">
            <h3 class="panel-title text-right"> <a class="btn btn-primary" href="<?php echo base_url();?>seller/personal-details-edit">Edit / Update</a></h3>
          </div>
        </div>
      </div>
    </div>
    <!--page content end-->
  </div>
  <!--page wrapper end-->
  <?php include'footer.php'; ?>