<input id="pac-input" class="search-controls" placeholder="Search Box" type="text">
<div id="map-canvas" class=""></div>

<hr>
<input id="latlng"  type="hidden"  class="form-control input-sm" >
<div class="col-md-12 form-group">
    <label for="projectlocation">Location or project area for genetic resource collection *:</label>
    <input type="text" class="form-control input-sm" id="projectlocation" name="projectlocation"  value="<?php echo $projectlocation; ?>" placeholder="" required data-toggle="tooltip" data-placement="top" title="Location or project area for genetic resource collection">
    <div class="help-block with-errors"></div>
</div>
