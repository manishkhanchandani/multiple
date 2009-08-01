<?php require_once('../Connections/conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO image (image, user_id, album_id, caption, imagedate) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['file'], "text"),
                       GetSQLValueString($_POST['file'], "int"),
                       GetSQLValueString($_POST['file'], "int"),
                       GetSQLValueString($_POST['textfield'], "text"),
                       GetSQLValueString($_POST['file'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style6 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-style: italic;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
  <table width="279" border="1" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#99CCFF">
      <td colspan="2" align="center"><span class="style6">Image Upload </span></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td width="39"><strong>Image</strong></td>
      <td width="194"><input type="file" name="file" /></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td valign="top"><strong>Title</strong></td>
      <td><p align="center">
        <input type="text" name="textfield" />
      </p>
      
      <p align="center">
        <input type="submit" name="Submit" value="Submit" />
      </p></td>
    </tr>
  </table>
  <p><a href="gallery1_home.php">[Back]</a></p>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>
</html>
