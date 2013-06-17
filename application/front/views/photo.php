<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<!-- 图片模板 -->
<body>
<?php foreach($data AS $d): ?>
<img src="<?php echo base_url().$d['img_url']; ?>" /><br />
<span>票数：<?php echo $d['votes'] ?> </span><span><a href="<?php echo base_url('index.php/photo/votes/'.$d['img_id']); ?>">投一票</a></span><br />

<?php endforeach ?>
</body>
</html>
