<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MonthEnd extends CI_Controller {


 public function __construct()
    {
        parent::__construct();

        $this->load->model('Crud_model','payperiods');
        $this->load->model('Common_model','common');
        $this->load->model('HR_model','hr');
        $this->load->model('Payroll_model','payroll');

        $this->payperiods->table      = 'payperiods';

    }

 public function index( ){

    $pay_period        = $this->payroll->get_pay_period_active();
    $data['pryear']    = $pay_period->pryear;
    $data['prmonth']   = $pay_period->prmonth;

    $this->load->view('month_end_view.php', $data);
 }

 public function process( )
 {

    $pay_period   = $this->payroll->get_pay_period_active();

    if(empty($pay_period)){
     $response['success'] = 0;
     $response['message'] = "Please Set Active Month";
     echo json_encode( $response );
     die();
    }

    $pryear       = $pay_period->pryear;
    $prmonth      = $pay_period->prmonth;
    $data         = [];
    $id           = generateID('paystfitms','id', $this->db );

    if($prmonth==12){
        $pryear_next   = $pryear+1;
        $prmonth_next  = 1;
    }else{
        $pryear_next   = $pryear;
        $prmonth_next  = $prmonth+1;
    }

     $qlf_staff  = $this->db->distinct()->select('staffno')->get_where('viewstaffitems', ['pryear' => $pryear, 'prmonth' => $prmonth] )->num_rows();

     $paid_staff = $this->db->distinct()->select('staffno')->get_where('viewpayslip',    ['pryear' => $pryear, 'prmonth' => $prmonth] )->num_rows();

     if($paid_staff==0 ){
      echo json_response(0,"You Have Not Yet Processed Payroll for {$pryear}-{$prmonth}");
      die;
     }

     if($qlf_staff>0 && $qlf_staff<$paid_staff ){
      $left_staff = $qlf_staff-$paid_staff;
      echo json_response(0,"{$pryear}-{$prmonth} Payroll for {$left_staff} staff Has Not been Processed Yet");
      die;
     }

     /**
      * clear next month data
      */

      $this->db->where('pryear',$pryear_next)->where('prmonth',$prmonth_next)->delete('payslip');
      $this->db->where('pryear',$pryear_next)->where('prmonth',$prmonth_next)->delete('paysummary');
      $this->db->where('pryear',$pryear_next)->where('prmonth',$prmonth_next)->delete('paystfitms');
      $this->db->where('pryear',$pryear_next)->where('prmonth',$prmonth_next)->delete('paynet');

      //get items
      //$itemsArray         =  $this->payroll->get_pay_items();
      $items_loan_rep     =  $this->payroll->get_pay_items_loan_rep();
      $items_loan_bal     =  $this->payroll->get_pay_items_loan_bal();
      $items_loan         =  [];
      $formularsArray     =  $this->payroll->get_pay_formulars();
      $payslips           =  $this->payroll->get_payslips_all( $pryear, $prmonth   );
      $all_staff_items    =  $this->payroll->get_all_staff_items_recurring( $pryear, $prmonth  );

      if(sizeof($items_loan_rep)>0 && sizeof($items_loan_bal)>0){
        foreach ($items_loan_rep  as $itmcode=>$itmname)
        {
         $items_loan[$itmcode]  = $itmname;
        }
        foreach ($items_loan_bal  as $itmcode=>$itmname)
        {
         $items_loan[$itmcode]  = $itmname;
        }
      }

      $staff_loans = [];

      if(sizeof($payslips)>0){
       foreach ($payslips  as $staffno=>$items)
       {

        if(sizeof($items)>0){
         foreach ($items  as $itmcode=>$amount)
         {
          if(array_key_exists($itmcode, $items_loan))
          {
           $staff_loans[$staffno][$itmcode]   = $amount;
          }
         }
        }

        }
      }


    if($all_staff_items){
     if(sizeof($all_staff_items)>0) {

     /**
      * get static items and overite from payslip
      *
      */
      $static_items_per_staff = [];
      foreach($all_staff_items as $staff_Item){
       $staffno      = valueof($staff_Item, 'staffno');
       $static_items = $this->payroll->get_staff_items_static( $staffno );

       if(sizeof($static_items)>0){
        foreach ($static_items as $itmcode => $amount ){
         $static_items_per_staff[$staffno][$itmcode] = $amount;
        }
       }
      }

      foreach($all_staff_items as $staff_Item){

        $staffno    = valueof($staff_Item, 'staffno');
        $itmcode    = valueof($staff_Item, 'itmcode');
        $itmname    = valueof($staff_Item, 'itmname');

        if( isset($static_items_per_staff[$staffno][$itmcode]) ){
        $amount     = $static_items_per_staff[$staffno][$itmcode];
        }else{
        $amount     = valueof($staff_Item, 'amount');
        }

        $isloanbal  = valueof($staff_Item, 'isloanbal');
        $isloanrep  = valueof($staff_Item, 'isloanrep');

        if( $isloanbal==1 || $isloanrep==1 ){

         $loan_item_amount = 0;

         if(isset($staff_loans[$staffno][$itmcode])){
          $loan_item_amount = $staff_loans[$staffno][$itmcode];
         }

         if($isloanbal==1 && $loan_item_amount<$amount){
          $amount = $loan_item_amount;
         }

        }

        $data[] = [
         'id'        =>  $id ,
         'staffno'   =>  $staffno ,
         'pryear'    =>  $pryear_next ,
         'prmonth'   =>  $prmonth_next ,
         'itmcode'   =>  $itmcode ,
         'amount'    =>  $amount ,
         'entryref'  =>  'C' ,
        ];

        ++$id;

      }
     }
    }

    $this->db->insert_batch( 'paystfitms', $data );

    self::increment_month( $pryear_next, $prmonth_next );

    $response['success'] = 1;
    $response['message'] = "Done";

    echo json_encode( $response );

 }

 private function increment_month( $pryear_next, $prmonth_next ){

    $this->db->query("update payperiods set isactive=null");

    $data['pryear']   = $pryear_next;
    $data['prmonth']  = $prmonth_next;
    $data['isactive'] = 1;
    $this->payperiods->save( $data );

 }

}
