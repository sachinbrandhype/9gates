<?php $this->load->view("hvwheader"); ?>

<!-- banner -->

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12" style="padding: 0px;">

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->

                <ol class="carousel-indicators">

                    <?php if(!empty($banner)){

                        $count=0;

                        foreach($banner as $b){?>

                            <li data-target="#myCarousel" data-slide-to="<?=$count?>" class="<?php if($count=='0'){?>active<?php } ?>"></li>

                            <?php $count++;}} ?>

                </ol>

                <!-- Wrapper for slides -->

                <div class="carousel-inner">

                    <?php if(!empty($banner)){

                        $count=1;

                        foreach($banner as $b){?>

                            <div class="item <?php if($count=='1'){?>active<?php } ?>"><img src="<?=base_url('uploads/'.$b->image)?>" alt="Nykaa" style="width:100%;"></div>

                            <?php $count++;}} ?>

                </div>

                <!-- Left and right controls -->

                <a class="left carousel-control" href="#myCarousel" data-slide="prev">

                    <span class="glyphicon glyphicon-chevron-left"></span>

                    <span class="sr-only">Previous</span>

                </a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next">

                    <span class="glyphicon glyphicon-chevron-right"></span>

                    <span class="sr-only">Next</span>

                </a>

            </div>

        </div>

    </div>

</div>


    <div class="container-fluid s1-wp">

        <div class="container">

            <div class="hdng-s">

                <h2>Shop By Category </h2>

            </div>

            <div class="row">



                <?php if(!empty($botcat)){

                    foreach($botcat as $p){?>

                        <div class="col-md-6">

                            <div class="sptbx">

                                <a href="<?=base_url().$m->url.'/'.$p->url?>-cat.html">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive">

                                    <div class="spt-txs">

                                        <h3><?=$p->category?></h3>

                                        <p>Free Facewash On 800 </p>

                                    </div>

                                </a>

                            </div>

                        </div>

                    <?php }} ?>





            </div>

        </div>

    </div>
    
    
    
    
    <div class="container-fluid s1-wp">

        <div class="container">

            <div class="hdng-s">

                <h2>Shop By Brands </h2>

            </div>

            <div class="row">

                <?php if(!empty($position2)){

                    foreach($position2 as $p){?>

                        <div class="col-md-6">





                            <div class="sptbx">

                                <a href="#">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive">

                                    <div class="spt-txs">

                                        <h3>Upto 20% OFF </h3>

                                    </div>

                                </a>

                            </div>



                        </div>

                    <?php }} ?>

            </div>

        </div>

    </div>



    <div class="container-fluid s1-wp">

        <div class="container">

            <div class="hdng-s">

                <h2>Offers For You </h2>

            </div>

            <div class="row slider2">

                <?php if(!empty($position12)){

                    foreach($position12 as $p){?>

                        <div class="col-md-12">

                            <a href="#">

                                <div class="trnds">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive" >

                                </div>
                                
                                <div class="ftr-bts">

                                        <h3>Upto 15% OFF + Free Moisturizer </h3>

                                        <p>Worth Rs.99 On Rs.399</p>

                                    </div>

                            </a>

                        </div>

                    <?php }} ?>

            </div>

        </div>

    </div>





    <div class="container-fluid s1-wp">

        <div class="container">

            <div class="hdng-s">

                <h2>Featured Products </h2>

            </div>


            <div class="row">

                <?php if(!empty($pro)){

                    foreach($pro as $p){?>

                        <div class="col-md-3 f1q">

                            <a href="<?=base_url()?>home/productdetail/<?=$p->product_url?>">

                                <div class="ftr-brnd">

                                    <img src="<?=base_url('uploads/'.$p->fimage)?>" alt="" class="img-responsive">

                                    <div class="ftr-bts">

                                        <h3><?=$p->product?> </h3>

                                        <p>$<?=$p->mrp?></p>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <?php }} ?>



            </div>



        </div>

    </div>


    <div class="container-fluid s1-wp" style="display:none">

        <div class="container">

            <div class="hdng-s">

                <h2>Offers For You </h2>

            </div>

            <div class="row">

                <?php if(!empty($position12)){

                    foreach($position12 as $p){?>

                        <div class="col-md-3 mre-ofr">

                            <a href="#">

                                <div class="mre-brnd">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive">

                                    <div class="ftr-bts">

                                        <h3>Upto 15% OFF + Free Moisturizer </h3>

                                        <p>Worth Rs.99 On Rs.399</p>

                                    </div>

                                </div>

                            </a>

                        </div>



                    <?php }} ?>



            </div>

        </div>

    </div>

    <div class="container-fluid s1-wp" style="display: none">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <a href="#"><img src="<?=base_url('uploads/'.$position17->image)?>" alt="" class="img-responsive" style="width: 100%"> </a>

                </div>

            </div>

        </div>

    </div>

    <div class="container-fluid s1-wp" style="display: none">

        <div class="container">

            <div class="hdng-s">

                <h2>Pop-up Stores </h2>

            </div>

            <div class="row">

                <?php if(!empty($position15)){

                    foreach($position15 as $p){?>

                        <div class="col-md-6">

                            <a href="#">

                                <div class="hdn-bxs">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive">

                                </div>

                            </a>

                        </div>

                    <?php }} ?>



            </div>

        </div>

    </div>

    <!--<div class="container-fluid s1-wp">

        <div class="container">

            <div class="hdng-s">

                <h2>Beauty Advice </h2>

            </div>

            <div class="row">

                <?php if(!empty($position13)){

                    foreach($position13 as $p){?>

                        <div class="col-md-6">

                            <a href="#">

                                <div class="hdn-bxs">

                                    <img src="<?=base_url('uploads/'.$p->image)?>" alt="" class="img-responsive">

                                </div>

                            </a>

                        </div>

                    <?php }} ?>



            </div>

            <div class="row btyqp" style="display: none">

                <div class="col-md-6 col-md-offset-3">

                    <a href="#">

                        <div class="hdn-bxs">

                            <img src="<?=base_url('uploads/'.$position16->image)?>" alt="" class="img-responsive" style="width: 100%">

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>-->

<?php $this->load->view("footer"); ?>