<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Business Information <p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong><a href="<?php echo base_url('seller/personal-details'); ?>">Business Information</a></strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <div class="row">
      <div class="col-sm-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Edit Or Update Your Business Information</h3>
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form action="<?php echo base_url();?>seller/update-personal-details" method="post" enctype="multipart/form-data">
                <table class="table table-user-information noBoredr">
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td><input class="form-control" name="pname" value="<?php echo $s[0]->seller_name; ?>" placeholder="Name" type="text" required></td>
                    </tr>
                    
                    <tr>
                      <td>Profile Info</td>
                      <td><textarea class="form-control" name="pinfo" placeholder="Profile Info" type="text" required><?php echo $s[0]->seller_info; ?></textarea></td>
                    </tr>
                    
                    
                    <tr>
                      <td>Store Name</td>
                      <td><input class="form-control" name="sname" value="<?php echo $s[0]->seller_business; ?>" placeholder="Store Name" type="text" readonly></td>
                    </tr>
                    
                    <?php /*?><tr>
                      <td>Store URL</td>
                      <td><input class="form-control" name="surl" value="<?php echo $s[0]->seller_url; ?>" placeholder="Store URL" type="text" required="required" id="surl"></td>
                    </tr><?php */?>
                    
                    <tr>
                      <td>Email Id</td>
                      <td><input class="form-control" name="email" value="<?php echo $s[0]->seller_email; ?>" placeholder="Email Id" type="text" required disabled="disabled"></td>
                    </tr>
                    <tr>
                      <td>Mobile No</td>
                      <td><input class="form-control" name="mobile" value="<?php echo $s[0]->seller_phone; ?>" placeholder="Mobile No" type="text" required></td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td>
                      	<select class="form-control" name="state" id="state" required>
                        	<option value="">Select State</option>
                            <?php
							foreach($state as $state1)
							{
							?>
                            <option value="<?php echo $state1->state_id;?>" <?php if($state1->state_id == $s[0]->state) echo 'selected'; ?>> <?php echo $state1->state_name;?></option>
                            <?php
							}
							?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td>
                      	<select class="form-control" name="city" id="city" required>
                        	<option>Select City</option>
                            <?php
							foreach($city as $city1)
							{
							?>
                            <option value="<?php echo $city1->city_id;?>" <?php if($city1->city_id == $s[0]->city) echo 'selected'; ?>> <?php echo $city1->city_name;?></option>
                            <?php
							}
							?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Area</td>
                      <td>
                      	<select class="form-control" name="area" id="area" required>
                        	<option>Select Area</option>
                            <?php
							foreach($area as $area1)
							{
							?>
                            <option value="<?php echo $area1->area_id;?>" <?php if($area1->area_id == $s[0]->area) echo 'selected'; ?>> <?php echo $area1->area_name;?></option>
                            <?php
							}
							?>
                        </select>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>Market</td>
                      <td>
                      	<select class="form-control" name="market" id="market" required>
                        	<option>Select Market</option>
                            <?php
							foreach($market as $m)
							{
							?>
                            <option value="<?php echo $m->market_id;?>" <?php if($m->market_id == $s[0]->market) echo 'selected'; ?>> <?php echo $m->market_name;?></option>
                            <?php
							}
							?>
                        </select>
                      </td>
                    </tr>
                    
                    <tr>
                    <td>Logo</td>
                    <td><input type="file" name="userfile" class="form-control" /></td>
                    </tr>
                    
                    <tr>
                    <td>Banner</td>
                    <td><input type="file" name="userfile2" class="form-control" /></td>
                    </tr>
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="submit" class="btn btn-primary">Update</button></td>
                    </tr>
                    
                  </tbody>
                </table>
                <input type="hidden" name="logo" value="<?php echo $s[0]->seller_logo; ?>" />
                <input type="hidden" name="banner" value="<?php echo $s[0]->seller_banner; ?>"  />
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