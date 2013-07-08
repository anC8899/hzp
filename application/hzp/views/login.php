<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<title>登录</title>
</head>
<link href="<?php echo base_url('style/css/admin/bootstrap.css');?>" rel="stylesheet" media="screen" />
<link href="<?php echo base_url('style/css/admin/bootstrap-responsive.min.css');?>" rel="stylesheet" media="screen" />

<script src="<?php echo base_url("style/js/jquery.js");?>"></script>
<style type="text/css">
<!--
html,body{ margin:0; height:100%; overflow-y:hidden;}
#center{ position:absolute; width:310px;height: 80px; top: 50%; left:50%; margin-top: -40px;margin-left: -155px; z-index: 100;}	
-->
</style>

<body >
<div style="width:100%; height:100%; top: 0px; left: 0px; background-image: url(<?php //echo base_url("style/image/bg.jpg")?>);">
<div id="center" style="overflow:hidden;" >
<?php if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE")){ ?>
<span class="badge badge-error">真爱生命，远离IE</span>    
<?php }else{ ?>
<script type="text/javascript">
<!--
$(document).ready(function(){       
    $('#topanc').delay(3000).hide(0);
    $('#vid').delay(1000).show(2000,'linear');
});
-->
</script>
<?php echo form_open('login/login',array('class'=>"well form-inline")); ?>
  <input name="name" type="text" class="input-small" placeholder="用户名" />
  <input name="pass" type="password" class="input-small" placeholder="密码" />
  <label class="checkbox">  
    <!--    <input type="checkbox" /> 记住我  -->
  </label>
  <button type="submit" class="btn">登录</button>
</form>
<?PHP } ?>
</div>
<div id="vid">
<video  autobuffer  poster="<?php echo base_url("style/image/bg.jpg")?>"  autoplay="autoplay" oncontextmenu="return false" style="min-width: 1366px; width: 100%; top: -98.5px; left: 0px; display: block; opacity: 1;" loop="true" >
<source src="<?php echo base_url("style/image/bg.ogv")?>" type="video/ogg" />
</video>
</div>
<div id="topanc" style="position:absolute;top:0;left:0;z-index: 50; width:100%; height:100%; top: 0px; left: 0px; background-image: url(<?php echo base_url("style/image/bg.jpg")?>);"></div>
</div>
</body>
</html>