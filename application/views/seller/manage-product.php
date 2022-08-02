<?php $this->load->view('seller/header'); ?>
<!--page wrapper start-->
<div class="container" style="min-height:500px;">
  <!--page title start-->
  <div class="row">
    <div class="col-md-12">
      <div class="page-head-line">Manage Product
        <p class="pageNav"><a href="#">Home</a><span class="separator"></span><strong>Manage Product</strong></p>
        
      </div>
    </div>
  </div>
  <!--page title end-->
  <!--page content start-->
  <div class="row">
    <form action="#" id="target">
    <div class="col-sm-4">
    <label>Product Name</label>
    <input type="text" id="tags" class="form-control" value="" placeholder="Product Name or Model No."/>
    <input type="hidden" value="" id="product_id" name="product_id" />
    </div>
    <div class="col-sm-4">
    <label>Status</label>
    <select class="form-control" id="status" required>
    <option value="">Select Status</option>
    <option value="1">Active</option>
    <option value="0">Inactive</option>
    </select>
    </div>
    
    <div class="col-sm-4" style="margin-top:35px;">
    
    <button type="button" class="btn btn-primary" id="m_product"><span class="glyphicon glyphicon-search"></span> &nbsp;Filter</button>
    </div>
    
    </form>
    </div>
    
    </br>
    
    
 <div id="result">
  <div class="row">
    <div class="col-sm-12">
    
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>SKU(Model No.)</th>
              <th>Quantity</th>
              <th>MRP ( <i class="fa fa-inr"></i> )</th>
              <th>Selling Price ( <i class="fa fa-inr"></i> )</th>
              <th>Status</th>
              <th width="12%">Action</th>
            </tr>
          </thead>
          <tbody>
           <?php if(!empty($pro)) { 
                  foreach($pro as $p) { ?>
            <tr>
              <td><img src="<?php echo base_url().'includes/uploads/product_image/'.$p->featured_image;?>" width="75" height="75" alt="" /></td>
              <td><?php echo $p->product_name; ?></td>
              <td><?php echo $p->model; ?></td>
              <td><?php echo $p->stock; ?></td>
              <td><?php if($p->mrp != 0){echo '<i class="fa fa-inr"></i> '.$p->mrp.' /-'; }else{echo '-';} ?></td>
              <td><?php if($p->retail_price != 0){echo '<i class="fa fa-inr"></i> '.$p->retail_price.' /-';}else{echo '-';} ?></td>
              
              <!--<td><?php // if($p->p_status == 1) {echo '<label class="label label-success">Active</label>';}else { echo '<label class="label label-danger">Inactive</label>';} ?></td>-->
              
              
              
<?php 
	if($p->p_status == '1')
	{
	?>                                              
	<td align="center"><a href="<?php echo base_url();?>seller/manage-product/<?php echo $p->product_id; ?>" class="label label-success">Active</a></td>												
    <?php
	}
	else
	{
	?>
    <td align="center"><a href="<?php echo base_url();?>seller/manage-product/<?php echo $p->product_id; ?>" class="label label-danger">Inactive</a></td>													
    <?php
	}
	?>
              
              
              
              
              
              
              
              
              <td><!--<a href="#myModal" id="openBtn" data-toggle="modal" class="btn btn-xs btn-info"><i class="fa fa-eye fa-2x"></i></a> --><a href="<?php echo base_url().'seller/update-product/'.$p->product_id; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit fa-2x"></i></a> <a onClick="return confirm('Are you sure?')" href="<?php echo base_url().'seller/delete-product/'.$p->product_id; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash fa-2x"></i></a></td>
            </tr>
            
            <!-- /.modal -->
            
            <!-- /.modal -->
            <?php 
      }       
      }
      else
      { ?>
            <tr><td colspan="5">Please Add Product.</td></tr>
            <?php } ?>
            
            
          </tbody>
        </table>
      </div>
      
      <?php echo $links; ?>
      
    </div>
  </div>
  </div>
  <!--page content end-->
</div>
<!--page wrapper end-->
<?php $this->load->view('seller/footer'); ?>