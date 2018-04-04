<table class="table table-bordered table-condensed">
 <thead>
 <tr>
  <th colspan="<?php echo count($approvalsteps); ?>" >Approvals</th>
 </tr>
</thead>

<tbody>
 <tr>
  <?php
  foreach($approvalsteps as $stepno=>$stepname){
   $aprcomment_col  = "aprcomment{$stepno}";
   $comments        = isset($aprcomments[$aprcomment_col]) ? $aprcomments[$aprcomment_col] : null;
   echo "<td  >{$stepname}</td>";
  }
  ?>
 </tr>

<?php

echo '<tr>';

foreach($approvalsteps as $stepno=>$stepname){
  $approval_col    = "approved{$stepno}";
  $aprcomment_col  = "aprcomment{$stepno}";
  $comments        = isset($aprcomments[$aprcomment_col]) ? $aprcomments[$aprcomment_col] : null;

  $approved        = isset($approvals[$approval_col]) && $approvals[$approval_col]==1 ? true : false;
  $approved_val        = isset($approvals[$approval_col]) ? $approvals[$approval_col] : null;

  if($approved_val==1){
   $approved_icon  =  'check success';
  }elseif($approved_val=='0'){
   $approved_icon  =  'times danger';
  }else{
   $approved_icon  =  'hourglass gray';
  }

  echo "<td><i class=\"fa fa-{$approved_icon}\"  ></i></td>";
}

echo '</tr>';

//comments
echo '<tr>';


foreach($approvalsteps as $stepno=>$stepname){
  $approval_col     = "approved{$stepno}";
  $aprcomment_col   = "aprcomment{$stepno}";
  $discomments_col  = "discomment{$stepno}";

  $approved_val     = isset($approvals[$approval_col]) ? $approvals[$approval_col] : null;
  $approved         = isset($approvals[$approval_col]) && $approvals[$approval_col]==1 ? true : false;

  if($approved){
  $comments         = isset($aprcomments[$aprcomment_col]) ? $aprcomments[$aprcomment_col] : null;
  }else{
  $comments         = isset($discomments[$discomments_col]) ? $discomments[$discomments_col] : null;
  }


  if($approved_val==1){
   $approved_icon  =  'check success';
  }elseif($approved_val=='0'){
   $approved_icon  =  'times danger';
  }else{
   $approved_icon  =  'hourglass gray';
  }

  echo "<td  >{$comments} </td>";
}

echo '</tr>';

?>
</tbody>
</table>

<script>
$('[data-toggle="tooltip"]').tooltip();
</script>
