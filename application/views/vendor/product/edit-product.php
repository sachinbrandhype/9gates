<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:15 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="product.">
    <meta name="keywords" content="product">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Edit Product</title>
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
                                <form class="needs-validation" action="<?=site_url()?>vendor/product/update/<?= $pro->has_very?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $pro->id?>">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Product Title</label>
                                            <input class="form-control" type="text" name="product" id="product" value="<?=$pro->product?>">
                                            <div class="valid-feedback">Product Title!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">SKU</label>
                                            <input class="form-control" type="text" name="sku" value="<?=$pro->sku?>">
                                            <div class="valid-feedback">SKU!</div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Category</label>
                                            <select class="form-control" name="category" id="category" >
                                                <option>Select Category</option>
                                                <?php if(!empty($cat)){
                                                    foreach($cat as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $pro->category){?><?php echo "selected";}?>><?=$c->category?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Sub Category</label>
                                            <select class="form-control" name="subcategory" id="subcategory" >
                                                <?php if(!empty($sub)){
                                                    foreach($sub as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $pro->subcategory){?><?php echo "selected";}?>><?=$c->subcategory?></option>
                                                    <?php }} ?>

                                            </select>
                                            <div class="valid-feedback">Sub Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Child Category</label>
                                            <select class="form-control" name="childcategory" id="childcategory">
                                                <?php if(!empty($child)){
                                                    foreach($child as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $pro->childcategory){?><?php echo "selected";}?>><?=$c->childcategory?></option>
                                                    <?php }} ?>

                                            </select>
                                            <div class="valid-feedback">Child Category!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">HSN NO</label>
                                            <input class="form-control" type="number" name="hsnno" value="<?=$pro->hsnno?>">
                                            <div class="valid-feedback">HSN No!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Color</label>
                                            <select class="form-control" name="color" id="color_code" >
                                                <?php if(!empty($color)){
                                                    foreach($color as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $pro->color){?><?php echo "selected";}?>><?=$c->color?></option>
                                                    <?php }} ?>

                                            </select>
                                            <div class="valid-feedback">Color!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Attribute Group</label>
                                            <select class="form-control" name="attributegroup" id="attributegroup">
                                                <?php if(!empty($attr)){
                                                    foreach($attr as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $pro->attributegroup){?><?php echo "selected";}?>><?=$c->attributegroup?></option>
                                                    <?php }} ?>

                                            </select>
                                            <div class="valid-feedback">Attribute Group!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Size</label>
                                            <select class="form-control" name="size" id="size">
                                                <?php if(!empty($size)){
                                                    foreach($size as $c){?>
                                                        <option value="<?=$c->id?>"<?php if($c->id == $pro->size){?><?php echo "selected";}?>><?=$c->size?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Size!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">M.R.P(Rs.)</label>
                                            <input class="form-control" type="text" name="mrp" value="<?=$pro->mrp?>">
                                            <div class="valid-feedback">M.R.P(Rs.)!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Retail Price</label>
                                            <input class="form-control" type="text" name="retail" value="<?=$pro->retail?>">
                                            <div class="valid-feedback">Retail Price!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Short Description</label>
                                            <textarea class="form-control" type="text" name="short_description" required=""><?=$pro->short_description?></textarea>
                                            <div class="valid-feedback">Short Description!</div>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label" for="validationCustom01">Full Description</label>
                                            <textarea class="form-control" id="id_cazary_full" style="height:200px;width:100%;" type="text" name="description"><?=$pro->description?></textarea>
                                            <div class="valid-feedback">Full Description!</div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <label class="form-label" for="validationCustom01">Image Description</label>
                                            <textarea class="form-control" id="id_cazary_full" style="height:200px;width:100%;" type="text" name="image_description"><?=$pro->image_description?></textarea>
                                            <div class="valid-feedback">Image Description!</div>
                                        </div>
                                        

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Stock</label>
                                            <input class="form-control" type="text" name="stock" value="<?=$pro->stock?>">
                                            <div class="valid-feedback">Stock!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Quantity(MIN)</label>
                                            <input class="form-control" type="text" name="minqty" value="<?=$pro->minqty?>">
                                            <div class="valid-feedback">Quantity(MIN)!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Quantity(MAX)</label>
                                            <input class="form-control" type="text" name="maxqty" value="<?=$pro->maxqty?>">
                                            <div class="valid-feedback">Quantity(MAX)!</div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Featured Image</label>
                                            <div class="input-group">
                                                <img src="<?=site_url()?>uploads/<?=$pro->fimage?>" style="width: 56px;height: 56px">
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
                                            <?php
                                            $product = $this->product_model->getProductMultipleById($pro->id);
                                            if(!empty($product)){
                                                foreach($product as $p){?>
                                                    <img src="<?= site_url()?>uploads/<?=$p->image?>" style="height: 56px;width: 56px;">
                                                <?php } } ?>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Meta Title</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="text" name="meta_title" aria-describedby="inputGroupPrepend" value="<?=$pro->meta_title?>">
                                                <div class="invalid-feedback">Meta Title.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Meta Description</label>
                                            <div class="input-group">
                                                <textarea class="form-control" id="validationCustomUsername" type="text" name="meta_description" aria-describedby="inputGroupPrepend"><?=$pro->meta_description?></textarea>
                                                <div class="invalid-feedback">Meta Description.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Meta Tag</label>
                                            <div class="input-group">
                                                <input class="form-control" id="validationCustomUsername" type="text" name="meta_tag" aria-describedby="inputGroupPrepend" value="<?=$pro->meta_tag?>">
                                                <div class="invalid-feedback">Meta Tag.</div>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Brand</label>
                                            <select class="form-control" name="brand" id="brand" value="<?=$pro->brand?>">
                                                <option>Select Brand</option>
                                                <?php if(!empty($brand)){
                                                    foreach($brand as $b){?>
                                                        <option value="<?=$b->name?>"<?php if($b->name == $pro->brand){?><?php echo "selected";}?>><?=$b->name?></option>
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
                                                        <option value="<?=$rep->replace?>"<?php if($rep->replace == $pro->replacement){?><?php echo "selected";}?>><?=$rep->replace?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Replacement Guarantee!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Estimated Delivery</label>
                                            <select class="form-control" name="estimate" id="estimate" required="">
                                                <option>Select Estimate Delivery</option>
                                                <?php if(!empty($estimate)){
                                                    foreach($estimate as $rep){?>
                                                        <option value="<?=$rep->delv_day?>"<?php if($rep->delv_day == $pro->estimate){?><?php echo "selected";}?>><?=$rep->delv_day?></option>
                                                    <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">Replacement Guarantee!</div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Offers List</label>
                                            <select class="form-control" name="offer" id="offer" required="">
                                                <option>Select Offers</option>
                                                 <option value="Popularity">Popularity</option>
                                                 <option value="Discount">Discount</option>
                                                 <option value="Customer Top Rated">Customer Top Rated</option>
                                                 <option value="New Arrivals">New Arrivals</option>
                                                 <option value="High Price">High Price</option>
                                                 <option value="Low">Low Price</option>
                                                    
                                            </select>
                                            <div class="valid-feedback">Offer List!</div>
                                        </div>
                                        <div id="setoffer">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustomUsername">Set Offer</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="set_offer" aria-describedby="inputGroupPrepend" value="<?=$pro->set_offer?>">
                                                <div class="invalid-feedback">Set Offer.</div>
                                            </div>
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
        <?php $this->load->view('vendor/footer.php');?>
    </div>
</div>
<!-- latest jquery-->
<?php $this->load->view('vendor/script.php');?>

<script>    
$('#setoffer').hide();

      
           
           $('#offer').on('change', function()
            {
                var data = $(this).val();
                if(data == 'Discount'){
                   $('#setoffer').show(); 
                }
                else {
                  $('#setoffer').hide();  
                }
            });

            </script>
            
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