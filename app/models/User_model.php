<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/

class User_model extends CI_Model
{

 public function auth( $data )
 {

    if(!isset($data['userid']) || !isset($data['password']) ){
     return ['status' => false , 'message' => 'Wrong User ID or Password'];
    }

    $email           = $data['userid'];
    $password        = $data['password'];
    $password_check  = sha1($password);

    $user = $this->db->select('u.id, u.rolecode, g.rolename, u.username,  u.email, u.mobile,  u.disabled ')
    ->from('sysusers u')
    ->where("u.email='{$email}' ")
    ->where("u.password='{$password_check}' ")
    ->join('sysroles g', 'g.rolecode = u.rolecode', 'left')
    ->get();

    $row    = $user->row();

    if(!isset($row))
    {
     return ['status' => false , 'message' => 'Wrong User ID or Password'];
    }
    else
    {
     $profile            = self::read( $data['userid'] );

     $response            = [];
     $response['status']  = true;
     $response['message'] = 'Login Successful';

     if(isset($profile[0])){
      $response['staffno']      = valueof($profile[0], 'staffno');
      $response['namefirst']    = valueof($profile[0], 'namefirst');
      $response['namemid']      = valueof($profile[0], 'namemid');
      $response['namelast']     = valueof($profile[0], 'namelast');
      $response['position']     = valueof($profile[0], 'position');
      $response['branch']       = valueof($profile[0], 'branch','');
      $response['department']   = valueof($profile[0], 'department');
      $response['dob']          = valueof($profile[0], 'dob');
      $response['gender']       = valueof($profile[0], 'gender');
      $response['nationalid']   = valueof($profile[0], 'nationalid');
      $response['email']        = valueof($profile[0], 'email');
      $response['mobile']       = valueof($profile[0], 'mobile');
     }

     return $response;

    }

  }

 public function read($staffno=null){
 $sql = "select id, staffno,namefirst,namemid,namelast,emtname employterms,jbtname position ,brcname branch, dptname department,
 dob,gndname gender , nationalid, email, mobile from viewstaff";

 if(!is_null($staffno)){
  $sql .= " where staffno='{$staffno}' ";
 }

 $query  = $this->db->query($sql);
 $staff  = $query->result_array();

 //$sql_users  = "select email,rolecode,username,password from sysusers where disabled is null";
 //$sysusers   = $this->db->query($sql_users);
 //$logins     = $sysusers->result_array();

 //if(sizeof($staff)>0 && sizeof($logins)>0) {
  //foreach($staff as $index=>$row){
   //$email =  valueof($row, 'email');

   //if(!empty($email)){

    //foreach($logins as $login){
    //$email_login =  valueof($login, 'email');

     //if($email_login==$email){
      //$staff[$index]['password'] = valueof($login, 'password');
     //}

    //}
   //}
  //}
 //}

 //print_pre($staff);//remove
 //print_pre($logins);//remove

 return $staff;

 }

 public  function  insert($data){
 return "Error has occured";
 $this->user_name= $data['name'];
 $this->user_password= $data['pass'];
 $this->user_type= $data['type'];
 if($this->db->insert('tbl_user',$this))
 {
 return 'Data is inserted successfully';
 }
 else
 {
 return "Error has occured";
 }

}

 public function update($id,$data){
  return "Error has occurred";
  $this->user_name= $data['name']; // please read the below note
  $this->user_password= $data['pass'];
  $this->user_type= $data['type'];
  $result = $this->db->update('tbl_user',$this,array('user_id' => $id));

  if($result)
  {
  return "Data is updated successfully";
  }
  else
  {
  return "Error has occurred";
  }
 }

 public function delete($id){
  return "Error has occurred .";
  $result = $this->db->query("delete from tbl_user where user_id = {$id}");
  if($result)
  {
  return "Data is deleted successfully";
  }
  else
  {
  return "Error has occurred : delete from tbl_user where user_id = {$id}";
  return "Error has occurred .";
 }

}

}
