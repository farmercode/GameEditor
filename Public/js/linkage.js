/**
 * 服务器选择联动js
 * @param {[type]} className [description]
 * @param {[type]} firstId   [description]
 */

function Linkage(){
        
}

Linkage.prototype.init = function(){
        this.fillFirstSelect();
        $("."+_select_classname+":first").change();
        $("."+_select_classname+":eq(1)").change();
}

/**
 * 初始化第一个select
 */
Linkage.prototype.fillFirstSelect = function(){
        var that = this;
        var _select = $("."+_select_classname+":first");
        //清空当前select
        _select.empty();
        $.each(select_data,function(key,val){
                if(typeof _selected_server != "undefined" && _selected_server.version == key){
                        var _option = "<option value=\""+key+"\" selected>"+key+"</option>";
                }else{
                        var _option = "<option value=\""+key+"\">"+key+"</option>";  
                }
                _select.append(_option);
        });
        /*绑定事件*/
        _select.on("change",this.firstSelectFunc);
}

Linkage.prototype.firstSelectFunc = function(){
       var $this = $(this);       
       var _version = $this.val();
       var _platForm = $("."+_select_classname+":eq(1)");
       var _selectData = eval("select_data."+_version);
       _platForm.empty();

       $.each(_selectData,function(key,val){
                if(typeof _selected_server != "undefined" && _selected_server.platform == key){
                        var _option = "<option value=\""+key+"\" selected>"+val.name+"</option>";
                }else{
                        var _option = "<option value=\""+key+"\">"+val.name+"</option>";
                }
                _platForm.append(_option);
                 $(".chosen-select").trigger("chosen:updated");
        });

       /*绑定平台事件*/
       $("."+_select_classname+":eq(1)").on("change",function(){
                var _versionVal = $("."+_select_classname+":first").val();
                 var _platFormVal = $("."+_select_classname+":eq(1)").val();
                 var _selectData = eval("select_data."+_versionVal+"['"+_platFormVal+"']['servers']");
                 var _servers = $("."+_select_classname+":eq(2)");
                 _servers.empty();
                 $.each(_selectData,function(key,val){
                        if(typeof _selected_server != "undefined" && _selected_server.server == key){
                                var _option = "<option value=\""+key+"\" selected>"+val+"</option>";
                        }else{
                                var _option = "<option value=\""+key+"\">"+val+"</option>";  
                        }
                        _servers.append(_option);
                });
                 $(".chosen-select").trigger("chosen:updated");
       });
       $("."+_select_classname+":eq(1)").change();
}

Linkage.prototype.emptySelect = function(obj){
        obj.empty();
        var _option = "<option value=\"\">请选择上一级</option>"; 
        obj.append(_option);
}
