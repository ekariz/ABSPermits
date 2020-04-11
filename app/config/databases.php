<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//backend connection

$db['admin'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',

    'username' => 'absprototype',
    'password' => 'absprototype',
    'database' => 'absprototype',

    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => APPPATH . 'cache',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);


