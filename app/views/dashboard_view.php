<?php
//print_pre($approvalsteps);//remove

$apps_count = sizeof($applications);

foreach($applications as $application){
 print_pre($application);//remove
 exit();//remove

}

?>
<div class="container  " style="background-color:#fff">

 <div class="row">
  <div class="col-md-6">1</div>
  <div class="col-md-6">2</div>
 </div>

 <div class="row">
  <div class="col-md-12"><?php  echo $apps_count;?></div>
 </div>

</div>
