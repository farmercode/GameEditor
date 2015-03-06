<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
    a .chosen-single{overflow: visible;}
    .lootview{position: fixed;top: 20px;width: 100%;height: 100%;background-color: white;
z-index: 999999;}
.view_body{width:100%;height: 85%;overflow: scroll;float: left;}
.view_search{position: absolute;bottom: 0px; }
.single_loot{float: left;margin:2px 5px;}
.single_loot img{width: 48px;height: 48px;}
</style>
<div class="panel panel-dark panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <a class="panel-close" data-dismiss="modal" aria-hidden="true">&times;</a>
        </div><!-- panel-btns -->
        <h3 class="panel-title">添加物品</h3>       
    </div>
    <div class="panel-body">
        <form class="form-horizontal form-bordered" method="post" action="<?php echo U("Loot/submitLoot");?>"> 
        <!-- form begin -->                                      
            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>地图ID</label>
                <div class="col-sm-8">
                <input type="text" name="AtlasLootID" placeholder="地图ID" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>地图名称</label>
                <div class="col-sm-8">
                <input type="text" name="AtlasLootName" placeholder="物品名称" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>掉落数量</label>
                <div class="col-sm-8">
                <input type="text" name="AtlasLootNun" placeholder="物品名称" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">掉落物品</label>
                <div class="input-group">
                    <span class="input-group-addon new_add_line"><i class="glyphicon glyphicon-plus my_cursor"></i></span>
                    <div class="row">
                            <div class="col-sm-4">
                            <select class="form-control mb15" name="mail_add[type][]" onchange="drawLootView(this)">
                              <?php if(is_array($LootTypes)): foreach($LootTypes as $typeid=>$t): ?><option value="<?php echo ($typeid); ?>"><?php echo ($t); ?></option><?php endforeach; endif; ?>
                            </select>                            
                             </div>
                          <div class="col-sm-5">
                            <input type="text" placeholder="物品ID" class="form-control" name="mail_add[ID][]">   
                          </div>
                          <div class="col-sm-2">
                            <input type="text" placeholder="数量" class="form-control" name="mail_add[count][]">
                          </div>
                    </div>
                </div>             
            </div>  
            
            <div class="panel-footer" style="text-align: center;">
              <button class="btn btn-info">添加地图</button>
            </div>
        </form> <!-- form end -->
    </div>
</div>


<div class="tpl" style="display: none;">
    <div class="input-group col-sm-9 add_line">
                <span class="input-group-addon del_new_line"><i class="glyphicon glyphicon-minus my_cursor"></i></span>
                <div class="row">
                    <div class="col-sm-4">
                     <select class="form-control mb15" name="mail_add[type][]">
                          <?php if(is_array($lootTypes)): foreach($lootTypes as $typeid=>$t): ?><option value="<?php echo ($typeid); ?>"><?php echo ($t); ?></option><?php endforeach; endif; ?>
                    </select>                    
                     </div>
                  <div class="col-sm-2">
                    <input type="text" placeholder="物品ID" class="form-control" name="mail_add[ID][]">
                  </div>
                  <div class="col-sm-2">
                    <input type="text" placeholder="数量" class="form-control" name="mail_add[count][]">
                  </div>
                </div>
</div>
</div>

<div class="lootview">
  <div class="view_body"></div>
  <div class="view_search"></div>
</div>
<script type="text/javascript" src="<?php echo (U('Js/loots'));?>"></script>
<script type="text/javascript">
function drawLootView(obj){
  console.log($(obj).val());
  var loot_type = 4;
  var loot_list = Loots[loot_type];
  var _view_body = $(".view_body");
  for (var index in loot_list){
    var _loot_html = "";
    var _loot_base = loot_list[index];
    _loot_html = "<div class='single_loot'><img src='"+_loot_base.img+"' title='"+_loot_base.name+"'/></div>";
    _view_body.append(_loot_html);
  }
}
</script>

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

  function del_new_line(){
        var $this = $(this);
        var _line = $this.closest('.add_line');
        _line.remove();
   }

});
</script>