<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<title>9Gates</title>
<link href="<?php echo base_url(); ?>sellercss/assets/css/bootstrap.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>sellercss/assets/css/custom.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>sellercss/assets/css/font-awesome.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>sellercss/assets/css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>sellercss/assets/css/datepicker.min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>sellercss/assets/css/datepicker3.min.css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!--header wrapper start-->
<div class="navbar navbar-inverse set-radius-zero">
  <div class="container">
  
    <div class="navbar-header">
    
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>public/img/logo1.png"  style="width:80px;"/> </a></div>
     
    <div class="navbar-form navbar-right">
    
    <?php if($this->session->userdata('sellerLogin')) { ?>
        <div class="welcomeText">
        <p>Merchant : <span><?php echo $this->session->userdata('seller_business'); ?></span></p>
        <p>Merchant ID : <span><?php echo $this->session->userdata('seller_id'); ?></span></p>
        <p><a href="<?php echo base_url(); ?>seller/logout"><i class="fa fa-sign-out"></i> Sign out</a></p>
        <div class="clearfix"></div>
        
        
        </div>
     
    <?php } else { ?>
         
        <form action="<?php echo base_url('seller/login');?>" method="post">
          <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email Id" required>
          </div>
          <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-default">Login</button>
        </form>
        <p align="right"><?php echo $this->session->flashdata('msg2');?><a href="#" data-toggle="modal" data-target="#myModal">Forgotten your password?</a></p>
     <?php } ?>
     
     
     
    </div>
  </div>
</div>
<section class="menu-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="navbar-collapse collapse ">
          <ul id="menu-top" class="nav navbar-nav navbar-left">
          
           
          
           <?php  if($this->session->userdata('seller_status') == 1 && $this->session->userdata('sellerLogin')) { 
			?>
            <li><a class="menu-top-active" href="<?php echo base_url('seller'); ?>">Dashboard</a></li>
            <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catalog <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('seller/manage-product'); ?>">Manage Products</a></li>
            <li><a href="<?php echo base_url('seller/add-product'); ?>">Add Products</a></li>
            </ul>
            </li>
            <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Order <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('seller/view-orders'); ?>">View Orders</a></li>
            <li><a href="<?php echo base_url('seller/ready-shipment'); ?>">Ready Shipment</a></li>
            <li><a href="<?php echo base_url('seller/returns'); ?>">Returns</a></li>
            </ul>
            </li>
            <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('seller/total-orders'); ?>">Total Orders</a></li>
            <li><a href="<?php echo base_url('seller/top-selling'); ?>">Top Selling</a></li>
            <li><a href="<?php echo base_url('seller/transaction'); ?>">Transaction</a></li>
            </ul>
            </li>
            
            <?php if($this->session->userdata('shipping_from') == 'own'){?>
            <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shipping <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url('seller/pincode');?>">Shipping Chrage by Pincode</a></li>
                <li><a href="<?php echo base_url('seller/weight');?>">Shipping Chrage by Weight</a></li>
                <li><a href="<?php echo base_url('seller/shipping-charge-by-order');?>">Shipping Charge By Order</a></li>
            </ul>
            </li>
            <?php } ?>
            
            
            <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo base_url('seller/personal-details'); ?>">Business Information</a></li>
            <!--<li><a href="#">Billing Details</a></li>-->
            <li><a href="<?php echo base_url('seller/bank-details'); ?>">Bank Details</a></li>
            <li><a href="<?php echo base_url('seller/commission'); ?>">Commission</a></li>
            <li><a href="<?php echo base_url('seller/change-password'); ?>">Change Password</a></li>
            <?php } ?>
            </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!--header wrapper end-->
