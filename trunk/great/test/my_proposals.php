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
$colname_rsPendingProposals = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_rsPendingProposals = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsPendingProposals = sprintf("SELECT * FROM matrimony_proposal LEFT JOIN users ON matrimony_proposal.user_id = users.user_id WHERE matrimony_proposal.proposed_to_id = %s", $colname_rsPendingProposals);
$rsPendingProposals = mysql_query($query_rsPendingProposals, $conn) or die(mysql_error());
$row_rsPendingProposals = mysql_fetch_assoc($rsPendingProposals);
$totalRows_rsPendingProposals = mysql_num_rows($rsPendingProposals);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h3><strong>My Actions</strong></h3>
<?php if ($totalRows_rsPendingProposals > 0) { // Show if recordset not empty ?>
  <p><strong>Pending Proposal List </strong></p>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <td><strong>Name</strong></td>
      <td><strong>View</strong></td>
      <td><strong>Accept</strong></td>
      <td><strong>Deny</strong></td>
    </tr>
    <tr>
      <td><?php echo $row_rsPendingProposals['name']; ?></td>
      <td><a href="profiles/profile.php?user_id=<?php echo $row_rsPendingProposals['user_id']; ?>">View</a></td>
      <td><a href="accept.php?proposer_id=<?php echo $row_rsPendingProposals['user_id']; ?>">Accept</a></td>
      <td>Deny</td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsPendingProposals);
?>
