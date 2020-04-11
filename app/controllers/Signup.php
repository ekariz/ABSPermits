<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','signups');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');
        $this->load->model('Researcher_model','researcher');
        $this->config->load('product');
        $this->config->load('orcid');
        $this->signups->table  = 'signups';

    }

    public function index(){
     $this->reset();
     $data = [];


     $data['titles']     =  $this->abs->get_titles();
     $data['countries']  =  $this->abs->get_countries();
     $data['genders']    =  ['male' => 'Male','female' => 'female'];

     $this->load->view('main/frontend/signup_view', $data );

    }

    public function reset(){

    $array_items = ['clientid','email','subdomain','fullname'];
    $this->session->unset_userdata($array_items);

    }

   /**
    * save sign up
    */

   public function save(){

     $titlecode        = $this->input->post('titlecode');
     $firstname        = $this->input->post('firstname');
     $midname          = $this->input->post('midname');
     $lastname         = $this->input->post('lastname');
     $fullname         = "{$firstname} {$midname} {$lastname}";
     $gender           = $this->input->post('gender');
     $ctncode          = $this->input->post('ctncode');
     $mobile           = $this->input->post('mobile');
     $email            = $this->input->post('email');
     $password         = $this->input->post('password');
     $passwordconfirm  = $this->input->post('passwordconfirm');
     $terms            = $this->input->post('terms');
     $password_check   = sha1($password);

     if(empty($titlecode)){
      $error = "select title";
     }elseif(empty($gender)){
      $error = "select gender";
     }elseif(empty($ctncode)){
      $error = "select country";
     }elseif(empty($firstname)){
      $error = "enter first name";
     //}elseif(empty($midname)){
      //$error = "enter middle name";
     }elseif(empty($lastname)){
      $error = "enter sur name";
     }elseif(empty($mobile)){
      $error = "enter mobile number";
     }elseif(empty($email)){
      $error = "enter email";
     }elseif(empty($password)){
      $error = "enter password";
     }elseif(empty($passwordconfirm)){
      $error = "enter confirmation password";
     }elseif($password !=$passwordconfirm){
      $error = "confirmation password does not match password";
     }

     /**
      * return error via JSON
      */
     if(!empty($error)){
       $response['success'] = 0;
       $response['message'] = $error;
       echo json_encode( $response );
     }else{


     $response['success']  = 0;
     $response['message']  = '';

     /**
      * check if exists
      */
     $researcher    = $this->researcher->get_researcher_by_email($email , TRUE );

    if(empty($researcher)) {

     $verifycode         = generateRandomString(10);

     $data = [];
     $data['firstname']  = $firstname;
     $data['midname']    = $midname;
     $data['lastname']   = $lastname;
     $data['fullname']   = $fullname;
     $data['gender']     = $gender;
     $data['ctncode']    = $ctncode;
     $data['email']      = $email;
     $data['mobile']     = $mobile;
     $data['title']      = $titlecode;
     $data['password']   = sha1($password);
     $data['regdate']    = date('Y-m-d');
     $data['regtime']    = time();
     $data['verifycode'] = $verifycode;

     /*
      * save researcher
      **/
     $save    = $this->researcher->create($data);

     }

     $response['success']  = 1;
     $response['message']  = "We sent  email verification link to {$email} .Check your inbox for the verification email. If not found , please check you SPAM folder.";

     /*
      * send verification email
      **/
    $researcher      = $this->researcher->get_researcher_by_email( $email , true );
    $verifycode      =  $researcher['verifycode'];
    $host            = base_url();
    $emailvars       = $researcher;
    $emailvars['verificationurl']  = "<a href=\"{$host}Signup/verification/{$verifycode}/?email={$email}\">Click Here</a>";


    $subject = "ABS Email Verification ";
    $message = self::get_email_template( $emailvars , 'emtpl_sev' );
    $this->common->queue_mail( $email, $subject, $message , $firstname , true);

    //}

    echo json_encode( $response );

   }
  }

   /**
    * verify email address
    */
   public function verification( $verifycode ){

      /**
       * clear existing sessions
       */

      $this->reset();

      $email            = $this->input->get('email');

    /*
     * verify  email
    **/
     $researcher      = $this->researcher->get_researcher_by_email( $email   );

      if(isset($researcher) && isset($researcher->verifycode))
      {

        //if verified, login
       if($researcher->verified == 1 && $researcher->hasuploads == 1){
        redirect( base_url() .'login' );
       }

       if($researcher->verifycode == $verifycode){
          $data_update = [];
          $data_update['verified']   = 1;
          $data_update['verifydate'] = date("Y-m-d");
          $update    = $this->researcher->update( $email, $data_update );

       }else{
         die("Invalid Verification Code. Verify from the email we sent to your inbox");
       }

      }

      /**
       * create session
       */

      $register_data               = [];
      $register_data['id']         = $researcher->id;
      $register_data['email']      = $researcher->email;
      $register_data['firstname']  = $researcher->firstname;
      $register_data['midname']    = $researcher->midname;
      $register_data['lastname']   = $researcher->lastname;
      $register_data['fullname']   = $researcher->fullname;

      $this->session->set_userdata( $register_data );

      redirect( base_url() .'Signup/profile/' );

   }

   /*
    * open profile to upload documents
    **/

   public function profile( ){

     $email             = $this->session->userdata('email');

     if(empty($email))
     {
      die("Session Expired.Please Reopen the email verification link");
     }

     $researcher        = $this->researcher->get_researcher_by_email( $email   );

     $data = [];
     $data['titles']      = $this->abs->get_titles();
     $data['countries']   = $this->abs->get_countries();
     $data['genders']     = ['male' => 'Male','female' => 'female'];
     $data['title']       = $researcher->title;
     $data['firstname']   = $researcher->firstname;
     $data['midname']     = $researcher->midname;
     $data['lastname']    = $researcher->lastname;
     $data['gender']      = $researcher->gender;
     $data['ctncode']     = $researcher->ctncode;
     $data['mobile']      = $researcher->mobile;
     $data['email']       = $researcher->email;
	 
     $data['docpassport']    = isJSON($researcher->docpassport) ? json_decode($researcher->docpassport , true) : [];
     $data['docidpass']   = isJSON($researcher->docid) ? json_decode($researcher->docid , true) : [];

     $this->load->view('main/frontend/signup_profile_view', $data );
    }

   /**
    * upload documemnts
    */

   public function upload(){

    $email              = $this->session->userdata('email');

    if(empty($email)){
     echo json_encode( ["success" => 0, 'message' => "login session expired.Please re-login" ] );
     die;
    }

    /**
     * presave form
     */

    if(isset($_FILES)){

        $folderid    = sha1($email);
        $upload_dir  = "./uploads/appdocs/{$folderid}";

        if(!is_dir($upload_dir)){
         if (!mkdir($upload_dir, 0777, true)) {
          echo json_encode( ["success" => 0, 'message' => 'Failed to create folders...'] );
          die;
         }else{
          @touch($upload_dir.'index.html');
          @touch($upload_dir.'index.php');
         }
        }

        $config['upload_path']          = $upload_dir;
        $config['allowed_types']        = 'pdf';
        $config['allowed_types']        = 'pdf|jpg|jpeg|png';
        $config['encrypt_name']         = true;
        $config['remove_spaces']        = true;
        $config['overwrite']            = true;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $expected_files                         =  [];
        $expected_files['docpassport']          = 'Passport Photo';
        //$expected_files['docidpass']            = 'ID/Passport';
        $expected_files['docid']                = 'ID/Passport';

        $documents =  [];

        foreach($expected_files as $expected_file_id => $expected_file_name){
          if( isset($_FILES[$expected_file_id]) && isset($_FILES[$expected_file_id]['tmp_name']) && !empty($_FILES[$expected_file_id]['tmp_name']) ){
           if($this->upload->do_upload($expected_file_id)){
            $upload_response              = $this->upload->data();
            $documents[$expected_file_id] = json_encode($upload_response);
           }else{
            $error =  $this->upload->display_errors();
            $error = strip_tags($error);
            echo json_encode( ["success" => 0, 'message' => "{$expected_file_name}:".$error ] );
            die;
           }
         }
        }

       if(sizeof($documents)>0)
       {

        /**
         * update table
        */

        $num_documents          = count($documents);
        $documents_ids          = array_keys($documents);

        $data_update               = $documents;
        $data_update['hasuploads'] = 1;
        $data_update['auditdate']  = date("Y-m-d");
        $data_update['audittime']  = time();

        $update    = $this->researcher->update( $email, $data_update );

        $s  = $num_documents>1 ? 's' : '';
        echo json_response( 1,  "Uploaded {$num_documents} document{$s}" ,[ 'documents' => $documents_ids] );
        die;
       }

    }

    echo json_encode( ["success" => 0, 'message' => "Nothing Uploaded"] );
    die;
   }

  public function saveProfile( ){

       $required_docs  = 2;
       $email          = $this->session->userdata('email');

       if(empty($email)){
        echo json_encode( ["success" => 0, 'message' => "Session Expired"] );
        die;
       }

       $researcher     = $this->researcher->get_researcher_by_email( $email   );
       $docpassport    = isJSON($researcher->docpassport) ? json_decode($researcher->docpassport , true) : [];
       $docid          = isJSON($researcher->docid) ? json_decode($researcher->docid , true) : [];

       /**
        * check if upload documents
        */
       
       
       /* upload is optional
        *
        $expected_files                         =  [];
        $expected_files['docpassport']          = 'Passport Photo';
        $expected_files['docid']                = 'ID/Passport';

       
       if(!isset($docpassport['file_name']))
       {
           echo json_encode( [ 'success' => 0, 'message' => "Upload {$expected_files['docpassport']}" ] );
           die;
       }elseif(!isset($docid['file_name']))
       {
           echo json_encode( [ 'success' => 0, 'message' => "Upload {$expected_files['docid']}" ] );
           die;
       }
       */
        
       if(isset($docpassport['file_name']))
       {
        $file_name   = $docpassport['file_name'];
        $folderid    = sha1($email);
        $upload_dir  = "uploads/appdocs/{$folderid}/";
        $urlphoto    = base_url() . "{$upload_dir}{$file_name}";

        $data_update = [];
        $data_update['active']   = 1;
        $data_update['urlphoto'] = $urlphoto;
        $update    = $this->researcher->update( $email, $data_update );
	    }
	    
        /**
         *auto-login user
        */

          $register_data               = [];
          $register_data['id']         = $researcher->id;
          $register_data['email']      = $researcher->email;
          $register_data['firstname']  = $researcher->firstname;
          $register_data['midname']    = $researcher->midname;
          $register_data['lastname']   = $researcher->lastname;
          $register_data['fullname']   = $researcher->fullname;
          $register_data['logged_in']  = 1;

          $this->session->set_userdata( $register_data );


         $success = 1;
         $message = 'Profile Saved';

         echo json_encode( [ 'success' => $success, 'message' => $message ] );

   }

  public function LinkOrcid(){

    $data    = [];
    $email   = $this->session->userdata('email');

    if(empty($email)){
     echo json_encode( ["success" => 0, 'message' => "login session expired.Please re-login" ] );
     die;
    }

    $researcher        = $this->researcher->get_researcher_by_email( $email   );

    $data = [];
    $data['title']       = $researcher->title;
    $data['firstname']   = $researcher->firstname;
    $data['midname']     = $researcher->midname;
    $data['lastname']    = $researcher->lastname;
    $data['gender']      = $researcher->gender;
    $data['mobile']      = $researcher->mobile;
    $data['email']       = $researcher->email;

    $data['orcid_client_id']      = $this->config->item('orcid_client_id');
    $data['orcid_redirect_uri']   = $this->config->item('orcid_redirect_uri');
    $data['orcid_scope']          = $this->config->item('orcid_scope');

    $this->load->view('main/frontend/signup_orcid_view', $data );
  }

  private function make_email_body_notify( $firstname, $email, $verifycode ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}Signup/verification/{$verifycode}/?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Account Registration</h2></td>
          </tr>

          <tr>
           <td><br>Hello {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>An account has been created for you at {$productname}  Portal.<br>
            Please follow the link below to activate your account.<br>
            Activation Link >> <a href="{$url}">Activate your Account</a><br>
            <br> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
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

           <tr>
           <td>
             <br>
            <small style="color:#999">
             <a href="{$host}">Home</a> | <a href="{$host}/contacts">Contact Us</a>
             </small>
           </td>
          </tr>

          </table>

HTML;
}

  private function make_email_body_save_continue( $firstname, $email, $accesscode ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}Signup/profile/{$accesscode}/?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Account Registration</h2></td>
          </tr>

          <tr>
           <td><br>Hello {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>Your signed up with {$productname}  Portal.<br>
            Please follow the link below to complete your researcher.<br>
             <a href="{$url}">Complete Signup</a><br>
            <br> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
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

           <tr>
           <td>
             <br>
            <small style="color:#999">
             <a href="{$host}">Home</a> | <a href="{$host}/contacts">Contact Us</a>
             </small>
           </td>
          </tr>

          </table>

HTML;
}

  private function make_email_body_complete( $firstname, $email ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');
          $host          = base_url();
          $url           = "{$host}ApplicationForm?email={$email}";

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><h2>ABS Signup</h2></td>
          </tr>

          <tr>
           <td><br>Hello {$firstname} <br> </td>
          </tr>

          <tr>
           <td><br>Your signed up with {$productname}  is now Complete.<br>
            To apply for an ABS PERMIT, please open the <a href="{$url}"> ABS Harmonized Application Form</a><br>
            <br> </td>
          </tr>

          <tr>
           <td><br>If you received this email in error, you can safely ignore this email.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
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

           <tr>
           <td>
             <br>
            <small style="color:#999">
             <a href="{$host}">Home</a> | <a href="{$host}/contacts">Contact Us</a>
             </small>
           </td>
          </tr>

          </table>

HTML;
}

   private function get_email_template( $data, $applicant_template  ){


          $data['companyname']    =  $this->config->item('companyname');
          $data['productname']    =  $this->config->item('companyname');
          $email_template         =  $this->abs->get_email_template( $applicant_template );

          if(empty($email_template)) return;

          foreach($data as $col=>$value)
          {
              $template_val = "[[{$col}]]";
              if(strstr($email_template, $template_val)){
             $email_template = str_replace($template_val, $value, $email_template);
            }
          }

          return   $email_template;

    }


 }
