<?php require_once('../../Connections/conn.php'); ?><?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Admin";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/restrict.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if($_FILES['userfile']['name']) {
		$file = "../../uploadDir/advertisements/".$_FILES['userfile']['name'];
		move_uploaded_file($_FILES['userfile']['tmp_name'], $file);
		$_POST['image'] = $_FILES['userfile']['name'];
	}
	$_POST['exp_date'] = time()+(60*60*24*$_POST['expire']);
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
  $insertSQL = sprintf("INSERT INTO advertisements (advt_type, title, description, image, advt_date, exp_date) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['advt_type'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"),
                       GetSQLValueString($_POST['image'], "text"),
                       GetSQLValueString($_POST['advt_date'], "date"),
                       GetSQLValueString($_POST['exp_date'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());

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
<h1>Advertisement </h1>
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1">
  <table>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>Advertisment Type:</td>
      <td valign="top"><table>
        <tr>
          <td><input name="advt_type" type="radio" value="Text" checked="checked" >
            Text</td>
        </tr>
        <tr>
          <td><input type="radio" name="advt_type" value="Image" >
            Image</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>Title:</td>
      <td valign="top"><input type="text" name="title" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Description:</td>
      <td valign="top"><textarea name="description" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>Image: </td>
      <td valign="top"><input name="userfile" type="file" id="userfile" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>Expire After: </td>
      <td valign="top"><select name="expire" id="expire">
        <option value="1">1</option>
        <option value="7">7</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="90">90</option>
      </select>
      Days </td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="top" nowrap>&nbsp;</td>
      <td valign="top"><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="image" value="">
  <input type="hidden" name="advt_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
  <input type="hidden" name="exp_date">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
