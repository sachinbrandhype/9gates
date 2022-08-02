 <?php $this->load->view('seller/header'); ?>
 <link href="<?php echo base_url();?>assets/plugins/date-time-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/multiselct-cs-js/jquery.multiselect.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/multiselct-cs-js/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/multiselct-cs-js/prettify.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" />
<style type="text/css">
a img:hover{border:1px solid #000;opacity:0.3;}
</style>
 
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">Update Products
          <p class="pageNav"><a href="<?php echo base_url('seller/dashboard'); ?>">Home</a><span class="separator"></span><strong>Update Products</strong></p>
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
        
        <form action="<?php echo base_url();?>seller/product-update" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel-body">
          <div class="tab-content">
            <!--General tab-->
            <div class="tab-pane fade in active" id="general">              
              
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Product Title</label>
              <div class="col-sm-8">
                <input type="text" name="productname" value="<?php echo $product[0]->product_name;?>" id="product_name" class="form-control" required />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Product URL</label>
              <div class="col-sm-8">
                <input type="text" name="urlname" value="<?php echo $product[0]->product_name_url;?>" id="product_url" class="form-control" required />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">SKU</label>
              <div class="col-sm-8">
                <input type="text" name="model" value="<?php echo $product[0]->model;?>" id="model" class="form-control"  />
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Select Category</label>
              <div class="col-sm-8">
                <select class="form-control" id="menu1" name="menu" required="required">
                <option>Select Category</option>
                <?php
				foreach($m as $menu)
				{
				?>
                <option value="<?php echo $menu->menu_id ?>" <?php if($menu->menu_id == $product[0]->menu_id) echo 'selected'; ?>><?php echo $menu->menu_name;?></option>
                <?php
				}
				?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Select Sub Category</label>
              <div class="col-sm-8">
                <select class="form-control" id="category" name="category" required="required">
                <option value="">Select Sub Category</option>
                <?php
				foreach($cat as $cat)
				{
				?>
                <option value="<?php echo $cat->category_id;?>" <?php if($cat->category_id == $product[0]->category_id) echo 'selected'; ?>><?php echo $cat->category_name; ?></option>
                <?php
				}
				?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Select Child Category</label>
              <div class="col-sm-8">
                <select class="form-control" id="subcategory" name="subcategory" required="required">
                  <option value="">Select Child Category</option>
                  <?php
					foreach($subcat as $sub)
					{
					?>
					<option value="<?php echo $sub->category_id;?>" <?php if($sub->category_id == $product[0]->subcategory_id) echo 'selected'; ?>><?php echo $sub->category_name; ?></option>
					<?php
					}
				  ?>
                </select>
              </div>
            </div>
            
            
            <div id="colorsize">
            	<?php
            	 $cat_id =  $product[0]->category_id;
	   	         $menu_id = $product[0]->menu_id;
				 
					 $arr = explode(',',$product[0]->product_color);
					 $sql = "select * from colour where menu_id='$menu_id' and category_id='$cat_id'";
	   	             $color = $this->db_model->getAlldata($sql);
				  if(!empty($color))
				 {
					 echo '<div class="form-group">
						  <label class="col-sm-3 col-md-2 control-label">Choose Color</label>
						  <div class="col-sm-8">
							<ul class="list-inline">';
							foreach($color as $c)
							{
								?>
								<li><label><input style="float:left;" type="checkbox" name="product_color[]" value="<?php echo $c->colour_id; ?>" <?php if(in_array($c->colour_id,$arr)) echo 'checked'; ?> /> <p style=" margin-top:6px;margin-left:5px;float:left;height:15px; width:25px;background:<?php echo $c->colour_code ?>"></p></label></li>
                               
							<?php }
							echo ' </ul>
						  </div>
						</div>';
						 }
				 else
				 {
					 echo '<input type="hidden" name="product_color[]" value="" />';
				 }
				 
				 
					  $arr2 = explode(',',$product[0]->product_size);
					  $sql2 = "select * from size where menu_id='$menu_id' and category_id='$cat_id'";
	                  $size = $this->db_model->getAlldata($sql2);
				 if(!empty($size))
				 {
					  echo '<div class="form-group">
							  <label class="col-sm-3 col-md-2 control-label">Choose Size</label>
							  <div class="col-sm-8">
								<ul class="list-inline color-list">';
								foreach($size as $s)
								{
									?>
									<li><input type="checkbox" name="product_size[]" value="<?php echo $s->size_id; ?>" <?php if(in_array($s->size_id,$arr2)) echo 'checked'; ?> />&nbsp;<?php echo $s->size_name; ?></li>
								<?php  }
								echo '</ul>
						  </div>
						</div>';
				 }
				 else
				 {
					 echo '<input type="hidden" name="product_size[]" value="" />';
				 }
				 
            	 ?>
            </div>
            
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Expected Payout</label>
              <div class="col-sm-8">
                <input type="text" name="exp_pay" value="<?php echo $product[0]->exp_pay; ?>" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">M.R.P. (Rs.)</label>
              <div class="col-sm-8">
                <input type="number" name="mrp" value="<?php echo $product[0]->mrp; ?>" class="form-control" required />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Retail Price (Rs.)</label>
              <div class="col-sm-8">
                <input type="number" name="retail" value="<?php echo $product[0]->retail_price; ?>" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Select Offer</label>
                  <div class="col-sm-8">
                    <select name="offer" class="form-control">
                      <option>Select Offer</option>
                      <?php
					  foreach($of as $offer)
					  {
					  ?>
                      <option value="<?php echo $offer->offer_id; ?>" <?php if($offer->offer_id == $product[0]->offer_id) echo 'selected'; ?>><?php echo $offer->offer_name; ?></option>
                      <?php
					  }
					  ?>                      
                    </select>
                  </div>
                </div>
            
            <?php /*?><div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Short Description</label>
              <div class="col-sm-8">
                <textarea type="text" rows="5" name="short_desc" class="form-control" ><?php echo $product[0]->short_desc; ?></textarea>
              </div>
            </div><?php */?>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Full Description</label>
              <div class="col-sm-8">
                <textarea name="product_details" id="content" required><?php echo $product[0]->description; ?></textarea>
	            <?php echo display_ckeditor($ckeditor); ?>
              </div>
            </div>
            
                        
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Stock</label>
              <div class="col-sm-8">
                <input type="text" name="stock"  value="<?php echo $product[0]->stock; ?>" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Quantity (MIN)</label>
              <div class="col-sm-8">
                <input type="text" name="minqty"  value="<?php echo $product[0]->minqty; ?>" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Quantity (MAX)</label>
              <div class="col-sm-8">
                <input type="text" name="maxqty" value="<?php echo $product[0]->maxqty; ?>" class="form-control" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Weight Of Product</label>
              <div class="col-sm-8">
                <input type="text" name="weight" value="<?php echo $product[0]->weight; ?>" class="form-control" />
              </div>
            </div>
                
            <div class="form-group">
              <label class="col-sm-3 col-md-2 control-label">Status</label>
              <div class="col-sm-8">
                <select class="form-control" name="status" required="required">
                  <option value="1" <?php if($product[0]->p_status == '1') echo 'selected'; ?>>Active</option>
                  <option value="0" <?php if($product[0]->p_status == '0') echo 'selected'; ?>>Deactivate</option>
                </select>
              </div>
            </div>
            
            
           <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Featured Image</label>                  
                  <div class="col-sm-8">
                      <div style="border:1px solid #ccc;">
                      <div style="padding:15px;">
                        <input type="file" name="userfile" class="form-control-file" />  
                        <br/>                      
                        <span class=""><img src="<?php echo base_url().'includes/uploads/product_image/'.$product[0]->featured_image; ?>" class="img-thumbnail" width="100" height="150" /></span>
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
                        <input type="file" name="uploadfile[]" multiple class="form-control" />                        <br/>
                        <?php
            						$pid = $product[0]->product_id;
            						$sql1 = "select * from om_product_gallery where product_id='$pid'";
            						$gi = $this->db_model->getAlldata($sql1);
            						foreach($gi as $gallery)
            						{
            						?>
                        <img src="<?php echo base_url().'includes/uploads/product_gallery/'.$gallery->product_gallery_path; ?>" class="img-thumbnail" width="100" height="150" />
                        <a href="<?php echo base_url().'seller/delete-product-image/'.$gallery->product_gallery_id.'/'.$this->uri->segment(3); ?>" alt="Click to delete image" title="click here to delete image"><i class="fa fa-trash fa-2x text-danger"></i></a>                        
                        <?php
            						}
            						?>
                      </div>  
                    </div>                
              </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 col-md-2 control-label">Select Type</label>
                <div class="col-sm-8">
                  <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox1" name="type" <?php if($product[0]->product_sale_type == '1') echo 'checked'; ?> value="1" >
                    Retailer </label>
                  <label class="checkbox-inline" data-toggle="collapse" data-target="#wholesale">
                    <input type="radio" id="inlineCheckbox2" <?php if($product[0]->product_sale_type == '2') echo 'checked'; ?> name="type" value="2">
                    Wholesale </label>
                    <label class="checkbox-inline" data-toggle="collapse" data-target="#wholesale">
                    <input type="radio" id="inlineCheckbox2" <?php if($product[0]->product_sale_type == '3') echo 'checked'; ?> name="type" value="3">
                    Both </label>
                </div>
              </div>
              
              <div id="wholesale" class="collapse" role="tabpanel">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Minimum Quantity for wholesale</label>
                  <div class="col-sm-8">
                    <input type="text" value="<?php echo $product[0]->ws_quantity;?>" name="wminqty" class="form-control" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">wholesale Price</label>
                  <div class="col-sm-8">
                    <input type="text" name="wprice"  value="<?php echo $product[0]->ws_price;?>" class="form-control" />
                  </div>
                </div>
              </div>
                   
            </div>
            
            
            <div class="tab-pane fade" id="metaDescription">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Meta Title</label>
                  <div class="col-sm-7">
                    <input type="text" value="<?php echo $product[0]->meta_title;?>" name="meta_title" class="form-control" placeholder="Meta Title" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Meta Keywords</label>
                  <div class="col-sm-7">
                    <input type="text" name="meta_key"  value="<?php echo $product[0]->meta_key;?>" class="form-control" placeholder="Meta Keywords" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Description</label>
                  <div class="col-sm-7">
                    <textarea class="form-control" name="meta_des"  rows="5" placeholder="Meta Description"> <?php echo $product[0]->meta_des;?></textarea>
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
                    ?>
                    <option value="<?php echo $brand->brand_id;?>" <?php if($brand->brand_id == $product[0]->brand_id) echo 'selected'; ?> ><?php echo $brand->brand_name;?></option>
                    <?php
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
						?>
                        
                  <option value="<?php echo $rp->rg_id; ?>" <?php if($rp->rg_id == $product[0]->rg_id ) echo 'selected'; ?>><?php echo $rp->rg_name; ?></option>
                  <?php   }
                    ?>
                    </select>
                  </div>
                </div>
                
                
                
                <div class="form-group">
                  
                   <label class="col-sm-3 col-md-2 control-label">Select Attribute</label>
                   <?php 
					$arr = explode(',',$product[0]->attr_group_id);
					foreach($atr as $a) { 
					$sql2 = "SELECT * FROM `attribute` where attribute_group_id='$a->attribute_group_id'";
					$ar = $this->db_model->getAlldata($sql2);
                    echo'<div class="col-sm-2"><div class="button-group">
                   <button type="button" class="btn btn-default btn-sm dropdown-toggle" class="form-control" data-toggle="dropdown">'.$a->attribute_group_name.'<span class="caret"></span></button>
                    <ul class="dropdown-menu" id="atrr_id">';
                         foreach($ar as $attr)
						 {
					?>
                    <li><a href="javascript:void(0)" class="small" data-value="option<?php echo $attr->attribute_id; ?>" tabIndex="-1"><input type="checkbox" name="attr_group_id[]" value="<?php echo $attr->attribute_id; ?>" <?php if(in_array($attr->attribute_id,$arr)) echo "checked"; ?>/>&nbsp;<?php echo $attr->attribute_name; ?></a></li>';
                    <?php
						 }
						echo '</ul></div></div>';
					   } 
				   ?>
                      
                  
               </div> 
                
                
            </div>
            <!--Shipping tab-->
            <div class="tab-pane fade" id="shipping">
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">Estimated Delivery</label>
                  <div class="col-sm-7">
                    <select name="delv_day" class="form-control">
                      <option <?php if($product[0]->delv_day == '2-3 days') echo 'selected'; ?>>2-3 days</option>
                      <option <?php if($product[0]->delv_day == '3-5 days') echo 'selected'; ?>>3-5 days</option>
                      <option <?php if($product[0]->delv_day == '5-7 days') echo 'selected'; ?>>5-7 days</option>
                    </select>
                  </div>
                </div>
                
                <input type="hidden" name="id" value="<?php echo $product[0]->product_id; ?>" />
                <input type="hidden" name="path" value="<?php echo $product[0]->featured_image; ?>" />
                
                <div class="form-group">
                  <label class="col-sm-3 col-md-2 control-label">COD Allowed</label>
                  <div class="col-sm-8">
                    <label class="checkbox-inline">
                      <input type="radio" name="cod" value="1" <?php if($product[0]->cod == '1') echo 'checked'; ?>>
                      Yes </label>
                    <label class="checkbox-inline" data-toggle="collapse" data-target="#wholesaleOrBoth">
                      <input type="radio" name="cod" value="0" <?php if($product[0]->cod == '0') echo 'checked'; ?> >
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