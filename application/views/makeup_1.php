<?php $this->load->view("header"); ?>



<div class="container-fluid sngle-wp">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar lft-mnus">
                    <h2>Category</h2>
                    <div class="panel-group category-products " id="accordian">


                        <?php if(!empty($cat)){
                            foreach($cat as $c){?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#beauty">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                <?=$c->category?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="beauty" class="panel-collapse collapse">
                                        <div class="panel-body drp-uls">
                                            <ul>
                                                <?php
                                                $subcat = $this->homemodel->getSubcategoryById($c->id);
                                                if(!empty($subcat)){
                                                    foreach($subcat as $s){?>
                                                        <li><a href="#"><?=$s->subcategory?></a></li>
                                                    <?php }} ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php }} ?>





                    </div>
                    <div class="brands_products">
                        <h2>More To Explore</h2>
                        <div class="brands-name sks-brnds">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href=""> <span class="pull-right">(50)</span>Makeup</a></li>
                                <li><a href=""> <span class="pull-right">(56)</span>Skin</a></li>
                                <li><a href=""> <span class="pull-right">(27)</span>Hair</a></li>
                                <li><a href=""> <span class="pull-right">(32)</span>Appliances</a></li>
                                <li><a href=""> <span class="pull-right">(25)</span>Personal Care</a></li>
                                <li><a href=""> <span class="pull-right">(59)</span>Natural</a></li>
                                <li><a href=""> <span class="pull-right">(47)</span>Mom & Baby</a></li>
                                <li><a href=""> <span class="pull-right">(27)</span>Health & Wellness</a></li>
                                <li><a href=""> <span class="pull-right">(32)</span>Men</a></li>
                                <li><a href=""> <span class="pull-right">(55)</span>Fragrances</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="price-range">
                        <h2>Price Range</h2>
                        <div class="well">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                            <b>$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <div class="shipping text-center">
                        <img src="<?=base_url()?>public/img/cost-prdut/sale.jpg" alt="" class="img-responsive" />
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row grid skctrgy">
                    
                    <?php  $url = $this->uri->segment(2);
                    $catid = $this->homemodel->getCategoryIdByUrl($url);
                    $product =$this->homemodel->getProductByurl($catid->id);
                    if(!empty($product)){
                        foreach($product as $p){?>
                        <a href="<?=base_url()?>home/productdetail/<?=$p->product_url?>">
                            <div class="col-md-4 itm1">
                                <div class="catgry-bxs">
                                    <figure class="effect-hera">
                                        <img src="<?=base_url('uploads/'.$p->fimage)?>" alt="img17" class="img-responsive" />
                                        <figcaption>
                                            <p>
                                                <a href="javascript:void(0)" class="item-add-to-wish-list" data-productid="<?= $p->id?>"><i class="fa fa-heart" aria-hidden="true"></i></a>
                                                <a href="javascript:void(0)" class="item-add-to-cart" data-productid="<?= $p->id ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                            </p>
                                        </figcaption>
                                    </figure>
                                    <h3><?=$p->product?></h3>
                                    <p>$<?=$p->mrp?></p>
                                </div>
                            </div>
                             </a>
                        <?php }} ?>


                </div>
            </div>
        </div>
    </div>
</div>-->
<?php $this->load->view("footer.php"); ?>
