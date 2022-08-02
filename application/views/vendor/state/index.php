<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from admin.pixelstrap.com/viho/theme/datatable-ext-key-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:55:23 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>All State</title>
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
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="focus-cell">
                                        <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>Date</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($state)){
                                            $count=1;
                                            foreach($state as $s){?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td><?=$s->country?></td>
                                            <td><?=$s->state?></td>
                                            <td><?= htmlentities($s->createdate)?></td>
                                            <td><a href="<?=site_url('admin/country/editstate/').$s->has_very?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span>Edit</a>
                                             <a href="<?=site_url('admin/country/deletestate/'.$s->has_very)?>" class="btn btn-warning">Delete</a> </td>
                                        </tr>
                                        <?php $count++;}}?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
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

<!-- login js-->
<!-- Plugin used-->
<?php $this->load->view('admin/script.php');?>
<!-- Plugins JS start-->



</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/datatable-ext-key-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:55:23 GMT -->
</html>