<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * assign templates to particular modules
 */

class EmailTemplatesAssign extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model','etemplateasg');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->etemplateasg->table       = 'etemplateasg';

    }

    public function index()
    {

         $data  = [];
         $data['templates'] = $this->abs->get_email_template_list();

        $this->load->view('email_templates_assignment_view', $data);
    }

    public function edit()
    {
        $id            = 1;
        $data          = $this->etemplateasg->get_by_id($id);
        $data->success = 1;
        $data->message = 'ok';
        echo json_encode($data);
    }

    public function save()
    {

     $id = 1;

     $this->_validate();

     $exists = $this->db->get_where( $this->etemplateasg->table , ['id' => $id] )->num_rows();

     $data = array(
                'emtpl_sev'   => $this->input->post('emtpl_sev'),

            );

     if(empty($exists)){
       $this->etemplateasg->save($data);
     }else{
       $this->etemplateasg->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    private function _validate()
    {
        $data                          = array();
        $data['error_string']   = array();
        $data['inputerror']      =  array();
        $data['status']            = true;

       if($this->input->post('emtpl_sev') == '')
        {
            $data['inputerror'][]    = 'emtpl_sev';
            $data['error_string'][] = 'Template 1 is required';
            $data['status'] = false;
        }

        if($data['status'] === false)
        {
            echo json_encode($data);
            exit();
        }
    }

}
