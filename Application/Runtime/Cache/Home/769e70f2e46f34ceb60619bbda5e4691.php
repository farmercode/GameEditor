<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="utf-8">
  <title>三国英雄后台管理</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Bracket Responsive Bootstrap3 Admin</title>

  <link href="<?php echo (RESOURCE_URL); ?>css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="<?php echo (RESOURCE_URL); ?>js/html5shiv.js"></script>
  <script src="<?php echo (RESOURCE_URL); ?>js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> 三国英雄后台管理 <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                  <br/><br/><br/><br/><br/><br/>
                   <!--  <h5><strong>Welcome to Bracket Bootstrap 3 Template!</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Fully Responsive Layout</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> HTML5/CSS3 Valid</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                    <strong>Not a member? <a href="#">注册</a></strong> -->
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form method="post" action="<?php echo U("Index/login_validate");?>">
                    <h4 class="nomargin">登录</h4>
                    <p class="mt5 mb20">Login to access your account.</p>
                
                    <input type="text" name="username" class="form-control uname" placeholder="账号" />
                    <input type="password" name="passwd" class="form-control pword" placeholder="密码" />
                    <!-- <a href=""><small>Forgot Your Password?</small></a> -->
                    <button class="btn btn-success btn-block">登录</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2014. All Rights Reserved. 上海火之炎
            </div>
            <div class="pull-right">
                Created By: <a href="#" target="_blank">上海火之炎</a>
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="<?php echo (RESOURCE_URL); ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/bootstrap.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/modernizr.min.js"></script>
<script src="<?php echo (RESOURCE_URL); ?>js/retina.min.js"></script>

<script src="<?php echo (RESOURCE_URL); ?>js/custom.js"></script>

</body>
</html>