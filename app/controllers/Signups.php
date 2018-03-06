<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signups extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model','signups');
        $this->load->model('Common_model','common');
        $this->load->model('Payroll_model','payroll');

        $this->signups->table       = 'clients';
        $this->signups->dataview    = 'clients';

        $this->columns             = [
                                     'fullname'  => "Full Name",
                                     'mobile'    => "Mobile",
                                     'email'     => "Email",
                                     'verified'  => "Verified",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->signups->columns        = array_keys($this->columns);
        $this->signups->column_order   = $column_order;
        $this->signups->column_search  = ['contact','fullname','mobile','email'];
        $this->signups->order          = ['clientid' => 'desc' , 'fullname' => 'desc' ];
    }

    public function index()
    {

        $data = [];
        $nosearchcolumns = [];
        $nosearchcolumns['address']      = 'address';

        $appname = 'Signups';

        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,

                    ];

        $this->load->library('CustomCrud', $params);
        $this->load->view('signup_view', $data);
    }

    public function data()
    {
        $list = $this->signups->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $signups) {

        $no++;
        $row = array();

        foreach($this->signups->column_order as $index => $colname){
         if(!is_null($colname)){
          $colvalue = isset($signups->$colname) ? $signups->$colname : null;

         if( ($colname=='verified') ){

          if(!is_null($colvalue)){
           $colvalue = '<span class="txt-color-green">Yes</span>';
          }else{
           $colvalue = '<span class="txt-color-red">No</span>';
          }

         }
         $row[] = $colvalue;
         }
        }

        //$row[] = '
               //<a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$signups->id."'".')"><i class="fa fa-pencil"></i> Edit </a>
               //&nbsp;|&nbsp;
              //<a   href="javascript:void(0)" title="Delete" onclick="crud.remove('."'".$signups->id."'".')"><i class="fa fa-trash"></i></a>
              //';

        $row[] = '';
        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->signups->count_all(),
                "recordsFiltered" => $this->signups->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data     = $this->payroll->get_staff_item_by_id( $id );

        echo json_encode($data);
    }

    public function save()
    {

     $id = $this->input->post('id');

     $this->_validate();

     $data = array(
                'staffno' => $this->input->post('staffno'),
                'itmcode' => $this->input->post('itmcode'),
                'pryear'  => $this->input->post('pryear'),
                'prmonth' => $this->input->post('prmonth'),
                'amount'  => $this->input->post('amount'),
            );

     if(empty($id)){
       $this->signups->save($data);
     }else{
       $this->signups->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    public function remove($id)
    {
        $this->signups->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if($this->input->post('staffno') == '')
        {
            $data['inputerror'][] = 'staffname';
            $data['error_string'][] = 'staff is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('itmcode') == '')
        {
            $data['inputerror'][] = 'itmname';
            $data['error_string'][] = 'Item Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pryear') == '')
        {
            $data['inputerror'][] = 'pryear';
            $data['error_string'][] = 'Payroll Year is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('prmonth') == '')
        {
            $data['inputerror'][] = 'minval';
            $data['error_string'][] = 'Payroll Month is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('amount') == '')
        {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
