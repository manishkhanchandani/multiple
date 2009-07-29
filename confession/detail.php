<?php require_once('../Connections/conn.php'); ?>
<?php session_start(); ?>
<?php
$colname_rsView = "-1";
if (isset($_GET['titleDescr_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['titleDescr_id'] : addslashes($_GET['titleDescr_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM confession_descr WHERE titleDescr_id = %s", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$maxRows_rsSuggestion = 10;
$pageNum_rsSuggestion = 0;
if (isset($_GET['pageNum_rsSuggestion'])) {
  $pageNum_rsSuggestion = $_GET['pageNum_rsSuggestion'];
}
$startRow_rsSuggestion = $pageNum_rsSuggestion * $maxRows_rsSuggestion;

$colname_rsSuggestion = "-1";
if (isset($_GET['titleDescr_id'])) {
  $colname_rsSuggestion = (get_magic_quotes_gpc()) ? $_GET['titleDescr_id'] : addslashes($_GET['titleDescr_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSuggestion = sprintf("SELECT * FROM confession_titlesuggestion LEFT JOIN users ON confession_titlesuggestion.user_id = users.user_id WHERE confession_titlesuggestion.titleDescr_id = %s ORDER BY confession_titlesuggestion.titleSuggestion_id ASC", $colname_rsSuggestion);
$query_limit_rsSuggestion = sprintf("%s LIMIT %d, %d", $query_rsSuggestion, $startRow_rsSuggestion, $maxRows_rsSuggestion);
$rsSuggestion = mysql_query($query_limit_rsSuggestion, $conn) or die(mysql_error());
$row_rsSuggestion = mysql_fetch_assoc($rsSuggestion);

if (isset($_GET['totalRows_rsSuggestion'])) {
  $totalRows_rsSuggestion = $_GET['totalRows_rsSuggestion'];
} else {
  $all_rsSuggestion = mysql_query($query_rsSuggestion);
  $totalRows_rsSuggestion = mysql_num_rows($all_rsSuggestion);
}
$totalPages_rsSuggestion = ceil($totalRows_rsSuggestion/$maxRows_rsSuggestion)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1><?php echo $row_rsView['title']; ?></h1>
<p><?php echo $row_rsView['description']; ?></p>
<p>Posted On: <?php echo $row_rsView['post_date']; ?></p>
<h1>Suggestions</h1>
<p><a href="add_suggestion.php?titleDescr_id=<?php echo $row_rsView['titleDescr_id']; ?>">Add New Suggestion </a></p>
<?php if ($totalRows_rsSuggestion > 0) { // Show if recordset not empty ?>
  <table border="1">
    <?php do { ?>
      <tr>
        <td><p><?php echo $row_rsSuggestion['suggestion']; ?></p>          <p>This Suggestion is Posted By <?php echo $row_rsSuggestion['name']; ?></p>
		<?php if($row_rsSuggestion['accept']==1) { ?>
		Owner has accepted this suggestion. Thank you for your invaluable suggestion.<br />
		<?php } ?>
		<?php if($_SESSION['user_id']==$row_rsView['user_id']) { ?>
		Edit | Delete | <?php if($row_rsSuggestion['accept']==0) { ?><a href="accept.php?titleDescr_id=<?php echo $row_rsView['titleDescr_id']; ?>&titleSuggestion_id=<?php echo $row_rsSuggestion['titleSuggestion_id']; ?>">Accept</a><?php } else { ?><a href="deny.php?titleDescr_id=<?php echo $row_rsView['titleDescr_id']; ?>&titleSuggestion_id=<?php echo $row_rsSuggestion['titleSuggestion_id']; ?>">Deny</a><?php } ?>
		<?php } ?>		</td>
      </tr>
      <?php } while ($row_rsSuggestion = mysql_fetch_assoc($rsSuggestion)); ?>
      </table>
  <?php } // Show if recordset not empty ?><p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsSuggestion);
?>
