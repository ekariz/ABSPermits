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


//overide required docs
$required_documentpic      =  '';
$required_documentmat      =  '';
$required_documentip       =  '';
$required_documentmta      =  '';

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

 
 </table>



