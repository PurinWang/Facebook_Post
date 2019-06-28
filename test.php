<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<p>
  <?php
// Copyright 2007 Facebook Corp.  All Rights Reserved. 
// 
// Application: Example
// File: 'index.php' 
//   This is a sample skeleton for your application. 
// 

require_once 'src/facebook.php';

$config = array(
	"appId"=>'',
	'secret'=>'',
	'fileUpload'=>true
);
$facebook = new Facebook($config);
$user_id=$facebook->getUser();
if($user_id==0){
	$login_url=$facebook->getLoginUrl(array(
	'scope'=>'read_stream,publish_stream,photo_upload,user_photos,friends_photos'
	,'redirect_url'=>'http://localhost/test.php'));
	print "not login";
	?>
  <a href="<?php print $login_url?>">login</a>
  <?php
}else{
	print "YOUR ID=".$user_id;	
	if(isset($_POST['button'])){
		$user_data = $facebook->api('/me');
		var_dump($user_data);
	}
	else if(isset($_POST['post'])){
		$message=$_POST['text'];
		$facebook->api('/me/feed','POST',array('message'=>$message));
	}
}
?>
</p>
<form id="form1" name="form1" method="post" action="">
  <p>
    <input type="submit" name="button" id="button" value="Detail" />
  </p>
  <p>
    <input type="submit" name="post" id="post" value="Submit" />
  </p>
  <p>
    <textarea name="text" cols="50" rows="10" id="text"></textarea>
  </p>
</form>
</body>
</html>
