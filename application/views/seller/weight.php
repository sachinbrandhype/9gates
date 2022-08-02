<?php include'header.php'; ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <h1 class="page-head-line">Shipping Charge By Weight</h1>
      </div>
    </div>
    <!--page title end-->
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
      <div class="col-sm-12">
      <a href=""></a>
        <br/>
      <form action="<?php echo base_url();?>seller/import_weight_excel" method="post" enctype="multipart/form-data" class="form-inline">
          <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Amount(in Rupees)</label>
            <div class="input-group">
              <div class="input-group-addon">Upload WEIGHT with delivery charges.</div>
              <input type="file" name="userfile" class="form-control" id="exampleInputAmount" placeholder="Amount" required>              
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Import</button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="<?php echo base_url('seller/export-weight');?>">Export</a>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-info" href="<?php echo base_url();?>includes/weight.xlsx" download>Download Exel Format</a>
        </form>
        <br/>
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-cart-arrow-down"></i> Delivery Charge Depend On Weight..</h3>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                
                <th>Weight From(in grms)</th>
                <th>Weight To(in grms)</th>
                <th>Delivery Chrage</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
            <?php
			if($p)
			{
			foreach($p as $pin)
			{
			?>
              <tr>
                
                <td><?php echo $pin->weight_from.'g'; ?></td>
                <td><?php echo $pin->weight_to.'g'; ?></td>
                <td><i class="fa fa-inr"></i> <?php echo $pin->delv_charge; ?>/-</td>
                <td><a onClick="update_weight(<?php echo $pin->weight_id; ?>)" title="Edit" alt="Edit"><i class="fa fa-pencil-square-o"></i></a>
                </td>
                <td><a onClick="return confirm('Are you sure?')" href="<?php echo base_url();?>seller/delete-weight/<?php echo $pin->weight_id; ?>" title="delete" alt="Delete"><i class="fa fa-trash"></i></a></td>
              </tr>
            <?php
			}
			}else{
			?>	
			  <tr>
			  	<td colspan="7">No data found..</td>
			  </tr>	
            <?php  
			}
			?>  
            </tbody>
          </table>
        </div>
      </div>
      
      <?php echo $links; ?>
    </div>
    </div>
    <!--page content end-->
    
    </div>
  <!--page wrapper end-->
  
  
  
  
  
  
  <!--exp-->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">&nbsp;&nbsp;Update Weight Charges</h4>
        </div>
        <form action="<?php echo base_url();?>seller/update-weight-charges" method="post" enctype="multipart/form-data">
        <div class="modal-body" id="modalbody">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" value="Update Shipping Charges" class="btn btn-primary btn-flat pull-left">&nbsp;Update weight Charges</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
  

  
  <?php include'footer.php'; ?>