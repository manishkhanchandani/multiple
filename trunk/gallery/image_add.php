<?php
session_start();
if($_POST) {
	move_uploaded_file($_FILES['userfile']['tmp_name'], "images/".$_FILES['userfile']['name']);
	$sql = "insert into table(field1, field2) values('value1', 'value2')";
	mysql_query($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>Upload Images</p>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>Album: 
    <select name="album_id" id="album_id">
      <option value="1">General</option>
      <option value="2">Birthday</option>
      </select>
</p>
  <p>Image: 
    <input type="file" name="userfile" />
  </p>
  <p>
    <input type="submit" name="Submit" value="Upload" />
    <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
  </p>
  <p>&nbsp;  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
