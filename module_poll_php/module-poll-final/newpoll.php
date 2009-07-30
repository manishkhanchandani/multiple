<?php require_once('../Connections/conn_poll.php'); ?><?php
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
  $insertSQL = sprintf("INSERT INTO polls_questions (comm_id, user_id, poll_question, option1, option2, option3, option4, option5, creation_date, expiry_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['comm_id'], "int"),
                       GetSQLValueString($_POST['user_id'], "int"),
                       GetSQLValueString($_POST['poll_question'], "text"),
                       GetSQLValueString($_POST['option1'], "text"),
                       GetSQLValueString($_POST['option2'], "text"),
                       GetSQLValueString($_POST['option3'], "text"),
                       GetSQLValueString($_POST['option4'], "text"),
                       GetSQLValueString($_POST['option5'], "text"),
                       GetSQLValueString($_POST['creation_date'], "date"),
                       GetSQLValueString($_POST['expiry_date'], "date"));

  mysql_select_db($database_conn_poll, $conn_poll);
  $Result1 = mysql_query($insertSQL, $conn_poll) or die(mysql_error());

  $insertGoTo = "success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Poll</title>
</head>

<body>
<h2>Create New Poll</h2>
<p>&nbsp;</p>

<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Poll_question:</strong></td>
      <td><textarea name="poll_question" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Option1:</strong></td>
      <td><textarea name="option1" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Option2:</strong></td>
      <td><textarea name="option2" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Option3:</strong></td>
      <td><textarea name="option3" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Option4:</strong></td>
      <td><textarea name="option4" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><strong>Option5:</strong></td>
      <td><textarea name="option5" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><strong>Expiry_date:</strong></td>
      <td><input type="text" name="expiry_date" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Create Poll"></td>
    </tr>
  </table>
  <input type="hidden" name="comm_id" value="">
  <input type="hidden" name="user_id" value="">
  <input type="hidden" name="creation_date" value="<?php echo date("Y/m/d"); ?>">
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
