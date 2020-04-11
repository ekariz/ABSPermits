<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



$config['orcid_client_id']           = 'APP-LY3W5WQ02KBI0Q3W';
$config['orcid_client_secret']       = 'ab4a4d30-e5b3-46c2-9071-57a7bdffb28b';
$config['orcid_authorize_request']   = 'https://orcid.org/oauth/authorize';
$config['orcid_token_request']       = 'https://orcid.org/oauth/token';
$config['orcid_openid']              = 'https://orcid.org/oauth/authorize';
$config['orcid_redirect_uri_login']  =  base_url().'Orcid/Authorization/login';
$config['orcid_redirect_uri_signup'] =  base_url().'Orcid/Authorization/signup';
$config['orcid_landing_page']        =  base_url().'ApplicationForm';
$config['orcid_scope']               =  'authenticate';

 
