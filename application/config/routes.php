<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
//$route['^(?!other|controller).*'] = 'Home/$0';

//$route['(:any)/(:any)'] = "home/categorylisting/$1";
//$route['(:any)/(:any)/(:any)'] = "home/childcategorylisting/$1";

$route['index'] = 'home/index';
$route['invoice'] = 'home/invoice';
$route['about-us'] = 'home/about';
$route['contact-us'] = 'home/contact';
$route['cart'] = 'home/cart';
$route['my-account'] ='home/myaccount';
$route['return-policy'] = 'home/returnpolicy';
$route['terms-condition'] = 'home/termscondition';
$route['testimonial'] = 'home/testimonial';
$route['voucher'] = 'home/voucher';
$route['discount'] = 'home/discount';
$route['offer'] = 'home/offer';
$route['login'] = 'home/login';
$route['cart'] = 'home/cart1';
$route['category'] = 'home/category';
$route['c/(:any)'] = 'home/makeup/$1';
$route['(:any).html'] = "gates/index/$1";

$route['(:any)/(:any).html'] = "gates/cat/$1/$2";
$route['(:any)/(:any)/(:any).html'] = 'gates/scat/$1/$2/$3';
$route['(:any)/(:any)/(:any)/(:any).html'] = 'gates/ccat/$1/$2/$3/$4';
$route['sb/(:any)'] = 'home/subcategorylist/$1';
$route['ch/(:any)/(:any)'] = 'home/childcategorylist/$2';



$route['giftcard'] = "gates/giftcard";

$route['help'] = "gates/help";



/*$route['(:any).html'] = "home/makeup";
//$route['(:any)/(:any).html'] = 'home/makeup/$1/$2';
$route['(:any)/(:any)/(:any).html'] = 'home/subcategorylist/$1/$2/$3';
$route['(:any)/(:any)/(:any)/(:any).html'] = 'home/childcategorylist/$1/$2/$3/$4';*/


$route['productdetail/(:any)'] = 'home/detail/$1';
$route['beauty/(:any)'] = 'home/beauty/$1';
$route['edit/(:any)'] = "admin/category/edit/$1";
$route['admin'] = 'admin/login/index';
//$route['index'] = 'admin/login/dashboard';
$route['vendor'] = 'vendor/login/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['seller'] = "seller";
$route['seller/(:any)'] = "seller/$1";


    