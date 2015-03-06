<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    a .chosen-single{overflow: visible;}
</style>
<div class="panel panel-dark panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <a class="panel-close" data-dismiss="modal" aria-hidden="true">&times;</a>
        </div><!-- panel-btns -->
        <h3 class="panel-title">发送系统邮件</h3>       
    </div>
    <div class="panel-body">
        <form class="form-horizontal form-bordered" method="post" action="<?php echo U("Manager/newSysMail");?>"> <!-- form begin -->
							     
            <div class="form-group">
            	<label class="col-sm-3 control-label"><font color="red">* </font>标题</label>
            	<div class="col-sm-8">
                <input type="text" name="title" placeholder="邮件标题" class="form-control" />
            	</div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>内容</label>
                <div class="col-sm-8">
                <textarea id="autoResizeTA" class="form-control" rows="8" style="height: 90px;" name="mail_body"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">附加物品</label>
                
                <div class="input-group">
                    <span class="input-group-addon new_add_line"><i class="glyphicon glyphicon-plus my_cursor"></i></span>
                    <div class="row">
                            <div class="col-sm-4">
                            <input type="text" placeholder="物品ID" class="form-control" name="mail_add[ID][]">
                             </div>
                          <div class="col-sm-5">
                              <select class="form-control mb15" name="mail_add[type][]">
                              <?php if(is_array($lootTypes)): foreach($lootTypes as $typeid=>$t): ?><option value="<?php echo ($typeid); ?>"><?php echo ($t); ?></option><?php endforeach; endif; ?>
                                </select>   
                          </div>
                          <div class="col-sm-2">
                            <input type="text" placeholder="数量" class="form-control" name="mail_add[count][]">
                          </div>
                    </div>
                </div>            
                
            </div>           

            <div class="form-group">
                <label class="col-sm-3 control-label">发送范围 <span class="asterisk">*</span></label>
                <div class="col-sm-4">
                    <select class="form-control mb15 chose_change" name="send_range">
                      <option value="1" >指定玩家</option>
                      <option value="2" >全部</option>
                    </select>  
                </div>               
            </div><!-- form-group -->
            <div class="form-group player_list">
                <label class="col-sm-3 control-label">玩家列表 <span class="asterisk">*</span></label>
                <div class="col-sm-9">
		<textarea id="autoResizeTA" class="form-control" rows="5" name="player_list"></textarea>
                </div>               
            </div><!-- form-group -->
            <div class="panel-footer" style="text-align: center;">
              <button class="btn btn-primary">新建邮件</button>
            </div>
    	</form> <!-- form end -->
    </div>
</div>

<div class="tpl" style="display: none;">
    <div class="input-group col-sm-9 add_line">
                <span class="input-group-addon del_new_line"><i class="glyphicon glyphicon-minus my_cursor"></i></span>
                <div class="row">
                    <div class="col-sm-4">
                    <input type="text" placeholder="物品ID" class="form-control" name="mail_add[ID][]">
                     </div>
                  <div class="col-sm-5">
                    <select class="form-control mb15" name="mail_add[type][]">
                          <?php if(is_array($lootTypes)): foreach($lootTypes as $typeid=>$t): ?><option value="<?php echo ($typeid); ?>"><?php echo ($t); ?></option><?php endforeach; endif; ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" placeholder="数量" class="form-control" name="mail_add[count][]">
                  </div>
                </div>
</div>
</div>
<script>
	jQuery(document).ready(function(){

    jQuery('#autoResizeTA').autogrow();

    /**
     * 新增奖励行
     */
    jQuery(".new_add_line").click(function(){
        var _html=$(".tpl").html();
        var _form_group = $(this).closest('.form-group');
        var _len = _form_group.find('.add_line').length;
        if(_len<4){
            _form_group.append(_html);
            $(".del_new_line").unbind('click', del_new_line);
            $(".del_new_line").bind('click',del_new_line);
        }
    });

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


   function del_new_line(){
        var $this = $(this);
        var _line = $this.closest('.add_line');
        _line.remove();
   }
});
</script>