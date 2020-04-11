<?php

class Researcher_model extends CI_Model{


/**
 *create researcher by ID
 */

  public function  get_researcher_by_id ( $id, $return_array = FALSE  )
  {

    $this->db->select('*');
    $this->db->from('viewresearchers ');
    $this->db->where("id",$id);
    $result = $this->db->get();
    $row    = $return_array ? $result->row_array() : $result->row();

    if (isset($row))
    {
     return $row;
    }

    return null;
  }

/**
 *create researcher by email
 */

  public function  get_researcher_by_email ( $email, $return_array = FALSE )
  {

    $this->db->select('*');
    $this->db->from('viewresearchers ');
    $this->db->where("email",$email);
    $result = $this->db->get();
    $row    = $return_array ? $result->row_array() : $result->row();

    if (isset($row))
    {
     return $row;
    }

    return null;
  }

 /**
 *create researcher by ORCID iD
 */

  public function  get_researcher_by_orcidid ( $orcidid, $return_array = FALSE  )
  {

    $this->db->select('*');
    $this->db->from('viewresearchers ');
    $this->db->where("orcidid",$orcidid);
    $result = $this->db->get();
    $row    = $return_array ? $result->row_array() : $result->row();

    if (isset($row))
    {
     return $row;
    }

    return null;
  }

/**
 *create researcher
 */

  public function create( $data )
  {

    //check if exists
    $email = valueof($data, 'email');

    if(empty($email)){
     return false;
    }

    $check =  self::get_researcher_by_email ( $email );

    if(empty($check)){
     $data['id'] = generateID('researchers','id', $this->db );
     $this->db->insert('researchers', $data);
    }else{
     //update if exists
     self::update( $email, $data );
    }

  }


 /**
 *update researcher
 */

  public function update( $email, $data )
  {
    $this->db->where('email', $email);
    $this->db->update('researchers', $data);
  }




}
