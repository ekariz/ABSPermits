<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

 class Paycalc  {
   private $pryear;
   private $prmonth;
   private $staffno;
   private $db;

    public function __construct( ){

    }

    public function init( $db, $pryear, $prmonth , $staffno ){
      $this->pryear  = $pryear;
      $this->prmonth = $prmonth;
      $this->staffno = $staffno;
      $this->db      = $db;
    }

    public function get_Staff_EDF( ){

    $result = $this->db->select('x.exmamount amount, s.staticedf')
     ->from('hrstaff s ')
     ->join('payexmcat x','s.exmcatcode=x.exmcatcode','left')
     ->where("s.staffno='{$this->staffno}'")
     ->get();

    if( $result && $result->num_rows() > 0 )
    {
     $row  = $result->row();

     if(isset($row))
     {
     if(isset($row->amount) && $row->amount>0)
     {
       return $row->amount;
     }elseif(isset($row->staticedf) && $row->staticedf>0)
     {
       return $row->staticedf;
     }
    }
    }

    return 0;

    }

    public function calculate_Tax_Charged( $chargable_pay ){

     return $chargable_pay;

    }

    public function calculate_Insurance_Relief($premium){
echo "\$premium={$premium} <br>";//remove

      $max = 5000;
      if(is_numeric($premium)){
       $relief   = (0.15 * $premium);
      }else{
        $relief  = 0;
      }
      if($relief>$max){
        $relief = $max;
      }
      return $relief;
    }

    public function Constant_Value($value){
        return isset($value) ? $value: 0;
    }

    public function Calculate_Income_Exemption ($value){
        return   0;
        return isset($value) ? $value: 0;
    }

   public static function list_fmrs( ){

    $custom_methods = get_class_methods( __class__ );

    unset($custom_methods[0]);

    $custom_methods[0]='User_Defined';

    asort($custom_methods);

    $methods = [];

    foreach ($custom_methods as $custom_method){
     if($custom_method !='list_fmrs'){
      $methods[$custom_method]  = str_replace('_',' ',$custom_method);
     }
    }

    return $methods;

 }

 }

