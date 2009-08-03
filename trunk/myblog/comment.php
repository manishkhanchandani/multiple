<?php require_once('../../Connections/conn.php'); ?>
<?php
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

$MM_restrictGoTo = "deny1.php";
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
$currentPage = $_SERVER["PHP_SELF"];

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
  $insertSQL = sprintf("INSERT INTO blogs_comment (user_id, post_id, commentdate, description_comment) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['post_id'], "int"),
                       GetSQLValueString($_POST['commentdate'], "date"),
                       GetSQLValueString($_POST['description_comment'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_GET['comment_id'])) && ($_GET['comment_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM blogs_comment WHERE comment_id=%s",
                       GetSQLValueString($_GET['comment_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());

  $deleteGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_rsView1 = 10;
$pageNum_rsView1 = 0;
if (isset($_GET['pageNum_rsView1'])) {
  $pageNum_rsView1 = $_GET['pageNum_rsView1'];
}
$startRow_rsView1 = $pageNum_rsView1 * $maxRows_rsView1;

$colname_rsView1 = "-1";
if (isset($_GET[post_id])) {
  $colname_rsView1 = (get_magic_quotes_gpc()) ? $_GET[post_id] : addslashes($_GET[post_id]);
}
mysql_select_db($database_conn, $conn);
$query_rsView1 = sprintf("SELECT * FROM blogs_comment LEFT JOIN blogs_post on blogs_comment.post_id=blogs_post.post_id WHERE blogs_comment.post_id=%s ORDER BY blogs_comment.commentdate DESC", $colname_rsView1);
$query_limit_rsView1 = sprintf("%s LIMIT %d, %d", $query_rsView1, $startRow_rsView1, $maxRows_rsView1);
$rsView1 = mysql_query($query_limit_rsView1, $conn) or die(mysql_error());
$row_rsView1 = mysql_fetch_assoc($rsView1);

if (isset($_GET['totalRows_rsView1'])) {
  $totalRows_rsView1 = $_GET['totalRows_rsView1'];
} else {
  $all_rsView1 = mysql_query($query_rsView1);
  $totalRows_rsView1 = mysql_num_rows($all_rsView1);
}
$totalPages_rsView1 = ceil($totalRows_rsView1/$maxRows_rsView1)-1;

$colname_Recordset1cat = "-1";
if (isset($_GET[post_id])) {
  $colname_Recordset1cat = (get_magic_quotes_gpc()) ? $_GET[post_id] : addslashes($_GET[post_id]);
}
mysql_select_db($database_conn, $conn);
$query_Recordset1cat = sprintf("SELECT * FROM blogs_post LEFT JOIN blogs_category on blogs_post.category_id=blogs_category.category_id WHERE blogs_post.post_id=%s", $colname_Recordset1cat);
$Recordset1cat = mysql_query($query_Recordset1cat, $conn) or die(mysql_error());
$row_Recordset1cat = mysql_fetch_assoc($Recordset1cat);
$totalRows_Recordset1cat = mysql_num_rows($Recordset1cat);

$queryString_rsView1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView1") == false && 
        stristr($param, "totalRows_rsView1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView1 = sprintf("&totalRows_rsView1=%d%s", $totalRows_rsView1, $queryString_rsView1);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Comment</title>
</head>

<body bgcolor="#CCCC00">
<h3 align="center">Category:<?php echo $row_Recordset1cat['category']; ?></h3>
<h3 align="center">Post:<?php echo $row_Recordset1cat['title']; ?></h3>
<h3 align="center">Add comment for <?php echo $row_Recordset1cat['title']; ?>(<?php echo $row_Recordset1cat['category']; ?>):</h3>
<h3 align="center"><a href="addcomment.php?comment_id=<?php echo $row_rsView1['comment_id']; ?>"></a>
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right" valign="top">Description:</td>
          <td><textarea name="description_comment" cols="50" rows="5"></textarea>
          </td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record"></td>
        </tr>
      </table>
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
      <input type="hidden" name="post_id" value="<?php echo $row_Recordset1cat['post_id']; ?>">
      <input type="hidden" name="commentdate" value="<?php echo date('Y-m-d H:i:s'); ?>">
      <input type="hidden" name="MM_insert" value="form1">
    </form>
  <p>&nbsp;</p>
</h3>
<?php if ($totalRows_rsView1 > 0) { // Show if recordset not empty ?>
  <h3>Comments on <?php echo $row_rsView1['title']; ?>:</h3>
  <?php do { ?>
    <?php echo $row_rsView1['description_comment']; ?>
    <p>Posted on <?php echo $row_rsView1['commentdate']; ?> <a href="comment.php?comment_id=<?php echo $row_rsView1['comment_id']; ?>">Delete</a> </p>
    <?php } while ($row_rsView1 = mysql_fetch_assoc($rsView1)); ?>
  <p align="left"> Records <?php echo ($startRow_rsView1 + 1) ?> to <?php echo min($startRow_rsView1 + $maxRows_rsView1, $totalRows_rsView1) ?> of <?php echo $totalRows_rsView1 ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_rsView1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsView1=%d%s", $currentPage, 0, $queryString_rsView1); ?>">First</a>
            <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center"><?php if ($pageNum_rsView1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_rsView1=%d%s", $currentPage, max(0, $pageNum_rsView1 - 1), $queryString_rsView1); ?>">Previous</a>
            <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsView1 < $totalPages_rsView1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsView1=%d%s", $currentPage, min($totalPages_rsView1, $pageNum_rsView1 + 1), $queryString_rsView1); ?>">Next</a>
            <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_rsView1 < $totalPages_rsView1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_rsView1=%d%s", $currentPage, $totalPages_rsView1, $queryString_rsView1); ?>">Last</a>
            <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
  <?php } // Show if recordset not empty ?>
</p>
<p> </p>
<?php if ($totalRows_rsView1 == 0) { // Show if recordset empty ?>
  <h3>No Comments for <?php echo $row_Recordset1cat['title']; ?></h3>
  <?php } // Show if recordset empty ?>
<h4 align="left">&nbsp;</h4>
<h4 align="center"><a href="index.php">List of categories</a> </h4>
</body>

</html>
<?php
mysql_free_result($rsView1);

mysql_free_result($Recordset1cat);
?>
