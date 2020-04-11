<?php

$documentmta_id            =  valueof($documentmta, 'file_name');
$documentpic_id            =  valueof($documentpic, 'file_name');
$documentmat_id            =  valueof($documentmat, 'file_name');
$documentip_id             =  valueof($documentip, 'file_name');

$exists_documentmta        =  !empty($documentmta_id)   ? true : false;
$exists_documentpic        =  !empty($documentmat_id)   ? true : false;
$exists_documentmat        =  !empty($documentmat_id)   ? true : false;
$exists_documentip         =  !empty($documentip_id)    ? true : false;

$display_documentmta       =  $exportanswer ==1 || $exists_documentmta  ? 'block' : 'none';
//$display_documentip        =  $exportanswer ==1 || $exists_documentip  ? 'block' : 'none';

$icon_documentmta          =  isset($documentmta['client_name'])   ? 'check' : 'hourglass';
$icon_documentpic          =  isset($documentpic['client_name'])  ? 'check' : 'hourglass';
$icon_documentmat          =  isset($documentmat['client_name'])  ? 'check' : 'hourglass';
$icon_documentip           =  isset($documentip['client_name'])  ? 'check' : 'hourglass';

$required_documentmta      =  $exportanswer ==1 ? '' : 'required';
$required_documentpic      =  $exists_documentpic  ? '' : 'required';
$required_documentmat      =  $exists_documentmat  ? '' : 'required';
$required_documentip       =  $exists_documentip  ? '' : 'required';

$state_resources_deposit      = $exportanswer==1 ? 'none' : 'block';
$required_resources_deposit   = $exportanswer==1 ? '' : 'required';

$required_documentmta      =  '';
$required_documentpic      =  '';
$required_documentmat      =  '';
$required_documentip       =  '';

$state_resources_deposit      = '';
$required_resources_deposit   = '';

?>

<!--
add -> required="required" 
to all required fields
-->

<div class="col-md-12 form-group">
    <label for="resourcetype">Will you be Researching / Collecting a Genetic Resource, Genetic Information or Traditional Knowledge from The Bahamas?</label>
</div>

<div class="col-md-12 form-group">
    <?php echo form_dropdown('geneticresourcerc', $export_answer_list, $geneticresourcerc ,'id="geneticresourcerc" class="form-control  input-sm" onchange="handle_is_export();handle_export_docs();"   ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group">
    <label for="resourcetype">Will you be Exporting a Genetic Resource, Genetic Information or Traditional Knowledge  from The Bahamas?</label>
</div>

<div class="col-md-12 form-group">
    <?php echo form_dropdown('exportanswer', $export_answer_list, $exportanswer ,'id="exportanswer" class="form-control  input-sm" onchange="handle_export_docs();" ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group resources_deposit" style="display:<?php echo $state_resources_deposit;?>" >
    <label for="resourcetype">Where will the  Genetic Resources / Material be deposited?</label>
</div>

<div class="col-md-12 form-group  resources_deposit" style="display:<?php echo $state_resources_deposit;?>" >
    <input type="text" class="form-control input-sm" name="resourcesdeposit" id="resourcesdeposit"  value="<?php echo $resourcesdeposit; ?>"  <?php echo $required_resources_deposit;?> >
    <div class="help-block with-errors"></div>
</div>


