<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institutions extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model','institutions');
        $this->load->model('Common_model','common');
        $this->load->model('Abs_model','abs');

        $this->institutions->table     = 'institutions';
        $this->institutions->dataview  = 'institutions';

        $this->columns             = [
                                     'instcode' => "Institution Code",
                                     'instname' => "Institution Name",
                                     'charges'  => "Charges",
                                     ];

        $column_order     = array_keys($this->columns);
        $column_order[]   = null;

        $this->institutions->columns        = array_keys($this->columns);
        $this->institutions->column_order   = $column_order;
        $this->institutions->column_search  = ['instcode' ,'instname' ];
        $this->institutions->order          = ['instname' => 'desc'];
    }

    public function index()
    {

        $nosearchcolumns =  [];

        $appname = 'Institution';
        $params  =  [
                    'route'   => $this->router->class,
                    'appname' => $appname,
                    'columns' => $this->columns,
                    'nosearchcolumns' => $nosearchcolumns,
                    ];

        $data  =  [
                    'actives' =>  [1 => 'Yes',0=> 'No'],
                  ];

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->load->library('CustomCrud', $params);
        $this->load->view('institutions_view', $data);
    }

     public function data()
    {
        $list = $this->institutions->get_datatables();
        $data = array();
        $no   =  filter_input(INPUT_POST , 'start', FILTER_SANITIZE_STRING);
        $draw =  filter_input(INPUT_POST , 'draw', FILTER_SANITIZE_STRING);
        foreach ($list as $index => $vendor) {

        $no++;
        $row = array();

        foreach($this->institutions->column_order as $index => $colname){
          $value       = isset($vendor->$colname) ? $vendor->$colname : null;

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
              <a   href="javascript:void(0)" title="View" onclick="crud.edit('."'".$vendor->id."'".')"><i class="fa fa-eye"></i> View</a>
              &nbsp;
              ';

        $data[] = $row;

        }

        $output = array(
                "draw" => $draw,
                "recordsTotal" => $this->institutions->count_all(),
                "recordsFiltered" => $this->institutions->count_filtered(),
                "data" => $data,
                );

        echo json_encode($output);
    }

    public function edit($id)
    {
        $data_raw  = $this->institutions->get_by_id($id);
        $img_path  = base_url() . 'assets/img/blank.jpeg';

        if(!empty($data_raw->photourl)){
         $img_path  = str_replace('admin.','',$data_raw->photourl);
         //$img_path  = $data_raw->photourl;
        }

        $data                = (object) [];
        $data->id            = $data_raw->id;
        //$data->active        = $data_raw->active;
        $data->charges         = $data_raw->charges;
        $data->instcode        = $data_raw->instcode;
        $data->instname      = strtoupper($data_raw->instname);
        $data->div_image     = "<img src=\"{$img_path}\" width=\"100\" height=\"100\">";

        echo json_encode($data);
    }

    public function save()
    {

    $id    = $this->input->post('id');
    $this->_validate();

    $instcode         = $this->input->post('instcode');
    $instname         = $this->input->post('instname');
    $charges          = $this->input->post('charges');
    $active           = $this->input->post('active');

    $data = array(
      'instcode' => $this->input->post('instcode'),
      'instname' => $this->input->post('instname'),
      'charges'  => $this->input->post('charges'),
      //'active'       => $this->input->post('active'),
    );

     if(empty($id)){
       $save_id  = $this->institutions->save($data);
     }else{
       $save     = $this->institutions->update( ['id' => $id ], $data );
       $save_id  = $id;
     }

     if($save_id>0 &&  isset($_FILES['photo'])){
        $savePhoto     = self::savePhoto( $save_id );
        $savePhoto_obj = json_decode($savePhoto);

        $data_photo = [];
        $data_photo['instphoto'] = json_encode($savePhoto_obj);

        if($savePhoto_obj->success==1){
         $data_photo['photourl'] = base_url() .'uploads/insphotos/' . $savePhoto_obj->document->file_name;
         $data_photo['thumburl'] = base_url() .'uploads/insphotos/' . $savePhoto_obj->document->raw_name.'_thumb'.$savePhoto_obj->document->file_ext;
         $save       = $this->institutions->update( ['id' => $id ], $data_photo );
        }

     }

     echo json_encode( ["success" => 1, 'message' => 'Category Saved' ] );

    }

     public function savePhoto( $save_id ){

       $this->load->library('image_lib');

       $upload_dir     = "./uploads/insphotos/";
       $document       = [];

        if(!is_dir($upload_dir)){
         if (!mkdir($upload_dir, 0777, true)) {
          echo json_encode( ["success" => 0, 'message' => 'Failed to create folders...'] );
          die;
         }
        }

        $config['upload_path']          = $upload_dir;
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name']            = $save_id;
        $config['overwrite']            = true;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('photo')){
         $document      = $this->upload->data();

         //create thumbnail
         $config_thumb['image_library']  = 'gd2';
         $config_thumb['source_image']   = $document['full_path'];
         $config_thumb['create_thumb']   = true;
         $config_thumb['thumb_marker']   = '_thumb';
         $config_thumb['maintain_ratio'] = true;
         $config_thumb['width']          = 75;
         $config_thumb['height']         = 50;

         $this->image_lib->initialize($config_thumb);

         if (!$this->image_lib->resize())
         {
          $success       = 0;
          $message       = $this->image_lib->display_errors();
         }else{
          $success       = 1;
          $message       = 'Logo  Uploaded';
         }
       }else{
          $success       = 0;
          $message       = 'Logo  Upload Failed';
       }

       return  json_encode( [ 'success' => $success, 'message' => $message, 'document' => $document ] );

   }


    public function remove($id)
    {
        $this->institutions->delete_by_id($id);
        echo json_encode( ["status" => true, 'message' => 'removed' ] );
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $data['message'] = 'Fill in all fields';

        if($this->input->post('instcode') == '')
        {
            $data['instname'][] = 'instcode';
            $data['error_string'][] = 'Institution Code is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('instname') == '')
        {
            $data['instname'][] = 'instname';
            $data['error_string'][] = 'Institution Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('charges') == '')
        {
            $data['instname'][] = 'charges';
            $data['error_string'][] = 'Institution Licence Charge is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_response(0,$data['message'] );
            exit();
        }
    }


}
