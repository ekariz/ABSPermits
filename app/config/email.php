<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['protocol']     = 'smtp';
$config['smtp_host']    = 'smtp.zoho.com';
$config['smtp_port']    = '587';
$config['smtp_crypto']  = "tls";
$config['smtp_user']    = 'admin@flexipay.co.ke';
$config['smtp_pass']    = 'payadmin';
$config['crlf']         = "\r\n";
$config['newline']      = "\r\n";
$config['mailtype']     = "html";
$config['wordwrap']     = TRUE;
$config['newline']      = "\r\n";
$config['useragent']    = "EnvisageMailer";
$config['smtp_timeout'] = '60';


/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.mailgun.org';
$config['smtp_port'] = '465';
$config['smtp_timeout'] = '30';
$config['smtp_user'] = 'postmaster@mydomain.com';
$config['smtp_pass'] = 'password';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
**/




