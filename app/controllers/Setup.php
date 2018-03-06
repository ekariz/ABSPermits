<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {
 private $db_adodb;

 public function __construct(){
    parent::__construct();
    $this->load->model('crud_model','setup');
    $this->load->model('Common_model','common');

   }

   public function index(){

   }

  public function steps( $step ){

    $clientid     = $this->session->userdata('clientid');
    $email        = $this->session->userdata('email');
    $connid       = $this->session->userdata('subdomain');

    if(empty($clientid) || empty($email) || empty($connid)){
     $data['success'] = 0;
     $data['message'] = "Something went wrong, refresh page to try again";
     echo json_encode($data);
     exit;
    }

    $connid = strtolower($connid);

    switch($step){
      case  1:
       self::step1( $clientid , $connid );
      break;
      case  2:
       self::step2( $clientid, $connid );
      break;
      case  3:
       self::step3( $clientid , $connid  );
      break;
      case  4:
       self::step4( $clientid , $connid );
      break;
    }

     $next_step = $step+1;
     $end       = $step==4? 1 :0;

     echo json_encode(
      array(
          'success'  =>  1,
          'end'      =>  $end,
          'step'     =>  $next_step,
          'message'  =>  'ok',
        )
      );

  }

  private function step1( $clientid, $connid ){
     global $db;

    $file_config_databases = APPPATH. "config/databases.php";

    include( $file_config_databases );

    if(!isset($db[$connid])){

    $this->load->helper('file');
    $this->config->load('product');

    $dbtype         = 'mysql';
    $dbhost         = 'localhost';
    $dbname         = strtolower('cdb_'.$clientid);
    $dbuser         = 'usr_'.$dbname;
    $dbpass         = generateRandomString(10);

    $this->db->query("CREATE DATABASE IF NOT EXISTS {$dbname}");

    $check_user_num = $this->db->get_where( 'mysql.user', ['User' => $dbuser,'Host' => $dbhost ] )->num_rows();

    if($check_user_num>0){
     $this->db->query("DROP USER '{$dbuser}'@'{$dbhost}'");
    }

    $this->db->query("CREATE USER '{$dbuser}'@'{$dbhost}' IDENTIFIED BY '{$dbpass}'");
    $this->db->query("GRANT ALL PRIVILEGES ON {$dbname}.* TO '{$dbuser}'@'{$dbhost}' IDENTIFIED BY '{$dbpass}'");
    $this->db->query("GRANT FILE ON *.* TO '{$dbuser}'@'{$dbhost}';");
    $this->db->query("FLUSH PRIVILEGES;");

    $code = <<<CFG

\$db['{$connid}'] = array(
    'dsn'   => '',
    'hostname' => '{$dbhost}',
    'username' => '{$dbuser}',
    'password' => '{$dbpass}',
    'database' => '{$dbname}',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => FALSE,
    'cache_on' => FALSE,
    'cachedir' => APPPATH . 'cache/{$connid}',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

CFG;

    if (!write_file($file_config_databases, $code , $mode = 'a+' )){
      //echo 'Unable to write the file';
    }else{
      //echo "written db config file";
    }

    sleep(3);
}


    return true;

  }

  private function step2( $clientid, $connid){
     global $db,$app_root,$db_skeleton;

    $file_db_backup  = APPPATH."../_backups/db-setup.sql";

     if(!is_readable($file_db_backup)){
      $data['success'] = 0;
      $data['message'] = "Something went wrong, refresh page to try again";
      echo json_encode($data);
      exit;
     }

    $file_config_databases  = APPPATH. "config/databases.php";

    include( $file_config_databases );

    if(!isset($db[$connid])){
     self::step1( $clientid, $connid );
     sleep(1);
    }

    $db_client   = $this->load->database( $connid , TRUE );

    $sql_file     = file_get_contents($file_db_backup);
    $string_query = rtrim($sql_file, "\n;" );
    $array_query  = explode(";", $string_query);

    foreach($array_query as $query){
      $db_client->query($query);
    }

    require_once(APPPATH.'third_party/datadict/views.php');

    foreach ($views as $view_name=>$view_sql) {
     $db_client->query("DROP VIEW {$view_name}");
     $db_client->query("CREATE VIEW {$view_name} AS {$view_sql}");
    }

    /**
     *live copy tables
     * */
    $live_copy   = [];
    $live_copy[] = 'sysmods';
    $live_copy[] = 'payitems';
    $live_copy[] = 'payformulars';

    if(sizeof($live_copy)>0){
     foreach($live_copy as $table ){
      $db_client->query("truncate table {$table}");
      $this->db->query("INSERT {$db_client->database}.{$table} SELECT * FROM {$this->db->database}.{$table} ");
     }
    }


    return true;

  }

  private function step3( $clientid, $connid ){

    $clientid     = $this->session->userdata('clientid');
    $email        = $this->session->userdata('email');

    $db_client    = $this->load->database( $connid , TRUE );

    $pryear       = date('Y');
    $prmonth      = date('n');

    $db_client->query("truncate table clients");
    $db_client->query("truncate table companies");
    $db_client->query("truncate table queuemail");
    $db_client->query("truncate table sysrights");
    $db_client->query("truncate table sysusers");
    /**
     * active  period
     */
    if( $db_client->get_where('payperiods', ['pryear' => $pryear, 'prmonth' => $prmonth ] )->num_rows() == 0 ) {
     $data['id']        = generateID( 'payperiods' ,'ID', $db_client);
     $data['pryear']    = $pryear;
     $data['prmonth']   = $prmonth;
     $data['isactive']  = 1;
     $data['audituser'] = 'setup';
     $data['auditdate'] = date('Y-m-d');
     $db_client->insert('payperiods' , $data );
    }

    $db_client->query("update payperiods set isactive=null");
    $db_client->query("update payperiods set isactive=1 where pryear={$pryear} and prmonth={$prmonth} ");

    /**
     * insert  roles
     */
    if( $db_client->get_where('sysroles', ['rolecode' => 'admin' ] )->num_rows() == 0 ) {
     $sysrole['id']        = generateID( 'sysroles' ,'id', $db_client);
     $sysrole['rolecode']  = 'admin';
     $sysrole['rolename']  = 'Administrator';
     $sysrole['audituser'] = 'setup';
     $sysrole['auditdate'] = date('Y-m-d');
     $sysrole['audittime'] = time();
     $db_client->insert('sysroles' , $sysrole );
    }

     $client = $this->db->select('*')
     ->from('clients')
     ->where("email='{$email}' ")
     ->where("clientid={$clientid} ")
     ->get();

     $row    = $client->row();

    /**
     * insert default user
     */
    if( $db_client->get_where('sysusers', ['email' => $email ] )->num_rows() == 0 ) {
     $sysuser['id']         = generateID( 'sysusers' ,'id', $db_client);
     $sysuser['email']      = $row->email;
     $sysuser['password']   = $row->password;
     $sysuser['username']   = ($row->fullname);
     $sysuser['rolecode']   = 'admin';
     $sysuser['audituser']  = 'setup';
     $sysuser['auditdate']  = date('Y-m-d');
     $sysuser['audittime']  = time();
     $db_client->insert('sysusers' , $sysuser );
    }

    $setup_company = $this->db->select('*')
     ->from('companies')
     ->where("clientid={$clientid} ")
     ->get();

     $row_company    = $setup_company->row();

    /**
     * insert company
     */
    if( $db_client->get_where('hrcompany')->num_rows() == 0 ) {
     $company['id']           = 1;
     $company['companyname']  = $row_company->companyname;
     $company['address']      = $row_company->address;
     $company['email']        = $row_company->email;
     $company['phone1']       = $row_company->telephone;
     $company['authsig1']     = $row_company->contact;
     $company['workdays']     = '26';
     $company['workhrs']      = '9';
     $company['audituser']    = 'setup';
     $company['auditdate']    = date('Y-m-d');
     $company['audittime']    = time();
     $db_client->insert('hrcompany' , $company );
    }

    /**
     * insert default business branch
     */
    if( $db_client->get_where('hrbranches' )->num_rows() == 0 ) {
     $branch['id']           = 1;
     $branch['brccode']      = 'M';
     $branch['brcname']      = 'HEAD OFFICE';
     $branch['email']        = $row_company->email;
     $branch['telephone']    = $row_company->telephone;
     $branch['audituser']    = 'setup';
     $branch['auditdate']    = date('Y-m-d');
     $branch['audittime']    = time();
     $db_client->insert('hrbranches' , $branch );
    }

   return true;

  }

  private function step4( $clientid, $connid ){

          $this->config->load('product');

          $clientid     = $this->session->userdata('clientid');
          $email        = $this->session->userdata('email');
          $db_client    = $this->load->database( $connid , TRUE );

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');

          $client = $this->db->select('*')
          ->from('clients')
          ->where("email='{$email}' ")
          ->where("clientid={$clientid} ")
          ->get();

         $row_client   = $client->row();

         $setup_company = $this->db->select('*')
          ->from('companies')
          ->where("clientid={$clientid} ")
          ->get();

          $row_company    = $setup_company->row();

          $accessurl      = valueof($row_company, 'accessurl');
          $email_company  = valueof($row_company, 'email');
          $email_client   = valueof($row_client, 'email');

          if(empty($accessurl)){
           $base_url      = base_url();
           $replace       = ['http://', 'https://', 'www'];
           $host          = str_replace( $replace, '', $base_url );
           $url           = "http://{$connid}.{$host}";
           $accessurl     =  strtolower($url);
          }

          $email_subject      = "{$productname} for {$companyname} is Ready";
          $email_body_client  = self::make_email_body( $email , $accessurl );
          $email_body_company = self::make_email_body( $email , $accessurl );

          $this->common->queue_mail( $email_client, $email_subject, $email_body_client );
          $this->common->queue_mail( $email_company, $email_subject, $email_body_company );

          self::reset();
          return true;

  }

  public function reset(){
    $array_items = ['clientid','email','subdomain','fullname'];
    $this->session->unset_userdata($array_items);
  }

  private function make_email_body( $email , $accessurl ){

          $this->config->load('product');

          $companyname   = $this->config->item('companyname');
          $productname   = $this->config->item('productname');

          return  <<<HTML

          <table id="" style="font-family:Verdana;font-size:14px"  cellpadding="5"  cellspacing="2"   width="100%" border="0">

          <tr>
           <td><br>{$productname} for <b>{$companyname}</b> is ready.</td>
          </tr>

          <tr>
           <td><br><a href="{$accessurl}">Click here</a> to start using <b>{$productname}</b>.</td>
          </tr>

          <tr>
           <td><br>If you have any questions have a look at our online FAQ or call our company service team during working hours.</td>
          </tr>

          <tr>
           <td><br>Best regards  <hr>  {$companyname} Customer Care</td>
          </tr>

           <tr>
           <td>
             <br>
            <small style="color:#999">
             This message was sent to {$email}  <br>
             From:{$companyname} <br>
             </small>

           </td>
          </tr>

          </table>

HTML;
}



}
