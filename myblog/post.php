<?php require_once('../Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
 session_start(); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO blogs_post (user_id, category_id, postdate, title, description) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['category_id'], "int"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['description'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_GET['post_id'])) && ($_GET['post_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM blogs_post WHERE post_id=%s",
                       GetSQLValueString($_GET['post_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());

  $deleteGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rsCategory = "-1";
if (isset($_GET['category_id'])) {
  $colname_rsCategory = (get_magic_quotes_gpc()) ? $_GET['category_id'] : addslashes($_GET['category_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsCategory = sprintf("SELECT * FROM blogs_category WHERE category_id = %s", $colname_rsCategory);
$rsCategory = mysql_query($query_rsCategory, $conn) or die(mysql_error());
$row_rsCategory = mysql_fetch_assoc($rsCategory);
$totalRows_rsCategory = mysql_num_rows($rsCategory);

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "-1";
if (isset($_GET['category_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['category_id'] : addslashes($_GET['category_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM blogs_post LEFT JOIN users on blogs_post.user_id = users.user_id WHERE blogs_post.category_id = %s ORDER BY blogs_post.postdate DESC", $colname_rsView);
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

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Posts</title>
</head>

<body bgcolor="#CCCC00">
<h2 align="center">Category:
  <?php echo $row_rsCategory['category']; ?><a href="index.php"></a></h2>
<h3 align="center">Add Posts on <?php echo $row_rsCategory['category']; ?>:</h3>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right"><h3>Title:</h3></td>
      <td><input type="text" name="title" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><h3>Description:</h3></td>
      <td><textarea name="description" cols="50" rows="5"></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="hidden" name="postdate" value="<?php echo date('Y-m-d H:i:s'); ?>">
    <input type="hidden" name="category_id" value="<?php echo $row_rsCategory['category_id']; ?>">
    <input type="hidden" name="MM_insert" value="form1">
  </p>
</form>

<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
  <h2>Posts on <?php echo $row_rsCategory['category']; ?>:</h2>
  <?php do { ?>
    <p><a href="comment.php?post_id=<?php echo $row_rsView['post_id']; ?>"><?php echo $row_rsView['title']; ?></a> </p>
    <p><?php echo $row_rsView['description']; ?></p>
    <p>Posted on <?php echo $row_rsView['postdate']; ?> <a href="post.php?post_id=<?php echo $row_rsView['post_id']; ?>">Delete</a></p>
    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
    <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_rsView == 0) { // Show if recordset empty ?>
      <h4>No Posts on <?php echo $row_rsCategory['category']; ?></h4>
      <?php } // Show if recordset empty ?>
      <p align="left"><a href="index.php"></a></p>
      <h4 align="center"><a href="index.php">List of categories</a></h4>
</body>
</html>
<?php
mysql_free_result($rsCategory);

mysql_free_result($rsView);
?>
