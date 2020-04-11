<?php

echo $this->customcrud->drawDT();

$this->customcrud->genJS(
  $load_datagrid      = true,
  $modal_title_change = false,
  $btn_add_visible    = true,
  $btn_import_visible = false,
  $btn_export_visible = false,
  $btn_add_text       = 'New Template'
  );

?>

<script>
 
var crud ={
  add:function(){
   location.hash = '#EmailTemplates/add.html';
  },
  edit:function(id){
   location.hash = '#EmailTemplates/edit/'+id+'.html';
  }
}
</script>

