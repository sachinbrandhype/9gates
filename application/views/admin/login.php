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
    <title>Login</title>
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
          <div class="col-xl-7"><img class="bg-img-cover bg-center" src="<?=site_url()?>private/assets/images/login/2.jpg" alt="looginpage"></div>
          <div class="col-xl-5 p-0">
            <div class="login-card">
              <form class="theme-form login-form" id="frm">
                <h4>Admin</h4>
                <h6>Welcome back! Log in to your account.</h6>
                <div class="form-group">
                  <label>Username</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input class="form-control" type="text" id="username" name="username" placeholder="username">
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
                  <button class="btn btn-primary btn-block" type="submit" id="islogin">Sign in</button>
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
              var username = $("#username").val();
              var password = $("#password").val();
              // Returns error message when submitted without req fields.
              if(username==''||password=='')
              {
                  jQuery("div#err_msg").show();
                  jQuery("div#msg").html("All fields are required");
              }
              else
              {
                  // AJAX Code To Submit Form.
                  $.ajax({
                      type: "POST",
                      url:  "<?php echo site_url(); ?>" + "admin/login/check_login",
                      data: {username: username, password: password},
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

  </script>

  </body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/login_one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 19:16:09 GMT -->
</html>