<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from admin.pixelstrap.com/viho/theme/login_one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 19:16:09 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?=site_url()?>private/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=site_url()?>private/assets/images/favicon.png" type="image/x-icon">
    <title>Vendor</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?=site_url()?>private/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?=site_url()?>private/assets/css/responsive.css">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
      <div class="container-fluid">
        <div class="row">
            <?php echo $this->session->flashdata('msg1');?>
          <div class="col-xl-7">
              <div class="login-card">
                  <form class="theme-form login-form" id="frm"  action="<?php echo site_url(); ?>vendor/login/sign_up" method="POST">
                      <h4>Vendor</h4>
                      <h6>Register New Account</h6>
                      <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">
                          <label>Store</label>
                          <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                              <input class="form-control" type="text" id="store" name="store" placeholder="Enter store">
                          </div>
                      </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Name</label>
                              <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                  <input class="form-control" type="text" id="name" name="name" placeholder="Enter name">
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Email</label>
                              <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                  <input class="form-control" type="text" id="email" name="email" placeholder="Enter email id">
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Mobile</label>
                              <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                  <input class="form-control" type="text" id="phone" name="phone" placeholder="Enter mobile">
                              </div>
                          </div>
                      </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Password</label>
                                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                      <input class="form-control" type="password" id="password" name="password" placeholder="Enter password">
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Confirm Password</label>
                                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                      <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Enter confirm password">
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>State</label>
                                      <select class="form-control" type="text" id="state" name="state" >
                                          <option>Select State</option>
                                        <?php if(!empty($s)){
                                            foreach($s as $st){?>
                                          <option value="<?=$st->id?>"><?=$st->state?></option>
                                        <?php }} ?>
                                          <select>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>City</label>
                                      <select class="form-control" type="text" id="city" name="city" >
                                          <option>Select City</option>

                                          <option></option>

                                          <select>
                              </div>
                          </div>


                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Area</label>
                                      <select class="form-control" type="text" id="area" name="area" >
                                          <option>Select Area</option>

                                          <option></option>

                                          <select>
                                  </div>
                          </div>
                        </div>

                      <div id='err_msg' style='display: none'>
                          <div id='content_result'>
                              <div id='err_show' class="w3-text-red">
                                  </label><div id='msg'> </div></label>
                              </div></div></div>
                      <div class="form-group">
                          <button class="btn btn-primary btn-block" type="submit">Register</button>
                      </div>
                  </form>
              </div>
          </div>
          <div class="col-xl-5 p-0">
            <div class="login-card">
              <form class="theme-form login-form" id="frm" action="<?php echo site_url(); ?>vendor/login/login" method="post">
                <h4>Vendor</h4>
                <h6>Welcome back! Log in to your account.</h6>
                <div class="form-group">
                  <label>Email id</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" type="text" id="email" name="email" placeholder="Enter email id">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input class="form-control" type="password" id="password" name="password"  placeholder="*********">
                    <div class="show-hide"><span class="show">                         </span></div>
                  </div>
                </div>
                  <div id='err_msg' style='display: none'>
                      <div id='content_result'>
                          <div id='err_show' class="w3-text-red">
                              </label><div id='msg'> </div></label>
                          </div></div></div>
                  <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit" id="isloginokoko">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="<?=site_url()?>private/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="<?=site_url()?>private/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?=site_url()?>private/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?=site_url()?>private/assets/js/sidebar-menu.js"></script>
    <script src="<?=site_url()?>private/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="<?=site_url()?>private/assets/js/bootstrap/popper.min.js"></script>
    <script src="<?=site_url()?>private/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?=site_url()?>private/assets/js/script.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
  <script>
      $(document).ready(function(){
          $("#islogin").click(function(){
              var email = $("#email").val();
              var password = $("#password").val();
              // Returns error message when submitted without req fields.
              if(email=='' || password=='')
              {
                  jQuery("div#err_msg").show();
                  jQuery("div#msg").html("All fields are required");
              }
              else
              {
                  // AJAX Code To Submit Form.
                  $.ajax({
                      type: "POST",
                      url:  "<?php echo site_url(); ?>" + "vendor/login/login",
                      data: {email: email, password: password},
                      cache: false,
                      success: function(result){
                          if(result!=0){
                              // On success redirect.
                              window.location.replace(result);
                          }
                          else
                              jQuery("div#err_msg").show();
                          jQuery("div#msg").html("Login Failed");
                      }
                  });
              }
              return false;
          });
      });

      $('#state').change(function()
      {
          var keyword = $('#state').val();
          $.ajax({
              url: "<?php echo base_url(); ?>vendor/login/list_search1",
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
              url: "<?php echo base_url(); ?>vendor/login/list_search2",
              async: false,
              type: "POST",
              data: {term:keyword},
              dataType: "html",
              success: function(data) {
                  $('#area').html(data);
              }
          })
      });


  </script>

  </body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/login_one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 19:16:09 GMT -->
</html>