<?php

$documentregistration_id        =  valueof($documentregistration, 'file_name');
$documentresearchproposal_id    =  valueof($documentresearchproposal, 'file_name');
$documentaffiliation_id         =  valueof($documentaffiliation, 'file_name');
$documentresearchbudget_id      =  valueof($documentresearchbudget, 'file_name');
$documentcv_id                  =  valueof($documentcv, 'file_name');
$documentpic_id                 =  valueof($documentpic, 'file_name');
$documentmat_id                 =  valueof($documentmat, 'file_name');
$documentmta_id                 =  valueof($documentmta, 'file_name');

$documentregistration_name      =  valueof($documentregistration, 'client_name');
$documentresearchproposal_name  =  valueof($documentresearchproposal, 'client_name');
$documentaffiliation_name       =  valueof($documentaffiliation, 'client_name');
$documentresearchbudget_name    =  valueof($documentresearchbudget, 'client_name');
$documentcv_name                =  valueof($documentcv, 'client_name');
$documentpic_name               =  valueof($documentpic, 'client_name');
$documentmat_name               =  valueof($documentmat, 'client_name');
$documentmta_name               =  valueof($documentmta, 'client_name');

$icon_documentregistration      =  isset($documentregistration['client_name'])     ? 'check' : 'hourglass';
$icon_documentresearchproposal  =  isset($documentresearchproposal['client_name']) ? 'check' : 'hourglass';
$icon_documentaffiliation       =  isset($documentaffiliation['client_name'])      ? 'check' : 'hourglass';
$icon_documentresearchbudget    =  isset($documentresearchbudget['client_name'])   ? 'check' : 'hourglass';
$icon_documentcv                =  isset($documentcv['client_name'])               ? 'check' : 'hourglass';
$icon_documentcv                =  isset($documentcv['client_name'])               ? 'check' : 'hourglass';
$icon_documentpic               =  isset($documentpic['client_name'])              ? 'check' : 'hourglass';
$icon_documentmat               =  isset($documentmat['client_name'])              ? 'check' : 'hourglass';
$icon_documentmta               =  isset($documentmta['client_name'])              ? 'check' : 'hourglass';

$exists_documentregistration     =  !empty($documentregistration_id)      ? true : false;
$exists_documentresearchproposal =  !empty($documentresearchproposal_id)  ? true : false;
$exists_documentaffiliation      =  !empty($documentaffiliation_id)       ? true : false;
$exists_documentresearchbudget   =  !empty($documentresearchbudget_id)    ? true : false;
$exists_documentcv               =  !empty($documentcv_id)                ? true : false;
$exists_documentpic              =  !empty($documentpic_id)               ? true : false;
$exists_documentmat              =  !empty($documentmat_id)               ? true : false;
$exists_documentmta              =  !empty($documentmta_id)               ? true : false;

?>


<div class="alert alert-warning">
  <strong>Info!</strong> Please confirm that you attached all required documents
</div>

<table class="table table-bordered table-condensed">

 <thead>
 <tr>
  <th>Document</th>
  <th>Uploaded?</th>
  <th>Attached PDF File</th>
  <th>Action</th>
 </tr>
</thead>

<tbody>

 <tr>
  <td><strong>Company Registration Document</strong></td>
  <td ><i class="fa fa-<?php echo $icon_documentregistration;?>"></i></td>
  <?php if($exists_documentregistration){ ?>
  <td><a href="#" onclick="view_file('<?php echo $documentregistration_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentregistration_name; ?></a></td>
  <td><a href="#" onclick="delete_file('documentregistration','<?php echo $documentregistration_id; ?>','<?php echo $documentregistration_name; ?>');" class="danger" data-toggle="tooltip" data-placement="top" title="Delete File"><i class="fa fa-remove "></i> Remove</a></td>
  <?php }else{ ?>
  <td><a href="#step-2" data-toggle="tooltip" data-placement="top" title="attach now"><i class="fa fa-paperclip"></i> attach now</a></td>
  <td>&nbsp;</td>
  <?php } ?>
 </tr>

 <tr>
  <td><strong>Research Proposal</strong></td>
  <td ><i class="fa fa-<?php echo $icon_documentresearchproposal;?>"></i></td>
  <?php if($exists_documentresearchproposal){ ?>
  <td><a href="#" onclick="view_file('<?php echo $documentresearchproposal_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentresearchproposal_name; ?></a></td>
  <td><a href="#" onclick="delete_file('documentresearchproposal','<?php echo $documentresearchproposal_id; ?>','<?php echo $documentresearchproposal_name; ?>');" class="danger" data-toggle="tooltip" data-placement="top" title="Delete File"><i class="fa fa-remove "></i> Remove</a></td>
  <?php }else{ ?>
  <td><a href="#step-2" data-toggle="tooltip" data-placement="top" title="attach now"><i class="fa fa-paperclip"></i> attach now</a></td>
  <td>&nbsp;</td>
  <?php } ?>
 </tr>

 <tr>
  <td><strong>Letter of Affiliation With local institution</strong></td>
  <td ><i class="fa fa-<?php echo $icon_documentaffiliation;?>"></i></td>
  <?php if($exists_documentaffiliation){ ?>
  <td><a href="#" onclick="view_file('<?php echo $documentaffiliation_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentaffiliation_name; ?></a></td>
  <td><a href="#" onclick="delete_file('documentaffiliation','<?php echo $documentaffiliation_id; ?>','<?php echo $documentaffiliation_name; ?>');" class="danger" data-toggle="tooltip" data-placement="top" title="Delete File"><i class="fa fa-remove "></i> Remove</a></td>
  <?php }else{ ?>
  <td><a href="#step-2" data-toggle="tooltip" data-placement="top" title="attach now"><i class="fa fa-paperclip"></i> attach now</a></td>
  <td>&nbsp;</td>
  <?php } ?>
 </tr>

 <tr>
  <td><strong>Research Budget</strong></td>
  <td ><i class="fa fa-<?php echo $icon_documentresearchbudget;?>"></i></td>
  <?php if($exists_documentresearchbudget){ ?>
  <td><a href="#" onclick="view_file('<?php echo $documentresearchbudget_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentresearchbudget_name; ?></a></td>
  <td><a href="#" onclick="delete_file('documentresearchbudget','<?php echo $documentresearchbudget_id; ?>','<?php echo $documentresearchbudget_name; ?>');" class="danger" data-toggle="tooltip" data-placement="top" title="Delete File"><i class="fa fa-remove "></i> Remove</a></td>
  <?php }else{ ?>
  <td><a href="#step-2" data-toggle="tooltip" data-placement="top" title="attach now"><i class="fa fa-paperclip"></i> attach now</a></td>
  <td>&nbsp;</td>
  <?php } ?>
 </tr>

 <tr>
  <td><strong>Curriculum Vitae</strong></td>
  <td ><i class="fa fa-<?php echo $icon_documentcv;?>"></i></td>
  <?php if($exists_documentcv){ ?>
  <td><a href="#" onclick="view_file('<?php echo $documentcv_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentcv_name; ?></a></td>
  <td><a href="#" onclick="delete_file('documentcv','<?php echo $documentcv_id; ?>','<?php echo $documentcv_name; ?>');" class="danger" data-toggle="tooltip" data-placement="top" title="Delete File"><i class="fa fa-remove "></i> Remove</a></td>
  <?php }else{ ?>
  <td><a href="#step-2" data-toggle="tooltip" data-placement="top" title="attach now"><i class="fa fa-paperclip"></i> attach now</a></td>
  <td>&nbsp;</td>
  <?php } ?>
 </tr>
  
</tbody>
</table>
 
 
  <?php 
 if(isset($required_field) && count($required_field)>0 ){
	 
 
 ?>
<div class="alert alert-danger">
  <strong>Error!</strong> The Following Fields Are Required
</div>

<table class="table table-bordered table-condensed">
 
<tbody>

 <?php 
  foreach($required_field as $field=> $description){	 
 ?>
 
 <tr>
  <td><strong><?php echo $description;?></strong></td>
  <td><a href="#step-1" data-toggle="tooltip" data-placement="top" title="fill fielld now"><i class="fa fa-pencil"></i> Enter Data</a></td>
 </tr>
 
<?php 
   }
?>
</tbody>
</table>
 
<?php 
  }
?>
