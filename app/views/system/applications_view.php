<?php

if (!$grid_html = $this->cache->get($this->router->class)){
$grid_html = $this->customcrud->drawDT();
$this->cache->save($this->router->class, $grid_html, 300);
}
echo $grid_html;
$this->customcrud->genJS();


?>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Apps</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-data" class="form-horizontal">
                    <input type="hidden" value="" id="id" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Application Code</label>
                            <div class="col-md-9">
                                <input id="appid"  name="appid" placeholder="Application Code" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Application Name</label>
                            <div class="col-md-9">
                                <input id="appname"  name="appname" placeholder="Application Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">Application Icon</label>
                            <div class="col-md-9">
                                <input id="appicon"  name="appicon" placeholder="App Icon" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">Icon Color</label>
                            <div class="col-md-9">
                                <input id="iconclr"  name="iconclr" placeholder="App Icon" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="crud.save()" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


