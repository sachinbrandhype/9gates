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
    <title>Edit Blog</title>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/blog/update/<?= $blog->has_very?>" method="post" enctype="multipart/form-data">

                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Heading</label>
                                            <input class="form-control" type="text" name="name" id="name" value="<?=$blog->name?>">
                                            <div class="valid-feedback">Heading!</div>
                                        </div>

                                        <div class="col-md-4" style="display: none">
                                            <label class="form-label" for="validationCustom01">Url</label>
                                            <input class="form-control" type="text" name="url" id="url" required="">
                                            <div class="valid-feedback">Url!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Image</label>
                                            <input class="form-control" type="file" name="image" id="image">

                                            <div class="valid-feedback">Image!</div>

                                            <img src="<?=site_url()?>uploads/<?=$blog->image?>" style="width: 57px;height: 57px">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Shourt Content</label>
                                            <textarea class="form-control" type="text" name="shourt_content" id="shourt_content" required=""><?=$blog->shourt_content?></textarea>
                                            <div class="valid-feedback">Shourt Content!</div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="validationCustom01">Content</label>
                                            <textarea class="form-control" type="text" name="content" id="id_cazary_full" style="height:200px;width:100%;" required=""><?=$blog->content?></textarea>
                                            <div class="valid-feedback">Content!</div>
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
    $("#name").bind("keyup", changed).bind("change", changed);
    function changed() {
        $("#url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
    }

</script>
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>