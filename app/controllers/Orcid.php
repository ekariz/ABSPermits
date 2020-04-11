<?php

//use GuzzleHttp\Psr7;
//use GuzzleHttp\Exception\RequestException;


defined('BASEPATH') OR exit('No direct script access allowed');

class Orcid extends CI_Controller {

 public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model','common');
        $this->load->model('Researcher_model','researcher');
        $this->config->load('product');
        $this->config->load('orcid');
    }

  public function index(){
    
    redirect( base_url() );
    
    $data = [];

    $data['orcid_client_id']      = $this->config->item('orcid_client_id');
    $data['orcid_redirect_uri']   = $this->config->item('orcid_redirect_uri');
    $data['orcid_scope']          = $this->config->item('orcid_scope');

    $this->load->view('main/frontend/orcid_auth_view', $data);
  }


  public function Authorization(){

   $authorization_error  = $this->input->get('error');
   $authorization_code   = $this->input->get('code');
   $orcid_client_id      = $this->config->item('orcid_client_id');
   $orcid_client_secret  = $this->config->item('orcid_client_secret');
   $orcid_landing_page   = $this->config->item('orcid_landing_page');
   $orcid_redirect_uri   = $this->config->item('orcid_redirect_uri');
   $companyname          = $this->config->item('companyname');
   $productname          = $this->config->item('productname');

   $data = [];

   if(strlen($authorization_error)>0){
    $data['message']  = $authorization_error;
    $data['message'] .= "By sharing your iD with {$productname}, and giving us permission to read and update your ORCID record, you enable us to help you keep your record up-to-date with trusted information. Learn more in Six ways to make your ORCID iD work for you!";
    $view             = 'orcid_auth_failed_view';
   }else{

    //get token
    $orcid_token_request = $this->config->item('orcid_token_request');

    $post_data = [];


    $fields['client_id']       = $orcid_client_id;
    $fields['client_secret']   = $orcid_client_secret;
    $fields['grant_type']      = 'authorization_code';
    $fields['code']            = $authorization_code;
    $fields['redirect_uri']    = $orcid_redirect_uri;

    $client = new GuzzleHttp\Client( ['headers' => ['Accept' => 'application/json']] );

    $res = $client->request('POST', $orcid_token_request, ['form_params' => $fields,  'http_errors' => 0] );

    $StatusCode    =  $res->getStatusCode();
    $reason        =  $res->getReasonPhrase();
    $content_type  =  $res->getHeaderLine('content-type');
    $body          =  $res->getBody();
    $contents      =  $body->getContents();
    $json          =  json_decode($contents);

    //echo "\$StatusCode={$StatusCode} <br>";//remove
    //echo "\$reason={$reason} <br>";//remove
    //echo "\$content_type={$content_type} <br>";//remove
    //echo "\$contents={$contents} <br>";//remove
    //print_pre($json);//remove

    /**
    * log ORCID requests and response
    */
    $this->common->insert_orcid_log( serialize($fields),  $StatusCode, $reason , $contents  );

    if($StatusCode !=200 && isset($json->error))
    {
      die("{$StatusCode} : {$reason} : {$json->error_description}");
    }

    $access_token   =  valueof($json, 'access_token');
    $token_type     =  valueof($json, 'token_type');
    $refresh_token  =  valueof($json, 'refresh_token');
    $expires_in     =  valueof($json, 'expires_in');
    $scope          =  valueof($json, 'scope');
    $name           =  valueof($json, 'name');
    $orcid          =  valueof($json, 'orcid');

    //save ORCID access token
    $email   = $this->session->userdata('email');

    if(empty($email)){
     echo json_encode( ["success" => 0, 'message' => "login session expired.Please re-login" ] );
     die;
    }

    $data_researcher =  [];
    $data_researcher['orcidid']      = $orcid;
    $data_researcher['orcidname']    = $name;
    $data_researcher['accesstoken']  = $access_token;
    $data_researcher['tokentype']    = $token_type;
    $data_researcher['refreshtoken'] = $refresh_token;
    $data_researcher['tokenexpiry']  = $expires_in;
    $data_researcher['tokenscope']   = $scope;

    $this->researcher->update($email, $data_researcher);

    $data['message'] = $authorization_code;
    $view            = 'orcid_auth_success_view';
    redirect( base_url() .'Orcid/Success' );
   }

   $this->load->view("main/frontend/{$view}", $data);

  }

  public function Success(){

    $email   = $this->session->userdata('email');

    if(empty($email)){
     echo json_encode( ["success" => 0, 'message' => "login session expired.Please re-login" ] );
     die;
    }

    $researcher        = $this->researcher->get_researcher_by_email( $email   );

    $data =  [];
    $data['orcidid']  =  $researcher->orcidid;

    $this->load->view("main/frontend/orcid_auth_success_view", $data );
  }

  public function RedirectURL1(){
   die('Nothing Here 1');
  }

  public function RedirectURL2(){
   die('Nothing Here 2');
  }



  public function RedirectURL3(){
   die('Nothing Here 3');
  }



  public function RedirectURL4(){
   die('Nothing Here 4');
  }


  public function RedirectURL5(){
   die('Nothing Here 5');
  }





}

