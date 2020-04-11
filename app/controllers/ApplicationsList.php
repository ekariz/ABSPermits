<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationsList extends CI_Controller{
  private $consumer_key      = 'idJITQURCMF5pean7CAHRcD3zFiKWGXj';
  private $consumer_secret   = 'A4DFfjXfW8CM7jWQ';
  private $BusinessShortCode = '174379';
  private $Passkey           =  'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
  private $base_url          = 'https://sandbox.safaricom.co.ke';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','applications');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');
        $this->load->model('Researcher_model','researcher');

        $this->applications->table         = 'applications';
        $this->applications->dataview      = 'viewapplications';
    }

   public function index(){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $researcher =  $this->researcher->get_researcher_by_email($email);

     if($researcher){
      foreach($researcher as $field=>$value){
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }

     $data['approvalsteps']  =  $this->abs->get_approval_steps( );
     $data['applications']   =  $this->abs->get_applications( $email );

     $this->load->view('main/frontend/appmine/my_apps_view', $data );

    }

   public function view( $id ){

     $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

     $researcher        = $this->researcher->get_researcher_by_email($email);

     if($researcher){
      foreach($researcher as $field=>$value){
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }

     $data['approvalsteps']  =  $this->abs->get_approval_steps( );
     $data['applications']   =  $this->abs->get_applications( $email );

     $this->load->view('main/frontend/appmine/my_apps_view', $data );

    }

   public function application($id){

    $email             = $this->session->userdata('email');

    if(empty($email)){
     redirect( base_url() .'login' );
    }

    $data = [];
    $data['email']     = $this->session->userdata('email');
    $data['mobile']    = $this->session->userdata('mobile');
    $data['firstname'] = $this->session->userdata('firstname');
    $data['approvalsteps']  =  $this->abs->get_approval_steps( );
    $data['charges']   =  $this->abs->get_institutions_charges( );

    $data_raw = $this->applications->get_by_id($id);

    if($data_raw){
     foreach($data_raw as $field=>$value){

      if(strstr($field,'paid')  ){
       $data['paids'][$field] = $value;
      }elseif(strstr($field,'payref')  ){
       $data['payrefs'][$field] = $value;
      }elseif(strstr($field,'paytime')  ){
       $data['paytimes'][$field] = $value;
      }elseif(strstr($field,'paymode')  ){
       $data['paymodes'][$field] = $value;
      }elseif(strstr($field,'approved')  ){
       $data['approves'][$field] = $value;
      }elseif(strstr($field,'aprcomment')  ){
       $data['aprcomments'][$field] = $value;
      }elseif(strstr($field,'discomment')  ){
       $data['discomments'][$field] = $value;
      }else{
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }
    }

     $this->load->view("main/frontend/appmine/my_app_view.php", $data );

    }

   public function viewref($refno_part1, $refno_part2){

    $email             = $this->session->userdata('email');

    if(empty($email)){
     redirect( base_url() .'login' );
    }

    $data = [];
    $data['email']     = $this->session->userdata('email');
    $data['mobile']    = $this->session->userdata('mobile');
    $data['firstname'] = $this->session->userdata('firstname');
    $data['approvalsteps']  =  $this->abs->get_approval_steps( );
    $data['charges']   =  $this->abs->get_institutions_charges( );
    
    $refno =  "{$refno_part1}/{$refno_part2}";

    $data_raw = $this->abs->get_application_by_email_appno($email, $refno);
    
    if(!($data_raw))
    {
	  die("Application Not Found");
	}
	
	
    //$data_raw = $this->applications->get_by_id($id);

    if($data_raw){
     foreach($data_raw as $field=>$value){

      if(strstr($field,'paid')  ){
       $data['paids'][$field] = $value;
      }elseif(strstr($field,'payref')  ){
       $data['payrefs'][$field] = $value;
      }elseif(strstr($field,'paytime')  ){
       $data['paytimes'][$field] = $value;
      }elseif(strstr($field,'paymode')  ){
       $data['paymodes'][$field] = $value;
      }elseif(strstr($field,'approved')  ){
       $data['approves'][$field] = $value;
      }elseif(strstr($field,'aprcomment')  ){
       $data['aprcomments'][$field] = $value;
      }elseif(strstr($field,'discomment')  ){
       $data['discomments'][$field] = $value;
      }else{
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }
    }

     $this->load->view("main/frontend/appmine/my_app_view.php", $data );

    }

   public function application_details($id){

    $email             = $this->session->userdata('email');

     if(empty($email)){
       redirect( base_url() .'login' );
     }

    $data = [];
    $data['email']     = $this->session->userdata('email');
    $data['mobile']    = $this->session->userdata('mobile');
    $data['firstname'] = $this->session->userdata('firstname');
    $data['approvalsteps']  =  $this->abs->get_approval_steps( );
    $data['charges']   =  $this->abs->get_institutions_charges( );

    $data_raw = $this->applications->get_by_id($id);

    if($data_raw){
     foreach($data_raw as $field=>$value){

      if(strstr($field,'paid')  ){
       $data['paids'][$field] = $value;
      }elseif(strstr($field,'payref')  ){
       $data['payrefs'][$field] = $value;
      }elseif(strstr($field,'paytime')  ){
       $data['paytimes'][$field] = $value;
      }elseif(strstr($field,'paymode')  ){
       $data['paymodes'][$field] = $value;
      }elseif(strstr($field,'approved')  ){
       $data['approves'][$field] = $value;
      }elseif(strstr($field,'aprcomment')  ){
       $data['aprcomments'][$field] = $value;
      }elseif(strstr($field,'discomment')  ){
       $data['discomments'][$field] = $value;
      }else{
       $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
      }
     }
    }

     $this->load->view("main/frontend/appmine/application_details_view.php", $data );

    }

   public function view_application($id){

    $data = [];
    $data['applyingas_list']      = $this->abs->get_applyas();
    $data['resource_list']        = $this->abs->get_resource_types();
    $data['researchtype_list']    = $this->abs->get_research_types();
    $data['purposes_list']        = $this->abs->get_purposes();
    $data['conservestatus_list']  = $this->abs->get_iucn_red_list();
    $data['sample_uom_list']      = $this->abs->get_sample_uom();

    $data['yesno_list']      = [];
    $data['yesno_list']['']  = 'Choose option';
    $data['yesno_list'][1]   = 'Yes';
    $data['yesno_list'][2]   = 'No';
    
    $data['positions']      = [];
    $data['positions']['']  = 'Choose option';
    $data['positions'][1]   = 'Yes';
    $data['positions'][2]   = 'No';

    $data['export_answer_list']      = [];
    $data['export_answer_list']['']  = 'Choose option';
    $data['export_answer_list'][1]   = 'Yes';
    $data['export_answer_list'][2]   = 'No';
    $data['urlphoto'] = '';
    

    $data_raw = $this->applications->get_by_id($id);


      if($data_raw){
       foreach($data_raw as $field=>$value){
        $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
       }
      }
       
     
     $resourcetypes       =  valueof($data, 'resourcetypes'); 
     $resourcetypes_array =  []; 
	 
	 if(is_array($resourcetypes)){
	  foreach($resourcetypes as $k=>$v){
		$resourcetypes_array[] = valueof($data['resource_list'], $v); 
		
	  }
	 }
	 
     $data['resourcetypes_str'] =   implode(' , ', $resourcetypes_array);
     
     $this->load->library('pdfgenerator');
     $html     = $this->load->view("application_form_view", $data, true);
     //exit($html);//remove

     $filename = "ABS_PERMIT_REF_{$data_raw->appno}";
     $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');

    }

   public function payment(){

    $id                = $this->input->post('id');
    $stepno            = $this->input->post('stepno');
    $instcode          = $this->abs->get_step_institution( $stepno );
    $data['stepno']    = $stepno;
    $data['instcode']  = $instcode;
    $data['charges']   = $this->abs->get_institutions_charges( );
    $data['institution']   = $this->abs->get_institutions_by_code( $instcode );
    $data['approvalsteps']  =  $this->abs->get_approval_steps( );
    $data['email']     = $this->session->userdata('email');
    $data['mobile']    = $this->session->userdata('mobile');
    $data['amount']    = valueof( $data['charges'], $instcode );

    $data_raw = $this->applications->get_by_id($id);

    if($data_raw){
     foreach($data_raw as $field=>$value){
      $data[$field]      = isJSON($value) ? json_decode($value , true) : $value;
     }
    }
    //print_pre($data);//remove

     $this->load->view("main/frontend/appmine/payment_view", $data );

    }

   public function init_mpesa_stkpush(){

    $id                = $this->input->post('id');
    $stepno            = $this->input->post('stepno');
    $mobilempesa       = $this->input->post('mobile');

    $instcode          = $this->abs->get_step_institution( $stepno );
    $institution       = $this->abs->get_institutions_by_code( $instcode );
    $amount            = $institution->charges;

    $data_raw = $this->applications->get_by_id($id);

    $lipa_na_mpesa = self::lipa_na_mpesa( $mobilempesa, $amount, $instcode, "ABS Permit Payment {$data_raw->appno}" );

    $lipa_na_mpesa_status = valueof($lipa_na_mpesa, 0);
    $lipa_na_mpesa_msg    = valueof($lipa_na_mpesa, 1);
    $CheckoutRequestID    = valueof($lipa_na_mpesa, 2);

    if($lipa_na_mpesa_status==0){
      echo json_encode([ 'success'=>0, 'message' => $lipa_na_mpesa_msg ]);
    }else{
      $_SESSION['CheckoutRequestID']  =  $CheckoutRequestID;//for querying transaction payment status
      echo json_encode([ 'success'=>1, 'message' => $lipa_na_mpesa_msg ]);
     }

  }

   private function lipa_na_mpesa( $mobileno, $amount, $AccountReference, $TransactionDesc ){

    $mobileno          =  substr_replace($mobileno,'2547',0,2);
    $Timestamp         =  date('Ymdhis');
    $BusinessShortCode =  $this->BusinessShortCode;
    $amount            =  5;//remove
    $Passkey           =  $this->Passkey;
    $Password          =  base64_encode("{$BusinessShortCode}{$Passkey}{$Timestamp}");
    $access_token      =  $this->get_access_token();

    $data = [];
    $data['BusinessShortCode'] = $BusinessShortCode;
    $data['Password'] =  $Password;
    $data['Timestamp'] =  $Timestamp;
    $data['TransactionType'] =  'CustomerPayBillOnline';
    $data['Amount'] =  $amount;
    $data['PartyA'] =  $mobileno;
    $data['PartyB'] =  $BusinessShortCode;
    $data['PhoneNumber'] = $mobileno;
    $data['CallBackURL'] =  'https://abskenya.tk/ipn/';
    $data['AccountReference'] =  $AccountReference;
    $data['TransactionDesc'] =  $TransactionDesc;

    $data_string = json_encode($data);
    $url         = "{$this->base_url}/mpesa/stkpush/v1/processrequest";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array
                                    ('Content-Type:application/json',
                                    'Authorization:Bearer '.$access_token.''
                                    )
                );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_VERBOSE, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);

    $curl_response = curl_exec($curl);
    $response      = json_decode($curl_response);

    if(isset($response->fault)){
      $faultstring   = $response->fault->faultstring;
      $detail        = $response->fault->detail->errorcode;
      return [0, $detail];
    }elseif(isset($response->errorCode)){
      $requestId     = $response->requestId;
      $errorCode     = $response->errorCode;
      $errorMessage  = $response->errorMessage;
      return [0, $errorMessage];
    }elseif(isset($response->CheckoutRequestID)){
      $MerchantRequestID     = $response->MerchantRequestID;//25347-1552944-1
      $CheckoutRequestID     = $response->CheckoutRequestID;//ws_CO_27032018111256055
      $ResponseCode          = $response->ResponseCode;//0
      $ResponseDescription   = $response->ResponseDescription;//Success. Request accepted for processing
      $CustomerMessage       = $response->CustomerMessage;//Success. Request accepted for processing
      return [1, $CustomerMessage, $CheckoutRequestID];
    }
  }

   public function check_payment(   ){

    $id                = $this->input->post('id');
    $stepno            = $this->input->post('stepno');
    $instcode          = $this->abs->get_step_institution( $stepno );

    $CheckoutRequestID = $this->session->userdata('CheckoutRequestID');

    $Timestamp         =  date('Ymdhis');
    $BusinessShortCode =  $this->BusinessShortCode;
    $Passkey           =  $this->Passkey;
    $Password          =  base64_encode("{$BusinessShortCode}{$Passkey}{$Timestamp}");
    $access_token      =  $this->get_access_token();

    $data = [];
    $data['BusinessShortCode'] =  $BusinessShortCode;
    $data['Password']          =  $Password;
    $data['Timestamp']         =  $Timestamp;
    $data['CheckoutRequestID'] =  $CheckoutRequestID;

    $data_string = json_encode($data);
    $url         = "{$this->base_url}/mpesa/stkpushquery/v1/query";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array
                                    ('Content-Type:application/json',
                                    'Authorization:Bearer '.$access_token.''
                                    )
                );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_VERBOSE, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);

    $curl_response = curl_exec($curl);
    $response      = json_decode($curl_response);


    if(isset($response->fault)){
      $faultstring   = $response->fault->faultstring;
      $detail        = $response->fault->detail->errorcode;
      echo json_encode([ 'success'=>3, 'message' => $detail ]);//3 system core error - network fault
    }elseif(isset($response->errorCode) && isset($response->errorMessage) ){
      $requestId     = $response->requestId;
      $errorCode     = $response->errorCode;
      $errorMessage  = $response->errorMessage;

      if($errorCode=='500.001.1001'){
       $success_id = 10;
       sleep(5);
      }else{
       $success_id = 3;
      }

      echo json_encode([ 'success'=>$success_id, 'message' => $errorMessage ]);//3 system core error - This transaction does not exist
    }elseif(!isset($response->errorCode) && isset($response->MerchantRequestID)  && isset($response->ResultCode) && !empty($response->ResultCode) ){
      $ResultCode    = $response->ResultCode;
      $ResultDesc    = $response->ResultDesc;
      echo json_encode([ 'success'=>2, 'message' => $ResultDesc ]);//2 user error  - STK_CBRequest cancelled by user
    }elseif(isset($response->MerchantRequestID)  && isset($response->ResultCode) && empty($response->ResultCode) ){
      $ResultCode    = $response->ResultCode;
      $ResultDesc    = $response->ResultDesc;

      //mark as paid
      $col_paid    = "paid{$stepno}";
      $col_payref  = "payref{$stepno}";
      $col_paytime = "paytime{$stepno}";
      $col_paymode = "paymode{$stepno}";

      $data_update = [];
      $data_update[$col_paid]    = 1;
      $data_update[$col_payref]  = $CheckoutRequestID;
      $data_update[$col_paytime] = time();
      $data_update[$col_paymode] = 'MPESA';

      $this->applications->update( ['id' => $id], $data_update );
      $emailPermits = self::emailPermits($id);
      unset($_SESSION['CheckoutRequestID']);

      echo json_encode([ 'success'=>1, 'message' => $ResultDesc ,'id' => $id ]);
    }else{
      echo json_encode([ 'success'=>0, 'message' => 'waiting for payment' ]);
    }
  }

   private function get_access_token(){

    $url             = "{$this->base_url}/oauth/v1/generate?grant_type=client_credentials";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    $credentials = base64_encode("{$this->consumer_key}:{$this->consumer_secret}");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_VERBOSE, false);

    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);

    $curl_response = curl_exec($curl);
    curl_close($curl);

    $json      = json_decode($curl_response, false );

    $access_token  = isset($json->access_token) && !empty($json->access_token) ? $json->access_token : null;

    return $access_token;
    }

   private function emailPermits($id){
    $data_raw    = $this->applications->get_by_id($id);
    $pdfs_dir    = FCPATH ."pdfs/{$id}";

    if(is_dir($pdfs_dir)){
     $pdf_list = glob($pdfs_dir.'/*');

     if(count($pdf_list)>0){
      $this->load->library('email');
      $this->config->load('product');

      $companyname       = $this->config->item('companyname');
      $companyemail      = $this->config->item('companyemail');
      $productname       = $this->config->item('productname');

      $subject = "ABS PERMIT {$data_raw->appno} is Ready";
      $message = self::make_email_body_permits( $data_raw->firstname, $data_raw->email, $data_raw->appno, $id );

      $this->email->clear();
      $this->email->from( $companyemail, $companyname );
      $this->email->to( $data_raw->email );
      $this->email->subject( $subject );
      $this->email->message( $message );

      foreach($pdf_list as $pdf){
      $this->email->attach($pdf);
      }

      $send = $this->email->send();

     }
    }

   }

   public function GetPermit($id,$stepno){
    $data_raw       = $this->applications->get_by_id($id);

    $email          = $data_raw->email;

    if(empty($email)) die('Ops!');
    $instcode    = $this->abs->get_step_institution( $stepno );
    $file        = FCPATH ."pdfs/{$id}/{$instcode}.pdf";

    if(is_readable($file)){

    $this->load->helper('download');

    force_download( $file , NULL);

    }else{
     echo "<script>alert('File Not Found');</script>";
    }

   }

    private function make_email_body_permits( $firstname, $email, $appno, $id ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}ApplicationsList/application/{$id}";
          $url           = str_replace('admin.','',$url);

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>Hi {$firstname}</h2></td>
          </tr>

          <tr>
           <td><br>Attached ,find your ABS PERMITS for Application Reference Number <b>{$appno}</b><br>
            <br><br> To view your application, <a href="{$url}">click here</a> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname}</td>
          </tr>

           <tr>
           <td>
             <br>
            <small style="color:#999">
             This message was sent to {$email}  <br>
             From:{$companyname}  <br>
             </small>
           </td>
          </tr>

         </table>

HTML;
 }


 }
