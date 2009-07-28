<?php require_once('Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM confession_titledescr ORDER BY postDate DESC";
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsDescription = "-1";
if (isset($_GET['title'])) {
  $colname_rsDescription = (get_magic_quotes_gpc()) ? $_GET['title'] : addslashes($_GET['title']);
}
mysql_select_db($database_conn, $conn);
$query_rsDescription = sprintf("SELECT * FROM confession_titledescr WHERE title = '%s'", $colname_rsDescription);
$rsDescription = mysql_query($query_rsDescription, $conn) or die(mysql_error());
$row_rsDescription = mysql_fetch_assoc($rsDescription);
$totalRows_rsDescription = mysql_num_rows($rsDescription);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<h1>Read Confession </h1>
<h3>Confession description :</h3>
<table width="460" border="1">
  <tr>
    <th width="450" height="32" scope="col"></th>
  </tr>
</table>
<p>&nbsp;</p>
<h3>View the Suggestions given by other members: <a href="DisplaySuggestions.php">Suggestions</a></h3>
<p>&nbsp;</p>
<h3>Your Suggestions or Comments: <a href="GiveSuggestions.php">My Suggestion</a></h3>
<p>&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
  <input name="Button" type="button" onclick="MM_goToURL('parent','ViewConfession.php');return document.MM_returnValue" value="Back" />
</form>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <p></p>
</form>
</body>
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsDescription);
?>
