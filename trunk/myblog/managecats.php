<?php require_once('../Connections/conn.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO blogs_category (category) VALUES (%s)",
                       GetSQLValueString($_POST['category'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_GET['deleteId'])) && ($_GET['deleteId'] != "")) {
  $deleteSQL = sprintf("DELETE FROM blogs_category WHERE category_id=%s",
                       GetSQLValueString($_GET['deleteId'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());
}

mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM blogs_category ORDER BY category ASC";
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);

$colname_rsEdit = "-1";
if (isset($_GET['category_id'])) {
  $colname_rsEdit = (get_magic_quotes_gpc()) ? $_GET['category_id'] : addslashes($_GET['category_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM blogs_category WHERE category_id = %s", $colname_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Manage Categories</title>
</head>

<body bgcolor="#CCCC00">
<h1 align="center">Manage Category</h1>
<h3 align="center">Add Category</h3>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="center">Category:</td>
          <td><input type="text" name="category" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
</form>
    <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
      <h3 align="center">View Categories </h3>
      <table border="1" align="center">
        <tr>
          <td><strong>Category Id </strong></td>
          <td><strong>Category</strong></td>
          <td><strong>Edit</strong></td>
          <td><strong>Delete</strong></td>
        </tr>
        <?php do { ?>
          <tr>
            <td><?php echo $row_rsView['category_id']; ?></td>
            <td><?php echo $row_rsView['category']; ?></td>
            <td><a href="editcategory.php?category_id=<?php echo $row_rsView['category_id']; ?>">Edit</a></td>
            <td><a href="managecats.php?deleteId=<?php echo $row_rsView['category_id']; ?>">Delete</a></td>
          </tr>
          <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
      </table>
        <?php } // Show if recordset not empty ?>
        <h3>&nbsp;</h3>
        <p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsView);

mysql_free_result($rsEdit);
?>
