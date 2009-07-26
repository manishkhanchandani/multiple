<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" src="../../js/script.js"></script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>Username: 
    <input name="username" type="text" id="username" />
</p>
  <p>Password: 
    <input name="password" type="text" id="password" />
</p>
  <p>
    <input type="button" name="Button" value="Login" onclick="str=getFormElements(this.form); doAjaxLoadingTextNoCache('4.php','POST','postid=1',str,'message','yes','Login in progress, please wait..','','','');" />
  </p>
</form>
<div id="message"></div>
</body>
</html>
