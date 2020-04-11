<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Researchers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model','applicants');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->applicants->table          = 'researchers';
        $this->applicants->dataview       = 'viewresearchers';

        $this->columns             = [
                                     'fullname'       => "Full Name",
                                     'idpassno'       => "ID/Passport",
                                     'email'          => "Email",
                                     'ctnname'        => "Country",
                                     'verified'       => "Verified",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->applicants->columns             = array_keys($this->columns);
        $this->applicants->column_order    = $column_order;
        $this->applicants->column_search   = array_keys($this->columns);
        $this->applicants->order                 = ['id' => 'desc' , 'email' => 'desc' ];
    }

    public function index()
    {

        $data = [];
        $nosearchcolumns = [];
        //$nosearchcolumns['verified']      = 'verified';

        $appname                          = 'Applicants';
       //$data['qualifications']          = $this->abs->get_qualifications_name_as_value();
        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,

                    ];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('applicants_view', $data);
    }

    public function data()
    {
        $list = $this->applicants->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $applicants) {

        $no++;
        $row = array();

        foreach($this->applicants->column_order as $index => $colname){
         if(!is_null($colname)){
          $colvalue = isset($applicants->$colname) ? $applicants->$colname : null;

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

        $row[] = '
               <a   href="javascript:void(0)" title="Edit" onclick="crud.edit('."'".$applicants->id."'".')"><i class="fa fa-pencil"></i> Edit </a>
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->applicants->count_all(),
                "recordsFiltered" => $this->applicants->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit( $id )
    {
        $data_raw        = $this->applicants->get_by_id($id);
       
        foreach($data_raw as $k=>$v){
        $data[$k]       = $v;
        }
 
        unset($data['docid']);
        unset($data['docpassport']);
		
        $data['success'] = 1;
        $data['message'] = 'ok';
        $data['div_image'] =   '<img src="' .base_url(). 'assets/img/blank.jpeg" width="200" height="200" >';
        $data['link_id']   =  "ID/Passport No <i class=\"fa fa-credit-card\"></i> ";
        
        if(isset($data_raw->urlphoto) && !empty($data_raw->urlphoto))
        {
         $data['div_image']    = "<img src=\"{$data_raw->urlphoto}\" width=\"200\" height=\"200\">";
        }
        
        if(isset($data_raw->urlid) && !empty($data_raw->urlid))
        {
         $data['link_id']    = "<a href=\"{$data_raw->urlid}\" target=\"_blank\"  >ID/Passport No <i class=\"fa fa-credit-card\"></i></a>";
        }
        
        echo json_encode($data);
    }
       
   public function search_country( ){

    $phrase  = $this->input->post('phrase');
    $data      =  $this->abs->search_records( 'countries', 'ctncode', 'ctnname', $phrase,$limit=5 );
    echo json_encode($data);
    
   }
    
    public function save()
    {

     $id = $this->input->post('id');

     $this->_validate();
 
	$data['idpassno']         =  $this->input->post('idpassno'); 
	$data['ctncode']          =  $this->input->post('ctncode'); 
	$data['firstname']        =  $this->input->post('firstname'); 
	$data['title']            =  $this->input->post('title'); 
	$data['midname']          =  $this->input->post('midname'); 
	$data['dob']              =  $this->input->post('dob'); 
	$data['lastname']         =  $this->input->post('lastname'); 
	$data['gender']           =  $this->input->post('gender'); 
	$data['specarea']         =  $this->input->post('specarea'); 
	$data['idpassip']         =  $this->input->post('idpassip'); 
	$data['idpassdi']         =  $this->input->post('idpassdi'); 
	$data['prmpcode']         =  $this->input->post('prmpcode'); 
	$data['prmaddress']       =  $this->input->post('prmaddress'); 
	$data['prmphone']         =  $this->input->post('prmphone'); 
	$data['email']            =  $this->input->post('email'); 
	
	$data['prmtown']          =  $this->input->post('prmtown'); 
	$data['secpcode']         =  $this->input->post('secpcode'); 
	$data['secaddress']       =  $this->input->post('secaddress'); 
	$data['secphone']         =  $this->input->post('secphone'); 
	$data['sectown']          =  $this->input->post('sectown'); 
	$data['secresidence']     =  $this->input->post('secresidence'); 
	$data['emppcode']         =  $this->input->post('emppcode'); 
	$data['empaddress']       =  $this->input->post('empaddress'); 
	$data['emphone']          =  $this->input->post('emphone'); 
	$data['emptown']          =  $this->input->post('emptown'); 
	$data['empctncode']       =  $this->input->post('empctncode'); 
	
	$data['institutionname']   =  $this->input->post('institutionname'); 
	$data['prmresidence']      =  $this->input->post('prmresidence'); 
	$data['qualification']     =  $this->input->post('qualification'); 

     if(empty($id)){
       $this->applicants->save($data);
     }else{
       $this->applicants->update( ['id' => $id], $data );
     }

     echo json_encode( ["status" => true, 'message' => 'Saved' ] );

    }

    public function remove($id)
    {
        $this->applicants->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
		 
			if($this->input->post('idpassno') == '')
				{
					$data['inputerror'][] = 'idpassno';
					$data['error_string'][] = 'ID/Passport No  is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('ctncode') == '')
				{
					$data['inputerror'][] = 'ctncode';
					$data['error_string'][] = 'Country is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('firstname') == '')
				{
					$data['inputerror'][] = 'firstname';
					$data['error_string'][] = 'First Name  is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('title') == '')
				{
					$data['inputerror'][] = 'title';
					$data['error_string'][] = 'Title is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('midname') == '')
				{
					$data['inputerror'][] = 'midname';
					$data['error_string'][] = 'Middle Name  is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('dob') == '')
				{
					$data['inputerror'][] = 'dob';
					$data['error_string'][] = 'Birthdate is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('lastname') == '')
				{
					$data['inputerror'][] = 'lastname';
					$data['error_string'][] = 'Last Name  is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('gender') == '')
				{
					$data['inputerror'][] = 'gender';
					$data['error_string'][] = 'Gender is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('qualification') == '')
				{
					$data['inputerror'][] = 'qualification';
					$data['error_string'][] = 'Qualification is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('institutionname') == '')
				{
					$data['inputerror'][] = 'institutionname';
					$data['error_string'][] = 'Institution Name  is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('specarea') == '')
				{
					$data['inputerror'][] = 'specarea';
					$data['error_string'][] = 'Area of Specialization  is required';
					$data['status'] = FALSE;
				} 
		 
		 
			if($this->input->post('prmpcode') == '')
				{
					$data['inputerror'][] = 'prmpcode';
					$data['error_string'][] = 'Postal Code is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('prmaddress') == '')
				{
					$data['inputerror'][] = 'prmaddress';
					$data['error_string'][] = 'Address is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('prmphone') == '')
				{
					$data['inputerror'][] = 'prmphone';
					$data['error_string'][] = 'Phone is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('email') == '')
				{
					$data['inputerror'][] = 'email';
					$data['error_string'][] = 'Email is required';
					$data['status'] = FALSE;
				} 
		 
			if($this->input->post('prmtown') == '')
				{
					$data['inputerror'][] = 'prmtown';
					$data['error_string'][] = 'Town is required';
					$data['status'] = FALSE;
				} 
		  
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
