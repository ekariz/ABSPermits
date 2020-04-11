

<div class="col-md-12 form-group">
   Lookup an area in the search box
</div>
<hr>

<input id="pac-input" class="search-controls" placeholder="Search Box" type="text">
<div id="map-canvas" class=""></div>

<hr>
<input id="latlng"  type="hidden"  class="form-control input-sm" >
<div class="col-md-12 form-group">
    <label for="projectlocation">Location or project area for genetic resource collection *:</label>
    <input type="text" class="form-control input-sm" id="projectlocation" name="projectlocation"  value="<?php echo $projectlocation; ?>" placeholder=""   data-toggle="tooltip" data-placement="top" title="Location or project area for genetic resource collection">
    <div class="help-block with-errors"></div>
</div>

 
<div  class="col-md-12 form-group"  >
    <label for="conservestatusdesc">What will be the genetic resource port of export?:</label>
    <input type="text" class="form-control input-sm" id="export_port" name="export_port"  value="<?php echo $export_port; ?>" placeholder=""   data-toggle="tooltip" data-placement="top" title="What will be the genetic resource port of export? ">
    <div class="help-block with-errors"></div>
</div>

<div  class="col-md-12 form-group"  >
    <label for="export_country">Which country is the genetic resource to be exported to?:</label>
     <input type="text" class="form-control input-sm" id="export_country" name="export_country"  value="<?php echo $export_country; ?>" placeholder=""   data-toggle="tooltip" data-placement="top" title="Which country is the genetic resource to be exported to? ">
    <div class="help-block with-errors"></div>
</div>
