<input type="hidden" id='amount' name="amount" value="<?php echo $amount; ?>" >

<div class="row">
  <div class="col-sm-12">
    <img src="<?php echo base_url();?>assets/frontend/images/Lipa-na-M-Pesa.png"  >
  </div>
</div>

<div class="alert alert-info ">
  Make sure you have your mobile with you to complete the payment. You will be required to enter your MPESA pin once to click 'Continue'<br>
</div>

<div class="col-sm-12">

<table class=" table-ruled table-bordered table-condensed">

 <tr>
  <td>Instituion</td>
  <td><strong><?php echo $institution->instname; ?></strong></td>
 </tr>

 <tr>
  <td>The calculated amount to pay is: KHS</td>
  <td><strong><?php echo $amount; ?></strong></td>
 </tr>

 <tr>
  <td>Provide Mobile Number for Lipa na Mpesa</td>
  <td><input type="text"   class="form-control" name="mobile" id="mobile" value="<?php echo $mobile; ?>"  ></td>
 </tr>

 <tr>
  <td>&nbsp;</td>
  <td>
     <a id="btnPay"  class="btn btn-md  btn-success" onclick="payments.init_mpesa_stkpush('<?php echo $id; ?>','<?php echo $stepno; ?>');return false;" ><i class="fa fa-check"></i> Pay Now </a> |
     <a href="javascript:void(0);" onclick="show_payment();" class="btn-link btn-sm  btn-default"><i class="fa fa-arrow-left"></i> Cancel </a>
  </td>
 </tr>

</div>


