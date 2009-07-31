<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #0033FF}
body {
	background-color: #CCCCCC;
}
-->
</style>
</head>

<body>
<h1 align="center" class="style1">Manage Category</h1>
<h3>Add Category</h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Category:</td>
      <td><input type="text" name="category" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input name="submit" type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
<h3>View Categories </h3>
<table border="1">
  <tr>
    <td><strong>Category Id </strong></td>
    <td><strong>Category</strong></td>
    <td><strong>Edit</strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <?php do { ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="manage_category.php?category_id=<?php echo $row_rsView['category_id']; ?>">Edit</a></td>
    <td><a href="manage_category.php?deleteId=<?php echo $row_rsView['category_id']; ?>">Delete</a></td>
  </tr>
  <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
</table>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
<h3>Edit Category</h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Category:</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input name="submit" type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="category_id" value="<?php echo $row_rsEdit['category_id']; ?>" />
</form>
<?php } // Show if recordset not empty ?>
</body>
</html>
