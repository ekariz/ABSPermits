
<div class="col-md-12 form-group">
    <label for="resourcetype">Type of Research to be Carried out ? *</label>
    <?php echo form_dropdown('researchtype', $researchtype_list, $researchtype ,'id="researchtype" class="form-control  input-sm"  required="required"  ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="samplesamount">Amount of proposed samples to be collected  *</label>
    <input type="number" step="any" class="form-control input-sm" id="samplesamount" name="samplesamount"  value="<?php echo $samplesamount; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="Type of genetic resource to be collected ">
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="samplesamount">Proposed samples Unit of Measure</label>
    <?php echo form_dropdown('sampleuom', $sample_uom_list, $sampleuom ,'id="sampleuom" class="form-control  input-sm"  required="required"  ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group">
    <label for="conservestatus">Select the conservation status of the sample to be collected  *:</label>
    <?php echo form_dropdown('conservestatus', $conservestatus_list, $conservestatus ,'id="conservestatus" class="form-control  input-sm"  required="required"  ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="conservestatusdesc">Describe the conservation status of the sample to be collected *:</label>
    <input type="text" class="form-control input-sm" id="conservestatusdesc" name="conservestatusdesc"  value="<?php echo $conservestatusdesc; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="Describe the conservation status of the sample to be collected ">
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="restraditionalknow">Will research on traditional knowledge is to be collected ? *:</label>
    <?php echo form_dropdown('restraditionalknow', $yesno_list, $restraditionalknow ,'id="restraditionalknow" class="form-control  input-sm"  required="required"  ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="exportgeneticresources">Will you need to export the collected genetic resources from Kenya ? *:</label>
    <?php echo form_dropdown('exportgeneticresources', $yesno_list, $exportgeneticresources ,'id="exportgeneticresources" class="form-control  input-sm"  required="required"  ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="legislationagree"> <input type="checkbox" class="form-control-checkbox" id="legislationagree" name="legislationagree"  value="1" required <?php echo $legislationagree==1 ? 'checked' : ''; ?> > I Agree with the National Legislation of Kenya and conditions for acquiring an ABS permit</label>
    <div class="help-block with-errors"></div>
</div>



