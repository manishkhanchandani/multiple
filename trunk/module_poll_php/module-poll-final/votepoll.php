<?php require_once('../Connections/conn_poll.php'); ?>
<?php
$colname_rsVote = "-1";
if (isset($_GET['id'])) {
  $colname_rsVote = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_conn_poll, $conn_poll);
$query_rsVote = sprintf("SELECT * FROM polls_questions WHERE poll_id = %s", $colname_rsVote);
$rsVote = mysql_query($query_rsVote, $conn_poll) or die(mysql_error());
$row_rsVote = mysql_fetch_assoc($rsVote);
$totalRows_rsVote = mysql_num_rows($rsVote);
?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO polls_voting (voting_user_id, poll_id, option_num, voting_date) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['voting_user_id'], "int"),
                       GetSQLValueString($_POST['poll_id'], "int"),
                       GetSQLValueString($_POST['option_num'], "int"),
                       GetSQLValueString($_POST['votind_date'], "date"));
					                       
  mysql_select_db($database_conn_poll, $conn_poll);
  $Result1 = mysql_query($insertSQL, $conn_poll) or die(mysql_error());

  $insertGoTo = "success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Vote Poll</title>
</head>

<body>
<h2>Voting the Poll</h2>
<form id="form1" name="form1" method="post" action="">
  <p><strong>Question</strong>: <em> </em><?php echo $row_rsVote['poll_question']; ?></p>
  <p><strong>Options</strong>:</p>
  <p> 1.
    <input name="option_num" type="radio" value="1" />
    <?php echo $row_rsVote['option1']; ?></p>
  <p>2. 
    <input name="option_num" type="radio" value="2" />
    <em><?php echo $row_rsVote['option2']; ?></em></p>
  <p>3. 
    <input name="option_num" type="radio" value="3" />
    <em><?php echo $row_rsVote['option3']; ?></em></p>
  <p>4. 
    <input name="option_num" type="radio" value="4" />
    <em><?php echo $row_rsVote['option4']; ?></em></p>
  <p>5. 
    <input name="option_num" type="radio" value="5" />
    <em><?php echo $row_rsVote['option5']; ?></em></p>
  <p>
    <input type="submit" name="Submit" value="Vote" />
</p>
<input type="hidden" name="voting_user_id" value="">
<input type="hidden" name="poll_id" value="">
<input type="hidden" name="voting_date" value="<?php echo date("Y/m/d"); ?>">
<input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp; </p>
</body>
</html>
<?php
mysql_free_result($rsVote);
?>
