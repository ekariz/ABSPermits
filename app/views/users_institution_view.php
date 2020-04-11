<?php

if (!$grid_html = $this->cache->get($this->router->class)){
$grid_html = $this->customcrud->drawDT();
$this->cache->save($this->router->class, $grid_html, 1);
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
                <h3 class="modal-title">Users</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form-data" class="form-horizontal">
                    <input type="hidden" value="" id="id" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Role</label>
                            <div class="col-md-9">
                                <?php
                                  echo form_dropdown('rolecode', $roles, '','id="rolecode" class="form-control" ');
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">User Name</label>
                            <div class="col-md-9">
                                <input id="username" name="username" placeholder="User Name" class="form-control" type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Mobile</label>
                            <div class="col-md-9">
                                <input id="text" name="mobile" placeholder="mobile" class="form-control" type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input  type="password" id="password" name="password" placeholder="Password" class="form-control" type="text" >
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Disabled?</label>
                            <div class="col-md-9">
                                <input id="disabled"  name="disabled" class="form-controlx" type="checkbox" value="1">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="crud.save()" class="btn btn-primary"><i class="fa fa-check-square"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

