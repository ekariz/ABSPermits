<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Adodbloader{

    public function __construct(){
        if ( !class_exists('ADONewConnection') )
        require_once(APPPATH.'libraries/adodb/adodb-php/adodb.inc.php');
        require_once(APPPATH.'libraries/adodb/adodb-php/adodb-xmlschema03.inc.php');
        include(APPPATH.'config/database.php');
    }

   public function _init_adodb_library(&$ci) {
        $db_var = false;
        $debug = false;

        if (!isset($dsn)) {
            // fallback to using the CI database file
            include(APPPATH.'config/database'.EXT);
            $group = 'default';
            $dsn = $db[$group]['dbdriver'].'://'.$db[$group]['username']
                   .':'.$db[$group]['password'].'@'.$db[$group]['hostname']
                   .'/'.$db[$group]['database'];
        }

        // $ci is by reference, refers back to global instance
        $ci->adodb =&ADONewConnection($dsn);

        if ($db_var) {
            // also set the normal CI db variable
            $ci->db =&$ci->adodb;
        }

        if ($debug) {
            $ci->adodb->debug = true;
        }
    }
}
