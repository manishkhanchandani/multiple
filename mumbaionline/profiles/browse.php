<?php require_once('../Connections/conn.php'); ?>
<?php session_start(); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsEdit = 10;
$pageNum_rsEdit = 0;
if (isset($_GET['pageNum_rsEdit'])) {
  $pageNum_rsEdit = $_GET['pageNum_rsEdit'];
}
$startRow_rsEdit = $pageNum_rsEdit * $maxRows_rsEdit;

mysql_select_db($database_conn, $conn);
$query_rsEdit = "SELECT * FROM users LEFT JOIN profile1 ON users.user_id = profile1.user_id LEFT JOIN profile2 ON users.user_id = profile2.user_id WHERE profile1.city != '' ORDER BY users.last_login_dt DESC";
$query_limit_rsEdit = sprintf("%s LIMIT %d, %d", $query_rsEdit, $startRow_rsEdit, $maxRows_rsEdit);
$rsEdit = mysql_query($query_limit_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);

if (isset($_GET['totalRows_rsEdit'])) {
  $totalRows_rsEdit = $_GET['totalRows_rsEdit'];
} else {
  $all_rsEdit = mysql_query($query_rsEdit);
  $totalRows_rsEdit = mysql_num_rows($all_rsEdit);
}
$totalPages_rsEdit = ceil($totalRows_rsEdit/$maxRows_rsEdit)-1;

$queryString_rsEdit = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsEdit") == false && 
        stristr($param, "totalRows_rsEdit") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsEdit = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsEdit = sprintf("&totalRows_rsEdit=%d%s", $totalRows_rsEdit, $queryString_rsEdit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Browse All Profiles</title>
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
						<li><a href="index.php">My Profile</a></li>	
						<?php } ?>
						<li><a href="browse.php">Browse Profiles</a></li>	
					</ul>
				</li>
				<?php if($_SESSION['user_id']) { ?>
				<li>
					<h2>Edit Profile</h2>
					<ul>
						<li><a href="edit_general.php">General</a></li>	
						<li><a href="edit_social.php">Social</a></li>	
						<li><a href="edit_personal.php">Personal</a></li>	
						<li><a href="edit_professional.php">Professional</a></li>	
						<li><a href="edit_contact.php">Contact</a></li>	
						<li><a href="edit_photo.php">Photo</a></li>		
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
            <h1 class="title"><a href="#">Browse All Users</a></h1>
		    <p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <?php if ($totalRows_rsEdit > 0) { // Show if recordset not empty ?>
              <table border="1" cellspacing="0" cellpadding="5">
                <tr>
                  <td valign="top"><strong>Image</strong></td>
        <td valign="top"><strong>Personal</strong></td>
        <td valign="top"><strong>Location</strong></td>
        <td valign="top"><strong>Actions</strong></td>
      </tr>
                <?php do { ?>
                <tr>
                  <td valign="top"><img src="../uploadDir/profiles/thumbs/<?php echo $row_rsEdit['image']; ?>" /></td>
                  <td valign="top"><?php echo $row_rsEdit['name']; ?><br />
                    Profile Created On: <br />
                    <?php echo $row_rsEdit['created_dt']; ?>
					<?php if($row_rsEdit['last_login_dt']) { ?>
					<br />
                    Last Login Date:<br />
                    <?php echo $row_rsEdit['last_login_dt']; ?>
					<?php } ?>
				  </td>
                  <td valign="top"><?php if($row_rsEdit['city']) { echo $row_rsEdit['city']; } if($row_rsEdit['province']) { ?>, <?php echo $row_rsEdit['province']; } ?><?php if($row_rsEdit['country']) { ?><br />
                    <?php echo $row_rsEdit['country']; ?><?php } ?></td>
                  <td valign="top"><a href="index.php?user_id=<?php echo $row_rsEdit['user_id']; ?>">Details</a></td>
                </tr>
                <?php } while ($row_rsEdit = mysql_fetch_assoc($rsEdit)); ?>
              </table>
              <p> Records <?php echo ($startRow_rsEdit + 1) ?> to <?php echo min($startRow_rsEdit + $maxRows_rsEdit, $totalRows_rsEdit) ?> of <?php echo $totalRows_rsEdit ?>
                    <table border="0" width="50%" align="center">
                      <tr>
                        <td width="23%" align="center"><?php if ($pageNum_rsEdit > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, 0, $queryString_rsEdit); ?>">First</a>
                              <?php } // Show if not first page ?>
                        </td>
                        <td width="31%" align="center"><?php if ($pageNum_rsEdit > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, max(0, $pageNum_rsEdit - 1), $queryString_rsEdit); ?>">Previous</a>
                              <?php } // Show if not first page ?>
                        </td>
                        <td width="23%" align="center"><?php if ($pageNum_rsEdit < $totalPages_rsEdit) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, min($totalPages_rsEdit, $pageNum_rsEdit + 1), $queryString_rsEdit); ?>">Next</a>
                              <?php } // Show if not last page ?>
                        </td>
                        <td width="23%" align="center"><?php if ($pageNum_rsEdit < $totalPages_rsEdit) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_rsEdit=%d%s", $currentPage, $totalPages_rsEdit, $queryString_rsEdit); ?>">Last</a>
                              <?php } // Show if not last page ?>
                        </td>
                      </tr>
                    </table>
                <?php } // Show if recordset not empty ?></p>
            <?php if ($totalRows_rsEdit == 0) { // Show if recordset empty ?>
            <p>No User Found. </p>
              <?php } // Show if recordset empty ?></div>
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
mysql_free_result($rsEdit);
?>
