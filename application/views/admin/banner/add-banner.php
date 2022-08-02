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
    <title>Add Banner</title>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/banner/save" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Gates</label>
                                            <select class="form-control" name="menu" id="menu" required="">
                                            <option>Select Gates</option>
                                                <?php if(!empty($gates)){
                                                    foreach($gates as $c){?>
                                               <option value="<?=$c->id?>"><?=$c->menu?></option>
                                            <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Gates!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Category</label>
                                            <select class="form-control" name="category" id="category" required="">
                                            <option>Select Category</option>
                                                <?php if(!empty($cat)){
                                                    foreach($cat as $c){?>
                                               <!--<option value="<?=$c->id?>"><?=$c->category?></option>-->
                                            <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Sub Category</label>
                                            <select class="form-control" name="subcategory" id="subcategory" required="">

                                            </select>
                                            <div class="valid-feedback">Sub Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Child Category</label>
                                            <select class="form-control" name="childcategory" id="childcategory" required="">

                                            </select>
                                            <div class="valid-feedback">Child Category!</div>
                                        </div>



                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Banner Image</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="file" name="image" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Banner Image.</div>
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
    $("#product").bind("keyup", changed).bind("change", changed);
    function changed() {
        $("#product_url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
    }

    $(document).ready(function(){
        $('#menu').change(function(){
            var menu = $('#menu').val();
            if(menu != '')
            {
                $.ajax({
                    url:"<?php echo site_url('admin/banner/menuBycategory'); ?>",
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

    $(document).ready(function(){
        $('#subcategory').change(function(){
            var subcategory = $('#subcategory').val();
            if(subcategory != '')
            {
                $.ajax({
                    url:"<?php echo site_url('admin/product/subcategoryBychildcategory'); ?>",
                    method:"POST",
                    data:{subcategory:subcategory},
                    success:function(data)
                    {
                        $('#childcategory').html(data);
                    }
                });
            }
            else
            {
                $('#childcategory').html('<option value="">Select Childcategory</option>');
            }
        });
    });

</script>
<!-- Plugin used-->
</body>


</html>