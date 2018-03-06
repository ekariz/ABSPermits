

<div class="col-md-6 form-group">
    <label for="email">Are you a student? *</label>
    <?php echo form_dropdown('position', $positions, $position ,'id="position" class="form-control  input-sm"  required="required" ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-6 form-group">
    <label for="email2">Applying As:</label>
    <?php echo form_dropdown('applyingas', $applyingas_list, $applyingas ,'id="applyingas" class="form-control  input-sm"  required="required" ');  ?>
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group">
    <label for="orchid">ORCHID  *:</label>
    <input type="text" class="form-control input-sm" name="orchid" id="orchid" value="<?php echo $orchid; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="ORCID Researcher ID">
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group">
    <label for="researcherid">Other Researcher ID :</label>
    <input type="text" class="form-control input-sm" name="researcherid" id="researcherid"  value="<?php echo $researcherid; ?>" placeholder=""  data-toggle="tooltip" data-placement="top" title="Other Researcher ID">
    <div class="help-block with-errors"></div>
</div>


<div class="col-md-6 form-group">
    <label for="legalofficername">Institution Legal Officer Name:</label>
    <input type="text" class="form-control input-sm" name="legalofficername" id="legalofficername"  value="<?php echo $legalofficername; ?>"  placeholder="" required data-toggle="tooltip" data-placement="top" title="Institution Legal Officer Name">
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-6 form-group">
    <label for="legalofficeremail">Institution Legal Officer Email</label>
    <input type="email" class="form-control input-sm" name="legalofficeremail" id="legalofficeremail"  value="<?php echo $legalofficeremail; ?>"  placeholder="" required data-toggle="tooltip" data-placement="top" title="Institution Legal Officer Email">
    <div class="help-block with-errors"></div>
</div>




