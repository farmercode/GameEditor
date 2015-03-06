<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    a .chosen-single{overflow: visible;}
</style>
<div class="panel panel-dark panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <a class="panel-close" data-dismiss="modal" aria-hidden="true">&times;</a>
        </div><!-- panel-btns -->
        <h3 class="panel-title">物品导入</h3>       
    </div>
    <div class="panel-body">
        <!-- form begin -->   
        <form class="form-horizontal form-bordered" method="post" action="<?php echo U("Loot/doExcelImport");?>" enctype="multipart/form-data"> 

             <div class="form-group">
              <label class="col-sm-3 control-label">Excel文件</label>
              <div class="col-sm-8">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <div class="input-append">
                    <div class="uneditable-input">
                      <i class="glyphicon glyphicon-file fileupload-exists"></i>
                      <span class="fileupload-preview"></span>
                    </div>
                    <span class="btn btn-default btn-file">
                      <span class="fileupload-new">Select file</span>
                      <span class="fileupload-exists">Change</span>
                      <input type="file" name="excel"/>
                    </span>
                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">物品类型 <span class="asterisk">*</span></label>
                <div class="col-sm-4">
                    <select class="form-control mb15 chose_change" name="LootType">
                    <?php if(is_array($LootTypes)): foreach($LootTypes as $k=>$t): ?><option value="<?php echo ($k); ?>" ><?php echo ($t); ?></option><?php endforeach; endif; ?>
                    </select>  
                </div>               
            </div><!-- form-group -->
            
            <div class="panel-footer" style="text-align: center;">
              <button class="btn btn-info">添加物品</button>
            </div>
        </form> <!-- form end -->
    </div>
</div>
<script>
jQuery(document).ready(function(){

    jQuery('#autoResizeTA').autogrow();

    jQuery(".chose_change").change(function(event) {
        var _val = $(this).val();
        console.log(_val);
        if(_val==1){
            $(".player_list").css({
                display: 'block',
            });
        }else{
            $(".player_list").css({
                display: 'none',
            });
        }
    });
});
</script>