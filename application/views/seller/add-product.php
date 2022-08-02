 <?php $this->load->view('seller/header'); ?>
 <link href="<?php echo base_url();?>assets/plugins/date-time-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/multiselct-cs-js/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/multiselct-cs-js/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/multiselct-cs-js/prettify.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />

 
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Add Products
          <p class="pageNav"><a href="<?php echo base_url('seller/dashboard'); ?>">Home</a><span class="separator"></span><strong>Add Products</strong></p>
        </div>
      </div>
      
    </div>
   
    <!--page title end-->
    <!--page content start-->
    <div class="row">
      <div class="col-xs-12">
       <?php echo $this->session->flashdata('msg'); ?>
      <div class="panel with-nav-tabs panel-primary">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#general" data-toggle="tab">General</a></li>
            <li><a href="#metaDescription" data-toggle="tab">Meta Description</a></li>
            <li><a href="#features" data-toggle="tab">Features</a></li>
            <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
          </ul>
        </div>
        
        <form action="<?php echo base_url();?>seller/add-suc-product" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="tab-content">
            <!--General tab-->
            <div class="tab-pane fade in active" id="general">              
              
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Product Title</label>
              <div class="col-sm-8">
                <input type="text" name="productname" id="product_name" class="form-control" required="required" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Product URL</label>
              <div class="col-sm-8">
                <input type="text" name="urlname" id="product_url" class="form-control" required="required" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">SKU</label>
              <div class="col-sm-8">
                <input type="text" name="model" id="model" class="form-control"  />
              </div>
            </div>
            
             
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Select Category</label>
              <div class="col-sm-8">
                <select class="form-control" id="menu1" name="menu" required="required">
                <option value="">Select Category</option>
                <?php
				foreach($m as $menu)
				{
					echo "<option value=".$menu->menu_id.">".$menu->menu_name."</option>";
				}
				?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Select Sub Category</label>
              <div class="col-sm-8">
                <select class="form-control" id="category" name="category" required="required">
                <option value="0">Select Sub Category</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Select Child Category</label>
              <div class="col-sm-8">
                <select class="form-control" id="subcategory" name="subcategory" required="required">
                  <option value="0">Select Child Category</option>
                </select>
              </div>
            </div>
            
            <div id="colorsize">
            	
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Expected Payout</label>
              <div class="col-sm-8">
                <input type="text" name="exp_pay" class="form-control" />
              </div>
            </div>
                         
                      
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">M.R.P. (Rs.)</label>
              <div class="col-sm-8">
                <input type="number" name="mrp" class="form-control" required="required" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Retail Price (Rs.)</label>
              <div class="col-sm-8">
                <input type="number" name="retail" class="form-control" />
              </div>
            </div>
            
           
            
            <!--<div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Short Description</label>
              <div class="col-sm-8">
                <textarea type="text" rows="5" name="short_desc" class="form-control" ></textarea>
              </div>
            </div>-->
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Full Description</label>
              <div class="col-sm-8">
                <textarea name="product_details" id="content" required="required"></textarea>
	            <?php echo display_ckeditor($ckeditor); ?>
              </div>
            </div>
            
                        
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Stock</label>
              <div class="col-sm-8">
                <input type="text" name="stock" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Quantity (MIN)</label>
              <div class="col-sm-8">
                <input type="text" name="minqty" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Quantity (MAX)</label>
              <div class="col-sm-8">
                <input type="text" name="maxqty" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Weight Of Product(in grams)</label>
              <div class="col-sm-8">
                <input type="text" name="weight" class="form-control" />
              </div>
            </div>
                
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Status</label>
              <div class="col-sm-8">
                <select class="form-control" name="status" required="required">
                  <option value="1">Active</option>
                  <option value="0">Deactivate</option>
                </select>
              </div>
            </div>
            
            
           <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Featured Image</label>                  
                  <div class="col-sm-8">
                      <div style="border:1px solid #ccc;">
                      <div style="padding:15px;">
                        <input type="file" name="userfile" class="form-control-file" />                        
                        <span style=""><br/>PHPExcel is a pure PHP library for reading and writing spreadsheet files and CodeIgniter is one of the well known PHP MVC framework. Here i am gonna show you how to Integrate PHPEXcel library in CodeIgniter.</span>
                      </div>  
                      </div>
                  </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Gallery Image</label>
              <div class="col-sm-8">
              		<div style="border:1px solid #ccc;">
                      <div style="padding:15px;">
                        <span style="color:red;">(Choose multiple images)</span>
                        <input type="file" name="uploadfile[]" multiple="multiple" class="form-control" />                        <span style=""><br/>PHPExcel is a pure PHP library for reading and writing spreadsheet files and CodeIgniter is one of the well known PHP MVC framework. Here i am gonna show you how to Integrate PHPEXcel library in CodeIgniter.</span>
                      </div>  
                    </div>                
              </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label">Select Type</label>
                <div class="col-sm-8">
                  <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox1" name="type" value="1" checked="checked">
                    Retailer </label>
                  <label class="checkbox-inline" data-toggle="collapse" data-target="#wholesale">
                    <input type="radio" id="inlineCheckbox2" name="type" value="2">
                    Wholesale </label>
                    <label class="checkbox-inline" data-toggle="collapse" data-target="#wholesale">
                    <input type="radio" id="inlineCheckbox2" name="type" value="3">
                    Both </label>
                </div>
              </div>
              
              <div id="wholesale" class="collapse" role="tabpanel">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Minimum Quantity for wholesale</label>
                  <div class="col-sm-8">
                    <input type="text" name="wminqty" class="form-control" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">wholesale Price</label>
                  <div class="col-sm-8">
                    <input type="text" name="wprice" class="form-control" />
                  </div>
                </div>
              </div>
                   
            </div>
            
            
            <div class="tab-pane fade" id="metaDescription">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Meta Title</label>
                  <div class="col-sm-7">
                    <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Meta Keywords</label>
                  <div class="col-sm-7">
                    <input type="text" name="meta_key"  class="form-control" placeholder="Meta Keywords" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Description</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" name="meta_des"  rows="5" placeholder="Meta Description"></textarea>
                  </div>
                </div>
                
            </div>
            
            <!--Features tab-->
            <div class="tab-pane fade" id="features">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Select Brand</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="brand" name="brand_id" >
                    <option>Select Brand</option>
                    <?php
                    foreach($b as $brand)
                    {
                        echo "<option value=".$brand->brand_id.">".$brand->brand_name."</option>";
                    }
                    ?>
                    </select>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Replacement Gaurantee</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="rg" name="rg_id" required>
                    <option value="">Select Replacement Gaurantee</option>
                    <?php
                    foreach($rg as $rp)
                    {
                        echo "<option value=".$rp->rg_id.">".$rp->rg_name."</option>";
                    }
                    ?>
                    </select>
                  </div>
                </div>
                
                
                
              <div class="form-group">
                  
                 <label class="col-sm-3 col-md-2 control-label">Select Attribute</label>
                    <div id="atrr_result">
                       
                    </div>
                  
                   
              </div>   
              
                
            </div>

            
            <!--Shipping tab-->
            <div class="tab-pane fade" id="shipping">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Estimated Delivery</label>
                  <div class="col-sm-7">
                    <select name="delv_day" class="form-control">
                      <option value="2-3 days">2-3 days</option>
                      <option value="3-5 days">3-5 days</option>
                      <option value="5-7 days">5-7 days</option>
                    </select>
                  </div>
            </div>
                
                
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">COD Allowed</label>
                  <div class="col-sm-8">
                    <label class="checkbox-inline">
                      <input type="radio" name="cod" value="1">
                      Yes </label>
                    <label class="checkbox-inline" data-toggle="collapse" data-target="#wholesaleOrBoth">
                      <input type="radio" name="cod" value="0" checked="checked">
                      No </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-7 col-sm-offset-3 col-md-offset-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
            </div>
            <!--Meta Description-->
                        
          </div>
        </div>
          </form>
      </div>   
      </div>
    </div>
    <!--page content end-->
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>