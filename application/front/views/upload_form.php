<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>
手机号码：<input type="text" name="phone_num" />
<br /> 
选择图片：<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="上传"  />

</form>

</body>
</html>