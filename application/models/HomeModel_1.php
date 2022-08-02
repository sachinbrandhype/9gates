<?php

class HomeModel extends CI_Model
{

    function getproctFilterByGroup($prid)
    {
        $query = $this->db->query("SELECT * from product where id ='$prid'");
        $output = '<div id="srch"></div>';
        foreach ($query->result() as $p) {
            $output .= '<div class="product_column"><div class="product_img"><a href="' . home / productdetail . '/' . $p->product_url . '"> <img src="' . base_url('uploads/' . $p->image) . '" alt="Product"> </a> </div><div class="product_content"> <div class="content"> <h4><i class="fas fa-book"></i><a href="' . home / productdetail . '/' . $p->product_url . '">' . $p->product . '</a></h4> </div><div class="price_area"> <ul class="pricing"> <li class="price"><span class="symbol">&#8377;</span> <span class="cost">' . $p->price . '</span></li><li class="addto"> <div class="addtoCart"> <a href="javascript:void(0)" data-bs-toggle="tooltip" class="item-add-to-cart" data-productid="' . $p->id . '" data-bs-html="true" title="Add to Cart"> <i class="fas fa-shopping-cart"></i> Add to cart </a> </div> </li></ul> </div></div></div>';
        }
        return $output;

    }


    function  getDataByFilterId($key)
    {
        return $this->db->get('group2', array('id' => $key))->row();
    }

    function  getDataByFilterId111($key)
    {
        return $this->db->get('group3', array('id' => $key))->row();
    }


    function  getDataByFilterId11($key)
    {
        return $this->db->get('multico', array('id' => $key))->row();
    }


    function filterGroupDataByNameGroupTable($id)
    {
        $this->db->select('multico.subcategory,multico.id,fitergroup.filtergroup');
        $this->db->from('multico');
        $this->db->join('product', 'product.id = multico.productid');
        $this->db->join('fitergroup', 'fitergroup.id = multico.filtergroup');
        $this->db->group_by('multico.filtergroup');
        $this->db->where('product.id', $id);

        return $query = $this->db->get()->result();


    }


    function filterGroupDataById($id)
    {
        $this->db->select('multico.subcategory,multico.id,fitergroup.filtergroup');
        $this->db->from('multico');
        $this->db->join('product', 'product.id = multico.productid');
        $this->db->join('fitergroup', 'fitergroup.id = multico.filtergroup');
        $this->db->where('product.id', $id);

        return $query = $this->db->get()->result();


    }


    function filterGroupDataByNameGroupTable2($id)
    {
        $query = $this->db->query("SELECT product.id,fitergroup.filtergroup FROM group2 INNER JOIN product ON product.id=group2.productid INNER JOIN fitergroup ON fitergroup.id=group2.filtergroup2 WHERE group2.productid='$id' GROUP BY group2.productid ");
        return $query->result();


    }


    function filterGroupDataById2($id)
    {
        $this->db->select('group2.filtername2,group2.filtergroup2,group2.id,fitergroup.filtergroup');
        $this->db->from('group2');
        $this->db->join('product', 'product.id = group2.productid');
        $this->db->join('fitergroup', 'fitergroup.id = group2.filtergroup2');
        $this->db->where('product.id', $id);
        return $query = $this->db->get()->result();
    }


    function filterGroupDataByNameGroupTable3($id)
    {

        $query = $this->db->query("SELECT product.id,fitergroup.filtergroup FROM group3 INNER JOIN product ON product.id=group3.productid INNER JOIN fitergroup ON fitergroup.id=group3.filtergroup3 WHERE group3.productid='$id' GROUP BY group3.productid");
        return $query->result();

    }


    function filterGroupDataById3($id)
    {
        $this->db->select('group3.filtername3,group3.id,fitergroup.filtergroup');
        $this->db->from('group3');
        $this->db->join('product', 'product.id = group3.productid');
        $this->db->join('fitergroup', 'fitergroup.id = group3.filtergroup3');
        $this->db->where('product.id', $id);

        return $query = $this->db->get()->result();


    }

    function searchAllSchoolData($keyword)
    {
        $this->db->where("(`school_name` LIKE '%$keyword%'");
        $this->db->or_where("`state` LIKE '%$keyword%')");
        $query = $this->db->get('school');

        return $query->result();
    }


    function searchAllData($keyword)
    {

        $this->db->where("(`product` LIKE '%$keyword%'");
        $this->db->or_where("`price` LIKE '%$keyword%'");
        $this->db->or_where("`state` LIKE '%$keyword%')");
        $query = $this->db->get('product');

        return $query->result();
    }


    function updateUserInfo($userid)
    {

        $arr['fname'] = $this->input->post('firstname');
        $arr['lname'] = $this->input->post('lastname');
        $arr['email'] = $this->input->post('email');
        $arr['phone'] = $this->input->post('phone');
        $arr['school_name'] = $this->input->post('school_name');
        $arr['school_address'] = $this->input->post('school_address');
        $arr['student_addmission'] = $this->input->post('student_addmission');
        $arr['city'] = $this->input->post('street_address');
        $arr['fname'] = $this->input->post('city');
        $arr['city'] = $this->input->post('city');
        $arr['shipp_state'] = $this->input->post('state');
        $arr['pincode'] = $this->input->post('pincode');
        $arr['des'] = $this->input->post('des');

        $this->db->where(array('id' => $userid));
        $this->db->update('user', $arr);
    }


    function getAboutUs()
    {
        $type = 'About';
        return $this->db->get_where('about', array('type' => $type))->row();
    }

    function getBannerPosition1()
    {
        $type = 'Position1';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition2()
    {
        $type = 'Position2';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition3()
    {
        $type = 'Position3';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition4()
    {
        $type = 'Position4';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition5()
    {
        $type = 'Position5';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition6()
    {
        $type = 'Position6';

        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition7()
    {
        $type = 'Position7';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition8()
    {
        $type = 'Position8';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition9()
    {
        $type = 'Position9';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition10()
    {
        $type = 'Position10';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition11()
    {
        $type = 'Position11';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition12()
    {
        $type = 'Position12';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition13()
    {
        $type = 'Position13';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition14()
    {
        $type = 'Position14';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition15()
    {
        $type = 'Position15';
        $query = $this->db->query("select * from bannerslider where banner_position='$type' ");
        return $query->result();
    }

    function getBannerPosition16()
    {
        $type = 'Position16';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getBannerPosition17()
    {
        $type = 'Position17';
        return $this->db->get_where('bannerslider', array('banner_position' => $type))->row();
    }

    function getCategoryIdByUrl($url)
    {
        return $this->db->get_where('category', array('url' => $url))->row();
    }


    function getAllBanner()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('banner')->result();
    }

    function getCategory()
    {
        $this->db->order_by('id ASC');
        return $this->db->get('category')->result();
    }

    function getProductByurl($id)
    {
        $query = $this->db->query("select * from product where category='$id' ");
        return $query->result();
    }
    function getRelatedProductBYId($id)
    {
        $query = $this->db->query("select * from product where category='$id' ");
        return $query->result();
    }
    function getBottomCategoryByUrl($url)
    {
        /*$query = $this->db->query("select * from category where cat_type='$type' ");
        return $query->result();*/
        return $this->db->get_where('category', array('url' => $url))->row();
    }

    function getBottomCategory()
    {
        $type = 'Bottum';
        $query = $this->db->query("select * from category where cat_type='$type' ");
        return $query->result();
    }

    function getTopCategory()
    {
        $type = 'Top';
        $query = $this->db->query("select * from category where cat_type='$type' ");
        return $query->result();
    }

    function getSubCategory()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('subcategory')->result();
    }

    function getBlog()
    {
        $this->db->order_by('id DESC');
        $this->db->limit('3');
        return $this->db->get('offer')->result();
    }

    function getTestimonial()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('testimonial')->result();
    }


    function getWishLishData()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('wishlist')->result();
    }


    function fetchFilterGroupDataName($filtergroup)
    {
        $this->db->where('groupname', $filtergroup);
        $query = $this->db->get('subcategory');
        $output = '<option value="">Select Filter Name</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->filtername . '</option>';
        }
        return $output;
    }


    function  getGroupFilter()
    {
        $query = $this->db->query("select * from product ");
        return $query->result();

    }

    function getsRowData($proId)
    {
        /*$query = $this->db->query("select * from product where id='$proId'");
        return $query->result();*/

        return $this->db->get_where('product', array('id' => $proId))->row();

    }

    function getProduct($id)
    {
        $query = $this->db->query("select * from product where category='$id' limit 0,12");
        return $query->result();

    }


    function getAllProductList()
    {
        $query = $this->db->query("select * from product");
        return $query->result();

    }



    function getCartValeu($id)
    {
        $query = $this->db->query("SELECT cart.id,cart.session_id,product.product,product.price,product.image,cart.qty FROM `cart`INNER JOIN product ON cart.product_id=product.id where cart.session_id='$id' ");
        return $query->result();

    }


    function getCategoryByUrl($url)
    {

        return $this->db->get_where('category', array('url' => $url))->row();

    }

    function getproductyByUrl($url)
    {
        /*$query = $this->db->query("select * from product where product_url='$url'");
        return $query->result();*/
        return $this->db->get_where('product', array('product_url' => $url))->row();


    }

    function getProductByCategoryId($id)
    {
        $query = $this->db->query("select * from product where category='$id'");
        return $query->result();

    }

    function getRelatedProduct($id)
    {
        $query = $this->db->query("select * from product where category='$id'");
        return $query->result();

    }

    function getProductImages($id)
    {
        $query = $this->db->query("select * from productimage where pro_id='$id'");
        return $query->result();

    }

    function getProductBySubcategoryId($id)
    {
        $query = $this->db->query("select * from product where subcategory='$id'");
        return $query->result();

    }

    function getSubCategoryByUrl($url)
    {

        return $this->db->get_where('subcategory', array('url' => $url))->row();

    }

    function getSubCategoryById($id)
    {
        $query = $this->db->query("select * from subcategory where category='$id'");
        return $query->result();

    }


    function getAlllCategory()
    {
        $query = $this->db->query("select * from category");
        return $query->result();

    }

    function getOrderByid($userid)
    {

        $this->db->select('tbl_order.firstname,tbl_order.state,tbl_order.firstname,user.name,user.phone,user.street_address,tbl_order.product_url,tbl_order.product,tbl_order.price,tbl_order.shipping_charge,tbl_order.image');
        $this->db->from('tbl_order');
        $this->db->where('tbl_order.status', 1);
        $this->db->join('user', 'tbl_order.userid =user.id ', 'inner');
        $query = $this->db->get();
        return $query->result();

        /*  return $query = $this->db->get()->result();*/


    }


    function updateCartItem($id)
    {
        $arr['qty'] = $this->input->post('qty');

        $this->db->where(array('id' => $id));
        $this->db->update('cart', $arr);
    }


    function updateAccountDetail($id)
    {
        $arr['fname'] = $this->input->post('fname');
        $arr['lname'] = $this->input->post('lname');
        $arr['name'] = $this->input->post('name');
        $arr['email'] = $this->input->post('email');
        $arr['phone'] = $this->input->post('phone');
        $arr['street_address'] = $this->input->post('street_address');

        $arr['state'] = $this->input->post('state');

        $arr['city'] = $this->input->post('city');

        if (isset($_FILES['image']['name'])) {
            $config['upload_path'] = APPPATH . '../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = date('YmdHms') . '_' . rand(1, 999999);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $uploaded = $this->upload->data();
                $arr['image'] = $uploaded['file_name'];
                $this->resize_image(APPPATH . '../uploads/' . $arr['image'], 900);
                $this->createThumbnail(PPPATH . '../uploads/' . $arr['image'], APPPATH . '../uploads/thumbnail/' . $arr['image'], 400, 300);
                //$arr['image'] =
            }
        }
        $this->db->where(array('id' => $id));
        $this->db->update('user', $arr);
    }

    function resize_image($source, $width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    function createThumbnail($source, $destination, $width, $height)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['new_image'] = $destination;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    public function logingUser($email, $pass)
    {
        $query = $this->db->get_where('user', array('email' => $email, 'password' => $pass, 'status' => 1));
        return $query->row();
    }

    function getUserDataById($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row();
    }

    function checkUser($email)
    {
        return $this->db->get_where('user', array('email' => $email))->row();

    }


    function getEmailPassword($email)
    {
        return $this->db->get_where('user', array('email' => $email))->row();
    }


    function getWishList()
    {
        return $this->db->get('wishlist')->result();
    }


    function checkCartItems()
    {
        return $this->db->get('temp_cart')->result();
    }

    function deleteCartItem($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('cart');
    }

    function deleteWishItem($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wishlist');
    }

    function getCartItemValues()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('cart')->result();
    }

    function countTotalCart($id)
    {
        $query = $this->db->query("SELECT SUM(retail) AS Total FROM cart where session_id='$id'");
        return $query->result();
    }






    function  getSessionId()
    {
        return $this->db->get('cart', array('status' => 0))->row();
    }


    function totalCartItem($id)
    {
        $query = $this->db->query("SELECT count(id) AS Total FROM cart where session_id='$id'");
        $output = '<div id="cart"></div>';
        foreach ($query->result() as $v) {

            $output .= '<span class="notification_count" id="go-to-basket">' . $v->Total . '</span>';
        }
        return $output;
    }

    function deleteWishList($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('wishlist');
    }

    /*function deleteCartItems($id)
    {
        $this->db->where('orderid', $id);
        $this->db->delete('tbl_order');
    }*/


    /*function deleteCartItemsEmpty($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('temp_cart');
    }*/


    function finalOrder()
    {
        /* return $this->db->get('cart')->result();*/

        $this->db->select('tbl_order.firstname,tbl_order.state,tbl_order.firstname,user.name,user.phone,user.street_address,tbl_order.product_url,tbl_order.product,tbl_order.price,tbl_order.shipping_charge,tbl_order.image');
        $this->db->from('tbl_order');
        $this->db->where('tbl_order.status', 1);
        $this->db->join('user', 'tbl_order.userid =user.id ', 'inner');
        /*  $this->db->join ( 'product', 'tbl_order.orderid  = product.id' , 'inner' );*/
        $query = $this->db->get();
        return $query->result();


    }


    function matchPriceByState($state)
    {
        $this->db->where('state', $state);
        $query = $this->db->get('product');

        $output = '<div id="shipp"></div>';


        foreach ($query->result() as $pro) {

            $output .= '<p>' . $pro->state . '</p>';

        }
        return $output;
    }


    function registerUser($tablename, $insert)
    {
        $this->db->insert($tablename, $insert);
        return $this->db->insert_id();
    }


    function saveOrder($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveWishlist($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveCartItem($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }


    function saveCart($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }

    function  getAllStreming()
    {
        return $this->db->get('streming')->result();
    }

    function  getAllClass()
    {
        return $this->db->get('classes')->result();
    }

    function  getAllLanguage()
    {
        return $this->db->get('language')->result();
    }

    function  getAllSubject()
    {
        return $this->db->get('subject')->result();
    }

    function  getAllSchool()
    {
        $this->db->order_by('id DESC');
        return $this->db->get('school')->result();
    }

    function  getAllRelatedProduct($id)
    {
        $query = $this->db->query("select * from product where product_url!='$id' order by id");
        return $query->result();

    }

    function  getAllProduct($id)
    {
        $query = $this->db->query("select * from product where class_name='$id' order by id");

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }


        //return $query->result();

    }

    function  getAllSchoolDataByUrl($url)
    {
        return $this->db->get_where('school', array('url' => $url))->row();
    }

    function  getAllClassNameByProduct($id)
    {
        return $this->db->get_where('classes', array('class_name' => $id))->row();
    }

    function  getAllProductByClass($url)
    {
        return $this->db->get_where('product', array('product_url' => $url))->row();
    }

    function  getAllClassBySchool($url)
    {
        $query = $this->db->query("select * from classes where school_name='$url' order by id");
        return $query->result();
    }


    function getproId($id)
    {
        return $this->db->get_where('product', array('class_name' => $id))->row();
    }


    function getproIdByUrl($id)
    {
        return $this->db->get_where('product', array('product_url' => $id))->row();
    }

    function getschoolName($id)
    {
        return $this->db->get_where('school', array('id' => $id))->row();
    }

    function getschoolNameByUrl($id)
    {
        return $this->db->get_where('school', array('url' => $id))->row();
    }
}