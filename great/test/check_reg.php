<?php require_once('Connections/conn.php'); ?>
<?php 
	include('Connections/conn.php');
	session.start();
	
	$sql = "select * from matrimony_status where user_id='".$_SESSION['user_id']."'";
	$rs = mysql_query($sql) or die('error');
	
	if(mysql_num_rows($rs))
	{
		header(" Location: already_registered.php");
		exit;
	}
	else
	{
		$sql = "insert into matrimony_status set status_id=1, user_id='".$_SESSION['user_id']."'";
		mysql_query($sql) or die('error');
		
		header(" Location: index_profile.php");
		exit;
	}
?>