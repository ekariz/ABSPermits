<?php

$documentregistration_id        =  valueof($documentregistration, 'file_name');
$documentresearchproposal_id    =  valueof($documentresearchproposal, 'file_name');
$documentaffiliation_id         =  valueof($documentaffiliation, 'file_name');
$documentresearchbudget_id      =  valueof($documentresearchbudget, 'file_name');
$documentcv_id                  =  valueof($documentcv,  'file_name');
$documentpic_id                 =  valueof($documentpic, 'file_name');
$documentmat_id                 =  valueof($documentmat, 'file_name');

$exists_documentregistration     =  !empty($documentregistration_id)      ? true : false;
$exists_documentresearchproposal =  !empty($documentresearchproposal_id)  ? true : false;
$exists_documentaffiliation      =  !empty($documentaffiliation_id)       ? true : false;
$exists_documentresearchbudget   =  !empty($documentresearchbudget_id)    ? true : false;
$exists_documentcv               =  !empty($documentcv_id)                ? true : false;
$exists_documentpic              =  !empty($documentpic_id)               ? true : false;
$exists_documentmat              =  !empty($documentmat_id)               ? true : false;

$icon_documentregistration     =  isset($documentregistration['client_name'])     ? 'check' : 'hourglass';
$icon_documentresearchproposal =  isset($documentresearchproposal['client_name']) ? 'check' : 'hourglass';
$icon_documentaffiliation      =  isset($documentaffiliation['client_name'])      ? 'check' : 'hourglass';
$icon_documentresearchbudget   =  isset($documentresearchbudget['client_name'])   ? 'check' : 'hourglass';
$icon_documentcv               =  isset($documentcv['client_name'])               ? 'check' : 'hourglass';
$icon_documentpic              =  isset($documentpic['client_name'])              ? 'check' : 'hourglass';
$icon_documentmat              =  isset($documentmat['client_name'])              ? 'check' : 'hourglass';

$required_documentregistration     =  $exists_documentregistration  ? '' : 'required';
$required_documentresearchproposal =  $exists_documentresearchproposal  ? '' : 'required';
$required_documentaffiliation      =  $exists_documentaffiliation  ? '' : 'required';
$required_documentresearchbudget   =  $exists_documentresearchbudget  ? '' : 'required';
$required_documentcv               =  $exists_documentcv  ? '' : 'required';
$required_documentpic              =  $exists_documentpic  ? '' : 'required';
$required_documentmat              =  $exists_documentmat  ? '' : 'required';

?>

<table class="table table-bordered table-condensed">
 <thead>
 <tr>
  <th>Document</th>
  <th>Description</th>
  <th>Attach PDF File</th>
  <th>Status</th>
 </tr>
</thead>

 <tr>
  <td><strong>Company Registration Document</strong></td>
  <td>A copy of the legal registration document for your organisation in your country. This may be a registration certificate, charter, statutes or equivalent</td>
  <td><div class="form-group">
     <input type="file" id="documentregistration" name="documentregistration" onchange="upload_files();"    <?php echo $required_documentregistration;?>  data-toggle="tooltip" data-placement="bottom" title="A copy of the legal registration document for your organisation in your country. This may be a registration certificate, charter, statutes or equivalent,  in PDF Format" >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentregistration" ><i class="fa fa-<?php echo $icon_documentregistration;?>"></i></td>
 </tr>

 <tr>
  <td><strong>Research Proposal</strong></td>
  <td>Attach A copy of your research proposal as submitted to your funding agency or as approved by them</td>
  <td><div class="form-group">
     <input type="file" id="documentresearchproposal" name="documentresearchproposal"  onchange="upload_files();" <?php echo $required_documentresearchproposal;?> data-toggle="tooltip" data-placement="top" title="Attach A copy of your research proposal as submitted to your funding agency or as approved by them"  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentresearchproposal" ><i class="fa fa-<?php echo $icon_documentresearchproposal;?>"></i></td>
 </tr>

 <tr>
  <td><strong>Letter of Affiliation With local institution</strong></td>
  <td>All applicants for research in Kenya must have a local partner.To access a list of approved local institutions and for more information <a href="<?php echo base_url(); ?>assets/frontend/pdf/List_Of_Institutions.pdf" target="_blank" >click here</a></td>
  <td><div class="form-group">
     <input type="file" id="documentaffiliation" name="documentaffiliation"   onchange="upload_files();"  <?php echo $required_documentaffiliation;?>  data-toggle="tooltip" data-placement="bottom" title="All applicants for research in Kenya must have a local partner.To access a list of approved local institution" >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentaffiliation" ><i class="fa fa-<?php echo $icon_documentaffiliation;?>"></i></td>
 </tr>

 <tr>
  <td><strong>Research Budget </strong></td>
  <td>Copy of your Research Budget </td>
  <td><div class="form-group">
     <input type="file" id="documentresearchbudget" name="documentresearchbudget"  onchange="upload_files();" <?php echo $required_documentresearchbudget;?>  data-toggle="tooltip" data-placement="top" title="Research Budget"  >
    <div class="help-block with-errors"></div>
   </div>
  </td>
  <td id="status-documentresearchbudget" ><i class="fa fa-<?php echo $icon_documentresearchbudget;?>"></i></td>
 </tr>

 <tr>
  <td><strong>Curriculum Vitae</strong></td>
  <td>Copy of your Curriculum Vitae </td>
  <td><div class=" form-group">
    <input type="file" id="documentcv" name="documentcv"  onchange="upload_files();"  <?php echo $required_documentcv;?>   data-toggle="tooltip" data-placement="top" title="Attach your CV in PDF Format" >
   <div class="help-block with-errors"></div>
  </div>
  </td>
  <td id="status-documentcv" ><i class="fa fa-<?php echo $icon_documentcv;?>"></i></td>
 </tr>



</table>
