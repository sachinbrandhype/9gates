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
    <title>Edit Area</title>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/country/updatearea/<?= $area->has_very?>" method="post" enctype="multipart/form-data">

                                    <div class="row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Country</label>
                                            <select class="form-control" name="country" id="country" required="">
                                                <option>Select Country</option>
                                                <?php if(!empty($country)){
                                                    foreach($country as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $area->country){?><?php echo "selected";}?>><?=$c->country?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Country!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">State</label>
                                            <select class="form-control" name="state" id="state" required="">
                                                <option>Select State</option>
                                                <?php if(!empty($state)){
                                                    foreach($state as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $area->state){?><?php echo "selected";}?>><?=$c->state?></option>
                                                    <?php }} ?>

                                            </select>
                                            <div class="valid-feedback">State!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">City</label>
                                            <select class="form-control" name="city" id="city" >

                                                <option>Select City</option>
                                                <?php if(!empty($city)){
                                                    foreach($city as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $area->city){?><?php echo "selected";}?>><?=$c->city?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">City!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">City</label>
                                            <input class="form-control" type="text" name="area" value="<?=$area->area?>">
                                            <div class="valid-feedback">Area!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Pincode</label>
                                            <input class="form-control" type="text" name="pincode" value="<?=$area->pincode?>">
                                            <div class="valid-feedback">Pincode!</div>
                                        </div>


                                    </div>
                                    <br>
                                    <div class="cliearfix"></div>
                                    <button class="btn btn-primary" type="submit">Update</button>
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

</script>
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>