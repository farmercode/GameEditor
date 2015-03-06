<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    a .chosen-single{overflow: visible;}
</style>
<div class="panel panel-dark panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <a class="panel-close" data-dismiss="modal" aria-hidden="true">&times;</a>
        </div><!-- panel-btns -->
        <h3 class="panel-title">添加物品</h3>       
    </div>
    <div class="panel-body">
        <form class="form-horizontal form-bordered" method="post" action="<?php echo U("Loot/doLootEdit");?>"> <!-- form begin -->
            <input type="hidden" name="auto_id" value="<?php echo ($lootInfo["auto_id"]); ?>" />                                        
            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>物品ID</label>
                <div class="col-sm-8">
                <input type="text" name="LootID" placeholder="物品ID" class="form-control" value="<?php echo ($lootInfo["loot_id"]); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>物品名称</label>
                <div class="col-sm-8">
                <input type="text" name="LootName" placeholder="物品名称" class="form-control" value="<?php echo ($lootInfo["loot_name"]); ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">物品类型 <span class="asterisk">*</span></label>
                <div class="col-sm-4">
                    <select class="form-control mb15 chose_change" name="LootType">
                    <?php if(is_array($LootTypes)): foreach($LootTypes as $k=>$t): ?><option value="<?php echo ($k); ?>" <?php if($k == $lootInfo['loot_type']): ?>selected<?php endif; ?>><?php echo ($t); ?></option><?php endforeach; endif; ?>
                    </select>  
                </div>               
            </div><!-- form-group -->
            
            <div class="panel-footer" style="text-align: center;">
              <button class="btn btn-info">编辑物品</button>
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