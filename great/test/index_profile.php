<?php require_once('Connections/conn.php'); ?>
<?php
$colname_rsStatus = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_rsStatus = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsStatus = sprintf("SELECT * FROM matrimony_status WHERE user_id = %s", $colname_rsStatus);
$rsStatus = mysql_query($query_rsStatus, $conn) or die(mysql_error());
$row_rsStatus = mysql_fetch_assoc($rsStatus);
$totalRows_rsStatus = mysql_num_rows($rsStatus);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php if ($totalRows_rsStatus == 0) { // Show if recordset empty ?>
  <h3>If necessary, please update your profile by clicking the following links. </h3>
  <?php } // Show if recordset empty ?><p><a href="matrimony_general.php">General Profile</a></p>
<p><a href="matrimony_professional.php">Professional</a></p>
<p><a href="matrimony_personal.php">Personal</a></p>
<p><a href="matrimony_social.php">Social</a></p>
<p><a href="matrimony_contacts.php">Contacts</a></p>
</body>
</html>
<?php
mysql_free_result($rsStatus);
?>
