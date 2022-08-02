<header class="main-nav">
          <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="<?=site_url()?>private/assets/images/dashboard/1.png" alt="">
            <div class="badge-bottom"></div><a href="#">
              <h6 class="mt-3 f-14 f-w-600">9Gates </h6></a>
           
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Admin Dashboard</h6>
                    </div>
                  </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Home Slider</span></a>
                        <ul class="nav-submenu menu-content">

                            <li><a class="submenu-title" href="javascript:void(0)">Banner Managment<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/banner/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/banner/index">View</a></li>
                                </ul>
                            <li><a class="submenu-title" href="javascript:void(0)">Home Offer Banner<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/banner/offerbanner">Add</a></li>
                                    <li><a href="<?=site_url()?>admin/banner/bannerslider">View</a></li>
                                </ul>

                            </li>
                            
                            <li><a class="submenu-title" href="javascript:void(0)">Home Trading Banner<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/banner/tradingbanner">Add</a></li>
                                    <li><a href="<?=site_url()?>admin/banner/bannerslider">View</a></li>
                                </ul>

                            </li>
                            
                            <li><a class="submenu-title" href="javascript:void(0)">Home Shop By Banner<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/banner/shopbybanner">Add</a></li>
                                    <li><a href="<?=site_url()?>admin/banner/bannerslider">View</a></li>
                                </ul>

                            </li>
                            
                            
                            </li>

                           <!-- <li><a class="submenu-title" href="javascript:void(0)">Shipping Charge By Weight<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?/*=site_url()*/?>admin/shipping/add">Add </a></li>
                                    <li><a href="<?/*=site_url()*/?>admin/shipping/index">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">User Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?/*=site_url()*/?>admin/user/add">Add </a></li>
                                    <li><a href="<?/*=site_url()*/?>admin/user/index">View</a></li>
                                </ul>
                            </li>-->


                        </ul>
                    </li>

                  <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Catalog Management</span></a>
                    <ul class="nav-submenu menu-content">
                      <li><a class="submenu-title" href="javascript:void(0)">Category Mnagement<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                        <ul class="nav-sub-childmenu submenu-content">
                          <li><a href="<?=site_url()?>admin/category/add">Add </a></li>
                          <li><a href="<?=site_url()?>admin/category/index">View</a></li>
                           <li><a href="<?=site_url()?>admin/category/bulk">Bulk</a></li>
                        </ul>
                      </li>
                        <li><a class="submenu-title" href="javascript:void(0)">SubCategory Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/subcategory/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/subcategory/index">View</a></li>
                                <li><a href="<?=site_url()?>admin/subcategory/bulk">Bulk</a></li>
                            </ul>
                        </li>
                        <li><a class="submenu-title" href="javascript:void(0)">ChildCategory Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/childcategory/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/childcategory/index">View</a></li>
                            </ul>
                        </li>
                        <li><a class="submenu-title" href="javascript:void(0)">Attribute Group <span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/attributegroup/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/attributegroup/index">View</a></li>
                            </ul>
                        </li>
                        <li><a class="submenu-title" href="javascript:void(0)">Attribute Variant <span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/attributevariant/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/attributevariant/index">View</a></li>
                            </ul>
                        </li>
                        <li><a class="submenu-title" href="javascript:void(0)">Color Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/color/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/color/index">View</a></li>
                            </ul>
                        </li>
                        <li><a class="submenu-title" href="javascript:void(0)">Size Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/size/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/size/index">View</a></li>
                            </ul>
                        </li>
                        <li><a class="submenu-title" href="javascript:void(0)">Brand Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                            <ul class="nav-sub-childmenu submenu-content">
                                <li><a href="<?=site_url()?>admin/brand/add">Add</a></li>
                                <li><a href="<?=site_url()?>admin/brand/index">View</a></li>
                            </ul>
                        </li>

                    </ul>
                  </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Location Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a class="submenu-title" href="javascript:void(0)">Country Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/country/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/country/index">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">State Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/country/add_state">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/country/state">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">City Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/country/add_city">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/country/city">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">Area Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/country/add_area">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/country/area">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">Replacement Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/replacement/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/replacement/index">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">Estimate Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/estimate/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/estimate/index">View</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Product Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="<?=site_url()?>admin/product/add">Add </a></li>
                            <li><a href="<?=site_url()?>admin/product/index">View</a></li>
                            <li><a href="<?=site_url()?>admin/product/bulk">Bulk</a></li>

                        </ul>
                    </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Package Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="<?=site_url()?>admin/package/add">Add </a></li>
                            <li><a href="<?=site_url()?>admin/package/index">View</a></li>

                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Shipping Management</span></a>
                        <ul class="nav-submenu menu-content">

                            <li><a class="submenu-title" href="javascript:void(0)">Pincode Availability<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/pincode/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/pincode/index">View</a></li>
                                </ul>
                            </li>

                            <li><a class="submenu-title" href="javascript:void(0)">Shipping Charge By Weight<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/shipping/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/shipping/index">View</a></li>
                                </ul>
                            </li>
                            <li><a class="submenu-title" href="javascript:void(0)">User Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="<?=site_url()?>admin/user/add">Add </a></li>
                                    <li><a href="<?=site_url()?>admin/user/index">View</a></li>
                                </ul>
                            </li>


                        </ul>
                    </li>

                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Wallet Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="<?=site_url()?>admin/wallet/credit">Credit </a></li>
                            <li><a href="<?=site_url()?>admin/wallet/debit">Debit</a></li>

                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Coupon Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="<?=site_url()?>admin/coupon/add">Credit </a></li>
                            <li><a href="<?=site_url()?>admin/coupon/index">View</a></li>

                        </ul>
                    </li>

                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Blog Management</span></a>
                    <ul class="nav-submenu menu-content">
                        <li><a href="<?=site_url()?>admin/blog/add">Credit </a></li>
                        <li><a href="<?=site_url()?>admin/blog/index">View</a></li>

                    </ul>
                </li>
                
                <li><a class="submenu-title" href="javascript:void(0)">GiftCard Management<span class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                    <ul class="nav-sub-childmenu submenu-content">
                        <li><a href="<?=site_url()?>admin/gift/add">Add </a></li>
                        <li><a href="<?=site_url()?>admin/gift/index">View</a></li>
                    </ul>
                </li>
                            
                            
                            
                            
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Notification</span></a>
                    <ul class="nav-submenu menu-content">
                        <!--<li><a href="<?=site_url()?>admin/notification/add">Credit </a></li>-->
                        <li><a href="<?=site_url()?>admin/notification/index">View</a></li>

                    </ul>
                </li>
                
                
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Order Status</span></a>
                    <ul class="nav-submenu menu-content">
                        <li><a href="<?=site_url()?>admin/product/order">Order</a></li>
                        <li><a href="<?=site_url()?>admin/product/cancel">Cancel</a></li>
                        <li><a href="<?=site_url()?>admin/product/return">Return</a></li>

                    </ul>
                </li>
                
                
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Promotion</span></a>
                    <ul class="nav-submenu menu-content">
                        <li><a href="<?=site_url()?>admin/promotion/add">Add</a></li>
                        <li><a href="<?=site_url()?>admin/promotion/index">View</a></li>

                    </ul>
                </li>
                
                

                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>