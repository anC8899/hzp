<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>晒网速得流量</title>
<script type="text/javascript">
<!--
	var dom = '<?php echo base_url() ?>';
-->
</script>
<script src="<?php echo base_url("style/js/sws/jquery-1.7.2.min.js");?>"></script>
<script src="<?php echo base_url("style/js/sws/lightbox.js");?>"></script>
<link href="<?php echo base_url("style/css/sws/lightbox.css");?>" rel="stylesheet" />
<link href="<?php echo base_url("style/css/sws/sws.css");?>" rel="stylesheet" />
</head>
<body>
<div  id="center">
  <div><img src="<?php echo base_url("style/image/sws/top_img.jpg");?>" width="900" height="292" /></div>
  <div id='nav'>
    <div><img src="<?php echo base_url("style/image/sws/nav-top.jpg");?>" width="900" height="8" /></div>
    <div style="height:42px;padding-left: 310px;"> 
      <!-- <span><a href="index.htm"><img src="images/index.jpg" width="130" height="42" /></a></span> --> 
      <span><a href="<?php echo base_url("index.php/sws/index/hdjs")?>">
      <img src="<?php echo base_url("style/image/sws/hdjs.jpg");?>" width="130" height="42" /></a></span> 
      <span><a href="<?php echo base_url("index.php/sws/")?>">
      <img src="<?php echo base_url("style/image/sws/tpzs.jpg");?>" width="130" height="42" /></a></span> </div>
    <div style="clear:both"></div>
    <div id="nav-bott">
    
    <a href="<?php echo base_url("index.php/sws/index/index?n=3");?>"><img src="<?php echo base_url("style/image/sws/n_03.png");?>" /></a>    
    <a href="<?php echo base_url("index.php/sws/index/index?n=2");?>"><img src="<?php echo base_url("style/image/sws/n_02.png");?>" /></a>
    <a href="<?php echo base_url("index.php/sws/index/index?n=1");?>"><img src="<?php echo base_url("style/image/sws/n_01.png");?>" /></a>
<!--
    <select size="1" id="sort">
	<option value="1" <?php if($id == '1'): echo 'selected="selected"'; endif?> >网速最快</option>
	<option value="2" <?php if($id == '2'): echo 'selected="selected"'; endif?> >网速最慢</option>
	<option value="3" <?php if($id == '3'): echo 'selected="selected"'; endif?> >点击量最高</option>
</select>
-->
    </div>
  </div>
  <div class="ph">
  <?php 
  if($data):  
  foreach($data AS $d):?>
    <div class="ll-photo">
      <div class="ll-photo-n"> 
      <a target="_blank" data='<?php echo $d['img_id'] ?>'  href="<?php echo base_url($d['img_url']);?>" rel="lightbox" >
      <img src="<?php echo base_url($d['img_url']);?>" width="100%" height="100%"/></a>
       </div>
      <div class="ll-photo-in">
        <div class="usinfo"><img src="<?php echo base_url("style/image/sws/{$d['cate']}.PNG");?>" width="40" height="40" /></div>
        <div style="width: 165px;" class="usinfo">
          <div><?php echo $d['nickname'] ?></div>
          <div><?php echo $d['uploadtime'] ?></div>
        </div>
      </div>
    </div>
    <?php endforeach;endif; ?>

  </div>
  <div class="bg-fg">
  <?php echo $pages ?>
  </div>
</div>
<script>
$(function(){    
    $('a[rel|=lightbox]').click(function(){
        var value = $(this).attr('data');
        $.get("<?php echo base_url("index.php/sws/index/votes")?>", { n: value } );
    });
//    $('#sort').change(function(){
//        top.location.href  =  "<?php echo base_url("index.php/sws/index/index")?>"+'?n='+$(this).val();
//        
//    });
});
</script>
</body>
</html>