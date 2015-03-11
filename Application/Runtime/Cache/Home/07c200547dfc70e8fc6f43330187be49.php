<?php if (!defined('THINK_PATH')) exit();?><div class="panel panel-dark panel-alt">
    <div class="panel-heading">
        <div class="panel-btns">
            <a class="panel-close" data-dismiss="modal" aria-hidden="true">&times;</a>
        </div><!-- panel-btns -->
        <h3 class="panel-title">添加掉落组</h3>       
    </div>
    <div class="panel-body">
        <form class="form-horizontal form-bordered" method="post" action="<?php echo U("Atlas/doAtlasLootAdd");?>"> 
        <!-- form begin -->                                      
            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>掉落组ID</label>
                <div class="col-sm-8">
                <input type="text" name="AtlasLootID" placeholder="掉落组ID" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>掉落组名称</label>
                <div class="col-sm-8">
                <input type="text" name="AtlasLootName" placeholder="掉落组名称" class="form-control" />
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label"><font color="red">* </font>掉落数量</label>
                <div class="col-sm-8">
                <input type="text" name="AtlasLootNun" placeholder="掉落数量" class="form-control" value="0"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">掉落物品</label>
                <div class="row">
                <div class="input-group">
                    <span class="input-group-addon new_add_line"><i class="glyphicon glyphicon-plus my_cursor"></i></span>
                    <div class="row">                            
                            <div class="col-sm-3">
                            <select class="form-control mb15" name="loot_add[type][]" onchange="drawLootView(this)">
                              <?php if(is_array($LootTypes)): foreach($LootTypes as $typeid=>$t): ?><option value="<?php echo ($typeid); ?>"><?php echo ($t); ?></option><?php endforeach; endif; ?>
                            </select>                            
                             </div>
                          <div class="col-sm-3">
                            <input type="text" placeholder="物品ID" class="form-control ipt-lootid" name="loot_add[ID][]">   
                          </div>
                          <div class="col-sm-3">
                            <input type="text" placeholder="物品名称" class="form-control ipt-lootname" name="loot_add[lootname][]">
                          </div>   
                          <div class="col-sm-2">
                            <input type="text" placeholder="物品等级" class="form-control ipt-lootlevel" name="loot_add[level][]" value="0">
                          </div> 

                    </div>
                </div>
                 <div class="row row2">
                            <div class="col-sm-3">
                            <input type="text" placeholder="数量" class="form-control" name="loot_add[count][]">
                          </div> 
                          <div class="col-sm-2">
                            <input type="text" placeholder="最小值" class="form-control" name="loot_add[min_num][]">
                          </div>   
                          <div class="col-sm-2">
                            <input type="text" placeholder="最大值" class="form-control" name="loot_add[max_num][]">
                          </div>
                          <div class="col-sm-2">
                            <input type="text" placeholder="是否独立" class="form-control" name="loot_add[is_alone][]">
                          </div>     
                          <div class="col-sm-2">
                            <input type="text" placeholder="概率" class="form-control" name="loot_add[probability][]">
                          </div>                  
                </div> 
                </div> <!-- end of row -->            
            </div>  
            
            <div class="panel-footer" style="text-align: center;">
              <button class="btn btn-info">添加地图</button>
            </div>
        </form> <!-- form end -->
    </div>
</div>


<div class="tpl" style="display: none;">
<div class="row add_line">
    <div class="input-group col-sm-12">
                <span class="input-group-addon del_new_line"><i class="glyphicon glyphicon-minus my_cursor"></i></span>
                <div class="row">                            
                            <div class="col-sm-3">
                            <select class="form-control mb15" name="loot_add[type][]" onchange="drawLootView(this)">
                              <?php if(is_array($LootTypes)): foreach($LootTypes as $typeid=>$t): ?><option value="<?php echo ($typeid); ?>"><?php echo ($t); ?></option><?php endforeach; endif; ?>
                            </select>                            
                             </div>
                          <div class="col-sm-3">
                            <input type="text" placeholder="物品ID" class="form-control ipt-lootid" name="loot_add[ID][]">   
                          </div>
                          <div class="col-sm-3">
                            <input type="text" placeholder="物品名称" class="form-control ipt-lootname" name="loot_add[lootname][]">
                          </div>     
                          <div class="col-sm-2">
                            <input type="text" placeholder="物品等级" class="form-control ipt-lootlevel" name="loot_add[level][]" value="0">
                          </div>                      
                    </div>
                </div>
                 <div class="row row3">
                            <div class="col-sm-3">
                            <input type="text" placeholder="数量" class="form-control" name="loot_add[count][]">
                          </div> 
                          <div class="col-sm-2">
                            <input type="text" placeholder="最小值" class="form-control" name="loot_add[min_num][]">
                          </div>   
                          <div class="col-sm-2">
                            <input type="text" placeholder="最大值" class="form-control" name="loot_add[max_num][]">
                          </div>
                          <div class="col-sm-2">
                            <input type="text" placeholder="是否独立" class="form-control" name="loot_add[is_alone][]">
                          </div>     
                          <div class="col-sm-2">
                            <input type="text" placeholder="概率" class="form-control" name="loot_add[probability][]">
                          </div>                  
                </div> 

</div> <!-- end of row -->
</div>


<script type="text/javascript" src="<?php echo (U('Js/loots'));?>"></script>
<script type="text/javascript">
var StartObj = null;
function initLootView(){
  var _lootView = $(".lootview");
  _lootView.find(".view_body").html("");
  _lootView.css("display","block");
}

function drawLootView(obj){
  initLootView();
  StartObj = $(obj);
  var loot_type = 4;
  var loot_list = Loots[loot_type];
  var _view_body = $(".view_body");
  for (var index in loot_list){
    var _loot_html = "";
    var _loot_base = loot_list[index];
    _loot_html = "<div class='single_loot' onclick='selectLoot(\""+_loot_base.id+"\",\""+_loot_base.name+"\")'><img src='"+_loot_base.img+"' title='"+_loot_base.name+"'/></div>";
    _view_body.append(_loot_html);
  }
}

function selectLoot(lootID,lootName){
    $(".lootview").css("display","none");
    var rowObj = StartObj.closest(".row");
    rowObj.find(".ipt-lootid").val(lootID);
    rowObj.find(".ipt-lootname").val(lootName);
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
        if(_len<18){
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


   //drawLootView();
});
</script>