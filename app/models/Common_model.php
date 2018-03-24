<?php

class Common_model extends CI_Model{
    private $menu_parents = [];
    private $menu_subs = [];
    private $run =1;

  function search_combogrid( $src, $col_array )
  {

    $page       = $this->input->get('page'); // get the requested page
    $limit      =  $this->input->get('rows');//$_GET['rows']; // get how many rows we want to have into the grid
    $sidx       = $this->input->get('sidx');//$_GET['sidx']; // get index row - i.e. user click to sort
    $sord       = $this->input->get('sord');//$_GET['sord']; // get the direction
    $searchTerm = $this->input->get('searchTerm');//$_GET['searchTerm'];
    $searchTerm = centerTrim( $searchTerm );

    $page_num  = $page;
    $per_page  = $limit;
    $offset    = ($page_num-1)*$per_page;
    $where     = [];
    $select    = [];
    $firstCol  = 'i';

    if(sizeof($col_array)>0){
      $dbcols    = array_keys($col_array);
      $firstCol  = valueof($dbcols, 0);

     foreach($col_array as $dbcol=>$coldesc){
      $where[]    = (" {$dbcol} like '%".$this->db->escape_like_str($searchTerm)."%' ");
      $select[]   = $dbcol;
     }
    }

    $where_str = implode(' or ', $where);
    $select_str = implode(' , ', $select);

    $result = $this->db->select("{$select_str}")
       ->from($src)
       ->where("1=1")
       ->where("{$where_str}")
       ->limit($per_page, $offset)
       ->get();

    $record_count_filtered = $this->db->select("count({$firstCol}) num")
       ->from($src)
       ->where("1=1")
       ->where("{$where_str}")
       ->get()
       ->row();

     $cnt_whole = 0;

     if(isset($record_count_filtered->num)){
      $cnt_whole = $record_count_filtered->num;
     }

    $result_num_rows = $result->num_rows();

    if($result_num_rows > 0){

    $response['page'] = $page;
    $response['total'] = $result_num_rows;
    $response['records'] = $cnt_whole;
    $response['rows'] = [];

     foreach ($result->result_array() as $row)
     {
      $response['rows'][]  = $row;
     }
    }

    $response =  utf8_converter($response);
    echo json_encode($response);

  }

  function search_ajaxcombobox( $src, $col_id, $col_name )
  {
    $json_data = [];

    $page_num  = $this->input->post('page_num');
    $per_page  = $this->input->post('per_page');
    $q_word    = $this->input->post('q_word');
    $keyword   = valueof($q_word, 0);
    $offset    = ($page_num-1)*$per_page;

    $result = $this->db->select("{$col_id} id,{$col_name} name")
       ->from($src)
       ->where("{$col_id} like '%".$this->db->escape_like_str($keyword)."%' or {$col_name} like '%".$this->db->escape_like_str($keyword)."%' ")
       ->limit($per_page, $offset)
       ->get();

    $record_count_filtered = $this->db->select("count({$col_id}) num")
       ->from($src)
       ->where("{$col_id} like '%".$this->db->escape_like_str($keyword)."%' or {$col_name} like '%".$this->db->escape_like_str($keyword)."%' ")
       ->get()
       ->row();

     $cnt_whole = 0;

     if(isset($record_count_filtered->num)){
      $cnt_whole = $record_count_filtered->num;
     }

    echo  '{"result":['."\r\n";

    if($result->num_rows() > 0){
     foreach ($result->result_array() as $row)
     {
     $id      =  $row['id'];
     $name    =  $row['name'];
     $json_data[]  ='{"id":"'.$id .'","name":"'.$name .'" }';
     }
    }

    echo implode(',' , $json_data);
    echo  '],"cnt_whole":"'.$cnt_whole.'"}'."\r\n";

  }

  function select_assoc( $table, $col_code, $col_desc, $sql_where='' )
  {
    $_sql_where = !empty($sql_where) ? "where {$sql_where}" : '';
    $sql    = "select {$col_code} code,{$col_desc} name from {$table} {$_sql_where} order by {$col_desc} ";
    $query  = $this->db->query($sql);
    $data   = [];
    if($query->num_rows() > 0){
    foreach ($query->result_array() as $row)
     {
        $code   =  $row['code'];
        $name   =  $row['name'];
        $data[$code] =  $name;
     }
    }

    return $data;

  }

  function search_icon_fa( $keyword ){
    $data   = [];

    $result = $this->db->select('icon')
       ->from('sysicons')
       ->where("icon LIKE '%{$keyword}%'")
       ->limit(10)
       ->get();

    if($result->num_rows() > 0){
     foreach ($result->result_array() as $row)
     {
     $data[]  =  $row['icon'];
     }
    }

    return $data;
  }

  function queue_mail( $email, $subject, $message, $toemail='' , $send_now=false ){

    $id   =  generateID( 'queuemail' ,'id', $this->db );

    $data = [
          'id'          =>  $id ,
          'toname'      =>  !empty($toemail) ? $toemail : $email ,
          'toemail'     =>  $email ,
          'subject'     =>  $subject ,
          'message'     =>  $message ,
          'queuedate'   =>  date("Y-m-d") ,
         ];

    $save  = $this->db->insert( 'queuemail', $data );

    if($save){
     if($send_now){
      $this->load->library('email');
      $this->config->load('product');
      $companyname       = $this->config->item('companyname');
      $companyemail      = $this->config->item('companyemail');
      $productname       = $this->config->item('productname');

      $this->email->clear();
      $this->email->from( $companyemail, $companyname );
      $this->email->to( $email );
      $this->email->subject( $subject );
      $this->email->message( $message );
      $this->email->send();
      $this->db->query( "update queuemail set sent=1  where id={$id} " );

     }
     return $id;
    }

    return null;

  }

  public function  get_queued_mail( $limit=10 )
  {
      $this->db->select('*');
      $this->db->from('queuemail');
      $this->db->where("sent is null or sent=0");
      $this->db->limit($limit);
      $result = $this->db->get();

      $data   = [];
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $data[] =  $row;
         }
      }

      return $data;

  }

  public function  get_queued_mail_id( $id )
  {
      $this->db->select('*');
      $this->db->from('queuemail');
      $this->db->where("id", $id);
      //$this->db->where("sent is null or sent=0");
      $result = $this->db->get();

      $row    = $result->row();
      if (isset($row))
      {
        return $row;
      }

      return [];

  }


  function get_sys_apps( $appid='' )
  {
    $sql_flt  = !empty($appid) ? " where appid='{$appid}' " : '';
    $sql    = "select appid,appname from sysapps {$sql_flt} order by appname";
    $query  = $this->db->query($sql);
    $data   = [];
    if($query->num_rows() > 0){
    foreach ($query->result_array() as $row)
     {
        $appid        =  $row['appid'];
        $appname      =  $row['appname'];
        $data[$appid] =  $appname;
     }
    }

    return $data;
  }


  function get_sys_app( $appid )
  {

      $result = $this->db->select('appid,appname,appicon,iconclr')
       ->from('sysapps')
       ->where("appid='{$appid}' ")
       ->get();
    $row    = $result->row();
    if (isset($row))
    {
     return $row;
    }
    return [];
  }

  function get_default_sys_app_user( )
  {

      $result = $this->db->select('appid')
       ->from('sysapps')
       ->where("isuser=1 ")
       ->where("isdef=1 ")
       ->get();
    $row    = $result->row();
    if (isset($row->appid))
    {
     return $row->appid;
    }
    return null;
  }

  function get_default_sys_app_admin( )
  {

      $result = $this->db->select('appid')
       ->from('sysapps')
       ->where("isadmin=1 ")
       ->get();
    $row    = $result->row();
    if (isset($row->appid))
    {
     return $row->appid;
    }
    return null;
  }

  function get_sys_apps_detailed(  )
  {
    $sql    = "select appid,appname,appicon,isdef,iconclr from sysapps  order by appname";
    $query  = $this->db->query($sql);
    $data   = [];
    if($query->num_rows() > 0){
    foreach ($query->result_array() as $row)
     {
       $data[] =  $row;
     }
    }

    return $data;
  }

  function get_sys_apps_detailed_admin(  )
  {
    $sql    = "select appid,appname,appicon,isdef,iconclr from sysapps where isadmin=1 order by appname";
    $query  = $this->db->query($sql);
    $data   = [];
    if($query->num_rows() > 0){
    foreach ($query->result_array() as $row)
     {
       $data[] =  $row;
     }
    }

    return $data;
  }

  function get_sys_apps_detailed_user(  )
  {
    $sql    = "select appid,appname,appicon,isdef,iconclr from sysapps where isuser=1 order by appname";
    $query  = $this->db->query($sql);
    $data   = [];
    if($query->num_rows() > 0){
    foreach ($query->result_array() as $row)
     {
       $data[] =  $row;
     }
    }

    return $data;
  }

  function get_app_modules( $appid, $id='' )
  {

    if(empty($id)){
     $sql    = "select id,modname from sysmods where appid='{$appid}' and (parentid=0 or parentid is null) order by modpos";
    }else{
     $sql    = "select id,modname from sysmods where appid='{$appid}' and parentid={$id} order by modpos";
    }

    $query  = $this->db->query($sql);
    $data   = [];
    if($query->num_rows() > 0){
    foreach ($query->result_array() as $row)
     {
        $id        =  $row['id'];
        $modname   =  $row['modname'];
        $data[$id] =  $modname;
     }
    }

    return $data;

  }

  function get_app_module( $appid, $id )
  {
    $sql    = "select appid,id,modname,mnutype,modpos,modicon,iconclr,parentid,modcont,modview,active,vars from sysmods where appid='{$appid}' and id={$id} order by modname";
    $query  = $this->db->query($sql);
    $row    = $query->row_array();
    if (isset($row))
    {
     return $row;
    }
    return [];
  }

  function get_app_module_by_id( $id )
  {
    $sql    = "select appid,id,modname,mnutype,modpos,modicon,iconclr,parentid,modcont,modview,active,vars from sysmods where id={$id} order by modname";
    $query  = $this->db->query($sql);
    $row    = $query->row();
    if (isset($row))
    {
     return $row;
    }
    return [];
  }

  public function get_app_menu( $appid  )
  {

    $sql    = "select id,parentid,modname,modicon,iconclr,mnutype,modcont,vars,modpos from sysmods where appid='{$appid}' and active=1 order by parentid,modpos ";
    $query  = $this->db->query($sql);
    $rows   = [];
    if($query->num_rows() > 0){
     foreach ($query->result_array() as $row){
      $rows[] = $row;
     }
    }

    $tree = self::buildTree($rows);

    return $tree;

  }

  public function get_app_role_menu( $appid , $rolecode  )
  {

    $sql    = "select id,parentid,modname,modicon,iconclr,mnutype,modcont,vars,modpos from sysmods where appid='{$appid}' and active=1 order by parentid,modpos ";
    $query  = $this->db->query($sql);
    $rows   = [];
    if($query->num_rows() > 0){
     foreach ($query->result_array() as $row){
      $id        = $row['id'];
      $rows[$id] = $row;
     }
    }

   $rolerights    = self::get_role_rights(  $appid, $rolecode );

   /**
    * remove menu not in access rights
    */

    if($rolerights){
     if(sizeof($rolerights)>0){
      foreach($rows as $menuid=> $menu){
       if(!array_key_exists($menuid,$rolerights)){
        unset($rows[$menuid]);
       }
      }
     }
    }

    $tree = self::buildTree($rows);

    return $tree;

  }

  public function get_app_module_menu( $appid, $parentid  )
  {

    $sql    = "select id,parentid,modname,modicon,iconclr,mnutype,modcont,vars from sysmods where appid='{$appid}' and (id={$parentid} or parentid={$parentid} ) and active=1 order by parentid,modpos ";
    $query  = $this->db->query($sql);
    $rows   = [];

    if($query->num_rows() > 0){
     foreach ($query->result_array() as $row){
      $rows[] = $row;
     }
    }

    $tree = self::buildTree($rows);

    return $tree;

  }

  private function buildTree(array $elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parentid'] == $parentId) {
            $children = self::buildTree($elements, $element['id']);
            if ($children) {
                $element['subs'] = $children;
            }
            $branch[] = $element;

        }
    }

    return $branch;
}

  function get_menu_sub_count( $id )
  {
    $sql    = "select count(id) num from sysmods where parentid={$id} and active=1 ";
    $query  = $this->db->query($sql);
    $row    = $query->row_array();
    $num    = 0;
    if (isset($row))
    {
     $num = $row['num'];
    }
    return $num;
  }


  function get_app_modules_subs( $appid,$id )
  {
    $sql    = "select count(id) num from sysmods where appid='{$appid}' and parentid={$id} ";
    $query  = $this->db->query($sql);
    $row    = $query->row_array();
    $num    = 0;
    if (isset($row))
    {
     $num = $row['num'];
    }
    return $num;
  }

  public function get_app_parents( $appid,$parentid )
  {
    $sql    = "select id,modname,parentid from sysmods where appid='{$appid}' and id={$parentid} ";
    $query  = $this->db->query($sql);
    $row    = $query->row_array();

    if (isset($row))
    {

     $mnid     = $row['id'];
     $parentid = $row['parentid'];
     $modname  = $row['modname'];
     ++$this->run;

     $this->menu_parents[] = [$mnid,$modname];

     if(!is_null($parentid)){
       $this->get_app_parents_recursive( $appid,$parentid );
     }

     return $this->menu_parents;

    }
    return [];
  }


  public function get_app_parents_recursive( $appid,$parentid )
  {
    $sql    = "select id,modname,parentid from sysmods where appid='{$appid}' and id={$parentid} ";
    $query  = $this->db->query($sql);
    $row    = $query->row_array();
    if (isset($row))
    {
     $mnid     = $row['id'];
     $parentid = $row['parentid'];
     $modname  = $row['modname'];
     $this->menu_parents[] = [$mnid,$modname];
     if(!is_null($parentid)){
       $this->get_app_parents_recursive( $appid,$parentid );
     }else{
      $this->menu_parents[] = [0,$appid];
     }
    }

  }

 function get_role_rights( $appid, $rolecode )
  {
    $data   = [];
    $result = $this->db->select('menuid')
    ->from('sysrights')
    ->where("appid='{$appid}' ")
    ->where("rolecode='{$rolecode}' ")
    ->get();

    if($result->num_rows() > 0){
     foreach ($result->result_array() as $row)
     {
      $menuid         =  $row['menuid'];
      $data[$menuid]  =  1;
     }
    }

    return $data;

  }

  public function get_history( $userid )
  {

    $data   = [];

    $result = $this->db->select('controller,timestamp')
       ->from('syshist')
       ->where("userid='{$userid}'")
       ->order_by("timestamp","desc")
       ->limit(10)
       ->get();

    if($result->num_rows() > 0){
     foreach ($result->result_array() as $row)
     {
      $data[]  =  $row;
     }
    }

    return $data;
  }

  public function insert_history( $controller, $userid )
  {

    $data                 = [];
    $data['userid']       = $controller;
    $data['controller']   = $controller;
    $data['timestamp']    = time();

    $db->insert('syshist', $data);

  }


}
