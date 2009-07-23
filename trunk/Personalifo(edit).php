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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE personalinformation_lifereminder SET Dob=%s, Identification=%s, BloodGrp=%s, Allergy=%s, Disease=%s, Disablility=%s, Email=%s, Name=%s WHERE id=%s",
                       GetSQLValueString($_POST['Dob'], "date"),
                       GetSQLValueString($_POST['Identification'], "text"),
                       GetSQLValueString($_POST['BloodGrp'], "text"),
                       GetSQLValueString($_POST['Allergy'], "text"),
                       GetSQLValueString($_POST['Disease'], "text"),
                       GetSQLValueString($_POST['Disablility'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "Personalifo(view).php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_connection, $connection);
$query_Recordset15 = "SELECT * FROM personalinformation_lifereminder";
$Recordset15 = mysql_query($query_Recordset15, $connection) or die(mysql_error());
$row_Recordset15 = mysql_fetch_assoc($Recordset15);
$totalRows_Recordset15 = mysql_num_rows($Recordset15);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Dob:</td>
      <td><input type="text" name="Dob" value="<?php echo $row_Recordset15['Dob']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Identification:</td>
      <td><textarea name="Identification" cols="50" rows="5"><?php echo $row_Recordset15['Identification']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">BloodGrp:</td>
      <td><input type="text" name="BloodGrp" value="<?php echo $row_Recordset15['BloodGrp']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Allergy:</td>
      <td><textarea name="Allergy" cols="50" rows="5"><?php echo $row_Recordset15['Allergy']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Disease:</td>
      <td><textarea name="Disease" cols="50" rows="5"><?php echo $row_Recordset15['Disease']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top">Disablility:</td>
      <td><textarea name="Disablility" cols="50" rows="5"><?php echo $row_Recordset15['Disablility']; ?></textarea>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="Email" value="<?php echo $row_Recordset15['Email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="Name" value="<?php echo $row_Recordset15['Name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_Recordset15['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset15);
?>
