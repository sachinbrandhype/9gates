<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    
    <title>Login With 247OpenMarket.com</title>
    <link href="<?php echo site_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
</head>
<body>
    
    <div class="navbar navbar-inverse set-radius-zero navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="<?php echo base_url();?>assets/img/logo.png" />
                </a>
            </div>

            <div class="left-div pull-right">
               <form action="<?php echo base_url();?>seller/login" method="post" class="form-inline" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="inputEmail">Email</label>
                        <input type="name" name="name" class="form-control" id="inputEmail" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="inputPassword">Password</label>
                        <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Password" required>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
        	</div>
            </div>
        </div>
    <!-- LOGO HEADER END-->
   
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                </div>
				<?php echo $this->session->flashdata('msg1');?>
            </div>
            <div class="row">
                <div class="col-md-5">
                <div class="span3 well">
                    <form id="loginForm" action="<?php echo base_url();?>seller/sign_up" method="POST" >
                     <h4> Register now with <strong>247OpenMarket</strong></h4>
                     <br />
                     <div class="form-group">
                     	<label>Your Name : </label>
                        <input type="text" name="name" class="form-control" required>
                     </div>
                     
                     
                     <div class="form-group">   
                        <label>Phone : </label>
                        <input type="text" name="phone" class="form-control" required>
                     </div>
                     
                     <div class="form-group">   
                        <label>Email :  </label>
                        <input type="email" name="email" class="form-control" required>
                     </div>
                     
                     <div class="form-group">   
                        <label>Password : </label>
                        <input type="password" name="password" class="form-control" required>
                     </div>
                     
                     <div class="form-group">   
                        <label>Confirm Password :  </label>
                        <input type="password" name="cpassword" class="form-control" required>
                     </div>
                     
                     <div class="form-group">   
                        <label>Select State : </label>
                        <select name="state" class="form-control" id="state" required>
                        <option >Select state</option>
                        <?php 
						foreach($s as $st)
						{
							echo '<option value='.$st->state_id.'>'.$st->state_name.'</option>';
						}
						?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>City Name</label>
                        <select name="city" class="form-control" id="city" required>
								<option>Select City</option>											
						</select>
                     </div>
                     <div class="form-group">
                        <label>Area Name</label>
                        <select name="area" class="form-control" id="area" required>
								<option>Select Area</option>											
						</select>
                     </div>
                     <?php /*?><div class="form-group">   
                        <label>Business Type:  </label>
                        <select id="bt" name="menu_name" class="form-control" required>
                        <option >Select Business Type</option>
                        <?php 
						foreach($c as $ct)
						{
							echo '<option value='.$ct->menu_id.'>'.$ct->menu_name.'</option>';
						}
						?>
                        </select>
                     </div>
                     <div class="form-group">   
                        <label>Which type you want to sale product:  </label>
                        <div id="chk"></div>
                     </div><?php */?>
                     <input type="submit" value="Submit" class="btn btn-info" />
                 </form> 
                 </div>   
                </div>
                <div class="col-md-7">
                    <div class="alert alert-info">
                        This is a free bootstrap admin template with basic pages you need to craft your project. 
                        Use this template for free to use for personal and commercial use.
                        <br />
                         <strong> Some of its features are given below :</strong>
                        <ul>
                            <li>
                                Responsive Design Framework Used
                            </li>
                            <li>
                                Easy to use and customize
                            </li>
                            <li>
                                Font awesome icons included
                            </li>
                            <li>
                                Clean and light code used.
                            </li>
                            <li>
                                Responsive Design Framework Used
                            </li>
                            <li>
                                Easy to use and customize
                            </li>
                            <li>
                                Font awesome icons included
                            </li>
                            <li>
                                Clean and light code used.
                            </li>
                        </ul>
                       
                    </div>
                    <div class="alert alert-success">
                         <strong> Instructions To Use:</strong>
                        <ul>
                            <li>
                               Lorem ipsum dolor sit amet ipsum dolor sit ame
                            </li>
                            <li>
                                 Aamet ipsum dolor sit ame
                            </li>
                            <li>
                               Lorem ipsum dolor sit amet ipsum dolor
                            </li>
                            <li>
                                 Cpsum dolor sit ame
                            </li>
                        </ul>
                       
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    &copy; 2016 24/7 OpenMarket.com All Rights Reserved | Powered By <a href="http://htsm.in/">HTSM TECHNOLOGIES PVT. LTD.</a>
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    
		<script type="text/javascript">
		$(document).ready(function()
		{
			$('#state').change(function()
			{
				var keyword = $('#state').val();				
			    $.ajax({
				url: "<?php echo base_url(); ?>seller/list_search1", 
				async: false,
				type: "POST", 
				data: {term:keyword},
				dataType: "html", 
				success: function(data) {
					$('#city').html(data);		
					//alert(data);			
			    }
			 })
			});
				
			$('#city').change(function()
			{
				var keyword = $('#city').val();
				$.ajax({
					url: "<?php echo base_url(); ?>seller/list_search2", 
					async: false,
					type: "POST", 
					data: {term:keyword},
					dataType: "html",
					success: function(data) {
				    	$('#area').html(data);
				    }
				  })
			});	
			
			$('#bt').change(function()
			{
				var keyword = $('#bt').val();				
			    $.ajax({
				url: "<?php echo base_url(); ?>seller/cat_type", 
				async: false,
				type: "POST", 
				data: {term:keyword},
				dataType: "html", 
				success: function(data) {
					$('#chk').html(data);		
					//alert(data);			
			    }
			 })
			});
					
		});
		</script>
</body>
</html>
