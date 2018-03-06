<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayProcess extends CI_Controller {
    private $reports=[];
    private $proc_debug = 0;
    private $pryear;
    private $prmonth;
    private static $rounding_presicion=2;

    private $prev_pyear;
    private $prev_pmonth;
    private $score;
    private $formularid;
    private $itemsArray =  [];
    private $item_descriptions =  [];
    private $item_types =  [];
    private $formular_descriptions =  [];

    private $items_val_from_formular =  [];
    private $items_val_from_formular_flipped =  [];

    private $psHeaderArray =  [];
    private $assignmentItems =  [];
    private $assignmentFormulas =  [];
    private $exemptItems =  [];
    private $staff_Items =  [];
    private $staff_Items_Multi =  [];
    private $staff_Items_Types =  [];
    private $staff_Items_Prev_Month =  [];
    private $staff_Items_Summed =  [];
    private $staff_exemptItems =  [];
    private $formularsArray =  [];

    private $loans               =  [];
    private $deposits            =  [];

    private $loanitems             =  [];
    private $loanitems_flipped     =  [];

    private $loan_interest_items     =  [];

    private $deposititems  =  [];
    private $bfitems       =  [];

    private $reductions              =  [];
    private $reducingitems           =  [];
    private $reducingitems_flipped   =  [];

    private $item_totals       =  [];
    private $negativeAmtItems  =  [];
    private $formular_result   =  [];

    private $type_loanrepayment     = 'LOANREP';
    private $type_loanbalance       = 'LOANBAL';

    private $type_deposit           = 'DEPO';
    private $type_broughtforward    = 'BFWD';

    private $type_reducingpayment    = 'REDAMT';
    private $type_reducingbalance    = 'REDBAL';

    private $netpay_code;
    private $grosspay_code;
    private $empty_segcode  = '-';
    private $nullcode       = '-';
    private $datetoday;


 public function __construct()
    {
        //parent::__construct();

        //$this->load->model('Crud_model','items');
        //$this->load->model('Crud_model','payslip');
        //$this->load->model('Crud_model','paynet');
        //$this->load->model('Crud_model','paysummary');
        //$this->load->model('Common_model','common');
        //$this->load->model('HR_model','hr');
        //$this->load->model('Payroll_model','payroll');

        //$this->payslip->table      = 'payslip';
        //$this->paynet->table       = 'paynet';
        //$this->paysummary->table   = 'paysummary';

    }


 public function process_per_branch( $pryear , $prmonth , $brccode )
 {
      self::do_process( $pryear , $prmonth , $brccode);
 }

 public function process_per_staff($pryear , $prmonth , $staffno='' )
 {
      self::do_process( $pryear , $prmonth , $brccode='' , $staffno);
 }

 public function do_process( $pryear , $prmonth , $brccode='' , $staffno='')
 {

      $this->pryear  = $pryear;
      $this->prmonth = $prmonth;

      $YearNow =  date('Y');

      self::get_payroll_settings();

      $this->db->select('*');
      $this->db->from('viewstaffitems ');
      $this->db->where("ispaid=1 ");
      $this->db->where("pryear={$pryear}");
      $this->db->where("prmonth={$prmonth}");

      if(!empty($brccode)){
      $this->db->where("brccode='{$brccode}' ");
      }

      if(!empty($staffno)){
      $this->db->where("staffno='{$staffno}' ");
      }

      $this->db->order_by("staffno","ASC");

      $result_staff  = $this->db->get();

        $staff             = [];
        $all_staff_Items   = [];
        $staff_props       = [];

        $this->itemsArray         =  $this->payroll->get_pay_items();
        $this->formularsArray     =  $this->payroll->get_pay_formulars();
        $this->psHeaderArray      =  $this->payroll->get_headers();
        $this->exemptions_by_age  =  $this->payroll->get_exemptions_by_age();
        $this->loanitems          = [];
        $this->loanitems_flipped  = [];
        $this->deposititems       = [];


      if($result_staff->num_rows() > 0){
        foreach ($result_staff->result_array() as $row)
         {

            $staffno         =  valueof($row, 'staffno');
            $staffname       =  valueof($row, 'staffname');
            $itmcode         =  valueof($row, 'itmcode');
            $itmname         =  valueof($row, 'itmname');
            $amount          =  valueof($row, 'amount');

            $emtcode         =  valueof($row, 'emtcode');
            $jbtcode         =  valueof($row, 'jbtcode');
            $dptcode         =  valueof($row, 'dptcode');
            $stscode         =  valueof($row, 'stscode');
            $nationalid      =  valueof($row, 'nationalid');
            $brccode         =  valueof($row, 'brccode');
            $bkcode          =  valueof($row, 'bkcode');
            $bkaccno         =  valueof($row, 'bkaccno');

            $dob             =  valueof($row, 'dob');
            $age             =  0;

            if(!empty($dob)){
            $dob      =  strtotime( $dob );
            $YearBorn =  date('Y', $dob);
            $age      =  $YearNow-$YearBorn;
            }

            $all_staff_Items[$staffno][$itmcode] =  $amount;

            $staff[$staffno]                     =  $staffno;

            $this->staff_props[$staffno]['emtcode']    =  $emtcode;
            $this->staff_props[$staffno]['jbtcode']    =  $jbtcode;
            $this->staff_props[$staffno]['dptcode']    =  $dptcode;
            $this->staff_props[$staffno]['stscode']    =  $stscode;
            $this->staff_props[$staffno]['brccode']    =  $brccode;
            $this->staff_props[$staffno]['nationalid'] =  $nationalid;
            $this->staff_props[$staffno]['brccode']    =  $brccode;
            $this->staff_props[$staffno]['bkcode']     =  $bkcode;
            $this->staff_props[$staffno]['bkaccno']    =  $bkaccno;

            /**
            * staff exempt items by age
            */
            if($age>0 && sizeof($this->exemptions_by_age)>0 ){
            foreach ($this->exemptions_by_age as $exempt_formular)
             {
                $fmrcode = valueof($exempt_formular, 'fmrcode');
                $agemin  = valueof($exempt_formular, 'agemin');
                $agemax  = valueof($exempt_formular, 'agemax');

                if($age>=$agemin && $age<=$agemax) {
                 if(is_array($this->staff_exemptItems) && !array_key_exists($fmrcode,$this->staff_exemptItems)) {
                    $this->staff_exemptItems[$fmrcode] = 1;
                 }
                }
             }
            }

         }
      }


    if(count($this->itemsArray)>0){
     foreach ($this->itemsArray as $itmcode => $item){

      $isloanrep  =  valueof($item, 'isloanrep', 0 );
      $isdepo     =  valueof($item, 'isdepo', 0 );
      $itmname    =  valueof($item, 'itmname',$itmcode );
      $itmbal     =  valueof($item, 'itmbal' );
      $itmcum     =  valueof($item, 'itmcum' );
      $itypename  =  valueof($item, 'itypename' );

      $this->item_descriptions[$itmcode] = $itmname;
      $this->item_types[$itmcode]        = $itypename;

      //get loan repayment items
      if($isloanrep==1 && !empty($itmbal) ){
       $this->loanitems[$itmcode]  = $itmbal;
      }

      //get deposit deduction items
      if($isdepo==1 && !empty($itmcum) ){
       $this->deposititems[$itmcode]  = $itmcum;
      }

     }
    }

    if(count($this->formularsArray)>0){
     foreach ($this->formularsArray as $fmlcode => $formular){
      $fmrname    =  valueof($formular, 'fmrname' );
      $hdrname    =  valueof($formular, 'hdrname' );
      $this->item_types[$fmlcode]        = $hdrname;
      $this->item_descriptions[$fmlcode] = valueof($formular, 'fmrname',$fmlcode );
     }
    }

      $this->loanitems_flipped  = sizeof($this->loanitems)>0 ? array_flip($this->loanitems) : array();

      $this->load->library('Paycalc');
      $this->load->library('evalmath');

      $Paycalc         = new Paycalc();
      $evalmath        = new evalmath();

      //print_pre($this->staff_exemptItems);//remove
      //print_pre($this->formularsArray);//remove
      //print_pre($staff);//remove
      //$this->proc_debug = true;

      if(count($staff)>0){
       foreach ($staff as $staffno)
       {
          $this->staff_Items = $all_staff_Items[$staffno];

         if(sizeof($this->formularsArray)>0)
         {
             $staff_exemptformular =  [];

            foreach ($this->formularsArray as $fmrcode => $fmr )
            {

              if($fmrcode!=='213x')
              {
                //if(1>0)
                if( ( !array_key_exists($fmrcode,$this->staff_exemptItems)))
                {

                $formular_name           =  valueof($fmr, 'fmrname');
                $formular_str            =  valueof($fmr, 'fmr');
                $formular_custom         =  valueof($fmr, 'calmtd');
                $formular_headercode     =  valueof($fmr, 'hdrcode');
                $formular_desc           = self::get_fmr_desc( $formular_str );

                $this->formular_descriptions[$fmrcode] = $formular_desc;

                if(array_key_exists($fmrcode,$this->staff_Items)){

                    $math_str = $this->staff_Items[$fmrcode];

                   if  ($this->proc_debug) echo "\$fmrcode={$fmrcode} is forced in staff items with amount {$math_str}<br>";

                }elseif($formular_custom == 'User_Defined' ) {

                    $formular_str_array = preg_split('/ /', $formular_str, -1, PREG_SPLIT_DELIM_CAPTURE);
                    $math_str = '';

                    /**
                     * formulate
                     */
                    foreach ($formular_str_array as $char) {

                       if(!empty($char)) {

                         if(array_key_exists($char,$this->itemsArray)) {

                          $itemcode  =  $char;
                          $itemname  =  $this->itemsArray[$char]['itmname'];
                          $itemtype  =  $this->itemsArray[$char]['itypecode'];
                          if  ($this->proc_debug) echo "getting value for item $itemcode : {$itemname}<br>";

                             $char      = self::getValueOf_Item($itemcode,$itemtype);

                            if  ($this->proc_debug) echo "which is [item] {$char} <div style=color:red>-------------------------------------------------------------</div>";

                            $this->item_totals[$itemcode] = self::round($char);

                        }elseif(array_key_exists($char,$this->formularsArray)){

                            $formular_formularcode  = $char;

                             if  ($this->proc_debug) echo "formular {$fmrcode}={$char}<br>";
                             if  ($this->proc_debug) echo "getting value for formular $formular_formularcode : {$this->formularsArray[$formular_formularcode]['fmrname']}<br>";

                            $char      = self::getValueOf_Formular($formular_formularcode);
                            if  ($this->proc_debug) echo "which is [fml] {$char} <div style=color:red>-------------------------------------------------------------</div>";

                            $amt = self::round($char);
                            $this->item_totals[$formular_formularcode] = ($amt);

                        }elseif(array_key_exists($char,$this->psHeaderArray)){

                             $formular_formularcode  = $fmrcode;
                             $formular_headercode    = $char;
                             if  ($this->proc_debug) echo " getting value of header item {$formular_formularcode}={$char} ...-> <br>";
                             $char = self::getValueOf_HeaderItems($formular_headercode,$formular_formularcode);
                             if  ($this->proc_debug) echo "which is [hdr] char={$char} <div style=color:red>-------------------------------------------------------------</div><br>";
                            $this->item_totals[$formular_formularcode] = self::round($char);

                        }else{

                        }
                     }//!empty($char)

                      $math_str.= " {$char} ";
                    }//foreach  $formular_str_array


                 } else {
                    if(method_exists('Paycalc',$formular_custom)){

                         $formular_str = trim($formular_str);

                         if($formular_custom== 'Constant_Value' ){
                             if  ($this->proc_debug) echo "method={Constant_Value_str}<br>";
                           $calc_value  = $formular_str;
                           $this->item_totals[$fmrcode] = self::round($calc_value);
                         }else{
                             if  ($this->proc_debug) echo "method={$formular_custom}<br>";

                             if(array_key_exists($formular_str,$this->itemsArray)) {
                                 $itemcode  = $formular_str;//formular should have 1 field only
                                if  ($this->proc_debug) echo " getting value of item {$itemcode}={$char} using {$formular_str} with calc_value={$calc_value}<br>";
                                 $calc_value  = self::getValueOf_Item($itemcode,$itemtype);
                                 if  ($this->proc_debug) echo "which is {$calc_value} <div style=color:red>-------------------------------------------------------------</div>";
                             }elseif(array_key_exists($formular_str,$this->formularsArray)){
                                 $calc_value  = self::getValueOf_Formular($formular_str);
                                 if  ($this->proc_debug) echo " getting value of formular {$formular_str}={$char} using {$formular_str} with calc_value={$calc_value}<br>";
                                 if  ($this->proc_debug) echo "\$calc_value={$calc_value} <br>";//
                                 if  ($this->proc_debug) echo "which is {$calc_value}  <div style=color:red>-------------------------------------------------------------</div>";
                             }

                             $this->item_totals[$formular_str] = self::round($calc_value);

                         }

                           $math_str    = $Paycalc->$formular_custom($calc_value);

                          if  ($this->proc_debug) echo "\$math_str={$math_str}<br>";

                       }//if cal using buildin formulars

                 }//end get value

                    if  ($this->proc_debug) echo "\$math_str={$math_str}<br>";

                    /**
                     * code
                     */

                    if( strstr($math_str,'if') || strstr($math_str,'return') || strstr($math_str,'else') ){
                      if  ($this->proc_debug) echo "\$math_str={$math_str} <br>";
                      $math_result  = eval($math_str);
                    }else{
                      $math_result = $evalmath->e($math_str);
                    }

                    if  ($this->proc_debug) echo "\$math_result={$math_result} <br>";

                    if(is_null($math_result) || empty($math_result)){
                        $math_result = '0';
                    }

                    $result = $math_result;

                    $this->formular_math_str[$fmrcode] =  $math_str ;


                     if  ($this->proc_debug) echo "\$result of {$fmrcode}={$result} [\$math_str={$math_str}]<hr>";

                     if(is_array($this->bfitems)){
                        if(array_key_exists($fmrcode,$this->bfitems)){
                            self::getValueOf_CarryForward($fmrcode,$result);
                        }
                     }

                     $this->item_totals[$fmrcode]  = self::getItemCeilAmount($fmrcode,$result);

                       if(!empty($formular_resultto)){
                        $this->item_totals[$formular_resultto]  = $this->item_totals[$fmrcode];
                       }


                     if(in_array($fmrcode , $this->items_val_from_formular , 0))
                     {//unused

                         $overide_staff_itemcode         = $this->items_val_from_formular_flipped[$fmrcode];

                         if  ($this->proc_debug) echo "\$overide_staff_itemcode={$overide_staff_itemcode} with new amount {$result}<br>";
                         if  ($this->proc_debug) print_pre($this->itemsArray[$overide_staff_itemcode]);

                         $temp                           = $this->staff_Items;

                         $current_staff_item_value       = 0;

                         $do_replace_value          = isset($this->itemsArray[$overide_staff_itemcode]['valrep']) && $this->itemsArray[$overide_staff_itemcode]['valrep']==1 ? true :false;
                         $current_staff_item_value  = isset($this->staff_Items[$overide_staff_itemcode]) && is_numeric($this->staff_Items[$overide_staff_itemcode]) ? $this->staff_Items[$overide_staff_itemcode] : 0;

                          if  ($this->proc_debug) echo "\$do_replace_value={$do_replace_value} {$current_staff_item_value}<br>";

                         if($do_replace_value){
                             $temp[$overide_staff_itemcode]  =  $this->item_totals[$fmrcode];
                         }else{
                             $temp[$overide_staff_itemcode]  = $current_staff_item_value + $this->item_totals[$fmrcode];
                         }

                         $this->item_totals[$overide_staff_itemcode]  = $temp[$overide_staff_itemcode];


                         $this->staff_Items              = $temp;

                         $temp =  [];

                  }
                }//other test (1>0)
               }//test formular
            }//each formular


            if  ($this->proc_debug) {
             echo "<table border=1>";
             foreach($this->item_totals as $k=>$v){
               $desc = valueof($this->item_descriptions, $k, $k);
               $formular_desc = valueof($this->formular_descriptions, $k, $k);
               $formular_math_str = valueof($this->formular_math_str, $k, $k);
               $item_type = valueof($this->item_types, $k, $k);
               echo "<tr>";
                echo "<td>{$k}</td>";
                echo "<td>{$desc}</td>";
                echo "<td>{$formular_desc}</td>";
                echo "<td>{$formular_math_str}</td>";
                echo "<td>{$item_type}</td>";
                echo "<td style='color:red'>{$v}</td>";
               echo "</tr>";
              }
              echo "</table>";

           }

              self::save_items( $staffno );

              $this->item_totals = [];

         }//we got some formulars
       }//each staff
      }//we got staff


      self::summaries();

      $response['success'] = 1;
      $response['message'] = "Done";
      echo json_encode( $response );
 }

  private function save_items( $staffno  )
  {
    if(count($this->item_totals)>0)
    {

    $this->db->where('pryear',$this->pryear)->where('prmonth',$this->prmonth)->where('staffno',$staffno)->delete( $this->payslip->table );

    foreach($this->item_totals as $itmcode => $amount)
    {
    if($amount>0)
     {

      $itmdesc  = valueof($this->item_descriptions, $itmcode, $itmcode );
      $data     = [];

      $data['pryear']       = $this->pryear;
      $data['prmonth']      = $this->prmonth;
      $data['staffno']      = $staffno;
      $data['itmcode']      = $itmcode;
      $data['itmdesc']      = $itmdesc;
      $data['amount']       = $amount;
      $data['rundate']      = date('Y-m-d');
      $data['auditdate']    = date('Y-m-d');
      $data['audittime']    = time();
      $data['audituser']    = $this->session->userdata('userid');
      $data['auditip']      = $this->input->ip_address();

      $this->payslip->save( $data );

      if($itmcode==$this->netpay_code){
       self::save_net( $staffno, $itmcode , $amount );
      }

     }
    }
   }
  }

  private function save_net( $staffno, $itmcode , $amount  )
  {

     $this->db->where('pryear',$this->pryear)->where('prmonth',$this->prmonth)->where('staffno',$staffno)->delete( $this->paynet->table );

     $staff_props = $this->staff_props[$staffno];
     $itmdesc     = valueof($this->item_descriptions, $itmcode, $itmcode );
     $data        = [];

     $data['pryear']       = $this->pryear;
     $data['prmonth']      = $this->prmonth;
     $data['staffno']      = $staffno;
     $data['itmcode']      = $itmcode;
     $data['itmdesc']      = $itmdesc;
     $data['amount']       = $amount;
     $data['emtcode']      = valueof($staff_props, 'emtcode');
     $data['jbtcode']      = valueof($staff_props, 'jbtcode');
     $data['dptcode']      = valueof($staff_props, 'dptcode');
     $data['stscode']      = valueof($staff_props, 'stscode');
     $data['brccode']      = valueof($staff_props, 'brccode');
     //$data['nationalid']   = valueof($staff_props, 'nationalid');
     $data['bkcode']       = valueof($staff_props, 'bkcode');
     $data['bkaccno']      = valueof($staff_props, 'bkaccno');

     $data['auditdate']    = date('Y-m-d');
     $data['audittime']    = time();
     $data['audituser']    = $this->session->userdata('userid');
     $data['auditip']      = $this->input->ip_address();

     $this->paynet->save( $data );

  }

  private function getValueOf_HeaderItems( $headercode, $formularcode ) {

    /**
     * check if exempt
     *
     */

    if(
        (
          array_key_exists($headercode,$this->staff_exemptItems)
              &&
          $this->staff_exemptItems[$headercode]==1
         )
         )
      {
        return  0;
      }

     /**
      * check from items array
      */
      $header_total = 0;

      foreach ($this->itemsArray as $itemcode=>$itemdetails) {

        if(
           ( isset($itemdetails['hdrcode']) && ($itemdetails['hdrcode']==$headercode) )
             &&
           array_key_exists($itemcode,$this->staff_Items)
             &&
           !array_key_exists($itemcode,$this->staff_exemptItems)
        ) {

          $itemtype = $itemdetails['itypecode'];

          ///get from items intenal fml
          $amount = self::getValueOf_Item($itemcode, $itemtype);

          $header_total += $amount;

          $amount       = 0;

          //...............................................

         }//if item is child of headercode
        }//foreach item

     /**
      * check from formulars array
      */

      foreach ($this->formularsArray as $fmrcode=>$fmrdetails) {

        if(
           ( isset($fmrdetails['hdrcode']) && ($fmrdetails['hdrcode']==$headercode) )
             &&
           array_key_exists($fmrcode,$this->item_totals)
             &&
           !array_key_exists($fmrcode,$this->staff_exemptItems)
        ) {

          ///get from items intenal fml
          $amount = $this->item_totals[$fmrcode];
          $amount = self::getItemCeilAmount($fmrcode, $amount);

          $header_total += $amount;

          $amount       = 0;

          //...............................................

         }//if item is child of headercode
        }//foreach item

        /**
         * first record item value in pay slip table
         *
        */

        if($header_total>0){
         $this->item_totals[$formularcode] = self::round($header_total);
        }

      return $header_total;
  }

  private function getValueOf_Item($itemcode, $itemtype ) {

    $value = 0;

    /**
     * check if exempt
     *
     */
      if  ($this->proc_debug) echo "function getValueOf_Item({$itemcode},{$itemtype})<br>";

    if(
        (
          array_key_exists($itemcode,$this->staff_exemptItems)
              &&
          $this->staff_exemptItems[$itemcode]==1
         )
         )
      {
        return  0;
      }


     /**
      * check from items array
      */

      foreach ($this->itemsArray as $loop_itemcode=>$itemdetails) {
        if(array_key_exists($loop_itemcode,$this->staff_Items) && $loop_itemcode==$itemcode)  {

          $itemtype = $itemdetails['itypecode'];
          $itemname = $itemdetails['itmname'];

          $amount   = isset($this->staff_Items[$itemcode]) ? $this->staff_Items[$itemcode] : 0;

          if((in_array($itemcode, $this->negativeAmtItems , true)) && $amount>0){
            $amount = ($amount*-1);
          }


          //.....................................................................................................................................................................


          if ($this->proc_debug) echo " raw amount for <font color=green>{$itemtype}</font>  <font color=blue>{$itemcode} {$itemname} </font>  is <font color=brown>{$amount}</font>  and   ";

          //-----------------------------------------------get value of header item--------------------------------------------------------------------------------------

           /**
            * get from processed list
            */

           if(array_key_exists($itemcode , $this->item_totals) && is_numeric($this->item_totals[$itemcode]) ) {


                 if ($this->proc_debug) echo " <font color=green> stored </font> ";

                 $amount = $this->item_totals[$itemcode];



           }elseif($itemtype==$this->type_reducingpayment && array_key_exists($itemcode, $this->reducingitems)) {

                 if ($this->proc_debug) echo " calculated <font color=green> reducingpayment </font> ";

                 $value  =   self::getValueOf_ReducingPayment($itemcode);
                 $amount = $value;


          }elseif($itemtype==$this->type_deposit && array_key_exists($itemcode, $this->deposititems)) {

                 if ($this->proc_debug) echo " calculated <font color=green> DepositCummulative </font> ";

                 $value  =   self::getValueOf_DepositCummulative($itemcode);
                 $amount = $value;


                 $this->item_totals[$itemcode] = self::getItemCeilAmount($itemcode, $amount);

           }elseif($itemtype==$this->type_loanrepayment && array_key_exists($itemcode,$this->loanitems)) {


                 if ($this->proc_debug) echo " calculated <font color=green> loanrepayment </font> ";

                 $value  =   self::getValueOf_LoanRepayment($itemcode);
                 $amount = $value;


           }else if($itemtype==$this->type_loanbalance) {

                if ($this->proc_debug) echo " calculated <font color=green> loanbalance </font> ";

                $exists_in_loan_setup = array_key_exists($itemcode , $this->loanitems_flipped) ? true : false;


                if($exists_in_loan_setup){
                    $itemcode_loanrep  = $this->loanitems_flipped[$itemcode];
                }else{
                    $itemcode_loanrep  = null;
                }

                if(array_key_exists($itemcode_loanrep,$this->staff_Items)){
                   $amount_rep = $this->staff_Items[$itemcode_loanrep];
                }else{
                    $amount_rep = 0;
                }

                if(isset($amount_rep) &&  $amount_rep>0) {

                    $amount_bal  =   self::getValueOf_LoanRepayment($itemcode_loanrep);

                 }elseif (isset($this->staff_Items[$itemcode])){
                    $amount_bal = $this->staff_Items[$itemcode];//for payslip processing only , process 0 bal to payslip if repayment is>0
                 }else{
                    $amount_bal = 0;//for payslip processing only , process 0 bal to payslip if repayment = 0 & bal = 0
                 }

                 $amount = $amount_bal;

                 /**
                  * if not in slip-items , insert it
                  */
                 if(!array_key_exists( $itemcode , $this->item_totals)){
                    $this->item_totals[$itemcode] = $amount;
                 }

               /**
                * add item amount in pay slip
                *
                */

           /**
            * return amount
            */

           }else{
             $value  =  $amount;

             if ($this->proc_debug) echo " <font color=green> empitem </font> ";
            /**
            * add item amount in pay slip
            *
            */
             $this->item_totals[$itemcode] = self::getItemCeilAmount($itemcode,$amount);

           }//end possibe types

           if ($this->proc_debug) echo "  amount  is <font color=red>{$amount}</font>  <br> ";


             return $amount;

        }
      }

      return 0;
  }

 private function getValueOf_Formular($formularcode){
    global $db;

    if  ($this->proc_debug) echo "getValueOf_Formular=getValueOf_Formular({$formularcode})<br>";

    if(
        (
          array_key_exists($formularcode,$this->staff_exemptItems)
         )
         )
      {
        return  0;
      }

      if(isset($this->item_totals[$formularcode]) && is_numeric($this->item_totals[$formularcode])){
        $value =  $this->item_totals[$formularcode];
      }else{
        $value =  0;
      }

       if(isset($value)){
        if(is_numeric($value)){
            $value = $value;
        }else{
            $value = 0;
        }
       }else{
        $value = 0;
       }

    $value = self::getItemCeilAmount($formularcode,$value);

    return $value;

  }


  private function getValueOf_LoanRepayment($itemcode) {
    global $db;

/**
 * check if loan is already processed
 */
 if(array_key_exists($itemcode , $this->loans)) {
   return  isset($this->loans[$itemcode]['AMTDED']) ? $this->loans[$itemcode]['AMTDED'] : 0;
 }else {

     if ($this->proc_debug) echo " <br><font color=green> ".str_repeat('.',50)." </font> <br>";

    $new_balance     = 0;
    $loan_complete   = false;
    $itembal  = isset($this->loanitems[$itemcode]) ? $this->loanitems[$itemcode] : null;
    $loan     = isset($this->staff_Items[$itemcode]) ?  $this->staff_Items[$itemcode] : 0;

    if($loan >0) {

     $repayment  = $loan;

    if($repayment>=0) {
        if($this->proc_debug) echo "\$repayment {$repayment}>0<br>";
     $balance_prev  = isset($this->staff_Items_Prev_Month[$itembal]) ? $this->staff_Items_Prev_Month[$itembal] : 0;

     if($this->proc_debug) echo "\$balance_prev in empitems for {$this->prev_pyear}/{$this->prev_pmonth} ={$balance_prev}<br>";

     if($balance_prev<=0){
         $balance  = isset($this->staff_Items[$itembal]) ?  $this->staff_Items[$itembal] : 0;
         if($this->proc_debug) echo "\$balance in empitems for {$this->pryear}/{$this->prmonth} ={$balance}<br>";
     }else{
        $balance = $balance_prev;
     }

     $balance_curr  = isset($this->staff_Items[$itembal]) ?  $this->staff_Items[$itembal] : 0;

     if($this->proc_debug) echo "\$balance_curr this month ={$balance_curr}<br>";

     if( $balance_curr <= $balance ){
        $balance = $balance_curr;
     }elseif($balance<=$balance_curr){
        $balance = $balance_curr;
     }

      if  ($this->proc_debug) echo "\$balance to use ={$balance}<br>";
      if  ($this->proc_debug) echo "REPAYMENT={$loan}<br>";
      if  ($this->proc_debug) echo "BALANCE as at {$this->prev_pyear}-{$this->prev_pmonth} is {$balance_prev}<br>";

     if($balance>=$repayment) {
         if($this->proc_debug) echo "\$balance {$balance}> \$repayment {$repayment}<br>";
        $loan_deduction  = $repayment;
     }elseif($repayment>$balance){
        if($this->proc_debug) echo " \$repayment {$repayment} > \$balance {$balance}<br>";

      //added 03/jun/2011 for loans without balance (one tyme payments)
       if($balance>0){
        $loan_deduction  = $balance;
       }else{
        $loan_deduction  = $repayment;
       }

      if  ($this->proc_debug) echo "\$loan_deduction={$loan_deduction}<br>";
     }else{
      $loan_deduction  = 0;
       //15-aug-2011 , if got bal , dont mark complete
      if(isset($this->staff_Items[$itembal]) && $this->staff_Items[$itembal]>0){
        $loan_complete   = false;
      }else{
        $loan_complete  = true;
      }

     }
    }else{
     $loan_deduction  = 0;
      //15-aug-2011 , if got bal ,  dont mark complete
      if(isset($this->staff_Items[$itembal]) && $this->staff_Items[$itembal]>0){
        $loan_complete   = false;
      }else{
        $loan_complete  = true;
      }

    }

    if(isset($balance)){
     $new_balance = $balance -  $loan_deduction;
    }else{
     $new_balance = 0;
    }

    if  ($this->proc_debug) echo "\$loan_deduction={$loan_deduction}<br>";
    if  ($this->proc_debug) echo "\$new_balance={$new_balance}<br>";

   }else{
    $loan_deduction  = 0;
   }

  $amtrep  = self::round($loan_deduction);

  if($amtrep>0){
    /*
   $this->loans[$itemcode]['ITMDED']    =  $itemcode;
   $this->loans[$itemcode]['AMTDED']    =  $amtrep;
   $this->loans[$itemcode]['ITMBAL']    =  $itembal;
   $this->loans[$itemcode]['AMTBAL']    =  $new_balance;
   */
  }

  if($amtrep>0 && $new_balance==0) {
    $loan_complete = true;
  }

  if($new_balance==0 && $loan_complete){
    $db->Execute(" UPDATE PRSITM SET STOPPED=1 WHERE STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE IN ('{$itemcode}','{$itembal}') ");
  }else{
    $db->Execute(" UPDATE PRSITM SET STOPPED=NULL WHERE STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE IN ('{$itemcode}','{$itembal}') ");
  }

  $this->item_totals[$itemcode]  = self::round($amtrep);
  $this->item_totals[$itembal]   = self::round($new_balance);

     if ($this->proc_debug) echo "<br><font color=green> ".str_repeat('.',50)." </font> <br>";

    return $loan_deduction;

  }
 }//fn get loan rep

  private function getValueOf_ReducingPayment($itemcode) {
    global $db;

/**
 * check if reducing_amount is already processed
 */
 if(array_key_exists($itemcode , $this->reductions)) {
   return  isset($this->reductions[$itemcode]['AMTPAY']) ? $this->reductions[$itemcode]['AMTPAY'] : 0;
 }else {

     if ($this->proc_debug) echo " <br><font color=blue> ".str_repeat('.',50)." </font> <br>";

    if ($this->proc_debug) print_pre($this->itemsArray[$itemcode]);

    $reducing_complete   = false;
    $itembal  = isset($this->reducingitems[$itemcode]) ? $this->reducingitems[$itemcode] : null;
    /**
     * reduce server querries , read curr amount from staff_items array
     */
    $reducing_amount     = isset($this->staff_Items[$itemcode]) ? $this->staff_Items[$itemcode] : 0;

//      echo "\$reducing_amount={$reducing_amount}<br>";

//      if(isset($reducing_amount) && is_array($reducing_amount) && sizeof($reducing_amount)>0) {
    if($reducing_amount > 0) {

//       $payment  = isset($reducing_amount['AMOUNT']) && $reducing_amount['AMOUNT']>0 ? $reducing_amount['AMOUNT'] : 0;
     $payment  = $reducing_amount;

    if($payment>=0) {
        if($this->proc_debug) echo "\$payment {$payment}>0<br>";

        $balance_prev     = isset($this->staff_Items_Prev_Month[$itembal]) ? $this->staff_Items_Prev_Month[$itembal] : 0;

//       $balance_prev  = $db->GetOne("SELECT AMOUNT FROM PRSLP WHERE  STAFFNO='{$this->staffno}' AND PRYEAR={$this->prev_pyear} AND PRMONTH={$this->prev_pmonth} AND ITMCODE='{$itembal}'");

//       echo "\$balance_prev={$balance_prev}<br>";
//       exit();
     if($this->proc_debug) echo "\$balance_prev in empitems for {$this->prev_pyear}/{$this->prev_pmonth} ={$balance_prev}<br>";
     // friday-13-may-2011

     //i no reducing_amount blance from last month , then reducing_amount is taken in curr month , get balance from curr-month , where bal=reduction_principal
     if(!isset($balance_prev) || empty($balance_prev)){
//           $balance = $db->GetOne("SELECT SUM(AMOUNT) AMOUNT  FROM PYEMsPITEMS WHERE  STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE='{$itembal}'");
         $balance     = isset($this->staff_Items[$itembal]) ? $this->staff_Items[$itembal] : 0;
         if($this->proc_debug) echo "\$balance in empitems for {$this->pryear}/{$this->prmonth} ={$balance}<br>";
     }else{
        $balance = $balance_prev;
     }

     // 05-jun-2011 -> get curr month bal n check if it has been increased
//       $balance_curr = $db->GetOne("SELECT SUM(AMOUNT) AMOUNT  FROM PRSITM WHERE  STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE='{$itembal}'");
     $balance_curr      = isset($this->staff_Items[$itembal]) ? $this->staff_Items[$itembal] : 0;

     if($this->proc_debug) echo "\$balance_curr this month ={$balance_curr}<br>";

     if( $balance_curr <= $balance ){//if current balace is less than prev bal
        $balance = $balance_curr;
     }elseif($balance<=$balance_curr){//if prev balance is less than current balance
        $balance = $balance_curr;
     }


      if  ($this->proc_debug) echo "\$balance to use ={$balance}<br>";
      if  ($this->proc_debug) echo "PAYMENT={$reducing_amount}<br>";
      if  ($this->proc_debug) echo "BALANCE as at {$this->prev_pyear}-{$this->prev_pmonth} is {$balance_prev}<br>";

     if($balance>=$payment) {
         if($this->proc_debug) echo "\$balance {$balance}> \$payment {$payment}<br>";
        $reduction_deduction  = $payment;
     }elseif($payment>$balance){
        if($this->proc_debug) echo " \$payment {$payment} > \$balance {$balance}<br>";

      //added 03/jun/2011 for reductions without balance (one tyme payments)
       if($balance>0){
        $reduction_deduction  = $balance;
       }else{
        $reduction_deduction  = $payment;
       }

      if  ($this->proc_debug) echo "\$reduction_deduction={$reduction_deduction}<br>";
     }else{
      $reduction_deduction  = 0;
       //15-aug-2011 , if got bal , dont mark complete
      if(isset($this->staff_Items[$itembal]) && $this->staff_Items[$itembal]>0){
        $reducing_complete   = false;
      }else{
        $reducing_complete  = true;
      }

     }
    }else{
     $reduction_deduction  = 0;
      //15-aug-2011 , if got bal ,  dont mark complete
      if(isset($this->staff_Items[$itembal]) && $this->staff_Items[$itembal]>0){
        $reducing_complete   = false;
      }else{
        $reducing_complete  = true;
      }

    }


    if(isset($balance)){
     $new_balance = $balance -  $reduction_deduction;
    }else{
     $new_balance = 0;
    }

    if  ($this->proc_debug) echo "\$reduction_deduction={$reduction_deduction}<br>";
    if  ($this->proc_debug) echo "\$new_balance={$new_balance}<br>";

  }else{
    $reduction_deduction  = 0;
  }

  $amtrep  = self::round($reduction_deduction);

  if($amtrep>0){
   $this->reductions[$itemcode]['ITEMPAY']    =  $itemcode;
   $this->reductions[$itemcode]['AMTPAY']     =  $amtrep;
   $this->reductions[$itemcode]['ITMBAL']    =  $itembal;
   $this->reductions[$itemcode]['AMTBAL']     =  $new_balance;
  }

  if($new_balance==0) {
    $reducing_complete = true;
  }

  //mark as complete if $new_balance=0
  if($new_balance==0 && $reducing_complete){
    $db->Execute(" UPDATE PRSITM SET COMPLETE=1 WHERE STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE='{$itemcode}' ");
    $db->Execute(" UPDATE PRSITM SET COMPLETE=1 WHERE STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE='{$itembal}' ");
  }else{
    $db->Execute(" UPDATE PRSITM SET COMPLETE=NULL WHERE STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE='{$itemcode}' ");
    $db->Execute(" UPDATE PRSITM SET COMPLETE=NULL WHERE STAFFNO='{$this->staffno}' AND PRYEAR={$this->pryear} AND PRMONTH={$this->prmonth} AND ITMCODE='{$itembal}' ");
  }

  $this->item_totals[$itemcode]  = $amtrep;
  $this->item_totals[$itembal]   =  self::round($new_balance);

   if ($this->proc_debug) echo "<br><font color=blue> ".str_repeat('.',50)." </font> <br>";

    return $reduction_deduction;

  }
 }//fn get reducing_amount rep

  private function getLoanStoppages(){

    foreach ($this->loanitems as $itemcode_repay=>$itemcode_bal){
     if(
         !array_key_exists($itemcode_repay,$this->staff_Items)
          &&
         array_key_exists($itemcode_bal,$this->staff_Items)
     ){

       if(
           ( isset($this->staff_Items[$itemcode_bal])  && $this->staff_Items[$itemcode_bal]>0 )
            &&
           ( isset($this->item_totals[$itemcode_bal])  && $this->item_totals[$itemcode_bal]>0 )
          )
        {
          $this->item_totals[$itemcode_bal] = $this->staff_Items[$itemcode_bal];
        }
     }
    }

  }

  private function getValueOf_DepositCummulative($itemcode) {
    global $db;

    $itemcumm     = isset($this->deposititems[$itemcode]) ? $this->deposititems[$itemcode] : null;

    if(isset($this->staff_Items[$itemcode])){
     $deposit_amount  = $this->staff_Items[$itemcode];
    }else{
     $deposit_amount  = isset($this->staff_Items[$itemcode]) ? $this->staff_Items[$itemcode] : 0;
    }

    if  ($this->proc_debug) echo "\$deposit_amount curr month={$deposit_amount}<br>";
    if($deposit_amount>0){

     $cummulative  = isset($this->staff_Items_Prev_Month[$itemcumm]) ? $this->staff_Items_Prev_Month[$itemcumm] : 0;

     if  ($this->proc_debug)  echo "staff_Items_Prev_Month::\$cummulative={$cummulative}<br>";
     if($cummulative<=0 || ( isset($this->staff_Items_Types[$itemcumm]) && strtoupper($this->staff_Items_Types[$itemcumm])=='D') ){
        $cummulative  = isset($this->staff_Items[$itemcumm]) ? $this->staff_Items[$itemcumm] : 0;
     }

     if  ($this->proc_debug)  echo "\$cummulative={$cummulative}<br>";

     if  ($this->proc_debug) echo "Cumm as at {$this->prev_pyear}-{$this->prev_pmonth} is {$cummulative}<br>";

    }else{
     $cummulative   = 0;
    }

     $cumm_total  = $deposit_amount + $cummulative;


    if  ($this->proc_debug) echo "\$deposit_amount={$deposit_amount}<br>";
    if  ($this->proc_debug) echo "\$cummulative={$cummulative}<br>";
    if  ($this->proc_debug) echo "\$cumm_total={$cumm_total}<br>";

    if($cumm_total>=0){
      $this->item_totals[$itemcumm] = self::round($cumm_total);
    }

    return $deposit_amount;

  }

  private function getValueOf_CarryForward($fmrcode, $formular_result) {
    global $db;

     if ($this->proc_debug)echo "calculating carry forward amount for formular {$fmrcode} with amount {$formular_result}<br>";

     $itemcf     = isset($this->bfitems[$fmrcode]['ITEMCF']) ? $this->bfitems[$fmrcode]['ITEMCF'] : null;
     $itembf     = isset($this->bfitems[$fmrcode]['ITEMBF']) ? $this->bfitems[$fmrcode]['ITEMBF'] : null;

     $curr_cfwdamount  = 0 ;

     if(array_key_exists($itembf,$this->staff_Items)){
       if( is_numeric($this->staff_Items[$itembf]) && is_numeric($formular_result) ){
         $curr_cfwdamount = $this->staff_Items[$itembf] + $formular_result;
       }
     }else{
        $curr_cfwdamount = $formular_result;
     }

      $this->staff_Items[$itemcf] = $curr_cfwdamount;

     $curr_bfwdamount  = 0 ;

     if(array_key_exists($itembf,$this->staff_Items)){
       if( is_numeric($this->staff_Items[$itembf]) ){
         $curr_bfwdamount = $this->staff_Items[$itembf];
       }
     }

    if ($this->proc_debug) echo "\$itemcf is {$itemcf} with current \$curr_cfwdamount of {$formular_result} = {$curr_cfwdamount}<br>";

    $this->item_totals[$itemcf] = self::getItemCeilAmount($itemcf,$curr_cfwdamount);

    $this->item_totals[$itembf] = self::getItemCeilAmount($itembf,$curr_bfwdamount);

  }

 private function get_payroll_settings(){
    $this->netpay_code    = 500;
    $this->grosspay_code  = 200;
    $this->datetoday      = date('Y-m-d');
  }

  private function getItemCeilAmount($itemcode,$amount){

    if($amount>0) {
        if(isset($this->itemsArray[$itemcode]['maxval']) && $this->itemsArray[$itemcode]['maxval']>0){
            if($amount > $this->itemsArray[$itemcode]['maxval'] ){
                $amount = $this->itemsArray[$itemcode]['maxval'];
            }
        }elseif(isset($this->formularsArray[$itemcode]['maxval']) && $this->formularsArray[$itemcode]['maxval']>0){
            if($amount > $this->formularsArray[$itemcode]['maxval'] ){
                $amount = $this->formularsArray[$itemcode]['maxval'];
            }
        }

    }elseif($amount<0) {
        if(isset($this->itemsArray[$itemcode]['minval'])){
            if($amount < $this->itemsArray[$itemcode]['minval'] ){
                $amount = $this->itemsArray[$itemcode]['minval'];
            }
        }elseif(isset($this->formularsArray[$itemcode]['minval'])){
            if($amount < $this->formularsArray[$itemcode]['minval'] ){
                $amount = $this->formularsArray[$itemcode]['minval'];
            }
        }
    }

    //returnn rounded
    return self::round($amount);

  }

  private function round($amount){
    return  round($amount / 5, self::$rounding_presicion) * 5;

  }

  private function get_fmr_desc( $formular ){
        global $db;

        $array_items     =  [];
        $array_headers   =  [];
        $array_formulars =  [];

        if( $this->psHeaderArray && sizeof($this->psHeaderArray)>0){
         foreach($this->psHeaderArray as $hdrcode=>$hdrname){
             $array_headers[$hdrcode] = $hdrname;
         }
        }

        if($this->itemsArray && sizeof($this->itemsArray)>0){
         foreach($this->itemsArray as $itemcode=>$itm){
             $itemname = valueof($itm, 'itmname');
             $array_items[$itemcode]  = $itemname;
         }
        }

        if($this->formularsArray && sizeof($this->formularsArray)>0){
         foreach($this->formularsArray as $fmrcode=>$frm){
             $frmname = valueof($frm, 'fmrname');
             $array_formulars[$fmrcode] = $frmname;
         }
        }

      $fmr_array = preg_split('/ /', $formular, -1, PREG_SPLIT_DELIM_CAPTURE);
      $text      =  " ";

      foreach ($fmr_array as $char) {

       if(array_key_exists($char , $array_items)){
         $text .= "<span style='color:green'> {$array_items[$char]} </span>";
       }elseif (array_key_exists($char , $array_formulars)){
         $text .= "<span style='color:brown'> {$array_formulars[$char]} </span>";
       }elseif (array_key_exists($char , $array_headers)){
         $text .= "<span style='color:#0000FF'> Sum({$array_headers[$char]})... </span>";
       }elseif (strstr($char,'if') || strstr($char,'else') || strstr($char,'{')  || strstr($char,'}') ) {
         $text .= "<br><b style='color: #6CAEF5'>{$char}</b>";
       }elseif (strstr($char,':ic') ) {
         $text .= " <b style='color: #CB9732'>{$char}</b> ";
       }else{
         $text .= " <b style='color: red'>{$char}</b> ";
       }

     }

     return $text;
  }

  public function summaries(){

     self::manage_table_summaries();

      $this->db->where('pryear',$this->pryear)->where('prmonth',$this->prmonth)->delete( $this->paysummary->table );

      $this->db->select('staffno,itmcode,amount');
      $this->db->from('viewpayslip ');
      $this->db->where("pryear ={$this->pryear}");
      $this->db->where("prmonth ={$this->prmonth}");
      $this->db->order_by("staffno","ASC");
      $this->db->order_by("itmcode","ASC");

      $payslip_records  = $this->db->get();

      $data_payslip  = [];

    if($payslip_records->num_rows() > 0)
    {

     foreach ($payslip_records->result_array() as $payslip_record )
     {

     $staffno    = valueof($payslip_record, 'staffno');
     $itmcode    = valueof($payslip_record, 'itmcode');
     $amount     = valueof($payslip_record, 'amount');

     $data_payslip[$staffno][$itmcode] = $amount;

     }

   $count       =  1;
   $num_records =  sizeof($data_payslip);

   if($num_records>0) {
    foreach($data_payslip as $staffno => $item ) {
     $data = [];

     foreach($item as $itmcode => $amount){
      $summary_col = "I{$itmcode}";
      $data['pryear']       = $this->pryear;
      $data['prmonth']      = $this->prmonth;
      $data['staffno']      = $staffno;
      $data[$summary_col] = $amount;
     }

     $this->paysummary->save( $data );

     }//each staff
    }//if got records
   }//if got records

  }

  private function manage_table_summaries(){
   global $db;

    require_once(APPPATH.'libraries/adodb/adodb-php/adodb.inc.php');
    require_once(APPPATH.'libraries/adodb/adodb-php/adodb-xmlschema03.inc.php');

    include(APPPATH.'config/database.php');
    $group    = 'default';
    $hostname = $db[$group]['hostname'];
    $username = $db[$group]['username'];
    $password = $db[$group]['password'];
    $database = $db[$group]['database'];

    unset($db);

    $db = ADONewConnection('mysqli');
    $db->Connect($hostname,$username,$password,$database);
    $db->SetFetchMode(ADODB_FETCH_ASSOC);

    $ADODB_ASSOC_CASE       = 0;
    $ADODB_ACTIVE_CACHESECS = 30;

    $company_uid =  rand(1,10000);

   $items = $db->GetAssoc("select distinct itmcode,itmdesc from payslip  ");

   if(!$items || sizeof($items)==0) return 'No Items Found';

   $xml_file_name = APPPATH."third_party/datadict/pivot_{$company_uid}.xml";
   $view_cols = array();

   $xml   = "<?xml version=\"1.0\"?> \r\n";
   $xml  .= "<schema version=\"0.3\"> \r\n";
   $xml  .= "\r\n";

    $xml .= "<table name=\"paysummary\"> \r\n";
    $xml .= " <descr>{$company_uid} pay summaries as pivot table</descr> \r\n";
    $xml .= " <opt platform=\"mysql\">ENGINE=MyISAM DEFAULT CHARSET=utf8</opt> \r\n";
    $xml .= " <opt platform=\"mssql\"></opt> \r\n";
    $xml .= " <opt platform=\"oci8\"></opt> \r\n";

    $xml .= " <field name=\"pryear\"     type=\"I\" size=\"4\"    ><KEY/><NOTNULL/></field>\r\n";
    $xml .= " <field name=\"prmonth\"    type=\"I\" size=\"2\"    ><KEY/><NOTNULL/></field>\r\n";
    $xml .= " <field name=\"staffno\"    type=\"C\" size=\"20\"   ><KEY/><NOTNULL/></field>\r\n";

    $itmcode_plh = "ZZZ";
    $colname     = "I{$itmcode_plh}";
    $view_cols[] = "p.{$colname}";

    $xml .= " <field name=\"{$colname}\" type=\"N\" size=\"9.2\" />\r\n";

    foreach ($items as $itmcode=>$itmname) {
    $colname     = "I{$itmcode}";
    $view_cols[] = "p.{$colname}";

    $xml .= " <field name=\"{$colname}\" type=\"N\" size=\"9.2\" />\r\n";
    }

    $xml .= "<index name=\"idx_pk\">\r\n";
     $xml .= "<col>pryear</col>\r\n";
     $xml .= "<col>prmonth</col>\r\n";
     $xml .= "<col>staffno</col>\r\n";
     $xml .= "<UNIQUE/>\r\n";
    $xml .= "</index>\r\n";

    $xml .= "<index name=\"idx_search\">\r\n";
    $xml .= " <col>staffno</col>\r\n";
    $xml .= " <FULLTEXT/>\r\n";
    $xml .= " <BITMAP/>\r\n";
    $xml .= " <NONCLUSTERED/>\r\n";
   $xml .= "</index>\r\n";

  $xml .= "</table> \r\n";
  $xml .=  "\r\n";
  $xml .= "</schema> \r\n";

   $handle = fopen($xml_file_name,'w');

   if(!$handle) return "Unable to open {$xml_file_name} for write!";
   if(!fwrite($handle,$xml)) return "Unable to write into {$xml_file_name} ";
    @fclose($handle);
    $schema = new adoSchema( $db );

    $schema->SetUpgradeMethod( 'BEST' );
    $schema->continueOnError = true;
    $schema->debug = true;

    $sql     = @$schema->ParseSchema($xml_file_name);
    $schema->ExecuteSchema();

    @unlink($xml_file_name);

    //create view
    $table_view_cols = implode(',', $view_cols);

     $view_sql        = "
    select p.pryear, p.prmonth, p.staffno,s.sltcode,t.sltname, s.namefirst, s.namemid, s.namelast, s.staffname, s.alias,
    s.emtcode, m.emtname, s.jbtcode, j.jbtname, s.brccode, b.brcname, s.dptcode, d.dptname, s.dob, s.doe,
    s.stscode,e.stsname,e.isdefault,e.isactive,e.isperma,e.ispaid,
    s.gndcode,g.gndname,s.ctncode, s.natcode, s.nationalid, s.mstcode, i.mstname,
    s.email, s.emailalt, s.mobile, s.mobilealt, s.address,
    s.taxno, s.npfno, s.bkcode,k.bkname, s.bkaccno, s.fp,
    {$table_view_cols}
    from paysummary p
    inner join hrstaff s on s.staffno=p.staffno
    LEFT JOIN hrsalut t on t.sltcode=s.sltcode
    LEFT JOIN hremployterms m on m.emtcode=s.emtcode
    LEFT JOIN hrjobtitle j on j.jbtcode=s.jbtcode
    LEFT JOIN hrbranches b on b.brccode=s.brccode
    LEFT JOIN hrdepartments d on d.dptcode=s.dptcode
    LEFT JOIN hremploystatus e on e.stscode=s.stscode
    LEFT JOIN hrmaritsts i on i.mstcode=s.mstcode
    LEFT JOIN hrbanks k on k.bkcode=s.bkcode
    LEFT JOIN hrgender g on g.gndcode=s.gndcode
     ";

    @$db->Execute("drop table viewpaysummary");
    @$db->Execute("drop view viewpaysummary");
    @$db->Execute("create view viewpaysummary as {$view_sql}");

  }





}
