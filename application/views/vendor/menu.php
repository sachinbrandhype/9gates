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
                      <h6>Vendor Dashboard</h6>
                    </div>
                  </li>





                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Product Management</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="<?=site_url()?>vendor/product/add">Add </a></li>
                            <li><a href="<?=site_url()?>vendor/product/index">View</a></li>
                           <!-- <li><a href="<?/*=site_url()*/?>admin/product/bulk">Bulk</a></li>-->

                        </ul>
                    </li>



                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>