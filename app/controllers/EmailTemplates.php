<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailTemplates extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('crud_model','template');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->template->table            = 'etemplates';
        $this->template->dataview      = 'etemplates';

        $this->columns   = [
                                     'templatename'    => "Template Name",
                                     'template'            => "Template Description",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->template->columns              = array_keys($this->columns);
        $this->template->column_order     = $column_order;
        $this->template->column_search   = ['templatename','templatename' ];
        $this->template->order                  = ['templatename' => 'desc'];
    }

    public function index()
    {

        $nosearchcolumns =  [];
        $nosearchcolumns['templatedesc']   = 'templatedesc';

        $appname = 'Email Templates';
        $params  =  [
                    'route'       => $this->router->class,
                    'appname' => $appname,
                    'columns'  => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,
                    ];

        $data  =  [];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('email_templates_view', $data);
    }

    public function add()
    {
        $appname               = 'Create New Email Template';
        $data                      =  [];
        $data['tmplref']      = mt_rand();
        $data['tempvars']   = $this->common->select_assoc( 'etemplatevars', 'colno', 'coldesc');
        $this->load->view('email_templates_add_view', $data);
    }

    public function edit($id)
    {

        $data_raw    = $this->template->get_by_id($id);

        foreach($data_raw as $k=>$v){
          $data[$k] =$v;
        }
        
        $data['tempvars']   = $this->common->select_assoc( 'etemplatevars', 'colno', 'coldesc');

        $appname = 'Edit Email Template';
 
        $this->load->view('email_templates_edit_view', $data);

    }
 
    public function data()
    {

        $list    = $this->template->get_datatables();
        $data  = array();
        $no     =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        
        foreach ($list as $index => $template) {

        $no++;
        $row = array();
        $replace = array("'","’");

        foreach($this->template->column_order as $index => $colname){
         if(!is_null($colname)){
			 
         $colvalue = isset($template->$colname) ? $template->$colname : null;
         $colvalue = str_replace($replace,'',$colvalue);

         if( ($colname=='template') ){
           $colvalue = substr(strip_tags(trim($colvalue)),0, 50).'...';
         }

         $row[] = $colvalue;
         }
        }

        $row[] = '
              <a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$template->id."'".')"><i class="fa fa-pencil"></i> Edit</a>
              &nbsp;
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->template->count_all(),
                "recordsFiltered" => $this->template->count_filtered(),
                "data" => $data,
                );


        echo json_encode($output);
    }
 
   public function save()
    {

    $id    = $this->input->post('id');
    $this->_validate();

    $tmplref                        = $this->input->post('tmplref');
    $templatename            = $this->input->post('templatename');
    $template                    = $this->input->post('template');

    $data = array(
        'tmplref'                     => $tmplref,
        'templatename'          => $templatename,
        'template'                  => $template,
    );
    
     /**
      * try update
      */
      
      if( $this->db->get_where( $this->template->table, ['tmplref' => $tmplref] )->num_rows() > 0 ) {
       $save_id  = $this->template->update( ['tmplref' => $tmplref ], $data );
      }elseif(empty($id)){
       $save_id  = $this->template->save($data);
     }
 
     echo json_encode( ["success" => 1, 'message' => 'Template Saved' ] );

    }

    public function remove($id)
    {
        $this->template->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $data['message'] = 'Fill in all fields';

        if($this->input->post('templatename') == '')
        {
            $data['error_string'][] = 'Template Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('template') == '')
        {
            $data['inputerror'][] = 'template';
            $data['error_string'][] = 'Template is required';
            $data['status'] = FALSE;
        }
         
        if($data['status'] === FALSE)
        {
            echo json_response(0,$data['message'] );
            exit();
        }
    }

}
