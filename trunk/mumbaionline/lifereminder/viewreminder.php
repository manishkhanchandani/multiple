<?php require_once('../Connections/conn.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsview = 10;
$pageNum_rsview = 0;
if (isset($_GET['pageNum_rsview'])) {
  $pageNum_rsview = $_GET['pageNum_rsview'];
}
$startRow_rsview = $pageNum_rsview * $maxRows_rsview;

$colname_rsview = "-1";
if (isset($_SESSION['user_id'])) {
  $colname_rsview = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsview = sprintf("SELECT * FROM lifereminder_reminder WHERE user_id = %s", $colname_rsview);
$query_limit_rsview = sprintf("%s LIMIT %d, %d", $query_rsview, $startRow_rsview, $maxRows_rsview);
$rsview = mysql_query($query_limit_rsview, $conn) or die(mysql_error());
$row_rsview = mysql_fetch_assoc($rsview);

if (isset($_GET['totalRows_rsview'])) {
  $totalRows_rsview = $_GET['totalRows_rsview'];
} else {
  $all_rsview = mysql_query($query_rsview);
  $totalRows_rsview = mysql_num_rows($all_rsview);
}
$totalPages_rsview = ceil($totalRows_rsview/$maxRows_rsview)-1;

$queryString_rsview = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsview") == false && 
        stristr($param, "totalRows_rsview") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsview = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsview = sprintf("&totalRows_rsview=%d%s", $totalRows_rsview, $queryString_rsview);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>View My Reminder</title>
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
            <h1 class="title"><a href="#">View My Reminders</a></h1>
		    <p class="byline"><small>Posted on August 1st, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <?php if ($totalRows_rsview > 0) { // Show if recordset not empty ?>
              <table border="1">
                <tr>
                  <td width="104"><strong>Account</strong></td>
                  <td width="122"><strong>Description</strong></td>
                  <td width="122"><strong>Detail</strong></td>
                  <td width="122"><strong>Edit</strong></td>
                  <td width="122"><strong>Delete</strong></td>
                </tr>
                <?php do { ?>
                  <tr>
                    <td><?php echo $row_rsview['account']; ?></td>
                    <td><?php echo $row_rsview['description']; ?></td>
                    <td><a href="detailreminder.php?reminder_id=<?php echo $row_rsview['reminder_id']; ?>">Detail</a></td>
                    <td><a href="editreminder.php?reminder_id=<?php echo $row_rsview['reminder_id']; ?>">Edit</a></td>
                    <td><a href="deletereminder.php?reminder_id=<?php echo $row_rsview['reminder_id']; ?>">Delete</a></td>
                  </tr>
                  <?php } while ($row_rsview = mysql_fetch_assoc($rsview)); ?>
                                  </table>
              <p> Records <?php echo ($startRow_rsview + 1) ?> to <?php echo min($startRow_rsview + $maxRows_rsview, $totalRows_rsview) ?> of <?php echo $totalRows_rsview ?></p>
                    <table border="0" width="50%" align="center">
                      <tr>
                        <td width="23%" align="center"><?php if ($pageNum_rsview > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_rsview=%d%s", $currentPage, 0, $queryString_rsview); ?>">First</a>
                              <?php } // Show if not first page ?>
                        </td>
                        <td width="31%" align="center"><?php if ($pageNum_rsview > 0) { // Show if not first page ?>
                              <a href="<?php printf("%s?pageNum_rsview=%d%s", $currentPage, max(0, $pageNum_rsview - 1), $queryString_rsview); ?>">Previous</a>
                              <?php } // Show if not first page ?>
                        </td>
                        <td width="23%" align="center"><?php if ($pageNum_rsview < $totalPages_rsview) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_rsview=%d%s", $currentPage, min($totalPages_rsview, $pageNum_rsview + 1), $queryString_rsview); ?>">Next</a>
                              <?php } // Show if not last page ?>
                        </td>
                        <td width="23%" align="center"><?php if ($pageNum_rsview < $totalPages_rsview) { // Show if not last page ?>
                              <a href="<?php printf("%s?pageNum_rsview=%d%s", $currentPage, $totalPages_rsview, $queryString_rsview); ?>">Last</a>
                              <?php } // Show if not last page ?>
                        </td>
                      </tr>
                    </table>
                <?php } // Show if recordset not empty ?>
              <?php if ($totalRows_rsview == 0) { // Show if recordset empty ?>
                <strong> No Reminder Found. </strong>
                <?php } // Show if recordset empty ?>
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
mysql_free_result($rsview);
?>
