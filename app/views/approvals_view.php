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
   echo "<td>{$stepname}</td>";
  }
  ?>
 </tr>
<?php
echo <<<ROW
 <tr>
ROW;

foreach($approvalsteps as $stepno=>$stepname){
  $approval_col    = "approved{$stepno}";
  $approved        = isset($approvals[$approval_col]) && $approvals[$approval_col]==1 ? true : false;
  $approved_icon        = $approved ? 'check success' : 'hourglass';
  echo "<td><i class=\"fa fa-{$approved_icon}\"></i></td>";
}

echo <<<ROW
 </tr>
ROW;
?>
</tbody>
</table>
