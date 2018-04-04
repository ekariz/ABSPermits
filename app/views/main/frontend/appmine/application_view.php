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

$documentmta_name           =  valueof($documentmta, 'orig_name');
$documentpic_name           =  valueof($documentpic, 'orig_name');
$documentmat_name           =  valueof($documentmat, 'orig_name');

$documentmta_file_name           =  valueof($documentmta, 'file_name');
$documentpic_file_name           =  valueof($documentpic, 'file_name');
$documentmat_file_name           =  valueof($documentmat, 'file_name');

$table    = 'font-family:Verdana;font-size:12px;';
$top    = 'border-top:1px solid  #aaa;';
$bottom = 'border-bottom:1px solid  #aaa;';
$right  = 'border-right:1px solid  #aaa;';
$left   = 'border-left:1px solid #aaa;';
$bgheader   = 'background-color:#9ED3EC;';
?>

<table cellpadding="2" cellspacing="0" width="100%" style="<?php echo "{$table}";?>" >

 <tr>
  <th colspan="2" align="left"  style="<?php echo "{$top}{$bottom}{$left}";?>"  ><img   src="assets/frontend/images/logo-abs.png" alt="ABS" width="70"></th>
  <th colspan="2"  align="left" style="<?php echo "{$top}{$bottom}{$right}";?>"  >ABS PERMIT APPLICATION</th>
 </tr>

 <tr>
  <th colspan="4"  style="<?php echo "{$bgheader}{$top}{$bottom}{$right}{$left}";?>"  >Personal Details</th>
 </tr>

 <tr>
  <td  nowrap style="<?php echo "{$bottom}{$right}{$left}";?>" >Application Reference No</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $appno;  ?></b></td>
  <td  style="<?php echo "{$bottom}{$right}";?>" >Application Date</td>
  <td  nowrap style="<?php echo "{$bottom}{$right}";?>"  ><b><?php echo  date('D d M Y',$apptime);  ?></b></td>
 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Full Name</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $firstname;  ?>&nbsp;<?php echo  $lastname;  ?></b></td>
  <td  style="<?php echo "{$bottom}{$right}";?>" > Country</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $ctnname;  ?></b></td>
 </tr>
 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Applicant Email</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $email;  ?></b></td>
  <td  style="<?php echo "{$bottom}{$right}";?>" >Applicant mobile</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $mobile;  ?></b></td>
 </tr>

 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>"  >Are you a student?</td>
  <td    style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  valueof($positions, $position );  ?></b></td>
  <td    style="<?php echo "{$bottom}{$right}";?>" >Applying As</td>
  <td    style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  valueof($applyingas_list, $applyingas );  ?></b></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>" >ORCHID</td>
  <td    style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $orchid  ?></b></td>
  <td nowrap  style="<?php echo "{$bottom}{$right}";?>" >Other Researcher ID</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $researcherid  ?></b></td>
 </tr>

 <tr>
  <td nowrap   style="<?php echo "{$bottom}{$right}{$left}";?>" >Institution Legal Officer Name</td>
  <td   style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $legalofficername  ?></b></td>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>" >Institution Legal Officer Email</td>
  <td    style="<?php echo "{$bottom}{$right}";?>" ><b><?php echo  $legalofficeremail  ?></b></td>
 </tr>

</table>

<br>

<table cellpadding="2" cellspacing="0"  width="100%"  style="<?php echo "{$table}";?>"  >

 <tr>
  <th width="50%"  style="<?php echo "{$bgheader}{$top}{$bottom}{$right}{$left}";?>"  >Required Document</th>
  <th  style="<?php echo "{$bgheader}{$top}{$bottom}{$right}";?>" >Attached File</th>
 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Company Registration Document</td>
  <?php if($exists_documentregistration){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentregistration_id}"; ?>"   > <?php echo $documentregistration_name; ?></td>
  <?php }else{ ?>
    <td><i style="color:red"  style="<?php echo "{$bottom}{$right}";?>" >*Not Attached</i></td>
  <?php } ?>

 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Research Proposal</td>
  <?php if($exists_documentresearchproposal){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentresearchproposal_id}"; ?>"   > <?php echo $documentresearchproposal_name; ?></td>
  <?php }else{ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><i style="color:red">*Not Attached</i></td>
  <?php } ?>

 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Letter of Affiliation With local institution</td>
  <?php if($exists_documentaffiliation){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentaffiliation_id}"; ?>"   > <?php echo $documentaffiliation_name; ?></td>
  <?php }else{ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><i style="color:red">*Not Attached</i></td>
  <?php } ?>

 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Research Budget</td>
  <?php if($exists_documentresearchbudget){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentresearchbudget_id}"; ?>"   > <?php echo $documentresearchbudget_name; ?></td>
  <?php }else{ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><i style="color:red">*Not Attached</i></td>
  <?php } ?>

 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Curriculum Vitae</td>
  <?php if($exists_documentcv){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentcv_id}"; ?>"   > <?php echo $documentcv_name; ?></td>
  <?php }else{ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><i style="color:red">*Not Attached</i></td>
  <?php } ?>

 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Prior Informed Consent (PIC)</td>
  <?php if($exists_documentpic){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentpic_id}"; ?>"   > <?php echo $documentpic_name; ?></td>
  <?php }else{ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><i style="color:red">*Not Attached</i></td>
  <?php } ?>
 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Mutually Agreed Terms (MAT) </td>
  <?php if($exists_documentmat){ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentmat_id}"; ?>"   > <?php echo $documentmat_name; ?></td>
  <?php }else{ ?>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><i style="color:red">*Not Attached</i></td>
  <?php } ?>
 </tr>


<?php if($exportanswer ==1){ ?>
 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Material Transfer Agreement (MTA)</td>
  <?php if($exists_documentmta){ ?>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentmta_id}"; ?>"   > <?php echo $documentmta_name; ?></td>
  <?php } ?>
 </tr>
<?php } ?>


</table>

<br>

<table cellpadding="2" cellspacing="0"  width="100%"  style="<?php echo "{$table}";?>" >

 <tr>
  <th colspan="2"  style="<?php echo "{$bgheader}{$top}{$bottom}{$right}{$left}";?>" >Requirements</th>
 </tr>

 <tr>
  <td width="50%"  style="<?php echo "{$bottom}{$right}{$left}";?>" >Type of genetic resource to be collected </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo  valueof($resource_list, $resourcetype );  ?></td>
 </tr>

 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>" >Describe other resourse type  </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $resourcetypeother;  ?></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>"  >Common/vernacular name of the generic resource to be collected </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $commonname;  ?></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>"  >Location or project area for genetic resource collection </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $projectlocation;  ?></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>"  >Is the project area inside a conservation area, gazetted forest or protected area</td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $projectarea;  ?></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>">Purpose of genetic resource collection </td>
  <td style="<?php echo "{$bottom}{$right}";?>" ><?php echo $resourceallocationpurpose;  ?></td>
 </tr>


 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>" >Purpose of collection </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" >
    <ol>
    <?php
     if($purpose && $purposes_list){
      if(sizeof($purpose)>0){
      foreach($purpose as $pupcode ){
        $pupname = valueof($purposes_list, $pupcode );
        echo "<li>{$pupname}</li>";
      }
     }
    }
   ?>
   </ol>
  </td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>"  >Specify If 'Other' Purpose of genetic resource collection  </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $purposeother;  ?></td>
 </tr>

</table>

<br>
<table cellpadding="2" cellspacing="0"  width="100%"  style="<?php echo "{$table}";?>" >

 <tr>
  <th colspan="2"  style="<?php echo "{$bgheader}{$top}{$bottom}{$right}{$left}";?>" >Resources</th>
 </tr>

 <tr>
  <td width="50%"  style="<?php echo "{$bottom}{$right}{$left}";?>"  >Will you be Researching/Collecting and or exporting a genetic resource from Kenya? </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo  valueof($export_answer_list, $exportanswer );  ?></td>
 </tr>

</table>

<br>
<table cellpadding="2" cellspacing="0"  width="100%" style="<?php echo "{$table}";?>"  >
 <thead>
 <tr>
  <th width="50%"   style="<?php echo "{$top}{$bottom}{$right}{$left}";?>" >Document</th>
  <th  style="<?php echo "{$top}{$bottom}{$right}";?>" >Attached File</th>
 </tr>
 </thead>

 <tbody>
   <tr>
   <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Material Transfer Agreement (MTA)</td>
    <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentmta_file_name}"; ?>"   > <?php echo $documentmta_name; ?></td>
   </tr>

   <tr>
   <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Prior Informed Consent (PIC)</td>
   <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentpic_file_name}"; ?>"   > <?php echo $documentpic_name; ?></td>
   </tr>

   <tr>
   <td  style="<?php echo "{$bottom}{$right}{$left}";?>" >Mutually Agreed Terms (MAT)</td>
   <td  style="<?php echo "{$bottom}{$right}";?>" ><a href="<?php echo base_url() ."Workflow/view_document/{$id}/{$documentmat_file_name}"; ?>"   > <?php echo $documentmat_name; ?></td>
   </tr>

 </tbody>
</table>

<table cellpadding="2" cellspacing="0"  width="100%"  style="<?php echo "{$table}";?>" >

 <tr>
  <th colspan="2"  style="<?php echo "{$bgheader}{$top}{$bottom}{$right}{$left}";?>"  >Samples</th>
 </tr>

 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>" >Type of genetic resource to be collected   </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo  valueof($resource_list, $resourcetype );  ?></td>
 </tr>

 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>" >Amount of proposed samples to be collected </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $samplesamount;  ?></td>
 </tr>

 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>" >Proposed samples Unit of Measure </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo  valueof($sample_uom_list, $sampleuom );  ?></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>"  >Select the conservation status of the sample to be collected </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo  valueof($conservestatus_list, $conservestatus );  ?></td>
 </tr>

 <tr>
  <td  style="<?php echo "{$bottom}{$right}{$left}";?>">Describe the conservation status of the sample to be collected  </td>
  <td style="<?php echo "{$bottom}{$right}";?>"><?php echo $conservestatusdesc;  ?></td>
 </tr>

 <tr>
  <td   style="<?php echo "{$bottom}{$right}{$left}";?>"  >Will research on traditional knowledge is to be collected ? </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $restraditionalknow;  ?></td>
 </tr>

 <tr>
  <td    style="<?php echo "{$bottom}{$right}{$left}";?>" >Will you need to export the collected genetic resources from Kenya ?   </td>
  <td  style="<?php echo "{$bottom}{$right}";?>" ><?php echo $exportgeneticresources;  ?></td>
 </tr>

</table>

