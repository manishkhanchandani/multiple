<?php require_once('../../Connections/conn.php'); ?>
<?php
$colname_rsView = "-1";
if (isset($_GET['poll_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['poll_id'] : addslashes($_GET['poll_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM polls_questions WHERE poll_id = %s", $colname_rsView);
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p>Poll</p>
<form id="form1" name="form1" method="post" action="">
  <p>Question: <?php echo $row_rsView['poll_question']; ?></p>
  <p>Options:</p>
  <?php if($row_rsView['option1']) { ?>
  <p>1. <input type="radio" name="option_num" value="1" /><?php echo $row_rsView['option1']; ?></p>
  <?php } ?>
  <?php if($row_rsView['option2']) { ?>
  <p>2. <input type="radio" name="option_num" value="2" /><?php echo $row_rsView['option2']; ?></p>
  <?php } ?>
  <?php if($row_rsView['option3']) { ?>
  <p>3. <input type="radio" name="option_num" value="3" /><?php echo $row_rsView['option3']; ?></p>
  <?php } ?>
  <?php if($row_rsView['option4']) { ?>
  <p>4. <input type="radio" name="option_num" value="4" /><?php echo $row_rsView['option4']; ?></p>
  <?php } ?>
  <?php if($row_rsView['option5']) { ?>
  <p>5. <input type="radio" name="option_num" value="5" /><?php echo $row_rsView['option5']; ?></p>
  <?php } ?>
  <?php if($row_rsView['option6']) { ?>
  <p>6. <input type="radio" name="option_num" value="6" /><?php echo $row_rsView['option6']; ?></p>
  <p>
    <?php } ?>
</p>
  <p>
    <input type="submit" name="Submit" value="Vote Poll" />
</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsView);
?>
