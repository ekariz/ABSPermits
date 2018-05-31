<?php

if(empty($exportanswer)){
 $exportanswer = 0;
}
$documentmta_id            =  valueof($documentmta, 'file_name');
$documentpic_id            =  valueof($documentpic, 'file_name');
$documentmat_id            =  valueof($documentmat, 'file_name');
$documentip_id             =  valueof($documentip, 'file_name');

$exists_documentmta        =  !empty($documentmta_id)   ? true : false;
$exists_documentpic        =  !empty($documentmat_id)   ? true : false;
$exists_documentmat        =  !empty($documentmat_id)   ? true : false;
$exists_documentip         =  !empty($documentip_id)    ? true : false;

$display_documentmta       =  $exportanswer ==1 || $exists_documentmta  ? 'block' : 'none';

$icon_documentmta          =  isset($documentmta['client_name'])   ? 'check' : 'hourglass';
$icon_documentpic          =  isset($documentpic['client_name'])  ? 'check' : 'hourglass';
$icon_documentmat          =  isset($documentmat['client_name'])  ? 'check' : 'hourglass';
$icon_documentip           =  isset($documentip['client_name'])  ? 'check' : 'hourglass';

$required_documentpic      =  $exists_documentpic  ? '' : 'required';
$required_documentmat      =  $exists_documentmat  ? '' : 'required';
$required_documentip       =  $exists_documentip  ? '' : 'required';

$required_documentmta      =  $exportanswer ==1 ? 'required' : '';

?>

<table class="table table-bordered table-condensed" >
 <thead>
 <tr>
  <th>Document</th>
<!--
  <th>&nbsp;</th>
-->
  <th>Attach PDF File</th>
  <th>Status</th>
 </tr>
</thead>

 <tr id="table_row_import_permit"   >
  <td><strong>Import Permit</strong></td>
<!--
  <td>Import Permit</td>
-->
  <td><div class="form-group">
     <input type="file" id="documentip" name="documentip" onchange="upload_files();"    <?php echo $required_documentip;?>  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentip" ><i class="fa fa-<?php echo $icon_documentip;?>"></i></td>
 </tr>


 <tr   id="table_row_exporter_pic"  >
  <td  ><strong>Prior Informed Consent (PIC)</strong></td>
<!--
  <td><a href="<?php  echo base_url();?>assets/frontend/pdf/Prior_Informed_Consent_template.pdf" target="_blank" ><i class="fa fa-file-pdf-o" style="color:red"></i> Downlod PIC Template</a></td>
-->
  <td><div class="form-group">
     <input type="file" id="documentpic" name="documentpic"  onchange="upload_files();" <?php echo $required_documentpic;?>  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentpic" ><i class="fa fa-<?php echo $icon_documentpic;?>"></i></td>
 </tr>

 <tr id="table_row_exporter_mat" >
  <td><strong>Mutually Agreed Terms (MAT) </strong></td>
<!--
  <td><a href="<?php  echo base_url();?>assets/frontend/pdf/Mutually_Agreed_Terms_Template.pdf" target="_blank" ><i class="fa fa-file-pdf-o" style="color:red"></i> Downlod MAT Template</a></td>
-->
  <td><div class="form-group">
     <input type="file" id="documentmat" name="documentmat"  onchange="upload_files();" <?php echo $required_documentmat;?>  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentmat" ><i class="fa fa-<?php echo $icon_documentmat;?>"></i></td>
 </tr>

 <tr  id="table_row_exporter_mta"  >
  <td class="td-mta"   ><strong>Material Transfer Agreement (MTA)</strong></td>
<!--
  <td class="td-mta"   ><a href="<?php  echo base_url();?>assets/frontend/pdf/Materials_Transfer_Agreement_Template.pdf" target="_blank" ><i class="fa fa-file-pdf-o" style="color:red"></i> Downlod MTA Template</a></td>
   <?php // echo $required_documentmta;?>
-->
  <td class="td-mta"   ><div class="form-group">
     <input type="file" id="documentmta" name="documentmta" onchange="upload_files();"    >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td class="td-mta"  id="status-documentmta" ><i class="fa fa-<?php echo $icon_documentmta;?>"></i></td>
 </tr>
 </table>



