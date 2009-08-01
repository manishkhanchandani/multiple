<?php require_once('../Connections/conn.php'); ?>
<?php session_start(); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsView = 10;
$pageNum_rsView = 0;
if (isset($_GET['pageNum_rsView'])) {
  $pageNum_rsView = $_GET['pageNum_rsView'];
}
$startRow_rsView = $pageNum_rsView * $maxRows_rsView;

$colname_rsView = "-1";
if (isset($_GET['titleDescr_id'])) {
  $colname_rsView = (get_magic_quotes_gpc()) ? $_GET['titleDescr_id'] : addslashes($_GET['titleDescr_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsView = sprintf("SELECT * FROM confession_descr LEFT JOIN confession_category ON confession_descr.category_id = confession_category.category_id WHERE confession_descr.titleDescr_id = %s ORDER BY confession_descr.post_date DESC", $colname_rsView);
$query_limit_rsView = sprintf("%s LIMIT %d, %d", $query_rsView, $startRow_rsView, $maxRows_rsView);
$rsView = mysql_query($query_limit_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);

if (isset($_GET['totalRows_rsView'])) {
  $totalRows_rsView = $_GET['totalRows_rsView'];
} else {
  $all_rsView = mysql_query($query_rsView);
  $totalRows_rsView = mysql_num_rows($all_rsView);
}
$totalPages_rsView = ceil($totalRows_rsView/$maxRows_rsView)-1;

$maxRows_rsSuggestion = 25;
$pageNum_rsSuggestion = 0;
if (isset($_GET['pageNum_rsSuggestion'])) {
  $pageNum_rsSuggestion = $_GET['pageNum_rsSuggestion'];
}
$startRow_rsSuggestion = $pageNum_rsSuggestion * $maxRows_rsSuggestion;

$colname_rsSuggestion = "-1";
if (isset($_GET['titleDescr_id'])) {
  $colname_rsSuggestion = (get_magic_quotes_gpc()) ? $_GET['titleDescr_id'] : addslashes($_GET['titleDescr_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsSuggestion = sprintf("SELECT * FROM confession_titleSuggestion LEFT JOIN users ON confession_titleSuggestion.user_id = users.user_id WHERE confession_titleSuggestion.titleDescr_id = %s ORDER BY confession_titleSuggestion.accept DESC, confession_titleSuggestion.titleSuggestion_id DESC", $colname_rsSuggestion);
$query_limit_rsSuggestion = sprintf("%s LIMIT %d, %d", $query_rsSuggestion, $startRow_rsSuggestion, $maxRows_rsSuggestion);
$rsSuggestion = mysql_query($query_limit_rsSuggestion, $conn) or die(mysql_error());
$row_rsSuggestion = mysql_fetch_assoc($rsSuggestion);

if (isset($_GET['totalRows_rsSuggestion'])) {
  $totalRows_rsSuggestion = $_GET['totalRows_rsSuggestion'];
} else {
  $all_rsSuggestion = mysql_query($query_rsSuggestion);
  $totalRows_rsSuggestion = mysql_num_rows($all_rsSuggestion);
}
$totalPages_rsSuggestion = ceil($totalRows_rsSuggestion/$maxRows_rsSuggestion)-1;

$queryString_rsSuggestion = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsSuggestion") == false && 
        stristr($param, "totalRows_rsSuggestion") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsSuggestion = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsSuggestion = sprintf("&totalRows_rsSuggestion=%d%s", $totalRows_rsSuggestion, $queryString_rsSuggestion);

$queryString_rsView = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsView") == false && 
        stristr($param, "totalRows_rsView") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsView = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsView = sprintf("&totalRows_rsView=%d%s", $totalRows_rsView, $queryString_rsView);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Confessions</title>
<!-- InstanceEndEditable -->
<link href="../default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../js/script.js"></script>
<script src="../js/jquery-1.2.6.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
<!--
.style1 {
	color: #A66100;
	font-style: italic;
}
-->
</style><!-- InstanceEndEditable -->
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
						<li><a href="index.php">Intro</a></li>
						<li><a href="list.php">List All Confessions</a></li>
						<?php if($_SESSION['user_id']) { ?>
						<li><a href="add.php">Add Confession</a></li>
						<li><a href="myconfessions.php">My Confessions</a></li>
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
            <h1 class="title"><a href="#">Confessions</a></h1>
		    <p class="byline"><small>Posted on July 30th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
		      <?php if ($totalRows_rsView > 0) { // Show if recordset not empty ?>
              <table width="100%" border="0" cellpadding="5" cellspacing="0">
                  <tr>
                    <td><h3><?php echo $row_rsView['title']; ?> [<a href="list.php?category_id=<?php echo $row_rsView['category_id']; ?>"><?php echo $row_rsView['category']; ?></a>]</h3>
                        <?php echo nl2br($row_rsView['description']); ?><br />
                      <strong>Posted On:</strong> <?php echo $row_rsView['post_date']; ?>
					</td>
                  </tr>
              </table>              
              <?php } // Show if recordset not empty ?>
		    </div>
	    </div>
		  <div class="post">
            <h1 class="title"><a href="#">Suggestions</a></h1>
		    <p class="byline"><small>Posted on July 30th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
			<p><a href="add_suggestion.php?titleDescr_id=<?php echo $row_rsView['titleDescr_id']; ?>">Add New Suggestion </a></p>
			<?php if ($totalRows_rsSuggestion > 0) { // Show if recordset not empty ?>
				<table border="0">
    <?php do { ?>
      <tr>
        <td><p><strong>Suggestion:</strong> <?php echo nl2br($row_rsSuggestion['suggestion']); ?></p>          
		<p><strong>Posted By</strong> <?php echo $row_rsSuggestion['name']; ?> On <?php echo $row_rsSuggestion['post_date']; ?></p>
		<?php if($row_rsSuggestion['accept']==1) { ?>
		<span class="style1">Owner has accepted this suggestion.</span><br />
		<?php } ?>
		<?php if($_SESSION['user_id']==$row_rsView['user_id']) { ?>
			<?php if($row_rsSuggestion['accept']==0) { ?><a href="accept.php?titleDescr_id=<?php echo $row_rsView['titleDescr_id']; ?>&titleSuggestion_id=<?php echo $row_rsSuggestion['titleSuggestion_id']; ?>">Accept</a>
			<?php } else { ?><a href="deny.php?titleDescr_id=<?php echo $row_rsView['titleDescr_id']; ?>&titleSuggestion_id=<?php echo $row_rsSuggestion['titleSuggestion_id']; ?>">Deny</a>
			<?php } ?>
		<?php } ?>		</td>
      </tr>
      <?php } while ($row_rsSuggestion = mysql_fetch_assoc($rsSuggestion)); ?>
      </table>
		 	   <p>
Records <?php echo ($startRow_rsSuggestion + 1) ?> to <?php echo min($startRow_rsSuggestion + $maxRows_rsSuggestion, $totalRows_rsSuggestion) ?> of <?php echo $totalRows_rsSuggestion ?></p>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_rsSuggestion > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsSuggestion=%d%s", $currentPage, 0, $queryString_rsSuggestion); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_rsSuggestion > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsSuggestion=%d%s", $currentPage, max(0, $pageNum_rsSuggestion - 1), $queryString_rsSuggestion); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsSuggestion < $totalPages_rsSuggestion) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsSuggestion=%d%s", $currentPage, min($totalPages_rsSuggestion, $pageNum_rsSuggestion + 1), $queryString_rsSuggestion); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_rsSuggestion < $totalPages_rsSuggestion) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsSuggestion=%d%s", $currentPage, $totalPages_rsSuggestion, $queryString_rsSuggestion); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<?php } // Show if recordset not empty ?>
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
mysql_free_result($rsView);

mysql_free_result($rsSuggestion);
?>
