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
    <title>Business Bank Details</title>
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
                <form class="theme-form login-form" id="frm"  action="<?php echo site_url(); ?>vendor/login/business_bank_details" method="POST" enctype="multipart/form-data">
                    <h4>Documents</h4>
                    <h6>It is compulsory to upload documents and fill their details. (Upload scans copy only)</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Holder's Name</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="text" id="ac_name" name="ac_name" placeholder="Enter ac_name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Number</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="text" id="ac_no" name="ac_no" placeholder="Enter ac_no">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Type</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <select class="form-control" type="text" id="ac_type" name="ac_type" placeholder="Enter tin_no">

                                    <option>Select Account Type</option>

                                      <option value="Saving">Saving</option>
                                        <option value="Current">Current</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="text" id="bank_name" name="bank_name" placeholder="Enter bank_name">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bank Branch Name</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="text" id="bank_branch" name="bank_branch" placeholder="Enter bank_branch">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IFSC CODE</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="text" id="ifsc_code" name="ifsc_code" placeholder="Enter ifsc_code">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cancelled cheque</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="file" id="cheque_file" name="cheque_file" placeholder="Enter address_no password">
                                </div>
                                <strong>upload? (Upload scanned copy of cancelled cheque)</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>I accept the memorandum of Undertaking</label>
                                <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                    <input class="form-control" type="checkbox" id="mem" name="memorandum" placeholder="Enter confirm password" value="1">
                                </div>
                            </div>
                        </div>
                        <div id='err_msg' style='display: none'>
                            <div id='content_result'>
                                <div id='err_show' class="w3-text-red">
                                    </label><div id='msg'> </div></label>
                                </div></div></div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Save and continue</button>
                        </div>
                </form>

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

<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>