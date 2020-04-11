<?php

?>

<div class="col-md-6 form-group">
    <label for="REFERENCE" class=" control-label">Reference</label>
        <input type="text" name="REFERENCE" id="REFERENCE" class="form-control" value="<?php echo $appno; ?>"  readonly />
</div>

<div class="col-md-6 form-group">
    <label for="EMAIL" class="  control-label">Customer Email</label>
        <input type="text" name="EMAIL" id="EMAIL" class="form-control" value="<?php echo $email; ?>" />
</div>

<div class="col-md-6 form-group">
    <label for="REFERENCE" class=" control-label">Amount</label>
        <input type="text" name="AMOUNT" id="AMOUNT" class="form-control" value="<?php echo $charge_usd; ?>" readonly />
</div>

<div class="col-md-6 form-group">
    <label for="CURRENCY" class="  control-label">Currency</label>
        <input type="text" name="CURRENCY" id="CURRENCY" class="form-control" value="<?php echo $currcode_pay; ?>" readonly />
</div>

<div class="col-md-6 form-group">
     <button type="btnInitpaygate" name="btnInitpaygate" class="btn btn-success" onclick="PayGate.initiate('<?php echo $id; ?>','<?php echo $stepno; ?>');"   >Initiate Payment</button>
</div>

<div class="col-md-12 form-group">
     <img src="<?php echo base_url();?>assets/img/PayGate-Card-Brand-Logos.jpg" >
</div>


