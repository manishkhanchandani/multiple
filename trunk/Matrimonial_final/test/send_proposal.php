<?php require_once('Connections/conn.php'); ?><?php
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
$colid_rsCheck = "-1";
if (isset($_SESSION['user_id'])) {
  $colid_rsCheck = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
$colname_rsCheck = "-1";
if (isset($_GET['proposed_to_id'])) {
  $colname_rsCheck = (get_magic_quotes_gpc()) ? $_GET['proposed_to_id'] : addslashes($_GET['proposed_to_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCheck = sprintf("SELECT * FROM matrimony_proposal WHERE proposed_to_id = %s AND user_id = %s", $colname_rsCheck,$colid_rsCheck);
$rsCheck = mysql_query($query_rsCheck, $conn) or die(mysql_error());
$row_rsCheck = mysql_fetch_assoc($rsCheck);
$totalRows_rsCheck = mysql_num_rows($rsCheck);

$colid_rsFriendlist = "-1";
if (isset($_SESSION['user_id'])) {
  $colid_rsFriendlist = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
$colname_rsFriendlist = "-1";
if (isset($_GET['proposed_to_id'])) {
  $colname_rsFriendlist = (get_magic_quotes_gpc()) ? $_GET['proposed_to_id'] : addslashes($_GET['proposed_to_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsFriendlist = sprintf("SELECT * FROM matrimony_accept WHERE proposer_id = %s AND user_id = %s", $colname_rsFriendlist,$colid_rsFriendlist);
$rsFriendlist = mysql_query($query_rsFriendlist, $conn) or die(mysql_error());
$row_rsFriendlist = mysql_fetch_assoc($rsFriendlist);
$totalRows_rsFriendlist = mysql_num_rows($rsFriendlist);


if($_SESSION['user_id']==$_GET['proposed_to_id']) {
	$message = "You cannot invite yourself.";
} else if($totalRows_rsCheck==0) {
	if($totalRows_rsFriendlist==1) {
		$message = "This user is already in your proposer list so you cannot send invitation to this user.";
	} else {
		$record['proposed_to_id'] = $_GET['proposed_to_id'];
		$record['user_id'] = $_SESSION['user_id'];
		$record['proposal_date'] = date('Y-m-d H:i:s');
		include("Classes/db.php");
		$db = new db;
		$db->phpinsert("matrimony_proposal","proposal_id",$record);
		$message = "You have successfully invited the user.";
	}
	
} else {
	$message = "You have already invited this user. Please be patient till he accepts your invitation.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Confirmation</h1>
<p><?php echo $message; ?>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsCheck);

mysql_free_result($rsFriendlist);
?>
