

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
    <input type="text" class="form-control input-sm" onkeyup="test_rid()"  onblur="test_rid()" name="orchid" id="orchid" value="<?php echo $orchid; ?>" placeholder="" data-toggle="tooltip" data-placement="top" data-html="true" title="ORCID provides a persistent digital identifier that distinguishes you from every other researcher and, through integration in key research workflows such as manuscript and grant submission, supports automated linkages between you and your professional activities ensuring that your work is recognized <a href='https://orcid.org/' target='_blank' >Read more</a>">
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-12 form-group">
    <label for="researcherid">Other Researcher ID :</label>
    <input type="text" class="form-control input-sm"  onkeyup="test_rid()"   onblur="test_rid()"  name="researcherid" id="researcherid"  value="<?php echo $researcherid; ?>" placeholder=""  data-toggle="tooltip" data-placement="top" title="Other Researcher ID">
    <div class="help-block with-errors"></div>
</div>


<div class="col-md-6 form-group">
    <label for="legalofficername">Institutional Contact person</label>
    <input type="text" class="form-control input-sm" name="legalofficername" id="legalofficername"  value="<?php echo $legalofficername; ?>"  placeholder="" required data-toggle="tooltip" data-placement="top" title="Institution Legal Officer Name">
    <div class="help-block with-errors"></div>
</div>

<div class="col-md-6 form-group">
    <label for="legalofficeremail">Institution Contact person Email</label>
    <input type="email" class="form-control input-sm" name="legalofficeremail" id="legalofficeremail"  value="<?php echo $legalofficeremail; ?>"  placeholder="" required data-toggle="tooltip" data-placement="top" title="Institution Legal Officer Email">
    <div class="help-block with-errors"></div>
</div>




