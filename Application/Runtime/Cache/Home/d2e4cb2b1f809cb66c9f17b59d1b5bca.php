<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="<?php echo (RESOURCE_URL); ?>images/favicon.png" type="image/png">
<title>Bracket Responsive Bootstrap3 Admin</title>
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/style.default.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/bootstrap-fileupload.min.css" />
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/jquery.tagsinput.css" />
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/colorpicker.css" />
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/dropzone.css" />
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/jquery.datatables.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo (RESOURCE_URL); ?>css/my_style.css" rel="stylesheet">
<script src="<?php echo (RESOURCE_URL); ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/modernizr.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery.cookies.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/toggles.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery.sparkline.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/bootstrap.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/chosen.jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
                // Chosen Select
    jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});
});
</script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php echo (RESOURCE_URL); ?>js/html5shiv.js"></script>
  <script src="<?php echo (RESOURCE_URL); ?>js/respond.min.js"></script>
  <![endif]-->
</head>

<body style="overflow: visible;">

<section>

<div class="leftpanel">
	
	<div class="logopanel">
	        <h3><span>[</span> 游戏配置工具 <span>]</span></h3>
	</div><!-- logopanel -->

	<div class="leftpanelinner">

<!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="<?php echo (RESOURCE_URL); ?>images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4>John Doe</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
    <ul class="nav nav-pills nav-stacked nav-bracket">
    	<li><a href="index.html"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
      <?php $controller = CONTROLLER_NAME; ?>
      
        <li class="nav-parent nav-active active">

      <a href=""><i class="fa fa-suitcase"></i> <span>副本掉落</span></a>
      
      	<ul class="children" style="display: block">
        
	   <li><a href="<?php echo U('Loot/lootList');?>"><span class="pull-right badge badge-danger">new</span>
          <i class="fa fa-caret-right"></i>物品列表</a>
          </li>    
          <li><a href="<?php echo U('Atlas/index');?>"> <span class="pull-right badge badge-danger">new</span>
                  <i class="fa fa-caret-right"></i>地图掉落</a>
          </li>              
        </ul>  
        </li>

    	<!-- <li class="nav-parent nav-active active"><a href=""><i class="fa fa-suitcase"></i> <span>系统管理</span></a>
      	<ul class="children" style="display: block">
	        <li><a href="<?php echo U("System/userList");?>"><i class="fa fa-caret-right"></i> 用户列表</a></li>          
	        <li class="active"><a href="<?php echo U("System/roleList");?>"><i class="fa fa-caret-right"></i> 角色列表</a></li>
          <li class="active"><a href="<?php echo U("System/menuList");?>"><i class="fa fa-caret-right"></i> 菜单列表</a></li>
          
      	</ul> -->
    	</li>

    </ul>
      
    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->

<div class="mainpanel">

        <div class="headerbar">
      <!-- <a class="menutoggle"><i class="fa fa-bars"></i></a> -->
      <div class="header_left" style="min-width: 450px;">
      <form class="form-inline" action="" method="post">
                 
      </form>
      </div>

      <div class="header-right">
        <ul class="headermenu">        
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo (RESOURCE_URL); ?>images/photos/loggeduser.png" alt="" />
                <?php echo ($_SESSION['user_info']['real_name']); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?php echo U("Index/logout");?>"><i class="glyphicon glyphicon-log-out"></i> 注销</a></li>
              </ul>
            </div>
          </li>          
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->


<div class="contentpanel">
        <div class="row">
      <div class="col-md-12">          
          <div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-btns">
              </div><!-- panel-btns -->
              <h3 class="panel-title">物品列表</h3>
            </div>
            <div class="panel-body">
               <a class="btn btn-warning" href="<?php echo U("Loot/lootAdd");?>" data-toggle="modal" data-target=".bs-example-modal-panel">添加物品</a>
               <a class="btn btn-pink" href="<?php echo U("Loot/excelImport");?>" data-toggle="modal" data-target=".bs-example-modal-panel">导入物品</a>
            </div>
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

      <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-info mb30">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>物品ID</th>
                        <th>物品名称</th>
                        <th>类型</th>                        
                        <th>操作</th>                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$loot): $mod = ($k % 2 );++$k;?><tr>
                        <td><img src="<?php echo ($loot["img_info"]); ?>" class="small_head"/></td>
                        <td><?php echo ($loot["loot_id"]); ?></td>
                        <td class="loot_name"><?php echo ($loot["loot_name"]); ?></td>                         
                        <td><?php echo $LootTypes[$loot["loot_type"]]; ?></td>
                        <td>
                        <a class="btn btn-lightblue small_btn" data-toggle="modal" data-target=".bs-example-modal-panel" href="<?php echo U("Loot/lootEdit",array('aid'=>$loot['auto_id']));?>">编辑</a>
                            <a class="btn btn-danger small_btn del_action" href="<?php echo U("Loot/lootDel",array('auto_id'=>$loot['auto_id']));?>">删除</a>
                        </td>
                      </tr><?php endforeach; endif; else: echo "" ;endif; ?>                      
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
                </div> <!-- end of row -->
        </div> <!-- end of contentpanel -->
</div> <!-- end of mainpanel -->

</section>

<div class="modal fade bs-example-modal-panel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content"></div>
  </div>
</div>
<script src="<?php echo (RESOURCE_URL); ?>js/retina.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/holder.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/morris.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/raphael-2.1.0.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery.autogrow-textarea.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/bootstrap-fileupload.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery.maskedinput.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery.tagsinput.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery.mousewheel.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/dropzone.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/colorpicker.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/custom.js"></script>
<script>
jQuery(document).ready(function(){
        
  $("#myModal").on("hidden.bs.modal", function() {
    $(this).removeData("bs.modal");
  });

    jQuery(".del_action").click(function(event) {
      var _parentTr = $(this).closest('tr');
      var _roleName = _parentTr.find(".loot_name").text();
      var _msg = "您确定删除\""+_roleName+"\"吗？此操作是不可恢复操作，请慎重操作！";
      if(!confirm(_msg)){
        event.preventDefault();
        return false;
      }
    });

});
</script>
</body>
</html>