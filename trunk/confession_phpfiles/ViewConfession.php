<?php require_once('Connections/conn.php'); ?>
<?php
$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM confession_titledescr ORDER BY postDate DESC";
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$colname_rsDescription = "-1";
if (isset($_POST['title'])) {
  $colname_rsDescription = (get_magic_quotes_gpc()) ? $_POST['title'] : addslashes($_POST['title']);
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
<h1>View Confession</h1>
<h3>Please click the confession you wish to read:</h3>
<table width="523" border="1">
  <tr>
    <th width="331" scope="col">Titles</th>
    <th width="176" scope="col">Date of Posting </th>
  </tr>
  <?php do { ?>
    <tr>
	  <td><a href="ReadConfession.php?title=<?php echo $row_rsDescription['description'];?>"><?php echo $row_rsView['title']; ?></a></td>
	  <!--<td><a href="ReadConfession.php">?php echo $row_rsView['title']; ?></a></td>-->
      <td><?php echo $row_rsView['postDate']; ?></td>
    </tr>
    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
</table>
<form id="form1" name="form1" method="post" action="">
  <input name="Button" type="button" onclick="MM_goToURL('parent','ConfessionIndex.php');return document.MM_returnValue" value="Back" />
</form>
<p>&nbsp; </p>
</body>
</html>
<?php
//mysql_free_result($rsView);

mysql_free_result($rsDescription);
?>
