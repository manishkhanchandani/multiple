<?php require_once('../Connections/conn.php'); ?><?php
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

$MM_restrictGoTo = "users/login.php";
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
?><?php
$colname_rsPendingFriends = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_rsPendingFriends = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsPendingFriends = sprintf("SELECT * FROM invitations LEFT JOIN users ON invitations.user_id = users.user_id WHERE invitations.invited_to_id = %s", $colname_rsPendingFriends);
$rsPendingFriends = mysql_query($query_rsPendingFriends, $conn) or die(mysql_error());
$row_rsPendingFriends = mysql_fetch_assoc($rsPendingFriends);
$totalRows_rsPendingFriends = mysql_num_rows($rsPendingFriends);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>My Actions</p>
<?php if ($totalRows_rsPendingFriends > 0) { // Show if recordset not empty ?>
  <p>Pending Friend List </p>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <td><strong>Name</strong></td>
      <td><strong>View</strong></td>
      <td><strong>Accept</strong></td>
      <td><strong>Deny</strong></td>
    </tr>
    <tr>
      <td><?php echo $row_rsPendingFriends['name']; ?></td>
      <td><a href="profiles/profile.php?user_id=<?php echo $row_rsPendingFriends['user_id']; ?>">View</a></td>
      <td><a href="profiles/accept.php?friend_id=<?php echo $row_rsPendingFriends['user_id']; ?>">Accept</a></td>
      <td>Deny</td>
    </tr>
      </table>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsPendingFriends);
?>
