<?php require_once('Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php require_once('Connections/conn.php'); ?>
<?php
$maxRows_rsEdit = 5;
$pageNum_rsEdit = 0;
if (isset($_GET['pageNum_rsEdit'])) {
  $pageNum_rsEdit = $_GET['pageNum_rsEdit'];
}
$startRow_rsEdit = $pageNum_rsEdit * $maxRows_rsEdit;

mysql_select_db($database_conn, $conn);
$query_rsEdit = "SELECT * FROM users LEFT JOIN profile1 ON users.user_id = profile1.user_id LEFT JOIN profile2 ON users.user_id = profile2.user_id";
$query_limit_rsEdit = sprintf("%s LIMIT %d, %d", $query_rsEdit, $startRow_rsEdit, $maxRows_rsEdit);
$rsEdit = mysql_query($query_limit_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);

if (isset($_GET['totalRows_rsEdit'])) {
  $totalRows_rsEdit = $_GET['totalRows_rsEdit'];
} else {
  $all_rsEdit = mysql_query($query_rsEdit);
  $totalRows_rsEdit = mysql_num_rows($all_rsEdit);
}
$totalPages_rsEdit = ceil($totalRows_rsEdit/$maxRows_rsEdit)-1;

$queryString_rsEdit = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsEdit") == false && 
        stristr($param, "totalRows_rsEdit") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsEdit = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsEdit = sprintf("&totalRows_rsEdit=%d%s", $totalRows_rsEdit, $queryString_rsEdit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Listing of Prospects </h1>
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td valign="top"><strong>Image</strong></td>
    <td valign="top"><strong>Personal</strong></td>
    <td valign="top"><strong>Action</strong></td>
  </tr>
    <?php do { ?>
  <tr>
      <td valign="top"><img src="uploadDir/profiles/thumbnail/<?php echo $row_rsEdit['image']; ?>" /></td>
      <td valign="top"><?php echo $row_rsEdit['name']; ?></td>
      <td valign="top"><p><a href="profile3.php?user_id=<?php echo $row_rsEdit['user_id']; ?>">Detail</a></p>
      <p><a href="send_proposal.php?proposed_to_id=<?php echo $row_rsEdit['user_id']; ?>">Send Proposal </a> </p></td></tr>
      <?php } while ($row_rsEdit = mysql_fetch_assoc($rsEdit)); ?>
</table>
<p> Records <?php echo ($startRow_rsEdit + 1) ?> to <?php echo min($startRow_rsEdit + $maxRows_rsEdit, $totalRows_rsEdit) ?> of <?php echo $totalRows_rsEdit ?>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_rsEdit > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, 0, $queryString_rsEdit); ?>">First</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_rsEdit > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, max(0, $pageNum_rsEdit - 1), $queryString_rsEdit); ?>">Previous</a>
        <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsEdit < $totalPages_rsEdit) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, min($totalPages_rsEdit, $pageNum_rsEdit + 1), $queryString_rsEdit); ?>">Next</a>
        <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsEdit < $totalPages_rsEdit) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, $totalPages_rsEdit, $queryString_rsEdit); ?>">Last</a>
        <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
