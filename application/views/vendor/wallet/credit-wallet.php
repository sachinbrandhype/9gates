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
    <title>Add Wallet</title>
    <!-- Google font-->
    <?php $this->load->view('admin/css.php');?>
    <style>
        .btnadd
        {
            float: right;
            margin-top: -56px;
            margin-right: 171px;
        }

    </style>
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
                                <form class="needs-validation" action="<?=site_url()?>admin/wallet/save" method="post" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <input class="form-control" type="hidden" name="type" value="Direct">
                                        <input class="form-control" type="hidden" name="data_type" value="credit">

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">User name</label>
                                            <select class="form-control" type="text" name="username" required="">
                                            <option>Select User</option>
                                                <?php if(!empty($user)){
                                                    foreach($user as $u){?>
                                                <option value="<?=$u->name.'__'.$u->id?>"><?=$u->name?></option>

                                                <?php }} ?>
                                            </select>
                                            <div class="valid-feedback">User name!</div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="validationCustom01">Amount</label>
                                            <input class="form-control" type="text" name="balance" required="">
                                            <div class="valid-feedback">Amount!</div>
                                        </div>

                                    </div>

                                    <div class="cliearfix"></div>
                                    <br>
                                    <button class="btn btn-primary btnadd" type="submit">Submit</button>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row">

                    <div class="col-sm-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="focus-cell">
                                        <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <th>TXN Type</th>
                                            <th>TXN Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($credit)){
                                            $count=1;
                                            foreach($credit as $s){?>
                                                <tr>
                                                    <td><?=$count?></td>
                                                    <td><?=$s->userid?></td>
                                                    <td><?=$s->username?></td>
                                                    <td><?=$s->credit_balance?></td>
                                                    <td><?=$s->credit_balance?></td>
                                                    <td><?=$s->type?></td>
                                                    <td><?= htmlentities($s->createdate)?></td>

                                                </tr>
                                                <?php $count++;}}?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>User ID</th>
                                            <th>Username</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                            <th>TXN Type</th>
                                            <th>TXN Date</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
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


    $(document).ready(function(){
        $('#category').change(function(){
            var category = $('#category').val();
            if(category != '')
            {
                $.ajax({
                    url:"<?php echo site_url('admin/childcategory/subcategoryBycategory'); ?>",
                    method:"POST",
                    data:{category:category},
                    success:function(data)
                    {
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



</script>
<!-- Plugin used-->
</body>

<!-- Mirrored from admin.pixelstrap.com/viho/theme/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Sep 2021 18:54:16 GMT -->
</html>