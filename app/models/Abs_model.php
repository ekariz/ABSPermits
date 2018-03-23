<?php
class Abs_model extends CI_Model{

  public function  get_applyas(  )
  {

      $this->db->select('ascode code,asname name');
      $this->db->from('applyas ');
      $this->db->order_by("id","ASC");
      $result = $this->db->get();
      $data   = [];
      $data[''] = 'Choose option';
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $code   =  $row['code'];
            $name   =  $row['name'];
            $data[$code] =  $name;
         }
      }

      return $data;

  }

  public function  get_resource_types(  )
  {

      $this->db->select('typecode code,typename name');
      $this->db->from('resourcetypes ');
      $this->db->order_by("id","ASC");
      $result = $this->db->get();
      $data   = [];
      $data[''] = 'Choose option';
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $code   =  $row['code'];
            $name   =  $row['name'];
            $data[$code] =  $name;
         }
      }

      return $data;

  }

  public function  get_purposes(  )
  {

      $this->db->select('pupcode code,pupname name');
      $this->db->from('purposes ');
      $this->db->order_by("id","ASC");
      $result = $this->db->get();
      $data   = [];
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $code   =  $row['code'];
            $name   =  $row['name'];
            $data[$code] =  $name;
         }
      }

      return $data;

  }

  public function  get_research_types(  )
  {

      $this->db->select('typecode code,typename name');
      $this->db->from('researchtypes ');
      $this->db->order_by("id","ASC");
      $result = $this->db->get();
      $data   = [];
      $data[''] = 'Choose option';
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $code   =  $row['code'];
            $name   =  $row['name'];
            $data[$code] =  $name;
         }
      }

      return $data;

  }

  public function  get_iucn_red_list(  )
  {

      $this->db->select('iucncode code,iucnname name');
      $this->db->from('iucnlist ');
      $this->db->order_by("id","ASC");
      $result = $this->db->get();
      $data   = [];
      $data[''] = 'Choose option';
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $code   =  $row['code'];
            $name   =  $row['name'];
            $data[$code] =  $name;
         }
      }

      return $data;

  }


  public function  get_sample_uom(  )
  {

      $this->db->select('uomcode code,uomname name');
      $this->db->from('sampleuom ');
      $this->db->order_by("id","ASC");
      $result = $this->db->get();
      $data   = [];
      $data[''] = 'Choose option';
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
            $code   =  $row['code'];
            $name   =  $row['name'];
            $data[$code] =  $name;
         }
      }

      return $data;

  }

  public function  get_applications( $email )
  {

      $this->db->select('*');
      $this->db->from('applications ');
      $this->db->where("email",$email);
      $this->db->order_by("id","desc");
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
  public function  get_applications_all( )
  {

      $this->db->select('*');
      $this->db->from('applications ');
      $this->db->order_by("id","desc");
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

  public function  get_approval_steps( )
  {

      $this->db->select('stepno, stepname');
      $this->db->from('approvesteps ');
      $this->db->order_by("stepno","asc");
      $result = $this->db->get();
      $data   = [];
      if($result->num_rows() > 0){
        foreach ($result->result_array() as $row)
         {
           $stepno   =  $row['stepno'];
           $stepname =  $row['stepname'];
           $data[$stepno] =  $stepname;
         }
      }

      return $data;

  }

  public function  my_approvalstep( $instcode )
  {

    $this->db->select('stepno');
    $this->db->from('approvesteps ');
    $this->db->where("instcode",$instcode);
    $result = $this->db->get();
    $row    = $result->row();

    if (isset($row))
    {
     return $row->stepno;
    }

    return null;
  }


  public function  get_approver( $stepno )
  {

    $this->db->select('instcode');
    $this->db->from('approvesteps ');
    $this->db->where("stepno",$stepno);
    $result = $this->db->get();
    $row    = $result->row();

    if (isset($row))
    {
     return $row->instcode;
    }

    return null;
  }


  public function  get_institutions_main_approver( $instcode,$rolecode = 'IA' )
  {

    $this->db->select('email,username');
    $this->db->from('sysusers ');
    $this->db->where("instcode",$instcode);
    $this->db->where("rolecode",$rolecode);
    $result = $this->db->get();
    $row    = $result->row();

    if (isset($row))
    {
     return $row;
    }

    return null;
  }




}
