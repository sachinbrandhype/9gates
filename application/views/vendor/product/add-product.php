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
    <title>Add Product</title>
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
        <?php $this->load->view('vendor/menu.php');?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">

                            <div class="card-body">
                                <form class="needs-validation" action="<?=site_url()?>vendor/product/save" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Product Title</label>
                                            <input class="form-control" type="text" name="product" id="product" required="">
                                            <div class="valid-feedback">Product Title!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">SKU</label>
                                            <input class="form-control" type="text" name="sku" required="">
                                            <div class="valid-feedback">SKU!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Category</label>
                                            <select class="form-control" name="category" id="category" required="">
                                            <option>Select Category</option>
                                                <?php if(!empty($cat)){
                                                    foreach($cat as $c){?>
                                               <option value="<?=$c->id?>"><?=$c->category?></option>
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
                                            <select class="form-control" name="childcategory" id="childcategory" >

                                            </select>
                                            <div class="valid-feedback">Child Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">HSN NO</label>
                                            <input class="form-control" type="number" name="hsnno" required="">
                                            <div class="valid-feedback">HSN No!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Color</label>
                                            <select class="form-control" name="color" id="color_code" >

                                            </select>
                                            <div class="valid-feedback">Color!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Attribute Group</label>
                                            <select class="form-control" name="attributegroup" id="attributegroup" >

                                            </select>
                                            <div class="valid-feedback">Attribute Group!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Size</label>
                                            <select class="form-control" name="size" id="size" >
                                            </select>
                                            <div class="valid-feedback">Size!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">M.R.P(Rs.)</label>
                                            <input class="form-control" type="text" name="mrp" required="">
                                            <div class="valid-feedback">M.R.P(Rs.)!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Retail Price</label>
                                            <input class="form-control" type="text" name="retail" required="">
                                            <div class="valid-feedback">Retail Price!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Short Description</label>
                                            <textarea class="form-control" type="text" name="short_description" required=""></textarea>
                                            <div class="valid-feedback">Short Description!</div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="validationCustom01">Full Description</label>
                                            <textarea class="form-control" id="id_cazary_full" style="height:200px;width:100%;" type="text" name="description" required=""></textarea>
                                            <div class="valid-feedback">full Description!</div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label class="form-label" for="validationCustom01">Image Description</label>
                                            <textarea class="form-control" id="id_cazary_full" style="height:200px;width:100%;" type="text" name="image_description"></textarea>
                                            <div class="valid-feedback">Image Description!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Stock</label>
                                            <input class="form-control" type="text" name="stock" required="">
                                            <div class="valid-feedback">Stock!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Quantity(MIN)</label>
                                            <input class="form-control" type="text" name="minqty" required="">
                                            <div class="valid-feedback">Quantity(MIN)!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Quantity(MAX)</label>
                                            <input class="form-control" type="text" name="maxqty" required="">
                                            <div class="valid-feedback">Quantity(MAX)!</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Featured Image</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="file" name="fimage" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Featured Image.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Gallery Image</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="file" name="image[]" multiple aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Image.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Meta Title</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="text" name="meta_title" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Meta Title.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Meta Description</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="validationCustomUsername" type="text" name="meta_description" aria-describedby="inputGroupPrepend"></textarea>
                                                <div class="invalid-feedback">Meta Description.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Meta Tag</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="text" name="meta_tag" aria-describedby="inputGroupPrepend">
                                                <div class="invalid-feedback">Meta Tag.</div>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Brand</label>
                                            <select class="form-control" name="brand" id="brand" required="">
                                                <option>Select Brand</option>
                                                <?php if(!empty($brand)){
                                                    foreach($brand as $b){?>
                                                        <option value="<?=$b->name?>"><?=$b->name?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Brand!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Replacement Guarantee</label>
                                            <select class="form-control" name="replacement" id="replacement" required="">
                                                <option>Select Replacement Guarantee</option>
                                                <?php if(!empty($replace)){
                                                    foreach($replace as $rep){?>
                                                        <option value="<?=$rep->replace?>"><?=$rep->replace?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Replacement Guarantee!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Estimated Delivery</label>
                                            <select class="form-control" name="estimate" id="estimate" required="">
                                                <option>Select Replacement Guarantee</option>
                                                <?php if(!empty($estimate)){
                                                    foreach($estimate as $rep){?>
                                                        <option value="<?=$rep->delv_day?>"><?=$rep->delv_day?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Replacement Guarantee!</div>
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
        <?php $this->load->view('vendor/footer.php');?>
    </div>
</div>
<!-- latest jquery-->
<?php $this->load->view('vendor/script.php');?>
<script>
    $("#product").bind("keyup", changed).bind("change", changed);
    function changed() {
        $("#product_url").val(this.value.replace(/([~!#$^&*()_+=`{}\[\]\'|\\:;<>,.\/? ])+/g, '-').replace(/@/g, '').replace(/%/g, '').toLowerCase());
    }


    $(document).ready(function(){
        $('#category').change(function(){
            var category = $('#category').val();
            if(category != '')
            {
                $.ajax({
                    url:"<?php echo site_url('vendor/childcategory/subcategoryBycategory'); ?>",
                    method:"POST",
                    data:{category:category},
                    success:function(data)
                    {
                        alert(data);
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
                    url:"<?php echo site_url('vendor/product/subcategoryBychildcategory'); ?>",
                    method:"POST",
                    data:{subcategory:subcategory},
                    success:function(data)
                    {
                        alert(data);
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

    $(document).ready(function(){
        $('#subcategory').change(function(){
            var subcategory = $('#subcategory').val();
            if(subcategory != '')
            {
                $.ajax({
                    url:"<?php echo site_url('vendor/product/subcategoryBycolor'); ?>",
                    method:"POST",
                    data:{subcategory:subcategory},
                    success:function(data)
                    {
                        $('#color_code').html(data);
                    }
                });
            }
            else
            {
                $('#color_code').html('<option value="">Select Color</option>');
            }
        });
    });

    $(document).ready(function(){
        $('#subcategory').change(function(){
            var subcategory = $('#subcategory').val();
            if(subcategory != '')
            {
                $.ajax({
                    url:"<?php echo site_url('vendor/product/subcategoryBysize'); ?>",
                    method:"POST",
                    data:{subcategory:subcategory},
                    success:function(data)
                    {
                        $('#size').html(data);
                    }
                });
            }
            else
            {
                $('#size').html('<option value="">Select Size</option>');
            }
        });
    });

    $(document).ready(function(){
        $('#subcategory').change(function(){
            var subcategory = $('#subcategory').val();
            if(subcategory != '')
            {
                $.ajax({
                    url:"<?php echo site_url('vendor/product/subcategoryByattributegroup'); ?>",
                    method:"POST",
                    data:{subcategory:subcategory},
                    success:function(data)
                    {
                        $('#attributegroup').html(data);
                    }
                });
            }
            else
            {
                $('#attributegroup').html('<option value="">Select attribute group</option>');
            }
        });
    });



</script>
<!-- Plugin used-->
</body>


</html>