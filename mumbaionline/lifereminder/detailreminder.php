<?php require_once('../Connections/conn.php'); ?>
<?php
$colid_rsdetail = "-1";
if (isset($_SESSION['user_id'])) {
  $colid_rsdetail = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
$colname_rsdetail = "-1";
if (isset($_GET['reminder_id'])) {
  $colname_rsdetail = (get_magic_quotes_gpc()) ? $_GET['reminder_id'] : addslashes($_GET['reminder_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsdetail = sprintf("SELECT * FROM lifereminder_reminder as r Left join lifereminder_friend as f on r.friendid = f.friendid WHERE r.reminder_id = %s and r.user_id = %s", $colname_rsdetail,$colid_rsdetail);
$rsdetail = mysql_query($query_rsdetail, $conn) or die(mysql_error());
$row_rsdetail = mysql_fetch_assoc($rsdetail);
$totalRows_rsdetail = mysql_num_rows($rsdetail);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
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
            <h1 class="title"><a href="#">Detail Reminder</a></h1>
		    <p class="byline"><small>Posted on August 1st, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td>Account</td>
    <td><?php echo $row_rsdetail['account']; ?></td>
  </tr>
  <tr>
    <td>Accountno</td>
    <td><?php echo $row_rsdetail['accountno']; ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><?php echo $row_rsdetail['description']; ?></td>
  </tr>
  <tr>
    <td>Contact</td>
    <td><?php echo $row_rsdetail['contact']; ?></td>
  </tr>
  <tr>
    <td>Place</td>
    <td><?php echo $row_rsdetail['place']; ?></td>
  </tr>
  <tr>
    <td>File</td>
    <td><a href="<?php echo $row_rsdetail['file']; ?>"><?php echo $row_rsdetail['file']; ?></a></td>
  </tr>
  <tr>
    <td>Share With Name</td>
    <td><?php echo $row_rsdetail['name']; ?></td>
  </tr>
  <tr>
    <td>Category</td>
    <td><?php echo $row_rsdetail['category']; ?></td>
  </tr>
  <tr>
    <td>Share With Email </td>
    <td><?php echo $row_rsdetail['email']; ?></td>
  </tr>
</table>

	        </div>
	    </div>
<!-- InstanceEndEditable -->
	  </div>
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
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsdetail);
?>
