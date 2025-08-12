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
$route['default_controller'] = 'login';//change accordingly to set default page
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['ajax-request'] = 'ItemController/ajaxRequest';
$route['ajax-requestPost']['post'] = 'ItemController/ajaxRequestPost';
$route['expense_subarea'] = 'expense_subarea/index';
$route['expense_subarea/create/(:num)'] = 'expense_subarea/create/$1';
$route['expense_subarea/store/(:num)'] = 'expense_subarea/store/$1';
$route['expense_subarea/show/(:num)'] = 'expense_subarea/show/$1';
$route['expense_subarea/edit/(:num)'] = 'expense_subarea/edit/$1';
$route['expense_subarea/update/(:num)'] = 'expense_subarea/update/$1';
$route['expense_subarea/delete/(:num)'] = 'expense_subarea/delete/$1';
$route['supplier_info'] = 'supplier_info/index';
$route['supplier_info/create'] = 'supplier_info/create';
$route['supplier_info/store'] = 'supplier_info/store';
$route['supplier_info/show/(:num)'] = 'supplier_info/show/$1';
$route['supplier_info/edit/(:num)'] = 'supplier_info/edit/$1';
$route['supplier_info/update/(:num)'] = 'supplier_info/update/$1';
$route['supplier_info/delete/(:num)'] = 'supplier_info/delete/$1';






