<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataDict extends CI_Controller {
 private $db_adodb;

 public function __construct(){
    parent::__construct();
    $this->load->model('crud_model','datadict');

   }

  public function tables(){

   include(APPPATH. "config/database.php");

   $data                   = [];
   $data['xmls'][]         = '';
   $data['connections'][]  = '';

   $active_database = $this->db->database;

   if(sizeof($db)>0){
     foreach($db as $db_index=>$db_cfg){
      $check_database = valueof($db_cfg, 'database');

      if($check_database == $active_database){
       $data['active_database']         =  $db_index;
      }
       $data['connections'][$db_index]  =  $db_index;
      }

    }

   $xml_files_dir   = APPPATH.'third_party/datadict/';
   $config_dir      = APPPATH.'config/';
   $files_list      = glob($xml_files_dir . "*.xml");

   if(sizeof($files_list)>0){
     foreach($files_list as $fullFileName){
      if(!strstr($fullFileName,'pivot')){
       $pathinfo   =  pathinfo($fullFileName);
       $filename   =  $pathinfo['basename'];
       $data['xmls'][$filename] = $filename;
      }
     }
    }

    $data['active_xml']              =  'clients.xml';

    $this->load->view('system/tables_view' , $data );

}

  public function views(){

   include(APPPATH. "config/database.php");

   $data                   = [];
   $data['xmls'][]         = '';
   $data['connections'][]  = '';

   $active_database = $this->db->database;

   if(sizeof($db)>0){
     foreach($db as $db_index=>$db_cfg){
      $check_database = valueof($db_cfg, 'database');

      if($check_database == $active_database){
       $data['active_database']         =  $db_index;
      }
       $data['connections'][$db_index]  =  $db_index;
      }

    }

    $this->load->view('system/views_view' , $data );

}

  public function datacopy(){

   include(APPPATH. "config/database.php");

   $data                   = [];
   $data['xmls'][]         = '';
   $data['connections'][]  = '';
   $data['blank_array'][]  = '';
   $data['copymodes']['a']  = 'Append to Existing Data';
   $data['copymodes']['t']  = 'Truncate Destination first';

   $active_database = $this->db->database;

   if(sizeof($db)>0){
     foreach($db as $db_index=>$db_cfg){
      $check_database = valueof($db_cfg, 'database');

      if($check_database == $active_database){
       $data['active_database']         =  $db_index;
      }
       $data['connections'][$db_index]  =  $db_index;
      }

    }

    $this->load->view('system/datacopy_view' , $data );

  }

  public function list_tables( ){
    global $db;

    $connection    = $this->input->post('conn');
    $table_source  = $this->input->post('table_source');
    $db_copy       = $this->load->database( $connection , TRUE );

    $tables_array = [];
    $tables_list  = $db_copy->list_tables();

    $skip_table = '';

    if($tables_list && sizeof($tables_list)>0){
     foreach($tables_list as $index=>$table){
      if(!strstr($table,'view') && $table!=$skip_table ){
       $tables_array[$table]  = $table;
      }
     }
    }

    ksort($tables_array);

    foreach($tables_array as $table ){
     $data[] = [ 'id'=>$table , 'name'=>$table ];
    }

    echo json_encode($data);

    //echo  form_dropdown('table_col_datasrc',$tables_array,$table_datatbl,"id=\"table_col_datasrc\" onchange=\"app.list_columns_select_src();\" class=\"form-control\"  " );

    }

  public function load_tables(){

    $connection  = $this->input->post('connection');
    $xml         = $this->input->post('xml');

    require_once(APPPATH.'libraries/adodb/adodb-php/adodb.inc.php');
    require_once(APPPATH.'libraries/adodb/adodb-php/adodb-xmlschema03.inc.php');

    include(APPPATH. "config/database.php");

    $hostname = $db[$connection]['hostname'];
    $username = $db[$connection]['username'];
    $password = $db[$connection]['password'];
    $database = $db[$connection]['database'];

    unset($db);

    $this->db_adodb = ADONewConnection('mysqli');
    $this->db_adodb->Connect($hostname,$username,$password,$database);
    $this->db_adodb->SetFetchMode(ADODB_FETCH_ASSOC);

    $ADODB_ASSOC_CASE       = 0;
    $ADODB_ACTIVE_CACHESECS = 30;
    $this->db_adodb->debug  = 0;

    error_reporting(-1);
    ini_set('display_errors', 1);

    $schemaFile   = APPPATH."third_party/datadict/{$xml}";
    $schema       = new adoSchema( $this->db_adodb );
    $schema->SetUpgradeMethod('ALTER');
    $schema->continueOnError = true;
    $sql    = $schema->ParseSchema($schemaFile);
    $result = $schema->ExecuteSchema();
    $sql    = $schema->sqlArray;

    echo '<pre>';
     print_r($sql);
    echo '</pre>';//remove


}

  public function load_views(){

    require_once(APPPATH.'libraries/adodb/adodb-php/adodb.inc.php');
    require_once(APPPATH.'third_party/datadict/views.php');

    $connection  = $this->input->post('connection');

    include(APPPATH. "config/database.php");

    //$connection = 'default';

    $hostname = $db[$connection]['hostname'];
    $username = $db[$connection]['username'];
    $username = $db[$connection]['username'];
    $password = $db[$connection]['password'];
    $database = $db[$connection]['database'];

    unset($db);

    $this->db_adodb = ADONewConnection('mysqli');
    $this->db_adodb->Connect($hostname,$username,$password,$database);
    $this->db_adodb->SetFetchMode(ADODB_FETCH_ASSOC);

    $ADODB_ASSOC_CASE       = 0;
    $ADODB_ACTIVE_CACHESECS = 30;
    $this->db_adodb->debug  = 0;//remove

    echo "<table>";

    $error_replace = array('"',"'");

    foreach ($views as $view_name=>$view_sql) {

    echo "<tr>\r\n";
        $test = 1;
        $error = $this->db_adodb->ErrorMsg();
        $error = '';
        if(isset($test) && empty($error)){

           @$this->db_adodb->Execute("DROP VIEW {$view_name}");
           @$this->db_adodb->Execute("DROP TABLE {$view_name}");

           echo  "<td>Creating view {$view_name} </td> \r\n";

           if(!$this->db_adodb->Execute("CREATE VIEW {$view_name} AS {$view_sql}")){

             $error  = "Error Creating view {$view_name} \\n ";
             $error  .= str_replace($error_replace,'',$this->db_adodb->ErrorMsg());

            echo  "<td style=\"cursor:pointer\" onclick=\"javascript:alert('{$error}');\">-X</td>\r\n ";
           }else{

            echo  "<td>-OK</td>\r\n ";
           }

         }
    echo "<tr>\r\n";

    }//foreach

    echo "<table>";

  }

  public function copy(){

    $connection_source       = $this->input->post('connection_source');
    $connection_destination  = $this->input->post('connection_destination');
    $table_source            = $this->input->post('table_source');
    $table_destination       = $this->input->post('table_destination');
    $copymode                = $this->input->post('copymode');

    if(empty($copymode)){
      die("<script>alert('Select Copy Mode');</script>");
    }

    if(empty($connection_source)){
      die("<script>alert('Select Source Connection');</script>");
    }

    if(empty($connection_destination)){
      die("<script>alert('Select destination Connection');</script>");
    }

    if(empty($table_source)){
      die("<script>alert('Select Source table');</script>");
    }

    if(empty($table_destination)){
      die("<script>alert('Select destination table');</script>");
    }

    if($connection_source==$connection_destination){
      die("<script>alert('Source Connection cannont be same a destination Connection');</script>");
    }

    if($table_source!=$table_destination){
      die("<script>alert('Source table must be same as destination table');</script>");
    }

    $db_source               = $this->load->database( $connection_source , TRUE );
    $db_destination          = $this->load->database( $connection_destination , TRUE );

    $db_source->select('*');
    $db_source->from($table_source);
    $result = $db_source->get();

    $num_rows    = $result->num_rows();
    $num_copied  = 0;

    if( $num_rows > 0)
    {

       if($copymode=='t'){
        $db_destination->query("truncate table {$table_destination}");
       }

     foreach ($result->result_array() as $row)
      {

        $data   =  [];

        foreach($row as $col => $val )
        {
         $data[$col] =  $val;
        }

        if(sizeof($data)>0){
          if( $db_destination->insert($table_destination, $data) )
          {
            ++$num_copied;
          }
        }

     }

    }

    echo "
     <div class=\"alert alert-info\">Source : {$num_rows} Rows.</div>
     <div class=\"alert alert-success\">Copied :{$num_copied} Rows</div>
    ";

  }

}
