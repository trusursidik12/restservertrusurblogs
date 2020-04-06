<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// api
$route['api/blogs']									= 'b_blogs_api/blogs';

// frontend
$route['login']										= 'f_login/login';
$route['process']									= 'f_login/process';
$route['logout']									= 'f_login/logout';

// backend
$route['backoffice/dashboard']						= 'b_dashboard/index';

$route['backoffice/blogs/list']						= 'b_blogs/index';
$route['backoffice/blogs/add']						= 'b_blogs/add';
$route['backoffice/blogs/edit/status/(:any)']		= 'b_blogs/status/$1';
$route['backoffice/blogs/edit/(:any)']				= 'b_blogs/edit/$1';
$route['backoffice/blogs/delete/(:any)']			= 'b_blogs/delete/$1';

$route['backoffice/users/list']						= 'b_users/index';
$route['backoffice/users/add']						= 'b_users/add';
$route['backoffice/users/edit/(:any)']				= 'b_users/edit/$1';
$route['backoffice/users/delete/(:any)']			= 'b_users/delete/$1';

$route['default_controller'] 						= 'f_home';
$route['404_override']				= '';
$route['translate_uri_dashes']		= FALSE;