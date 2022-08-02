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
    <link rel="icon" href="<?=site_url()?>private/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?=site_url()?>private/assets/images/favicon.png" type="image/x-icon">
    <title>Gift Card</title>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/gift/savegift" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        
                                         <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Heading</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="text" name="heading" id="heading" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Heading.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Url</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="text" name="url" id="url" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">url.</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Content</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="validationCustomUsername" name="content" aria-describedby="inputGroupPrepend"></textarea>
                                                <div class="invalid-feedback">Content.</div>
                                            </div>
                                        </div>
                                        
                                    
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Small Image</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="file" name="image" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Image.</div>
                                            </div>
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
    $("#heading").bind("keyup", changed).bind("change", changed);
    function changed() {
        $("#url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
    }

</script>
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>