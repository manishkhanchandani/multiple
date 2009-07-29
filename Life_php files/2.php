<?php require_once('Connections/conn.php'); ?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$tmp = time();
	$_POST['image'] = $tmp.$_FILES['file']['name'];
}
?>
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
                       GetSQLValueString($_POST['image'], "text"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['album_id'], "int"),
                       GetSQLValueString($_POST['caption'], "text"),
                       GetSQLValueString($_POST['imagedate'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	move_uploaded_file($_FILES['file']['tmp_name'], "uploadDir/albums/".$_POST['image']);

  $insertGoTo = "confirm.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Image Upload</h1>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1">
  <table>
    <tr valign="baseline">
      <td nowrap align="right">Album_id:</td>
      <td><select name="album_id">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>General</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Birthday</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Image:</td>
      <td><input type="file" name="file" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Caption:</td>
      <td><input type="text" name="caption" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="image" value="">
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
  <input type="hidden" name="imagedate" value="<?php echo date('Y-m-d H:i:s'); ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
