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

<table class="table table-bordered table-condensed">

 <tr>
  <th>Required Document</th>
  <th>Attached File</th>
 </tr>

 <tr>
  <td>Company Registration Document</td>
  <?php if($exists_documentregistration){ ?>
  <td><a href="javascript:void(0);"  onclick="workflow.view_document('<?php echo $documentregistration_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentregistration_name; ?></a></td>
  <?php } ?>
 </tr>

 <tr>
  <td>Research Proposal</td>
  <?php if($exists_documentresearchproposal){ ?>
  <td><a href="javascript:void(0);"  onclick="workflow.view_document('<?php echo $documentresearchproposal_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentresearchproposal_name; ?></a></td>
  <?php } ?>
 </tr>

 <tr>
  <td>Letter of Affiliation With local institution</td>
  <?php if($exists_documentaffiliation){ ?>
  <td><a href="javascript:void(0);"  onclick="workflow.view_document('<?php echo $documentaffiliation_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentaffiliation_name; ?></a></td>
  <?php } ?>
 </tr>

 <tr>
  <td>Research Budget</td>
  <?php if($exists_documentresearchbudget){ ?>
  <td><a href="javascript:void(0);"  onclick="workflow.view_document('<?php echo $documentresearchbudget_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentresearchbudget_name; ?></a></td>
  <?php } ?>
 </tr>

 <tr>
  <td>Curriculum Vitae</td>
  <?php if($exists_documentcv){ ?>
  <td><a href="javascript:void(0);"  onclick="workflow.view_document('<?php echo $documentcv_id; ?>');"  data-toggle="tooltip" data-placement="top" title="View File"><i class="fa fa-file-pdf-o danger"></i> <?php echo $documentcv_name; ?></a></td>
  <?php } ?>
 </tr>
 

<?php } ?>

</table>
