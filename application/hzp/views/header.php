<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<title>库管系统</title>
</head>
<link href="<?php echo base_url('style/css/admin/bootstrap.css');?>" rel="stylesheet" media="screen" />
<link href="<?php echo base_url('style/css/admin/main.css');?>" rel="stylesheet" media="screen" />
<script src="<?php echo base_url("style/js/jquery.js");?>"></script>
<script src="<?php echo base_url("style/js/bootstrap-dropdown.js");?>"></script>
<script src="<?php echo base_url("style/js/bootstrap-modal.js");?>"></script>
<script src="<?php echo base_url("style/js/bootstrap-transition.js");?>"></script>
<script src="<?php //echo base_url("style/js/bootstrap-alert.js");?>"></script>
<script type="text/javascript">
<!--
$(document).ready(function(){
/*	$("input[name=select]").click(function(){
	    var start		=	$("input[name=start]").val();
		var stop		=	$("input[name=stop]").val();
	
		if(start.length==0)
		{
			alert("开始日期不能为空");
			return false;
			
		}else if(stop.length==0)
		{
			alert("结束日期不能为空");
			return false;
		}
        $("#myform").attr('action', '<?php //echo base_url('casoon.php/index/selectdata')?>');        
        $("#myform").submit();      

		})*/
        
  /*ajax 提交数据加提示信息 */
	$('#myModal').on('show', function () {
	   var $form = $("#form");
        var action = $form.attr("action");
        //alert($form.serialize());
        $.post(action, $form.serialize(),
            function(jsonStr) {
                 jsonObj = eval('('+ jsonStr +')');
                //alert(jsonObj.msg);
                if(jsonObj.mod == 'success')
                {
                    //清空表单，如果提交成功，就清空表单
                    $(":input[type=text]").val('');
                    $(":input[type=hidden]").val('');
                    $('textarea').val('');
                    $('#msg').html(jsonObj.msg);
                    
                }else{                    
                    $('#msg').html(jsonObj.msg);
                }          
        });
    });
    
//	$('#myModal').on('hidden', function () {
//	   history.go(-1);
//    });

// tooltip
//    $('.table-striped').tooltip({
//      selector: "a[rel=tooltip]",
//    })

});
-->
</script>
<style type="text/css">
<!--
	#alert_anc {    position: fixed;    z-index: 20;    left: 50%; }
-->
</style>
<body>
<div class="navbar navbar-fixed-top">
<div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="<?php echo site_url();?>">库管系统</a>
        <div class="nav-collapse">
          <ul class="nav">
            <!--<li><a href="<?php //echo site_url();?>">首页</a></li>-->
            <?php foreach($menu AS $d): ?>
            <li class="<?php echo $d['active'];?>" ><a href="<?php echo site_url("{$d['url']}");?>"><?php echo $d['title']?></a></li>
            <?php endforeach?>
<!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">下拉 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">动作</a></li>
                <li class="divider"></li>
                <li class="nav-header">导航头</li>
                <li><a href="#">被间隔的链接</a></li>
                <li><a href="#">另一个链接</a></li>
              </ul>
            </li>
-->
          </ul>
          <form class="navbar-search pull-left" action="" _lpchecked="1">
            <input type="text" class="search-query span2" placeholder="搜索" />
          </form>
          <ul class="nav pull-right">
            <li><a href="<?php echo site_url("goodsbox/cart");?>">购物车</a></li>
            <li class="divider-vertical"></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('uname'); ?><b class="caret"></b></a>
              <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('users/updatePassoord');?>">修改密码</a></li>
              <li><a href="<?php echo site_url("login/quit");?>">退出</a></li>                
<!--
                <li><a href="#">其他动作</a></li>
                <li class="divider"></li>
                <li class="nav-header">导航头</li>
                <li><a href="#">被间隔的链接</a></li>
                <li><a href="#">另一个链接</a></li>
-->
              </ul>
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div>
</div>
<div id="wrapper">
    <div id="main">
    <!-- leftmenu -->
    <?php if($son_menu):?>
        <div class="main-left" id="base-left">
            <div id="left-menu-each-box">
                <div class="box" id="menu-left-box">
            		<ul>
                    <?php foreach($son_menu AS $m): ?>
            		    <?php 
                        if($m['is_show'] != 1):
                        if($m['checked'] == 'checked'):?>                        
                        <li class="each-menu" id="each-menu" style="">
                        <a href="<?php echo site_url("{$m['url']}");?>" style="color: #000;"><strong><?php echo $m['title'] ?></strong></a></li>
                        <?php else: ?>                        
                        <li><a href="<?php echo site_url("{$m['url']}");?>"><?php echo $m['title'] ?></a></li>            
                        <?php endif;endif; ?>
                    <?php endforeach;?>
            		</ul>          
            	</div>
            </div>
        </div>
        <?php endif;?>
    <!-- end leftmenu -->
    
<!--  提示信息 -->
<div class="modal fade" id="myModal" style="display: none;">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>提示</h3>
  </div>
  <div class="modal-body">
    <p id="msg"></p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <!--<a href="#" class="btn btn-primary">保存更新</a>-->
  </div>
</div>
<!-- end 提示信息 -->
<div id="alert_anc" class="alert fade in" style="display:none ;width: 200px;margin-left: -100px;text-align: center;" >
    <!--<button type="button" class="close" data-dismiss="alert">×</button>-->
    <h4 id="alert_msg"></h4>
</div>