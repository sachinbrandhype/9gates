<?php $this->load->view("hvwheader.php"); ?>



<div class="container-fluid s1-wp">

        <div class="container">

            <div class="hdng-s">

                <h2>Discount Products </h2>

            </div>

            <div class="row">

                <?php if(!empty($voucher1)){

                    foreach($voucher1 as $p){?>

                        <div class="col-md-3 f1q">

                            <a href="<?=$p->link?>">

                                <div class="ftr-brnd">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive">

                                    <div class="ftr-bts">

                                        <h3><?=$p->name?> </h3>

                                        <p>$<?=$p->discount?></p>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <?php }} ?>



            </div>



        </div>

    </div>

<?php $this->load->view("footer.php"); ?>

