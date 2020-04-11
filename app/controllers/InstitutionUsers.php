<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  InstitutionUsers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','users');
        $this->load->model('Common_model','common');

        $this->users->table      = 'sysusers';
        $this->users->dataview   = 'viewusers';

        $this->columns             = [
                                     'rolename'    => "Role",
                                     'username'    => "User Name",
                                     'email'       => "Email",
                                     'mobile'      => "Mobile",
                                     'disabled'    => "Disabled",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->users->columns        = array_keys($this->columns);
        $this->users->column_order   = $column_order;
        $this->users->column_search  = ['rolename','username','email','mobile'];
        $this->users->order          = ['email' => 'desc'];
    }

    public function index()
    {
        $appname      = 'Users';
        $roles        = $this->common->select_assoc( 'sysroles', 'rolecode', 'rolename',"rolecode='AP'");

        $params  =  [
                    'route'    => $this->router->class,
                    'appname'  => $appname,
                    'columns'  => $this->columns,
                    'roles'    => $roles,
                    ];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('users_institution_view', $params);
    }

    public function data()
    {
        $list   = $this->users->get_datatables();

        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);

        $userid   = $this->session->userdata('userid');
        $numusers = sizeof($list);

        foreach ($list as $index => $users) {
        $audituser  = $users->audituser;

        if($userid == $audituser) {
        $allow_edit = $numusers>1 && ($users->id != $userid) ?  true : false;

        $no++;
        $row = array();

        foreach($this->users->column_order as $index => $colname){
         if(!is_null($colname)){

          $colvalue = isset($users->$colname) ? $users->$colname : null;

         if( $colname=='disabled' ){

          if(!is_null($colvalue)){
           $colvalue = '<span class="txt-color-red">Yes</span>';
          }else{
           $colvalue = 'No';
          }

         }
         $row[] = $colvalue;
         }
        }

        if($allow_edit){
         $row[] = '
              <a   href="javascript:void(0)" class="txt-color-blue" title="Edit" onclick="crud.edit('."'".$users->id."'".')"><i class="fa fa-pencil"></i> edit </a>
               |
              <a   href="javascript:void(0)" class="txt-color-red" title="Delete" onclick="crud.remove('."'".$users->id."'".')"><i class="fa fa-trash"></i> </a>
              ';
        }else{
         $row[] = '
              <a   href="javascript:void(0)" class="txt-color-blue" title="Edit" onclick="crud.edit('."'".$users->id."'".')"><i class="fa fa-pencil"></i> edit </a>
              ';
        }

        $data[] = $row;

        }
      }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->users->count_all(),
                "recordsFiltered" => $this->users->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data = $this->users->get_by_id($id);
        echo json_encode($data);
    }

    public function save()
    {
     $id = $this->input->post('id');

     $new = empty($id) ? true : false;

     $this->_validate( $new );

     $rolecode    = $this->input->post('rolecode');
     $username    = $this->input->post('username');
     $password    = $this->input->post('password');
     $mobile      = $this->input->post('mobile');
     $email       = $this->input->post('email');
     $disabled    = $this->input->post('disabled');
     $instcode    = $this->session->userdata('instcode');//instcode

     $data = array(
                'rolecode'    => $rolecode,
                'username'    => $username,
                'mobile'      => $mobile,
                'email'       => $email,
                'instcode'    => $instcode,
            );

     if(!empty($password))
     {
     $data['password']      = sha1($password);
     }

     $data['modifydate']    = date('Y-m-d');
     //$data['modifyby']      =  $this->session->userdata('userid');
     $data['disabled']      =  $disabled ==1 ? date('Y-m-d') : null;

     if(empty($id)){
       $id   = $this->users->save($data);
       echo json_encode( ["status" => true, 'message' => 'Saved.' ] );
     }else{
       $save = $this->users->update( ['id' => $id ], $data );
       echo json_encode( ["status" => true, 'message' => 'Updated' ] );
     }

    }

    public function remove($id)
    {
        $this->users->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }


    private function _validate( $new )
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');


        if($this->input->post('rolecode') == '')
        {
            $data['inputerror'][] = 'rolecode';
            $data['error_string'][] = 'Role is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('username') == '')
        {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'User Name is required';
            $data['status'] = FALSE;
        }

        if($mobile == '')
        {
            $data['inputerror'][] = 'mobile';
            $data['error_string'][] = 'Mobile is required';
            $data['status'] = FALSE;
        }

        if($email == '')
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email is required';
            $data['status'] = FALSE;
        }

       if($new){

         if( $this->db->get_where( $this->users->table, ['email' => $email] )->num_rows() > 0 ) {
            $data['inputerror'][]   = 'email';
            $data['error_string'][] = "{$email} already regisered with another user.";
            $data['status'] = FALSE;
         }

        if( $this->db->get_where( $this->users->table, ['mobile' => $mobile] )->num_rows() > 0 ) {
            $data['inputerror'][]   = 'mobile';
            $data['error_string'][] = "{$mobile} already registered with another user.";
            $data['status'] = FALSE;
        }

        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
