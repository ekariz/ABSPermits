<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataCrud extends CI_Controller {
   private $modname;
   private $columntypes = [];
   private $columnsvisibles = [];
   private $columnsrequired = [];
   private $columnselects = [];
   private $gridcolumns = [];

    public function __construct( )
    {
        parent::__construct();
        $this->load->model('crud_model','crud');
        $this->load->model('Common_model','common');
    }

    public function init( $mnid )
    {

        $module        = $this->common->get_app_module_by_id( $mnid );
        $this->modname = $module->modname;

        $modcfg   = [];

        if(isset($module->vars) && !empty($module->vars)){
         $modcfg = unserialize( base64_decode($module->vars) );
        }

        if(empty($modcfg)){
         die('Module Has Not Been Configured');
        }

        $appname = valueof($modcfg, 'table_datatbl');
        $datatbl = valueof($modcfg, 'table_datatbl');
        $datasrc = valueof($modcfg, 'table_datasrc');
        $columns = valueof($modcfg, 'title');
        $columns_visible = valueof($modcfg, 'visible');
        $required = valueof($modcfg, 'required');
        $defaultType = 'text';

        foreach($columns as $column=>$title){
          $forminput_col                   = "forminput_{$column}";
          $input_type                      = valueof($modcfg,$forminput_col, $defaultType );
          $this->columntypes[$column]      = $input_type;
          $visible                         = valueof($columns_visible, $column );
          $this->columnsvisibles[$column]  = $visible;

          if(isset($modcfg['selects'][$column]) && ($visible==1 || $visible==3)){
          $this->columnselects[$column]  = $modcfg['selects'][$column];
          }


          if( ($visible==1 || $visible==2)){
		   /*
		    * grid columns
		    **/
          $this->gridcolumns[$column]      = $title;
          
          /*
           * sortable columns
           **/
          $this->crud->column_order[]      = $column;
          }

        }
		
		/**
		 * form validation required columns
		 */
        foreach($required as $column=>$required_state ){
          if($required_state ==1){
            $this->columnsrequired[$column]  =  true;
	      }else{
			$this->columnsrequired[$column]  =  false;
		  }
        }

        $this->crud->table          = $datatbl;
        $this->crud->dataview       = $datasrc;
        $this->columns              = $columns;
        $this->crud->columns        = $columns;
        $column_order               = array_keys( $this->crud->columns );
        $column_order[]             = null;

        $this->crud->column_search  = array_keys( $this->crud->columns );
        $this->crud->order          = ['id' => 'desc'];

    }

    public function index( $mnid )
    {

        self::init( $mnid );

        $params  =  [
                    'mnid'    => $mnid,
                    'route'   => $this->router->class,
                    'appname' => $this->modname,
                    'columns' => $this->columns,
                    'columntypes' => $this->columntypes,
                    'columnsvisibles' => $this->columnsvisibles,
                    'columnselects' => $this->columnselects,
                    'gridcolumns' => $this->gridcolumns,
                    ];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('system/crud_view', $params);

    }

    public function data( $mnid )
    {
        self::init( $mnid );

        $list = $this->crud->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);

        foreach ($list as $index => $crud) {

        $no++;
        $row = array();

        foreach($this->gridcolumns as $colname => $title){
         if(!is_null($colname)){

         $colvalue = isset($crud->$colname) ? $crud->$colname : null;

         if($colname=='disabled'){

          if(!is_null($colvalue)){
           $colvalue = '<span class="txt-color-red">Yes</span>';
          }else{
           $colvalue = 'No';
          }

         }
         $row[] = $colvalue;
         }
        }

        $row[] = '
              <a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$crud->id."'".')"><i class="fa fa-pencil txt-color-blueDark"></i> </a>
               &nbsp;|&nbsp;
              <a   href="javascript:void(0)" title="Delete" onclick="crud.remove('."'".$crud->id."'".')"><i class="fa fa-trash txt-color-redLight" ></i> </a>
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->crud->count_all(),
                "recordsFiltered" => $this->crud->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($mnid, $id)
    {
        self::init( $mnid );

        $data = $this->crud->get_by_id($id);

        echo json_encode($data);
    }

    public function save( $mnid )
    {
     self::init( $mnid );

     $formValues = $this->input->post(NULL, TRUE);
     $data       = [];

     foreach($formValues as $field => $value)
     {
      if(array_key_exists($field, $this->crud->columns)){
       $data[$field] = $value;
      }
     }

     $this->_validate( $data );

     $this->db->cache_on();
     $colums    = $this->db->list_fields( $this->crud->table );
     $this->db->cache_off();

     $id                     = $this->input->post('id');

     if(in_array('modifydate',$colums)){
      $data['modifydate']    = date('Y-m-d');
     }

     if(in_array('modifyby',$colums)){
      $data['modifyby']      =  $this->session->userdata('userid');
     }

     if(in_array('disabled',$colums)){
     $disabled              = $this->input->post('disabled');
     $data['disabled']      = $disabled==1 ? date('Y-m-d') : null;
     }

     if(empty($id)){
       $this->crud->save($data);
     }else{
       $this->crud->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    public function remove($mnid, $id)
    {
        self::init( $mnid );
        $this->crud->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }


    private function _validate(array $data )
    {
        $status = [];
        $status['error_string'] = [];
        $status['inputerror'] = [];
        $status['status'] = TRUE;

        if(sizeof($data)>0){
         foreach($data as $column=>$value){
          $columntype = valueof( $this->columntypes, $column);

          if($columntype!='checkbox' && $this->columnsrequired[$column] && $value == '')
          {
            $status['inputerror'][]   = $column;
            $status['error_string'][] = $this->crud->columns[$column];
            $status['status'] = FALSE;
          }
         }
        }

        if($status['status'] === FALSE)
        {
            echo json_encode($status);
            exit();
        }
    }

}
