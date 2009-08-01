<?php require_once('../Connections/conn.php'); ?>
<?php session_start(); ?>
<?php
$sql = "update confession_titleSuggestion set accept = 1 where titleSuggestion_id = '".$_GET['titleSuggestion_id']."' and user_id = '".$_SESSION['user_id']."'";
mysql_query($sql) or die('error');
header("Location: detail.php?titleDescr_id=".$_GET['titleDescr_id']);
exit;
?>
