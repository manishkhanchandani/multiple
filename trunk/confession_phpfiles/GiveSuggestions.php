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

$MM_restrictGoTo = "login.php";
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
mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM confession_titledescr ORDER BY postDate DESC";
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsSuggestion = "-1";
if (isset($_SERVER['colname'])) {
  $colname_rsSuggestion = (get_magic_quotes_gpc()) ? $_SERVER['colname'] : addslashes($_SERVER['colname']);
}
mysql_select_db($database_conn, $conn);
$query_rsSuggestion = sprintf("SELECT * FROM confession_titledescr WHERE title = '%s'", $colname_rsSuggestion);
$rsSuggestion = mysql_query($query_rsSuggestion, $conn) or die(mysql_error());
$row_rsSuggestion = mysql_fetch_assoc($rsSuggestion);
$totalRows_rsSuggestion = mysql_num_rows($rsSuggestion);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
</head>

<body>
<h1>Give suggestions </h1>
<h3>Your Suggestions or Comments:</h3>
<form id="form1" name="form1" method="post" action="">
  <p>
    <textarea name="suggestion" id="suggestion"></textarea>
</p>
  <p>&nbsp;</p>
  <p>
    <input type="submit" onclick="MM_goToURL('parent','ViewConfession.php');return document.MM_returnValue" value="Submit" />
  </p>
</form>
<p>&nbsp;  </p>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsSuggestion);
?>
