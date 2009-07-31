<?php require_once('Connections/conn.php'); ?>
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
$colid_rsAccept = "-1";
if (isset($_SESSION['user_id'])) {
  $colid_rsAccept = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
$colname_rsAccept = "-1";
if (isset($_GET['friend_id'])) {
  $colname_rsAccept = (get_magic_quotes_gpc()) ? $_GET['friend_id'] : addslashes($_GET['friend_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsAccept = sprintf("SELECT * FROM friends WHERE friend_id = %s and user_id = %s", $colname_rsAccept,$colid_rsAccept);
$rsAccept = mysql_query($query_rsAccept, $conn) or die(mysql_error());
$row_rsAccept = mysql_fetch_assoc($rsAccept);
$totalRows_rsAccept = mysql_num_rows($rsAccept);

if($totalRows_rsAccept==1) {
	$message = "User already in your friend list.";
} else {
	$sql = "delete from invitations where invited_to_id = '".$_SESSION['user_id']."' and user_id = '".$_GET['friend_id']."'";
	mysql_query($sql) or die(mysql_error());
	$sql = "insert into friends set user_id = '".$_SESSION['user_id']."', friend_id = '".$_GET['friend_id']."'";
	@mysql_query($sql);
	$sql = "insert into friends set user_id = '".$_GET['friend_id']."', friend_id = '".$_SESSION['user_id']."'";
	@mysql_query($sql);
	$message = "User successfully added in your friend list.";
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>Confirmation</p>
<p><?php echo $message; ?></p>
</body>
</html>
<?php
mysql_free_result($rsAccept);
?>
