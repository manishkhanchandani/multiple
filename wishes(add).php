<?php require_once('Connections/connection.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO wish_lifereminder (Wishes, Donation, Description, Institution, Contact, Email, Name) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Wishes'], "text"),
                       GetSQLValueString($_POST['Donation'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Institution'], "text"),
                       GetSQLValueString($_POST['Contact'], "int"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Name'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}

mysql_select_db($database_connection, $connection);
$query_Recordsetaddw = "SELECT * FROM wish_lifereminder";
$Recordsetaddw = mysql_query($query_Recordsetaddw, $connection) or die(mysql_error());
$row_Recordsetaddw = mysql_fetch_assoc($Recordsetaddw);
$totalRows_Recordsetaddw = mysql_num_rows($Recordsetaddw);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #6545A7}
-->
</style>
</head>

<body bgcolor="#D0D0D0">
<h1 align="center" class="style1">WISHES</h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="LEFT">
    <tr valign="baseline">
      <td nowrap align="LEFT" valign="top"><span class="style1"><strong>Wishes:</strong></span></td>
      <td align="left"><textarea name="Wishes" cols="50" rows="5"></textarea>      </td>
    
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1"><strong>Donation:</strong></span></td>
      <td align="right"><select name="Donation">
        <option value="BodyParts" <?php if (!(strcmp("BodyParts", ""))) {echo "SELECTED";} ?>>BodyParts</option>
        <option value="Money" <?php if (!(strcmp("Money", ""))) {echo "SELECTED";} ?>>Money</option>
        <option value="Others" <?php if (!(strcmp("Others", ""))) {echo "SELECTED";} ?>>Others</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1"><strong>Description:</strong></span></td>
      <td><input type="text" name="Description" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1"><strong>Institution:</strong></span></td>
      <td><input type="text" name="Institution" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1"><strong>Contact:</strong></span></td>
      <td><input type="text" name="Contact" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="LEFT"><span class="style1"><strong>Email:</strong></span></td>
      <td align="left"><input type="text" name="Email" value="" size="32"></td>
    
    
      <td nowrap align="right"><span class="style1"><strong>Name:</strong></span></td>
      <td align="right"><input type="text" name="Name" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordsetaddw);
?>
