<?php require_once('../../Connections/conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../users/login.php";
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
if($_POST['MM_Insert']=="photo") {
	$file = "../../uploadDir/profiles/original/".$_FILES['image']['name'];
	move_uploaded_file($_FILES['image']['tmp_name'], $file);
	include("../Classes/db.php");
	$db = new db;
	$record['image'] = $_FILES['image']['name'];
	$db->phpedit("profile2","user_id",$record,$_SESSION['user_id']);
}
?>
<?php
$coluserid_rsEdit = "1";
if (isset($_SESSION['user_id'])) {
  $coluserid_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM users LEFT JOIN profile1 ON users.user_id = profile1.user_id LEFT JOIN profile2 ON users.user_id = profile2.user_id WHERE users.user_id = %s", $coluserid_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?>
<?php
if($_GET['action']=="remove") {
	@unlink("../../uploadDir/profiles/original/".$row_rsEdit['image']);
	$sql = "update profile2 set image = NULL where user_id = '".$_SESSION['user_id']."'";
	mysql_query($sql) or die(mysql_error());
	header("Location: edit_photo.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Edit Profile: My Photo</h1>
<form id="myphotoform" name="myphotoform" enctype="multipart/form-data" method="post" action="">
  <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
	<?php if(!$row_rsEdit['image']) { ?>
      <tr>
        <td>Image:</td>
        <td><input type="file" id="image" name="image"/></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="Update" name="Button"/>
            <input type="hidden" value="photo" name="MM_Insert"/></td>
      </tr>
	  <?php } ?>
	  <?php if($row_rsEdit['image']) { ?>
      <tr>
        <td></td>
        <td><img src="../../uploadDir/profiles/original/<?php echo $row_rsEdit['image']; ?>"/> <br/>
          <a href="edit_photo.php?action=remove">Remove</a> </td>
      </tr>
	  <?php } ?>
    </tbody>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
