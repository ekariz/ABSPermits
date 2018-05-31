<?php
$num_steps     = count($approvalsteps);
$num_paid      = 0;
$num_approved  = 0;
foreach($approvalsteps as $stepno=>$stepname){
$col_paid     = "paid{$stepno}";
$col_approved = "approved{$stepno}";
$paid         = valueof($paids, $col_paid);
$approved     = valueof($approves, $col_approved);

 if($paid==1){
  ++$num_paid;
 }

 if($approved==1){
  ++$num_approved;
 }

}

?>
<div class="col-sm-12">

<?php if($num_paid==$num_steps){ ?>
<div class="alert alert-success ">
 Congratulations <?php echo $firstname; ?> , Your ABS PERMIT Ref# <?php echo $appno; ?> is now Ready
</div>
<?php }else{ ?>
<div class="alert alert-info ">
 Payments for Application Ref #<?php echo $appno; ?>
</div>
<?php } ?>

<table class="table table-ruled table-stripped table-bordered table-condensed" width="100%">
 <thead>
  <tr>
   <th>Institution</th>
   <th>Licensing Fees</th>
   <th>Payment</th>
   <th class="text-center">Permit</th>
  </tr>
 </thead>
 <tbody>
 <?php

  foreach($approvalsteps as $stepno=>$stepname){

    $col_paid     = "paid{$stepno}";
    $col_payref   = "payref{$stepno}";
    $col_paytime  = "paytime{$stepno}";
    $col_paymode  = "paymode{$stepno}";
    $col_approved = "approved{$stepno}";

    $amount      = valueof($charges, $stepname);
    $paid        = valueof($paids, $col_paid);
    $payref      = valueof($payrefs, $col_payref);
    $paytime     = valueof($paytimes, $col_paytime);
    $paymode     = valueof($paymodes, $col_paymode);
    $approved    = valueof($approves, $col_approved);

  ?>
  <tr>
   <td><?php echo $stepname; ?></td>
   <td><strong><?php echo number_format($amount); ?></strong></td>

   <?php if($paid==1){ ?>
   <td  class="text-left"><a href="javascript:void(0);"   class="btnx btn-sm  btn-success"><i class="fa fa-check"></i> Paid</a></td>
   <?php }else{ ?>
   <td class="text-left"><a href="javascript:void(0);" onclick="payments.init('<?php echo $id; ?>','<?php echo $stepno; ?>');" class="btnx btn-sm  btn-info"><i class="fa fa-arrow-right"></i> Pay Now</a></td>
   <?php } ?>


   <?php if($paid==1 && ($num_paid==$num_steps)){?>

      <?php if(($num_approved==$num_steps) ){ ?>
     <td  class="text-center"><a href="javascript:void(0);" onclick="permit.download(<?php echo $id; ?>,'<?php echo $stepno; ?>');"   class="btnx btn-sm  btn-info"><i class="fa fa-arrow-down"></i> Download Permit</a></td>
      <?php }else{ ?>
     <td  class="text-center"><a href="javascript:void(0);" onclick="swal({ text: 'Not Yet Approved Fully', icon: 'warning'});"  class="btn-sm btn-warning" disabled><i class="fa fa-ban"></i> <i>Not Approved</i></a></td>
      <?php } ?>

   <?php }else{ ?>
   <td  class="text-center"><a href="javascript:void(0);" onclick="swal({ text: 'Pay All Institutions First', icon: 'error'});"  class="btn-sm btn-danger" disabled><i class="fa fa-ban"></i> <i>Pay First</i></a></td>
   <?php } ?>

  </tr>

 <?php
  }
  ?>
  <?php if($num_paid==$num_steps){ ?>
<!--
   <tr>
   <td colspan="3" class="text-left">
     <a href="<?php  echo base_url().'ABSPermit/'.$id; ?>"   class="btn btn-md  btn-danger"><i class="fa fa-file-pdf-o"></i> Download Your ABS PERMIT</a>
    </td>
  </tr>
-->
   <?php } ?>
 </tbody>
</table>

</div>
</div>
