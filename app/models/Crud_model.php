<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

    public $table;
    public $dataview;
    public $columns;
    public $select_columns;
    public $column_order;
    public $column_search;
    public $order;
    public $where=[];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        if(!empty($this->dataview)){
         $this->db->from($this->dataview);
        }else{
         $this->db->from($this->table);
        }

        //appy where
        if(sizeof($this->where)>0){
         foreach($this->where as $where_colname => $where_value){
            if(is_null($where_value)){
             $this->db->where("{$where_colname} is null ");
            }else{
             $this->db->where("{$where_colname}='{$where_value}'");
            }
         }
       }

        $i = 0;
        $num_cols = sizeof($this->columns);
        $search_columns = [];

        if($num_cols >0 ){
          foreach($this->columns as $k=>$v){
            if(!is_numeric($k)){
             $this->columns[]  = $k;
             unset($this->columns[$k]);
            }
          }
        }

       if(isset($_POST['columns'])){
         foreach($_POST['columns'] as $col_index => $search_vars) {

           $search_colname = valueof($this->columns, $col_index);
           $search_value   =  isset($_POST['columns'][$col_index]['search']['value']) && !is_null($_POST['columns'][$col_index]['search']['value']) ? $_POST['columns'][$col_index]['search']['value'] : null;

           if(!empty($search_value)) {
            $search_columns[$search_colname] = $search_value;
           }

         }
       }

//print_pre($search_columns);//remove

       if(sizeof($search_columns)>0){
          $this->db->group_start();
         foreach($search_columns as $search_colname => $search_value){
             $this->db->like($search_colname, $search_value);
         }
         $this->db->group_end();
       }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();

        if(isset($_POST['length']) && ($_POST['length'] != -1))
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        //@todo remove syscols audituser null auditdate  null audittime  null auditip    null
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function generate_id($idcol ='id'){
    $this->db->cache_off();
    $sql    = "select MAX({$idcol}) max_id from ".$this->table;
    $query  = $this->db->query($sql);
    $row    = $query->row();
    if(isset($row))
    {
     return $row->max_id + 1;
    }
    return 0;
  }

    public function get_by_id($id)
    {
        $this->db->cache_off();

        $datasrc = isset($this->dataview) && !empty($this->dataview) ? $this->dataview : $this->table;

        $this->db->select( );
        //$this->db->from( $this->table );
        $this->db->from( $datasrc );
        $this->db->where('id',$id);

        $query    = $this->db->get();
        $result   = $query->row();

        return $query->row();
    }

    public function save($data, $idcol ='id')
    {

        $data['auditdate']    =  date('Y-m-d');
        $data['audittime']    =  time();
        $data['audituser']    =  $this->session->userdata('userid');
        $data['auditip']      =  $this->input->ip_address();

        $fields       = $this->db->field_data( $this->table );

         $colums = [];
         $keycolums = [];
         $check_where = [];
         foreach ($fields as $field)
         {
           $colname           = $field->name;
           $colums[$colname]  = $colname;

           if($field->primary_key==1){
            $keycolums[]  = $colname;
           }

         }

         //remove columns in data array but not in db table
         foreach ($data as $field=>$value )
         {
           if(!array_key_exists($field,$colums)){
             unset($data[$field]);
           }
         }

         //check if records exists via primary keys , if exists, update
         if(sizeof($keycolums)>0) {

          foreach($keycolums as $keycolum){
           $check_where[$keycolum] = valueof($data, $keycolum);
          }

          $count_col = valueof($keycolums, 0);

          $num_existing          = $this->db->select("count({$count_col}) num")->get_where( $this->table , $check_where )->row()->num;

          if($num_existing>=1){
            $this->db->update( $this->table, $data, $check_where );
          }else{
            if(array_key_exists($idcol, $colums)){
             $data[$idcol] = $this->generate_id( $idcol );
            }
           $this->db->insert($this->table, $data);
          }

         }else{
         /**
          * table has no primary key columns
          */

           if(array_key_exists($idcol, $colums)){
             $data[$idcol] = $this->generate_id( $idcol );
           }
           $this->db->insert($this->table, $data);
         }

        $last_insert_id =  $this->db->insert_id();

        return !empty($last_insert_id) ? $last_insert_id : valueof($data, $idcol);

    }

    public function update($where, $data)
    {
        $data['auditdate']    =  date('Y-m-d');
        $data['audittime']    =  time();
        $data['audituser']    =  $this->session->userdata('userid');
        $data['auditip']      =  $this->input->ip_address();

        $fields               =  $this->db->field_data($this->table );

        $keycolums = [];
        foreach ($fields as $field)
        {
          $colname           = $field->name;
          $colums[$colname]  = $colname;
        }

         //remove columns in data array but not in db table
        foreach ($data as $field=>$value )
        {
          if(!array_key_exists($field,$colums)){
            unset($data[$field]);
          }
        }

        $this->db->update( $this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }


}
