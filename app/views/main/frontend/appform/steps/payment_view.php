<?php
$num_steps = count($approvalsteps);
$num_paid  = 0;
foreach($approvalsteps as $stepno=>$stepname){
$col_paid    = "paid{$stepno}";
$paid        = valueof($paids, $col_paid);
if($paid==1){
 ++$num_paid;
}
}

?>
<div class="col-sm-12">

<?php if($num_paid==$num_steps){ ?>
<div class="alert alert-success ">
 Congratulations <?php echo $firstname; ?> , you can now submit your application.
</div>
<?php }else{ ?>

<div class="alert alert-warning ">
 You are required to pay Permit Licence Fees to the Following Institutions
</div>

<?php } ?>

<table class="table table-colored table-striped table-bordered table-hover table-condensed" width="100%">
 <thead>
  <tr>
   <th>Institution</th>
   <th>Licensing Fees</th>
   <th>Payment</th>
  </tr>
 </thead>
 <tbody>
 <?php

  foreach($approvalsteps as $stepno=>$stepname){

    $col_paid    = "paid{$stepno}";
    $col_payref  = "payref{$stepno}";
    $col_paytime = "paytime{$stepno}";
    $col_paymode = "paymode{$stepno}";

    $amount      = valueof($charges, $stepname);
    $paid        = valueof($paids, $col_paid);
    $payref      = valueof($payrefs, $col_payref);
    $paytime     = valueof($paytimes, $col_paytime);
    $paymode     = valueof($paymodes, $col_paymode);

  ?>
  <tr>
   <td><?php echo $stepname; ?></td>
   <td><strong><?php echo number_format($amount); ?></strong></td>

   <?php if($paid==1){ ?>
   <td  class="text-left"><a href="javascript:void(0);"   class="btnx btn-sm  btn-success"><i class="fa fa-check"></i> Paid</a></td>
   <?php }else{ ?>
   <td class="text-left"><a href="javascript:void(0);" onclick="payments.init('<?php echo $id; ?>','<?php echo $stepno; ?>');" class="btnx btn-sm  btn-info"><i class="fa fa-arrow-right"></i> Pay Now</a></td>
   <?php } ?>

  </tr>

 <?php
  }
  ?>

 </tbody>
</table>


</div>
