  <!--banner and form section start-->
  <div class="blue-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-7"> <img src="<?php echo base_url(); ?>sellercss/assets/img/services.jpg" class="img-responsive" alt="" /> </div>
      <hr class="visible-xs" />
      <div class="col-sm-5">
      <?php echo $this->session->flashdata('msg1');?>
        <div class="panel panel-default">
       
          <div class="panel-heading">
        
            <h3 class="panel-title">Register New Account</h3>
           
          </div>
          <div class="panel-body accountTable">
            <div class="table-responsive">
              <form id="loginForm" action="<?php echo base_url();?>seller/sign-up" method="POST" >
                <table class="table table-user-information noBoredr">
                  <tbody>
					<tr>
                      <td>Store</td>
                      <td><input type="text" name="store" class="form-control" placeholder="Store" required="required"/></td>
                    </tr>
                    <tr>
                      <td>Name</td>
                      <td><input type="text" name="name" class="form-control" placeholder="Name" required="required"/></td>
                    </tr>
                    <tr>
                      <td>Email Id</td>
                      <td><input type="email" name="email" class="form-control" placeholder="Email Id" required="required"/></td>
                    </tr>
                    <tr>
                      <td>Mobile No</td>
                      <td><input type="text" name="phone" class="form-control" placeholder="Mobile No" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Password</td>
                      <td><input type="password" name="password" class="form-control" placeholder="Password" required="required" /></td>
                    </tr>
                    <tr>
                      <td>Confirm Password</td>
                      <td><input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required="required" /></td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td>
                      	<select name="state" class="form-control" id="state" required>
                        	<option>Select State</option>
                        	 <?php 
								foreach($s as $st)
								{
									echo '<option value='.$st->state_id.'>'.$st->state_name.'</option>';
								}
								?>
                        </select>
                      </td>
                    </tr>
                    
                    <tr>
                      <td>City</td>
                      <td>
                      	<select name="city" class="form-control" id="city" required>
                        	<option>Select City</option>
                            
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Area</td>

                      <td>
                      	<select name="area" class="form-control" id="area" required>
                        	<option>Select Area</option>
                        	
                        </select>
                      </td>

                    </tr>
                    
                    <tr>
                      <td>&nbsp;</td>
                      <td><button type="submit" class="btn btn-primary">Submit</button></td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--banner and form section end-->
  
  <!--Four Round box work start-->
  <div class="container fourRound">
    <div class="row">
      <div class="col-sm-3">
        <div>Creat<br />
          Account
          </p>
        </div>
      </div>
      <div class="col-sm-3">
        <div>Submit<br />
          Documents</div>
      </div>
      <div class="col-sm-3">
        <div>Upload<br />
          Products</div>
      </div>
      <div class="col-sm-3">
        <div>Sell Your<br />
          Products</div>
      </div>
    </div>
  </div>
  <!--Four Round box work end-->
<br />
<br />
<br />
<!--content section start-->
<div class="well" style="margin-bottom:-50px;">
<h2 class="text-capitalize text-center text-info">Why 9Gates</h2><br />
	<div class="container">
    	<div class="row">
        	<div class="col-sm-6">
            <h3>Better profitability</h3> 
            <p class="text-muted" align="justify">9Gates lower cost of ownership means our partners benefit from higher margins, plus client budgets focused on value-added services instead of IT maintenance.</p>
            <br />
            <h3>Unparalleled time to market</h3>
            <p class="text-muted" align="justify">Launch new sites for your clients in half the time of other ecommerce platforms.</p>
            <br />
            <h3>Robust enterprise offering</h3>
            <p class="text-muted" align="justify">Our enterprise platform is secure, reliable, open and scalable, letting you build world-class ecommerce sites that come standard with robust analytics and dedicated support.</p>
            </div>
            <div class="col-sm-6">
            <h3>A platform built for marketers</h3>
            <p class="text-muted" align="justify">With more marketing tools than any other platform and best-in-class SEO, we allow agencies to bundle packages for their clients and create a search-optimized, commerce-first strategy.</p>
            <br />
            <h3>Seamless API integrations</h3>
            <p class="text-muted" align="justify">Bigcommerce integrates with hundreds of industry-leading business applications, letting you connect your clients to everything they need to succeed.</p>
            <br />
            <h3>Comprehensive program benefits</h3>
            <p class="text-muted" align="justify">Our Design & Solution Partners enjoy generous commissions and access to marketing tools, lead distribution, account management and more.</p>
            </div>
        </div>
    </div>
</div>
<!--content section end-->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">&nbsp;&nbsp;Find Your Password</h4>
        </div>
         <form action="<?php echo base_url();?>seller/reset-password" method="post" enctype="multipart/form-data">
        <div class="modal-body">
                   <table class="table table-user-information noBoredr">
                    <tbody>
                        <tr>
                          <td width="10%">Email</td>
                          <td><input type="email" name="email" class="form-control" placeholder="Email" required="required"/></td>
                        </tr>
                    </tbody>
                    </table>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

           <button type="submit" value="Reset Password" class="btn btn-primary btn-flat pull-left">&nbsp;Reset Password</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>