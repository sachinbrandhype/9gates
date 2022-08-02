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
    <title>Edit Child Category</title>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/childcategory/update/<?= $child->has_very?>" method="post" enctype="multipart/form-data">

                                    <div class="row g-3">
                                        
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Menu</label>
                                            <select class="form-control" name="menu" id="menu" required="">
                                            <option>Select Menu</option>
                                                <?php if(!empty($menu)){
                                                    foreach($menu as $m){?>
                                               <option value="<?=$m->id?>" <?php if($m->id == $child->menu){?> <?php echo "selected";}?>><?=$m->menu?></option>
                                            <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Menu!</div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Category</label>
                                            <select class="form-control" name="category" id="category">
                                                <option>Select Category</option>
                                                <?php if(!empty($cat)){
                                                    foreach($cat as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id==$child->category){?><?php echo "selected";} ?>><?=$c->category?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Category!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Sub Category</label>
                                            <select class="form-control" name="subcategory">

                                                <option>Select Sub Category</option>
                                                <?php if(!empty($sub)){
                                                    foreach($sub as $s){
                                                ?>
                                                <option value="<?=$s->id?>" <?php if($s->id == $child->subcategory){?><?php echo "selected";}?>><?=$s->subcategory?></option>
                                                <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Sub Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Child Category</label>
                                            <input class="form-control" type="text" name="childcategory" id="childcategory" value="<?=$child->childcategory?>">
                                            <div class="valid-feedback">Child Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Sub Category Description</label>
                                            <textarea class="form-control" type="text" name="description" required=""><?=$child->description?></textarea>
                                            <div class="valid-feedback">Sub Category Description!</div>
                                        </div>


                                        <div class="col-md-4" style="display: none">
                                            <label class="form-label" for="validationCustom02">Url</label>
                                            <input class="form-control" type="text" name="url" id="url" value="<?= $child->url?>">
                                            <div class="valid-feedback">Url!</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Small Image</label>
                                            <div class="input-group">
                                                <img src="<?=site_url()?>uploads/<?= $child->image ?>" style="height: 57px;width: 57px">
                                                <input class="form-control" id="validationCustomUsername" type="file" name="image" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Image.</div>
                                            </div>
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