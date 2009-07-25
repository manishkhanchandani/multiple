<?php require_once('../../Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsPolls = 10;
$pageNum_rsPolls = 0;
if (isset($_GET['pageNum_rsPolls'])) {
  $pageNum_rsPolls = $_GET['pageNum_rsPolls'];
}
$startRow_rsPolls = $pageNum_rsPolls * $maxRows_rsPolls;

mysql_select_db($database_conn, $conn);
$query_rsPolls = "SELECT * FROM polls_questions ORDER BY poll_id DESC";
$query_limit_rsPolls = sprintf("%s LIMIT %d, %d", $query_rsPolls, $startRow_rsPolls, $maxRows_rsPolls);
$rsPolls = mysql_query($query_limit_rsPolls, $conn) or die(mysql_error());
$row_rsPolls = mysql_fetch_assoc($rsPolls);

if (isset($_GET['totalRows_rsPolls'])) {
  $totalRows_rsPolls = $_GET['totalRows_rsPolls'];
} else {
  $all_rsPolls = mysql_query($query_rsPolls);
  $totalRows_rsPolls = mysql_num_rows($all_rsPolls);
}
$totalPages_rsPolls = ceil($totalRows_rsPolls/$maxRows_rsPolls)-1;

$queryString_rsPolls = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsPolls") == false && 
        stristr($param, "totalRows_rsPolls") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsPolls = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsPolls = sprintf("&totalRows_rsPolls=%d%s", $totalRows_rsPolls, $queryString_rsPolls);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>Polls </p>
<table border="1">
  <?php do { ?>
    <tr>
      <td><a href="voting.php?poll_id=<?php echo $row_rsPolls['poll_id']; ?>"><?php echo $row_rsPolls['poll_question']; ?></a></td>
    </tr>
    <?php } while ($row_rsPolls = mysql_fetch_assoc($rsPolls)); ?>
</table>
<p> Records <?php echo ($startRow_rsPolls + 1) ?> to <?php echo min($startRow_rsPolls + $maxRows_rsPolls, $totalRows_rsPolls) ?> of <?php echo $totalRows_rsPolls ?>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_rsPolls > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsPolls=%d%s", $currentPage, 0, $queryString_rsPolls); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_rsPolls > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsPolls=%d%s", $currentPage, max(0, $pageNum_rsPolls - 1), $queryString_rsPolls); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsPolls < $totalPages_rsPolls) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsPolls=%d%s", $currentPage, min($totalPages_rsPolls, $pageNum_rsPolls + 1), $queryString_rsPolls); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsPolls < $totalPages_rsPolls) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsPolls=%d%s", $currentPage, $totalPages_rsPolls, $queryString_rsPolls); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
</body>
</html>
<?php
mysql_free_result($rsPolls);
?>
