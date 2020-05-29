<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// api
$route['api/faqs']									= 'b_faqs_api/faqs';
$route['api/slide']									= 'b_slide_api/slide';
$route['api/clients']								= 'b_clients_api/clients';
$route['api/blogs']									= 'b_blogs_api/blogs';
$route['api/message']								= 'b_message_api/contactus';

// frontend
$route['login']										= 'f_login/login';
$route['process']									= 'f_login/process';
$route['logout']									= 'f_login/logout';

// backend
$route['backoffice/dashboard']						= 'b_dashboard/index';

$route['backoffice/message/list']					= 'b_message/index';
$route['backoffice/message/delete/(:any)']			= 'b_message/delete/$1';

$route['backoffice/clients/list']					= 'b_clients/index';
$route['backoffice/clients/add']					= 'b_clients/add';
$route['backoffice/clients/edit/(:any)']			= 'b_clients/edit/$1';
$route['backoffice/clients/delete/(:any)']			= 'b_clients/delete/$1';

$route['backoffice/faqs/list']						= 'b_faqs/index';
$route['backoffice/faqs/add']						= 'b_faqs/add';
$route['backoffice/faqs/edit/(:any)']				= 'b_faqs/edit/$1';
$route['backoffice/faqs/delete/(:any)']				= 'b_faqs/delete/$1';

$route['backoffice/blogs/list']						= 'b_blogs/index';
$route['backoffice/blogs/add']						= 'b_blogs/add';
$route['backoffice/blogs/edit/status/(:any)']		= 'b_blogs/status/$1';
$route['backoffice/blogs/edit/(:any)']				= 'b_blogs/edit/$1';
$route['backoffice/blogs/delete/(:any)']			= 'b_blogs/delete/$1';

$route['backoffice/slide/list']						= 'b_slide/index';
$route['backoffice/slide/add']						= 'b_slide/add';
$route['backoffice/slide/edit/(:any)']				= 'b_slide/edit/$1';
$route['backoffice/slide/delete/(:any)']			= 'b_slide/delete/$1';

$route['backoffice/users/list']						= 'b_users/index';
$route['backoffice/users/add']						= 'b_users/add';
$route['backoffice/users/edit/(:any)']				= 'b_users/edit/$1';
$route['backoffice/users/delete/(:any)']			= 'b_users/delete/$1';

$route['default_controller'] 						= 'b_dashboard';
$route['404_override']				= '';
$route['translate_uri_dashes']		= FALSE;
