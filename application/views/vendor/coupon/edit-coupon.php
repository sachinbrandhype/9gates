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
    <title>Add Coupon</title>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/coupon/update/<?=$coupon->has_very?>" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Coupon Code</label>
                                            <input class="form-control" type="text" name="coupon_code" value="<?=$coupon->coupon_code?>">
                                            <div class="valid-feedback">Coupon Code!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Coupon Type</label>
                                            <input class="form-control" type="text" name="coupon_type" value="<?=$coupon->coupon_type?>">
                                            <div class="valid-feedback">Coupon Type!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Coupon Value</label>
                                            <input class="form-control" type="text" name="coupon_value" value="<?=$coupon->coupon_value?>">
                                            <div class="valid-feedback">Coupon Value!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Amount</label>
                                            <input class="form-control" type="text" name="amount" value="<?=$coupon->amount?>">
                                            <div class="valid-feedback">Amount!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Start Date</label>
                                            <input class="form-control" type="text" name="start_date" value="<?=$coupon->start_date?>">
                                            <div class="valid-feedback">Start Date!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">End Date</label>
                                            <input class="form-control" type="text" name="end_date" value="<?=$coupon->end_date?>">
                                            <div class="valid-feedback">End Date!</div>
                                        </div>

                                    </div>

                                    <div class="cliearfix"></div>
                                    <br>
                                    <button class="btn btn-primary btnadd" type="submit">Update</button>

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
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>