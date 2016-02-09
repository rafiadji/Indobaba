<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home_controller';
$route['page/(:any)'] = 'home_controller/hal/$1';
$route['cart'] = 'user_checkout/cart';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
