<?php
$documentmta_id            =  valueof($documentmta, 'file_name');
$exists_documentmta        =  !empty($documentmta_id)   ? true : false;
$icon_documentmta          =  isset($documentmta['client_name'])   ? 'check' : 'hourglass';
$required_documentmta      =  $exportanswer ==1   ? '' : 'required';
$display_documentmta       =  $exportanswer ==1 || $exists_documentmta  ? 'block' : 'none';

$documentpic_id            =  valueof($documentpic, 'file_name');
$documentmat_id            =  valueof($documentmat, 'file_name');

$exists_documentpic        =  !empty($documentmat_id)   ? true : false;
$exists_documentmat        =  !empty($documentmat_id)   ? true : false;

$icon_documentpic          =  isset($documentpic['client_name'])  ? 'check' : 'hourglass';
$icon_documentmat          =  isset($documentmat['client_name'])  ? 'check' : 'hourglass';

$required_documentpic      =  $exists_documentpic  ? '' : 'required';
$required_documentmat      =  $exists_documentmat  ? '' : 'required';

?>
<div class="col-md-12 form-group">
    <label for="resourcetype">Will you be Researching/Collecting and or exporting a genetic resource from Kenya?</label>
</div>

<div class="col-md-12 form-group">
    <?php echo form_dropdown('exportanswer', $export_answer_list, $exportanswer ,'id="exportanswer" class="form-control  input-sm" onchange="handle_is_export();" required="required" ');  ?>
    <div class="help-block with-errors"></div>
</div>


<table class="table table-bordered table-condensed" >
 <thead>
 <tr>
  <th>Document</th>
  <th>Description</th>
  <th>Attach PDF File</th>
  <th>Status</th>
 </tr>
</thead>

 <tr id="table_row_mta"   >
  <td><strong>Material Transfer Agreement (MTA)</strong></td>
  <td>Attach Material Transfer Agreement (MTA)</td>
  <td><div class="form-group">
     <input type="file" id="documentmta" name="documentmta" onchange="upload_files();"    <?php echo $required_documentmta;?>  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentmta" ><i class="fa fa-<?php echo $icon_documentmta;?>"></i></td>
 </tr>


 <tr   >
  <td  ><strong>Prior Informed Consent (PIC)</strong></td>
  <td>Prior Informed Consent (PIC)</td>
  <td><div class="form-group">
     <input type="file" id="documentpic" name="documentpic"  onchange="upload_files();" <?php echo $required_documentpic;?>  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentpic" ><i class="fa fa-<?php echo $icon_documentpic;?>"></i></td>
 </tr>


 <tr>
  <td    ><strong>Mutually Agreed Terms (MAT) </strong></td>
  <td>Mutually Agreed Terms (MAT) </td>
  <td><div class="form-group">
     <input type="file" id="documentmat" name="documentmat"  onchange="upload_files();" <?php echo $required_documentmat;?>  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentmat" ><i class="fa fa-<?php echo $icon_documentmat;?>"></i></td>
 </tr>

 </table>
