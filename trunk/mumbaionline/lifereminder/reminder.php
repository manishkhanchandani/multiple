<?php require_once('../Connections/conn.php'); ?>
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

$MM_restrictGoTo = "../users/login.php";
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
$colname_rsFriends = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_rsFriends = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsFriends = sprintf("SELECT * FROM lifereminder_friend WHERE user_id = %s", $colname_rsFriends);
$rsFriends = mysql_query($query_rsFriends, $conn) or die(mysql_error());
$row_rsFriends = mysql_fetch_assoc($rsFriends);
$totalRows_rsFriends = mysql_num_rows($rsFriends);

	if($_POST['MM_Insert']==1)
	{
		if(!$_POST['friendid'])
		{
			$msg.='Please choose your friend. ';
		}
		if(! $msg)
		{
		 	 	
			if($_FILES['userfile']['name'])
			{
				$_POST['file']=$_SESSION['user_id']."_".time()."_".$_FILES['userfile']['name'];
				move_uploaded_file($_FILES['userfile']['tmp_name'],"../uploadDir/lifereminder/".$_POST['file']);
			}
			include("../Classes/db.php");
			$db = new db;
			$db->phpinsert("lifereminder_reminder","reminder_id",$_POST);
			header("Location: viewreminder.php");
			exit;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Reminder</title>
<!-- InstanceEndEditable -->
<link href="../default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../js/script.js"></script>
<script src="../js/jquery-1.2.6.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>

<body>
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="http://www.mumbaionline.org.in"><span>Mumbai</span>Online<span>.org</span>.in</a></h1>
	</div>
</div>
	<div id="menu">
		<ul id="main">
			<li class="current_page_item"><a href="http://www.mumbaionline.org.in">Homepage</a></li>
</ul>
	</div>
	
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
		<div id="sidebar1" class="sidebar">
			<ul>
				<li>
					<h2>Users</h2>
					<ul>
						<?php if($_SESSION['user_id']) { ?>
							<li><a href="#">My Actions</a></li>	
							<li><a href="../users/logout.php">Logout</a></li>						
						<?php } else { ?>
							<li><a href="../users/login.php">Login</a></li>
							<li><a href="../users/register.php">Register</a></li>
						<?php } ?>
					</ul>
				</li>
				<li>
					<h2>Profiles</h2>
					<ul>
						<?php if($_SESSION['user_id']) { ?>
						<li><a href="../profiles/index.php">My Profile</a></li>	
						<?php } ?>
						<li><a href="../profiles/browse.php">Browse Profiles</a></li>	
					</ul>
				</li>
				<?php if($_SESSION['user_id']) { ?>
				<li>
					<h2>Edit Profile</h2>
					<ul>
						<li><a href="../profiles/edit_general.php">General</a></li>	
						<li><a href="../profiles/edit_social.php">Social</a></li>	
						<li><a href="../profiles/edit_personal.php">Personal</a></li>	
						<li><a href="../profiles/edit_professional.php">Professional</a></li>	
						<li><a href="../profiles/edit_contact.php">Contact</a></li>	
						<li><a href="../profiles/edit_photo.php">Photo</a></li>		
					</ul>
				</li>
				<?php } ?>
				<li>
					<h2>Confession Room</h2>
					<ul>
						<li><a href="../confession/index.php">Intro</a></li>
						<li><a href="../confession/list.php">List All Confessions</a></li>
						<?php if($_SESSION['user_id']) { ?>
						<li><a href="../confession/add.php">Add Confession</a></li>
						<li><a href="../confession/myconfessions.php">My Confessions</a></li>
						<?php } ?>
					</ul>
				</li>
				<li>
					<h2>Life Reminder</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Communities</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Polls</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Website Sell/Purchase</h2>
					<ul>
						<li></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- start content -->
		<div id="content">
<!-- InstanceBeginEditable name="EditRegion3" -->
		  <div class="post">
            <h1 class="title"><a href="#">Set New Reminder</a></h1>
		    <p class="byline"><small>Posted on August 1st, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
			  <?php 
			  echo $msg;
			  ?>
                <table border="1" cellspacing="0" cellpadding="5">
                  <tr>
                    <td valign="top">Accounts:</td>
                    <td valign="top"><select name="account" id="account">
                      <option value="Bank account">Bank account</option>
                      <option value="Policy">Policy</option>
                      <option value="Wills">Wills</option>
                      <option value="Credit">Credit</option>
                      <option value="Assets">Assets</option>
                      <option value="Others">Others</option>
                      <option value="Message" selected="selected">Message</option>
                    </select>
</td>
                  </tr>
                  <tr>
                    <td valign="top">Account no: </td>
                    <td valign="top"><input name="accountno" type="text" id="accountno" value="<?php echo $_POST['accountno']; ?>" /></td>
                  </tr>
                  <tr>
                    <td valign="top">Description:</td>
                    <td valign="top"><textarea name="description" rows="5" id="description"><?php echo $_POST['description']; ?></textarea></td>
                  </tr>
                  <tr>
                    <td valign="top">Contact:</td>
                    <td valign="top"><input name="contact" type="text" id="contact"value="<?php echo $_POST['contact']; ?>" /></td>
                  </tr>
                  <tr>
                    <td valign="top">Place:</td>
                    <td valign="top"><input name="place" type="text" id="place" value="<?php echo $_POST['place']; ?>"></td>
                  </tr>
                  <tr>
                    <td valign="top">File:</td>
                    <td valign="top"><input name="userfile" type="file" id="userfile" /></td>
                  </tr>
                  <tr>
                    <td valign="top">Share with: </td>
                    <td valign="top"><select name="friendid" id="friendid">
                      <option value="">select friend</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_rsFriends['friendid']?>"><?php echo $row_rsFriends['name']?></option>
                      <?php
} while ($row_rsFriends = mysql_fetch_assoc($rsFriends));
  $rows = mysql_num_rows($rsFriends);
  if($rows > 0) {
      mysql_data_seek($rsFriends, 0);
	  $row_rsFriends = mysql_fetch_assoc($rsFriends);
  }
?>
                    </select>
                      <a href="friends.php">Add friends</a></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td valign="top"><input type="submit" name="Submit" value="Add reminder" />
                    <input name="user_id" type="hidden" id="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                    <input name="MM_Insert" type="hidden" id="MM_Insert" value="1" />
                    <input name="file" type="hidden" id="file" /></td>
                  </tr>
                </table>
              </form>
	        </div>
	    </div>
<!-- InstanceEndEditable --> </div>
		<!-- end content -->
		<!-- start sidebars -->
		<div id="sidebar2" class="sidebar">
			<ul>
				
				<li>
					<h2>Forums</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Blogs</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Gallery</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Jobs</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Real Estate</h2>
					<ul>
						<li></li>
					</ul>
				</li>
				<li>
					<h2>Matrimonial</h2>
					<ul>
						<li></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- end sidebars -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end page -->
</div>
<div id="footer">
	<p class="copyright">&copy;&nbsp;&nbsp;2009 All Rights Reserved &nbsp;&bull;&nbsp;</p>
	<p class="link"><a href="#">Privacy Policy</a>&nbsp;&#8226;&nbsp;<a href="#">Terms of Use</a></p>
</div>
</body><!-- InstanceEnd -->
</html>
<?php
mysql_free_result($rsFriends);
?>
