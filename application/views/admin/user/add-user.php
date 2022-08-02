<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:15 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Add User</title>
    <!-- Google font-->
    <?php $this->load->view('admin/css.php');?>
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
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php $this->load->view('admin/head.php');?>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        <?php $this->load->view('admin/menu.php');?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">

                            <div class="card-body">
                                <form class="needs-validation" action="<?=site_url()?>admin/user/save" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">User name</label>
                                            <input class="form-control" type="text" name="username" required="">
                                            <div class="valid-feedback">User name!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Password</label>
                                            <input class="form-control" type="password" name="password" required="">
                                            <div class="valid-feedback">Password!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Name</label>
                                            <input class="form-control" type="text" name="name" required="" >
                                            <div class="valid-feedback">Name!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Email</label>
                                            <input class="form-control" type="text" name="email" required="" >
                                            <div class="valid-feedback">Email!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Mobile</label>
                                            <input class="form-control" type="text" name="mobile" required="" >
                                            <div class="valid-feedback">Mobile!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Address</label>
                                            <input class="form-control" type="text" name="address" required="" >
                                            <div class="valid-feedback">Address!</div>
                                        </div>




                                    </div>
                                    <br>
                                    <div class="cliearfix"></div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php $this->load->view('admin/footer.php');?>
    </div>
</div>
<!-- latest jquery-->
<?php $this->load->view('admin/script.php');?>
<script>
    $("#childcategory").bind("keyup", changed).bind("change", changed);
    function changed() {
        $("#url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
    }


    $(document).ready(function(){
        $('#category').change(function(){
            var category = $('#category').val();
            if(category != '')
            {
                $.ajax({
                    url:"<?php echo site_url('admin/childcategory/subcategoryBycategory'); ?>",
                    method:"POST",
                    data:{category:category},
                    success:function(data)
                    {
                        $('#subcategory').html(data);
                    }
                });
            }
            else
            {
                $('#subcategory').html('<option value="">Select Subcategory</option>');
            }
        });
    });



</script>
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>