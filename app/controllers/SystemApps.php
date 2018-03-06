<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemApps extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','application');

        $this->application->table       = 'sysapps';

        $this->columns             = [
                                     'appid'      => "App Code",
                                     'appname'    => "App Name",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->application->columns        = array_keys($this->columns);
        $this->application->column_order   = $column_order;
        $this->application->column_search  = ['appid','appname'];
        $this->application->order          = ['id' => 'desc'];
    }

    public function index()
    {
        $appname = 'Applications';
        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    ];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('system/applications_view');
    }

    public function data()
    {
        $list = $this->application->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $application) {

        $no++;
        $row = array();

        foreach($this->application->column_order as $index => $colname){
         if(!is_null($colname)){
         $row[] = $application->$colname;
         }
        }

        $row[] = '
              <a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$application->id."'".')"><i class="fa fa-pencil"></i> Edit</a>
               |
              <a   href="javascript:void(0)" title="Delete" onclick="crud.remove('."'".$application->id."'".')"><i class="fa fa-trash" style="color:red"></i> Delete</a>
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->application->count_all(),
                "recordsFiltered" => $this->application->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data = $this->application->get_by_id($id);
        echo json_encode($data);
    }

    public function save()
    {
     $id = $this->input->post('id');

     $this->_validate();

     $data = array(
                'appid' => $this->input->post('appid'),
                'appname' => $this->input->post('appname'),
                'appicon' => $this->input->post('appicon'),
                'iconclr' => $this->input->post('iconclr'),
            );

     if(empty($id)){
       $this->application->save($data);
     }else{
       $this->application->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    public function remove($id)
    {
        $this->application->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('appid') == '')
        {
            $data['inputerror'][] = 'appid';
            $data['error_string'][] = 'Application Code is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('appname') == '')
        {
            $data['inputerror'][] = 'appname';
            $data['error_string'][] = 'Application Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('appicon') == '')
        {
            $data['inputerror'][] = 'appicon';
            $data['error_string'][] = 'Application Icon is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
