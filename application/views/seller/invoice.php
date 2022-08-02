<?php $this->load->view('seller/header'); ?>
  <!--page wrapper start-->
  <div class="container" style="min-height:500px;">
    <!--page title start-->
    <div class="row">
      <div class="col-md-12">
        <div class="page-head-line">View Invoice<p class="pageNav"><a href="<?php echo base_url('seller'); ?>">Home</a><span class="separator"></span><strong>View Invoice</strong></p>
      </div>
      </div>
    </div>
    <!--page title end-->
    
    <!--page content start-->
    <?php echo $this->session->flashdata('msg'); ?>
    <div class="row">
    <div class="col-sm-12">
      
      <div id="dvContainer">
                                    <div class="row ">
                                        <div class="col-lg-12 col-md-12 col-sm-12" align="center">
                                            <h3>RETAIL INVOICE</h3>
                                        </div>
                                    </div> 
                                    <br />
                                    
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6" style="float:left;">
                                            <h4><strong>Invoice No :<?php echo ' # '.$od[0]->order_item_id;?></strong></h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6" style="float:right;" align="right">
                                            <h4><strong>Invoice Date : <?php echo DATE('d M Y',strtotime($od[0]->order_item_added_date));?></strong></h4>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div> 
                                    <hr/>
                                    <br/>
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6" style="float:left;">
                                            <h4><strong>Seller :</strong></h4>
                                            <h6 style="margin:4px 0 0 0;"><strong><?php echo $od[0]->seller_name; ?></strong></h6>
                                            
                                            <h6 style="margin:4px 0 0 0;"><?php echo $cit; ?></h6>
                                            <h6 style="margin:4px 0 0 0;"><strong>Email: </strong><?php echo $od[0]->seller_email; ?></h6>
                                            <h6 style="margin:4px 0 0 0;"><strong>Call: </strong><?php echo $od[0]->seller_phone; ?></h6>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6" align="right" style="float:right;">
                                            <h4><strong>Buyer :</strong></h4>
                                            <h6 style="margin:4px 0 0 0;"><strong><?php echo $cus[0]->cus_name; ?></strong></h6>
                                            <h6 style="margin:4px 0 0 0;"><strong>Invoice No: </strong><?php echo ' # '.$od[0]->order_item_id;?></h6>
                                            <h6 style="margin:4px 0 0 0;"><strong>Purchased On: </strong> <?php echo DATE('d M Y',strtotime($od[0]->order_item_added_date));?></h6>
                                            <h6 style="margin:4px 0 0 0;"><strong>Amount Paid : </strong>
                                            <?php
											$t_price = 0;
                                            foreach($od as $j)
                                            { 
												$ty = $j->total_product_price;
                                                $t_price +=$ty;
                                                echo 'Rs. '.$t_price;                                        
											}
											?>
                                            </h6>
                                            
                                            <h6 style="margin:4px 0 0 0;"><strong>Address: </strong> 
											<?php 
											if(empty($s)) 
											{
												if($b[0]->bill_address != ''){ echo $b[0]->bill_address;} else { echo '-';}
											}
											else
											{
												if($s[0]->ship_address != ''){ echo $s[0]->ship_address;} else { echo '-';}
											}
											?>
                                            <h6 style="margin:4px 0 0 0;"><strong>City: </strong> 
											<?php 
											if(empty($s)) 
											{
												if($b[0]->bill_city != 0){ echo $b[0]->city_name;} else { echo '-';}
											}
											else
											{
												if($s[0]->ship_city != 0){ echo $s[0]->city_name;} else { echo '-';}
											}
											?>
                                            </h6>
                                            <h6 style="margin:4px 0 0 0;"><strong>Pincode: </strong> 
											<?php 
											if(empty($s)) 
											{
												if($b[0]->bill_pincode != 0){ echo $b[0]->bill_pincode;} else { echo '-';}
											}
											else
											{
												if($s[0]->ship_pincode != 0){ echo $s[0]->bill_pincode;} else { echo '-';}
											}
											?>
                                            </h6>
                                            
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                    
                                    <br><br><br>
                                    <div class="row" style="height:auto;">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table cellpadding="0" cellspacing="0" class="table table-bordered" style="width:100%;border:1px solid #ddd;">
                                                    <thead>
                                                        <tr>
                                                            <th style="border:1px solid #ddd;border-top:none;border-right:none;border-left:none;padding:4px;">Sl. No.</th>
                                                            <th style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;">Perticulars</th>
                                                            <th style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;">Quantity.</th>
                                                            <th style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;">Unit Price</th>
                                                            <th style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $sl = 1;
                                                    $subtotal = $oc[0]->total_order_price;
													$ship_charge = $oc[0]->total_ship_charge + ($oc[0]->minus_ship_charge);
													$ad_ship_charge = $oc[0]->additional_ship_charge;
                                                    foreach($od as $j)
                                                    {
                                                    ?>
                                                        <tr>
                                                            <td style="border:1px solid #ddd;border-top:none;border-right:none;border-left:none;padding:4px;"><?php echo $sl; ?></td>
                                                            <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo $j->product_name; ?></td>
                                                            <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo $j->product_qty; ?></td>
                                                            <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo 'Rs. '.$j->product_price; ?></td>
                                                            <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo 'Rs. '.$j->total_product_price; ?></td>
                                                        </tr>
                                                    <?php
                                                    $sl++;
                                                    }
                                                    ?> 
                                                    <tr>
                                                        <td colspan="4" align="right" style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><strong>Sub Total</strong></td>
                                                       
                                                        <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo 'Rs. '.$subtotal; ?></td>
                                                    </tr> 
                                                    
                                                     <tr>
                                                        <td colspan="4" align="right" style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><storng>Total Shipping Charge:</storng></td>
                                                       
                                                        <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php if($ship_charge != 0){echo 'Rs '.$ship_charge;}else{echo 'FREE';} ?></td>
                                                    </tr> 
                                                    
                                                    <?php if($ad_ship_charge != 0) { ?>
                                                    <tr>
                                                        <td colspan="4" align="right" style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><storng>Additional Shipping Charge :</storng></td>
                                                       
                                                        <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo 'Rs '.$ad_ship_charge; ?></td>
                                                    </tr> 
                                                    <?php } ?>
                                                 <?php $grand_total = $subtotal + $ship_charge + $ad_ship_charge; ?>   
                                                    <tr>
                                                        <td colspan="4" align="right" style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><storng>Grand Total:</storng></td>
                                                       
                                                        <td style="border:1px solid #ddd;border-top:none;border-right:none;padding:4px;"><?php echo 'Rs. '.$grand_total; ?></td>
                                                    </tr> 
                                                    
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                            <br>
                                <strong>IMPORTANT INSTRUCTIONS :
                                </strong>
                                <h5 style="margin:4px 0 0 0;"># This is an electronic receipt so doesn't require any signature.</h5>
                                <h5 style="margin:4px 0 0 0;"># You can contact us between 10:am to 6:00 pm on all working days.</h5>
                            </div>
                        </div>
                        </div>
                        
                        <div class="row pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12">
            				<button class="btn btn-flat btn-success" onClick="PrintDiv();">Print Invoice</button> 
                            </div>  
                        </div>
   
      
    </div>
  </div>
 <!--page content end-->
 
  </div>
  <!--page wrapper end-->
  <?php $this->load->view('seller/footer'); ?>
  <script type="text/javascript">     
        function PrintDiv() {    
           var dvContainer = document.getElementById('dvContainer');
           var popupWin = window.open('', '_blank', 'width=900,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + dvContainer.innerHTML + '</html>');
           popupWin.document.close();
        }
        </script>