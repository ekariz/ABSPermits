<?php

$required             =  'required';
$docpayment_id        =  valueof($docpayment , 'file_name');
$exists_docpayment    =  !empty($docpayment_id) ? true : false;
$icon_docpayment      =  isset($docpayment['client_name'])     ? 'check' : 'hourglass';
$required_docpayment  =  $exists_docpayment  ? '' : ' ';


 
    //$data['invno']         = $saved_invno;
    //$data['payamount']     = $saved_payamount;
    //$data['invdesc']       = $saved_invdesc;


$bank_instructions = [];

if(sizeof($bankaccounts)>0){
foreach($bankaccounts as $row ){

$BankName = valueof($row, 'bankname');
$BranchName = valueof($row, 'branchname');
$AccountNo = valueof($row, 'accountno');
$AccountName = valueof($row, 'accountname');
$SwiftCode = valueof($row, 'swiftcode');

$bank_instructions[] =  <<<INS
<table  class="table table-bordered table-condensed">

 <tr>
  <td>Bank</td><td>{$BankName}</td>
 </tr>

 <tr>
  <td>Branch</td><td>{$BranchName}</td>
 </tr>

 <tr>
  <td>Account No</td><td>{$AccountNo}</td>
 </tr>

 <tr>
  <td>Account Name</td><td>{$AccountName}</td>
 </tr>

 <tr>
  <td>Swift Code</td><td>{$SwiftCode}</td>
 </tr>

</table>
INS;
 }
}

$bank_instructions_str     = implode("<br> or ",$bank_instructions);
$payamount_f               = number_format($payamount);
?>

<div class="alert  alert-icon alert-info" role="alert">
    <i class="fa fa-info-circle"></i>
    <?php echo $institution->instname; ?>  Bio  Diversity Permit <?php echo $apptypedesc; ?> Charges are <?php echo $payamount_f; ?> <?php echo $currname; ?>
</div>

<div class="vertical">

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#vtab1" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-mobile-phone pr-10"></i> MPESA Express </a></li>
        <li class=" "><a href="#vtab2" role="tab" data-toggle="tab"  ><i class="fa fa-mobile-phone pr-10"></i> MPESA Paybill </a></li>
        <li class=""><a href="#vtab3" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-bank pr-10"></i> Bank Transfer</a></li>
        <li class=""><a href="#vtab4" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-bank pr-10"></i> Card Payment</a></li>
        <li class=""><a href="#vtab5" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-credit-card pr-10"></i> I have already paid</a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane fade active in" id="vtab1"style="width:100%" >

            <h3 class="title">Lipa na MPESA Online</h3>
            <ul class="list-icons">
                <li><i class="icon-check pr-10"></i> Make sure you have the MPESA paying phone with you</li>
                <li><i class="icon-check pr-10"></i> Click 'Pay Now' a Below</li>
                <li><i class="icon-check pr-10"></i> Enter MPESA PIN when prompted on your phone</li>
                <li><i class="icon-check pr-10"></i> Submit and wait a confirmation message from Safaricom M-PESA</li>
            </ul>

            <p><?php echo $companyname; ?> will send you a  Confirmation SMS once the transaction is complete</p>

            <hr>
            <p>Provide Mobile Number for Lipa na Mpesa</p>
            <p><input type="text"   class="form-control" name="mobile" id="mobile" value="<?php echo $mobile; ?>"  ></p>

            <a href="javascript:void(0);"  class="btn btn-animated btn-success" id="btnPayMX" onclick="mpesaExpress.init_mpesa_stkpush('<?php echo $id; ?>','<?php echo $stepno; ?>');" >Pay Now <i class="fa fa-mobile-phone"></i> </a>
            <a href="#"  onclick=" show_payments();"  class="btn   btn-gray">Pay Later </a>

        </div>

        <div class="tab-pane fade " id="vtab2" style="width:100%" >
            <h3 class="title">Pay with MPESA</h3>
            <ul class="list-icons">
                <li><i class="icon-check pr-10"></i> Go to <b>M-PESA</b> menu of your Phone</li>
                <li><i class="icon-check pr-10"></i> Select Lipa na Mpesa</li>
                <li><i class="icon-check pr-10"></i> Select Pay Bill</li>
                <li><i class="icon-check pr-10"></i> Enter <b><?php echo $paybillno; ?></b> as the Business Number</li>
                <li><i class="icon-check pr-10"></i> Enter <b><?php echo $invno; ?></b> as the <b>Account Number</b></li>
                <li><i class="icon-check pr-10"></i> Enter <b> <?php echo $payamount_f;  ?></b> as the Amount.</li>
                <li><i class="icon-check pr-10"></i> Enter your M-PESA PIN number</li>
                <li><i class="icon-check pr-10"></i> Wait a confirmation message from Safaricom M-PESA</li>
            </ul>

            <p><?php echo $companyname; ?> will send you a  Confirmation SMS once the transaction is complete</p>

            <a href="javascript:void(0);" class="btn btn-animated btn-success" onclick="mpesaPaybill.validate('<?php echo $id; ?>','<?php echo $stepno; ?>');return false" >Confirm Payment <i class="fa fa-arrow-right"></i> </a>
            <a href="#"  onclick=" show_payments();"  class="btn   btn-gray">Pay Later </a>

        </div>

        <div class="tab-pane fade" id="vtab3" style="width:100%" >
            <h3 class="title">Bank Transfer</h3>
            <p>Kindly use the following bank details to make the payments</p>
            <p><?php echo $bank_instructions_str; ?></p>

            <a href="#" class="btn btn-animated btn-success">Continue <i class="fa fa-arrow-right"></i> </a>
        </div>

        <div class="tab-pane fade" id="vtab4">
            <h3 class="title">Credit/Debit  Card Payment</h3>

             <?php
              $this->load->view('main/frontend/appform/steps/payment_card_paygate');
            ?>
        </div>

        <div class="tab-pane fade" id="vtab5">
            <h3 class="title">Have you already  paid for <?php echo $institution->instname; ?> ?</h3>

           <div class="col-md-12 form-group">
            <label for="doc_fee_payment">Evidence of access  Application Fee payment</label>
            <?php
             echo make_file_upload_field( 'docpayment', $docpayment, 'Evidence of access Permit Application Fee payment',$required_docpayment, "upload_files_payment('{$stepno}','{$instcode}');" );
            ?>
           </div>

            <p>We will confirm your payment at the finance approval stage</p>
            <a href="#"  onclick=" show_payment();" class="btn btn-animated btn-success">Continue <i class="fa fa-arrow-right"></i> </a>
        </div>

    </div>
</div>

