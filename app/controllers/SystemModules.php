<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemModules extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','module');
        $this->load->model('Common_model','common');

        $this->module->table       = 'sysmods';

        $this->columns             = [
                                     'appid'      => "App ID",
                                     'modid'      => "Module ID",
                                     'modname'    => "Module Name",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->module->column_order   = $column_order;
        $this->module->column_search  = ['appid','modid','modname'];
        $this->module->order          = ['appid' => 'desc'];
    }

    public function index()
    {
        $modname = 'Applications';
        $params  =  [
                    'route'   => $this->router->class,
                    'modname' => $modname,
                    'columns' => $this->columns,
                    ];

        $data['apps'] = $this->common->select_assoc( 'sysapps', 'appid', 'appname' );
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('system/modules_view', $data);
    }

    public function data()
    {
        $list = $this->module->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $module) {

        $no++;
        $row = array();

        foreach($this->module->column_order as $index => $colname){
         if(!is_null($colname)){
         $row[] = $module->$colname;
         }
        }

        $row[] = '
              <a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$module->id."'".')"><i class="fa fa-pencil"></i> Edit</a>
               |
              <a   href="javascript:void(0)" title="Delete" onclick="crud.remove('."'".$module->id."'".')"><i class="fa fa-trash" style="color:red"></i> Delete</a>
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->module->count_all(),
                "recordsFiltered" => $this->module->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data = $this->module->get_by_id($id);
        echo json_encode($data);
    }

    public function save()
    {
     $id = $this->input->post('id');

     $this->_validate();

     $data = array(
                'appid' => $this->input->post('appid'),
                'modid' => $this->input->post('modid'),
                'modname' => $this->input->post('modname'),
            );

     if(empty($id)){
       $this->module->save($data);
     }else{
       $this->module->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    public function remove($id)
    {
        $this->module->delete_by_id($id);
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
            $data['error_string'][] = 'Application ID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('modid') == '')
        {
            $data['inputerror'][] = 'modid';
            $data['error_string'][] = 'Module ID is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('modname') == '')
        {
            $data['inputerror'][] = 'modname';
            $data['error_string'][] = 'Module Name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
