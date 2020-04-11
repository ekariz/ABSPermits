<?php

?>
<table class="table table-bordered table-condensed">
 <thead>
 <tr>
  <th>Application Reference</th>
  <th>Date Submitted</th>
  <?php
  foreach($approvalsteps as $stepno=>$stepname){
   echo "<th>{$stepname}</th>";
  }
  ?>
  <th colspan="2">Actions</th>
 </tr>
</thead>

<tbody>

<?php
if( ($applications) ){
foreach($applications as $row){
    $id = valueof($row, 'id');
    $appno = valueof($row, 'appno');
    $email = valueof($row, 'email');
    $position = valueof($row, 'position');
    $applyingas = valueof($row, 'applyingas');
    $orcid = valueof($row, 'orcid');
    $researcherid = valueof($row, 'researcherid');
    $legalofficername = valueof($row, 'legalofficername');
    $legalofficeremail = valueof($row, 'legalofficeremail');
    $resourcetype = valueof($row, 'resourcetype');
    $speciesname = valueof($row, 'speciesname');
    $scientificname = valueof($row, 'scientificname');
    $commonname = valueof($row, 'commonname');
    $projectlocation = valueof($row, 'projectlocation');
    $projectarea = valueof($row, 'projectarea');
    $resourceallocationpurpose = valueof($row, 'resourceallocationpurpose');
    $exportanswer = valueof($row, 'exportanswer');
    $resourcetypeother = valueof($row, 'resourcetypeother');
    $purpose = valueof($row, 'purpose');
    $purposeother = valueof($row, 'purposeother');
    $documentregistration = valueof($row, 'documentregistration');
    $documentresearchproposal = valueof($row, 'documentresearchproposal');
    $documentaffiliation = valueof($row, 'documentaffiliation');
    $documentresearchbudget = valueof($row, 'documentresearchbudget');
    $documentcv = valueof($row, 'documentcv');
    $documentpic = valueof($row, 'documentpic');
    $documentmat = valueof($row, 'documentmat');
    $documentmta = valueof($row, 'documentmta');
    $researchtype = valueof($row, 'researchtype');
    $samplesamount = valueof($row, 'samplesamount');
    $conservestatus = valueof($row, 'conservestatus');
    $conservestatusdesc = valueof($row, 'conservestatusdesc');
    $restraditionalknow = valueof($row, 'restraditionalknow');
    $exportgeneticresources = valueof($row, 'exportgeneticresources');
    $legislationagree = valueof($row, 'legislationagree');
    $sampleuom = valueof($row, 'sampleuom');
    $apptime = valueof($row, 'apptime');
    $appdate = fuzzyDate($apptime, true);
    $approved1 = valueof($row, 'approved1');
    $approved2 = valueof($row, 'approved2');
    $approved3 = valueof($row, 'approved3');
    $approved5 = valueof($row, 'approved5');
    $approved4 = valueof($row, 'approved4');
    $approved6 = valueof($row, 'approved6');
    $approved7 = valueof($row, 'approved7');
    $approved8 = valueof($row, 'approved8');
    $approved9 = valueof($row, 'approved9');
    $approved10 = valueof($row, 'approved10');


echo <<<ROW
 <tr>
  <td>{$appno}</td>
  <td>{$appdate}</td>
ROW;

foreach($approvalsteps as $stepno=>$stepname){
  $approval_col    = "approved{$stepno}";
  $approved        = isset($row[$approval_col]) && $row[$approval_col]==1 ? true : false;
  $approved_val    = isset($row[$approval_col])   ? $row[$approval_col] : null;

  if($approved_val==1){
   $approved_icon   =   'check success' ;
  }elseif($approved_val=='0'){
   $approved_icon   =  'times danger';
  }else{
   $approved_icon   =  'hourglass';
  }

  echo "<td><i class=\"fa fa-{$approved_icon}\"></i></td>";
}

//  <td><a href="ApplicationsList/view/{$id}"  ><i class="fa fa-eye"></i> View</a></td>

echo <<<ROW
  <td><a href="ApplicationsList/application/{$id}" ><i class="fa fa-user"></i> Open</a></td>
  <td><a href="#"  onclick="view_application({$id});" ><i class="fa fa-print"></i> View</a></td>
 </tr>
ROW;

 }
}
?>

</tbody>

</table>
