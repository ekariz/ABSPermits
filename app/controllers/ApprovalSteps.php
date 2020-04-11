<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApprovalSteps extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','approvalsteps');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->approvalsteps->table     = 'approvesteps';
        $this->approvalsteps->dataview  = 'viewapprovesteps';

        $this->columns             = [
                                     'stepno'     => "Step No",
                                     'stepname'   => "Step Name",
                                     'instname'   => "Institution Name",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->approvalsteps->columns        = array_keys($this->columns);
        $this->approvalsteps->column_order   = $column_order;
        $this->approvalsteps->column_search  = array_keys($this->columns);
        $this->approvalsteps->order          = ['stepno' => 'desc'];
    }


    public function index()
    {

        $nosearchcolumns        =  [];
        $data                   =  [];
        $data['templates']      = $this->abs->get_email_template_list();
        $data['institutions']   = $this->abs->get_institutions_assoc();
		

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        $appname = 'Approval Step';

        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,
                    ];

        $this->load->library('CustomCrud', $params);
        $this->load->view('approval_steps_view', $data);
    }

     public function data()
    {
        $list = $this->approvalsteps->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $line) {

        $no++;
        $row = array();

        foreach($this->approvalsteps->column_order as $index => $colname){
          $value       = isset($line->$colname) ? $line->$colname : null;

         if(strstr($colname,'active')){
          $icon           = $value ? 'check success' : 'hourglass gray';
          $row[]          = "<i class=\"fa fa-{$icon}\"></i>";
         }else{
          if(!is_null($colname)){
           $row[] = $value;
          }
         }
        }

       $row[] = '
       <a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$line->id."'".')"><i class="fa fa-pencil"></i> Edit </a>
       &nbsp;|&nbsp;
       <a   href="javascript:void(0)" title="Delete" onclick="crud.remove('."'".$line->id."'".')"><i class="fa fa-trash"></i></a>
       ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->approvalsteps->count_all(),
                "recordsFiltered" => $this->approvalsteps->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit( $id )
    {
        $data        = $this->approvalsteps->get_by_id($id);

        $data->success = 1;
        $data->message = 'ok';
        echo json_encode($data);
    }

    public function save()
    {

     $id      =  $this->input->post('id');
     $stepno  =  $this->input->post('stepno');

     $this->_validate();

     $exists = $this->db->get_where( $this->approvalsteps->table , ['stepno' => $stepno] )->num_rows();

     $data = array(
                'stepno'       => $this->input->post('stepno'),
                'stepname'     => $this->input->post('stepname'),
                'stepdesc'     => $this->input->post('stepdesc'),
                'instcode'     => $this->input->post('instcode'),
                'emtplaplapr'  => $this->input->post('emtplaplapr'),
                'emtplapldsp'  => $this->input->post('emtplapldsp'),
                'emtplinsapr'  => $this->input->post('emtplinsapr'),
                'emtplinsdsp'  => $this->input->post('emtplinsdsp'),
            );

     if(empty($exists)){
       $this->approvalsteps->save($data);
     }else{
       $this->approvalsteps->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    private function _validate()
    {
        $data                    = array();
        $data['error_string']    = array();
        $data['inputerror']      = array();
        $data['status']          = true;

       if($this->input->post('stepno') == '')
        {
            $data['inputerror'][]    = 'stepno';
            $data['error_string'][] = 'Step no is required';
            $data['status'] = false;
        }

       if($this->input->post('stepname') == '')
        {
            $data['inputerror'][]    = 'stepname';
            $data['error_string'][] = 'Step Name  is required';
            $data['status'] = false;
        }

       if($this->input->post('stepdesc') == '')
        {
            $data['inputerror'][]    = 'stepdesc';
            $data['error_string'][] = 'Step Description is required';
            $data['status'] = false;
        }

       if($this->input->post('instcode') == '')
        {
            $data['inputerror'][]    = 'instcode';
            $data['error_string'][] = 'Approving Institutions is required';
            $data['status'] = false;
        }

       if($this->input->post('emtplaplapr') == '')
        {
            $data['inputerror'][]    = 'emtplaplapr';
            $data['error_string'][] = 'Workflow - Approved Notification to Applicant is required';
            $data['status'] = false;
        }

       if($this->input->post('emtplapldsp') == '')
        {
            $data['inputerror'][]    = 'emtplapldsp';
            $data['error_string'][] = 'Workflow - DisApproval Notification to Applicant is required';
            $data['status'] = false;
        }

       if($this->input->post('emtplinsapr') == '')
        {
            $data['inputerror'][]    = 'emtplinsapr';
            $data['error_string'][] = 'Workflow - Approval Notification to Approver is required';
            $data['status'] = false;
        }

       if($this->input->post('emtplinsdsp') == '')
        {
            $data['inputerror'][]    = 'emtplinsdsp';
            $data['error_string'][] = 'Workflow - DisApproval Notification to Approver is required';
            $data['status'] = false;
        }

        if($data['status'] === false)
        {
            echo json_encode($data);
            exit();
        }
    }

}
