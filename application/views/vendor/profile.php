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
    <title>Sub Category</title>
    <!-- Google font-->
    <?php $this->load->view('vendor/css.php');?>
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
    <?php $this->load->view('vendor/head.php');?>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
        <!-- Page Sidebar Start-->
        <?php //$this->load->view('vendor/menu.php');?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="login-card">
                            <form class="theme-form login-form" id="frm"  action="<?php echo site_url(); ?>vendor/login/upload_document" method="POST" enctype="multipart/form-data">
                                <h4>Documents</h4>
                                <h6>It is compulsory to upload documents and fill their details. (Upload scans copy only)</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>PAN NO</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="text" id="pan_no" name="pan_no" placeholder="Enter pan_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UPLOAD</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="file" id="pan_file" name="pan_file" placeholder="Enter name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TIN NO</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="text" id="tin_no" name="tin_no" placeholder="Enter tin_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UPLOAD</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="file" id="tin_file" name="tin_file" placeholder="Enter mobile">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TAN NO</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="text" id="tan_no" name="tan_no" placeholder="Enter tan_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UPLOAD</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="file" id="tan_file" name="tan_file" placeholder="Enter confirm password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ADDRESS PROOF</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="text" id="address_no" name="address_no" placeholder="Enter address_no password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UPLOAD</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="file" id="address_file" name="address_file" placeholder="Enter confirm password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ID PROOF</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="text" id="id_no" name="id_no" placeholder="Enter confirm password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>UPLOAD</label>
                                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                                <input class="form-control" type="file" id="id_file" name="id_file" placeholder="Enter confirm password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id='err_msg' style='display: none'>
                                    <div id='content_result'>
                                        <div id='err_show' class="w3-text-red">
                                            </label><div id='msg'> </div></label>
                                        </div></div></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save and Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php $this->load->view('vendor/footer.php');?>
    </div>
</div>
<!-- latest jquery-->
<?php $this->load->view('vendor/script.php');?>
<script>
    $("#subcategory").bind("keyup", changed).bind("change", changed);
    function changed() {
        $("#url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
    }


    $(document).ready(function(){
        $('#menu').change(function(){
            var menu = $('#menu').val();
            if(menu != '')
            {
                $.ajax({
                    url:"<?php echo site_url('admin/subcategory/categorybymenu'); ?>",
                    method:"POST",
                    data:{menu:menu},
                    success:function(data)
                    {
                        $('#category').html(data);
                    }
                });
            }
            else
            {
                $('#category').html('<option value="">Select Category</option>');
            }
        });
    });


</script>
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>