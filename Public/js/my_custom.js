jQuery(document).ready(function(){
        
  $("#myModal").on("hidden.bs.modal", function() {
    $(this).removeData("bs.modal");
  });
  
  // Chosen Select    
    jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});

    jQuery(".del_action").click(function(event) {
      var _parentTr = $(this).closest('tr');
      var _roleName = _parentTr.find(".role_name").text();
      var _msg = "您确定删除\""+_roleName+"\"吗？";
      if(!confirm(_msg)){
        event.preventDefault();
        return false;
      }
      
    });
});