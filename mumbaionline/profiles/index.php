<?php require_once('../Connections/conn.php'); ?>
<?php
session_start();
if($_GET['user_id']) {
	$uid = $_GET['user_id'];
} else if($_SESSION['user_id']) {
	$uid = $_SESSION['user_id'];
} else {
	$MM_restrictGoTo = "../users/login.php";
	$MM_qsChar = "?";
	$MM_referrer = $_SERVER['PHP_SELF'];
	if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
	if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
	$MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
	$MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
	header("Location: ". $MM_restrictGoTo); 
	exit;
}
function marital_status($status) {
	switch($status) {
		case 1:
			return 'Single';
			break;
		case 2:
			return 'Seperated';
			break;
		case 3:
			return 'Divorced';
			break;
		case 4:
			return 'Widowed';
			break;
		case 5:
			return 'Married';
			break;
	}
}
?>
<?php
$coluserid_rsEdit = "-1";
if (isset($uid)) {
  $coluserid_rsEdit = (get_magic_quotes_gpc()) ? $uid : addslashes($uid);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM users LEFT JOIN profile1 ON users.user_id = profile1.user_id LEFT JOIN profile2 ON users.user_id = profile2.user_id WHERE users.user_id = %s", $coluserid_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Profile of <?php echo $row_rsEdit['name']; ?></title>
<!-- InstanceEndEditable -->
<link href="../default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../js/script.js"></script>
<script src="../js/jquery-1.2.6.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<script src="../js/jquery.tabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="../js/jquery.tabs/jquery.tabs.pack.js" type="text/javascript"></script>
<link rel="stylesheet" href="../js/jquery.tabs/jquery.tabs.css" type="text/css" media="print, projection, screen">
<script type="text/javascript">
	$(function() {
		$('#container-1').tabs();
	});
	</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<!-- InstanceEndEditable -->
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
<div id="container-1">
		<div class="entry">              
				<ul class="tabs-nav">
					<li class="tabs-selected"><a href="#fragment-6"><span>Main</span></a></li>
					<li class=""><a href="#fragment-7"><span>Friends</span></a></li>
					<li class=""><a href="#fragment-1"><span>General</span></a></li>
					<li class=""><a href="#fragment-2"><span>Social</span></a></li>
					<li class=""><a href="#fragment-3"><span>Contact</span></a></li>
					<li class=""><a href="#fragment-4"><span>Professional</span></a></li>
					<li class=""><a href="#fragment-5"><span>Personal</span></a></li>
				</ul>
				<div style="clear:both;"></div>
	        </div>
		  <div id="fragment-6" class="tabs-container post">
            <h1 class="title"><a href="#">Main</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
				<table width="100%" cellspacing="1" cellpadding="5" border="0">
						<tbody><tr>
						  <th width="100" align="left" valign="top" bgcolor="#999999" class="tdhead style1">Description</th>
						  <th align="left" valign="top" bgcolor="#999999" class="tdhead style1">Summary</th>
					  </tr>
					  <tr>
					  <td valign="top">
						<table cellspacing="1" cellpadding="5" border="0">
						  <tbody><tr>
							<td>
								<?php if($row_rsEdit['image']) { ?>
						  <div class="img"><img src="../uploadDir/profiles/thumbs/<?php echo $row_rsEdit['image']; ?>"/></div><?php } ?>
							<div class="status">
								<?php echo $row_rsEdit['gender']; ?>, <?php echo marital_status($row_rsEdit['marital_status']); ?>									  </div>
							<div class="status">
								<?php echo $row_rsEdit['city']; ?>, <?php echo $row_rsEdit['country']; ?>			</div>		    </td>
						  </tr>
						</tbody></table>		</td>
						<td valign="top">
							<table cellspacing="1" cellpadding="5" border="0">
								  <tbody><tr>
									<th valign="top" align="right"><span class="strng">aboutme:</span></th>
									<td valign="top"><?php echo $row_rsEdit['aboutme']; ?></td>
								  </tr>
								  <tr>
									<th valign="top" align="right"><span class="strng">location:</span></th>
									<td valign="top"><span class="tdsimpleText"><?php echo $row_rsEdit['city']; ?>, <?php echo $row_rsEdit['province']; ?><br/>
									<?php echo $row_rsEdit['country']; ?>                    </span></td>
								  </tr>
								  <tr>
									<th valign="top" align="right"><span class="simpleText"><span class="strng">relationship status: </span> <span class="tdsimpleText"> </span></span></th>
									<td valign="top"><?php echo marital_status($row_rsEdit['marital_status']); ?></td>
								  </tr>
								</tbody></table>    </td>
					</tr></tbody></table>		
	        </div>
	    </div>
		  <div id="fragment-7" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Friends</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              Friends
	        </div>
	    </div>
		  <div id="fragment-1" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">General</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
      <tr>
        <td valign="top" align="right">Name:</td>
        <td valign="top"><input name="name" type="text" id="name" value="<?php echo $row_rsEdit['name']; ?>" size="35"/>
            <br/>
            <label style="display: none;" id="name_error" for="name" class="error">This field is required.</label>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Gender:</td>
        <td valign="top"><input <?php if (!(strcmp($row_rsEdit['gender'],"Male"))) {echo "checked=\"checked\"";} ?> name="gender" type="radio" value="Male"/>
          Male <br/>
          <input <?php if (!(strcmp($row_rsEdit['gender'],"Female"))) {echo "checked=\"checked\"";} ?> type="radio" value="Female" name="gender"/>
          Female </td>
      </tr>
      <tr>
        <td valign="top" align="right">Relationship Status: </td>
        <td valign="top"><select id="marital_status" name="marital_status">
          <option value="1" <?php if (!(strcmp(1, $row_rsEdit['marital_status']))) {echo "selected=\"selected\"";} ?>>Single</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['marital_status']))) {echo "selected=\"selected\"";} ?>>Seperated</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['marital_status']))) {echo "selected=\"selected\"";} ?>>Divorced</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['marital_status']))) {echo "selected=\"selected\"";} ?>>Widowed</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['marital_status']))) {echo "selected=\"selected\"";} ?>>Married</option>
        </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Birth Date: </td>
        <td valign="top"><select name="bMonth">
          <option value="01" label="January" <?php if (!(strcmp(01, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>January</option>
          <option value="02" label="February" <?php if (!(strcmp(02, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>February</option>
          <option value="03" label="March" <?php if (!(strcmp(03, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>March</option>
          <option value="04" label="April" <?php if (!(strcmp(04, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>April</option>
          <option value="05" label="May" <?php if (!(strcmp(05, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>May</option>
<option value="06" label="June" <?php if (!(strcmp(06, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>June</option>
          <option value="07" label="July" <?php if (!(strcmp(07, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>July</option>
          <option value="08" label="August" <?php if (!(strcmp(08, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>August</option>
          <option value="09" label="September" <?php if (!(strcmp(09, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>September</option>
          <option value="10" label="October" <?php if (!(strcmp(10, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>October</option>
          <option value="11" label="November" <?php if (!(strcmp(11, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>November</option>
          <option value="12" label="December" <?php if (!(strcmp(12, $row_rsEdit['bMonth']))) {echo "selected=\"selected\"";} ?>>December</option>
        </select>
            <select name="bDay">
              <option value="1" label="01" <?php if (!(strcmp(1, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>01</option>
              <option value="2" label="02" <?php if (!(strcmp(2, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>02</option>
              <option value="3" label="03" <?php if (!(strcmp(3, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>03</option>
              <option value="4" label="04" <?php if (!(strcmp(4, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>04</option>
              <option value="5" label="05" <?php if (!(strcmp(5, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>05</option>
              <option value="6" label="06" <?php if (!(strcmp(6, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>06</option>
              <option value="7" label="07" <?php if (!(strcmp(7, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>07</option>
              <option value="8" label="08" <?php if (!(strcmp(8, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>08</option>
              <option value="9" label="09" <?php if (!(strcmp(9, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>09</option>
<option value="10" label="10" <?php if (!(strcmp(10, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>10</option>
              <option value="11" label="11" <?php if (!(strcmp(11, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>11</option>
              <option value="12" label="12" <?php if (!(strcmp(12, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>12</option>
<option value="13" label="13" <?php if (!(strcmp(13, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>13</option>
              <option value="14" label="14" <?php if (!(strcmp(14, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>14</option>
              <option value="15" label="15" <?php if (!(strcmp(15, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>15</option>
              <option value="16" label="16" <?php if (!(strcmp(16, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>16</option>
              <option value="17" label="17" <?php if (!(strcmp(17, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>17</option>
              <option value="18" label="18" <?php if (!(strcmp(18, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>18</option>
              <option value="19" label="19" <?php if (!(strcmp(19, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>19</option>
              <option value="20" label="20" <?php if (!(strcmp(20, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>20</option>
              <option value="21" label="21" <?php if (!(strcmp(21, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>21</option>
              <option value="22" label="22" <?php if (!(strcmp(22, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>22</option>
              <option value="23" label="23" <?php if (!(strcmp(23, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>23</option>
              <option value="24" label="24" <?php if (!(strcmp(24, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>24</option>
              <option value="25" label="25" <?php if (!(strcmp(25, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>25</option>
              <option value="26" label="26" <?php if (!(strcmp(26, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>26</option>
              <option value="27" label="27" <?php if (!(strcmp(27, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>27</option>
              <option value="28" label="28" <?php if (!(strcmp(28, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>28</option>
<option value="29" label="29" <?php if (!(strcmp(29, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>29</option>
              <option value="30" label="30" <?php if (!(strcmp(30, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>30</option>
<option value="31" label="31" <?php if (!(strcmp(31, $row_rsEdit['bDay']))) {echo "selected=\"selected\"";} ?>>31</option>
            </select>
            <select name="bYear">
              <option value="1909" label="1909" <?php if (!(strcmp(1909, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1909</option>
<option value="1910" label="1910" <?php if (!(strcmp(1910, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1910</option>
              <option value="1911" label="1911" <?php if (!(strcmp(1911, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1911</option>
              <option value="1912" label="1912" <?php if (!(strcmp(1912, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1912</option>
              <option value="1913" label="1913" <?php if (!(strcmp(1913, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1913</option>
              <option value="1914" label="1914" <?php if (!(strcmp(1914, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1914</option>
              <option value="1915" label="1915" <?php if (!(strcmp(1915, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1915</option>
              <option value="1916" label="1916" <?php if (!(strcmp(1916, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1916</option>
              <option value="1917" label="1917" <?php if (!(strcmp(1917, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1917</option>
              <option value="1918" label="1918" <?php if (!(strcmp(1918, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1918</option>
              <option value="1919" label="1919" <?php if (!(strcmp(1919, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1919</option>
<option value="1920" label="1920" <?php if (!(strcmp(1920, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1920</option>
              <option value="1921" label="1921" <?php if (!(strcmp(1921, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1921</option>
              <option value="1922" label="1922" <?php if (!(strcmp(1922, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1922</option>
              <option value="1923" label="1923" <?php if (!(strcmp(1923, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1923</option>
              <option value="1924" label="1924" <?php if (!(strcmp(1924, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1924</option>
              <option value="1925" label="1925" <?php if (!(strcmp(1925, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1925</option>
              <option value="1926" label="1926" <?php if (!(strcmp(1926, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1926</option>
              <option value="1927" label="1927" <?php if (!(strcmp(1927, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1927</option>
              <option value="1928" label="1928" <?php if (!(strcmp(1928, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1928</option>
              <option value="1929" label="1929" <?php if (!(strcmp(1929, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1929</option>
              <option value="1930" label="1930" <?php if (!(strcmp(1930, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1930</option>
              <option value="1931" label="1931" <?php if (!(strcmp(1931, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1931</option>
              <option value="1932" label="1932" <?php if (!(strcmp(1932, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1932</option>
              <option value="1933" label="1933" <?php if (!(strcmp(1933, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1933</option>
              <option value="1934" label="1934" <?php if (!(strcmp(1934, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1934</option>
              <option value="1935" label="1935" <?php if (!(strcmp(1935, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1935</option>
              <option value="1936" label="1936" <?php if (!(strcmp(1936, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1936</option>
              <option value="1937" label="1937" <?php if (!(strcmp(1937, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1937</option>
              <option value="1938" label="1938" <?php if (!(strcmp(1938, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1938</option>
              <option value="1939" label="1939" <?php if (!(strcmp(1939, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1939</option>
              <option value="1940" label="1940" <?php if (!(strcmp(1940, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1940</option>
              <option value="1941" label="1941" <?php if (!(strcmp(1941, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1941</option>
              <option value="1942" label="1942" <?php if (!(strcmp(1942, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1942</option>
              <option value="1943" label="1943" <?php if (!(strcmp(1943, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1943</option>
              <option value="1944" label="1944" <?php if (!(strcmp(1944, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1944</option>
              <option value="1945" label="1945" <?php if (!(strcmp(1945, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1945</option>
              <option value="1946" label="1946" <?php if (!(strcmp(1946, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1946</option>
              <option value="1947" label="1947" <?php if (!(strcmp(1947, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1947</option>
              <option value="1948" label="1948" <?php if (!(strcmp(1948, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1948</option>
              <option value="1949" label="1949" <?php if (!(strcmp(1949, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1949</option>
              <option value="1950" label="1950" <?php if (!(strcmp(1950, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1950</option>
              <option value="1951" label="1951" <?php if (!(strcmp(1951, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1951</option>
              <option value="1952" label="1952" <?php if (!(strcmp(1952, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1952</option>
              <option value="1953" label="1953" <?php if (!(strcmp(1953, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1953</option>
              <option value="1954" label="1954" <?php if (!(strcmp(1954, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1954</option>
              <option value="1955" label="1955" <?php if (!(strcmp(1955, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1955</option>
              <option value="1956" label="1956" <?php if (!(strcmp(1956, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1956</option>
              <option value="1957" label="1957" <?php if (!(strcmp(1957, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1957</option>
              <option value="1958" label="1958" <?php if (!(strcmp(1958, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1958</option>
              <option value="1959" label="1959" <?php if (!(strcmp(1959, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1959</option>
              <option value="1960" label="1960" <?php if (!(strcmp(1960, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1960</option>
              <option value="1961" label="1961" <?php if (!(strcmp(1961, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1961</option>
              <option value="1962" label="1962" <?php if (!(strcmp(1962, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1962</option>
              <option value="1963" label="1963" <?php if (!(strcmp(1963, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1963</option>
              <option value="1964" label="1964" <?php if (!(strcmp(1964, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1964</option>
              <option value="1965" label="1965" <?php if (!(strcmp(1965, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1965</option>
              <option value="1966" label="1966" <?php if (!(strcmp(1966, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1966</option>
              <option value="1967" label="1967" <?php if (!(strcmp(1967, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1967</option>
              <option value="1968" label="1968" <?php if (!(strcmp(1968, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1968</option>
              <option value="1969" label="1969" <?php if (!(strcmp(1969, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1969</option>
              <option value="1970" label="1970" <?php if (!(strcmp(1970, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1970</option>
              <option value="1971" label="1971" <?php if (!(strcmp(1971, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1971</option>
              <option value="1972" label="1972" <?php if (!(strcmp(1972, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1972</option>
              <option value="1973" label="1973" <?php if (!(strcmp(1973, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1973</option>
              <option value="1974" label="1974" <?php if (!(strcmp(1974, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1974</option>
              <option value="1975" label="1975" <?php if (!(strcmp(1975, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1975</option>
              <option value="1976" label="1976" <?php if (!(strcmp(1976, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1976</option>
              <option value="1977" label="1977" <?php if (!(strcmp(1977, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1977</option>
              <option value="1978" label="1978" <?php if (!(strcmp(1978, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1978</option>
              <option value="1979" label="1979" <?php if (!(strcmp(1979, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1979</option>
              <option value="1980" label="1980" <?php if (!(strcmp(1980, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1980</option>
              <option value="1981" label="1981" <?php if (!(strcmp(1981, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1981</option>
              <option value="1982" label="1982" <?php if (!(strcmp(1982, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1982</option>
              <option value="1983" label="1983" <?php if (!(strcmp(1983, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1983</option>
              <option value="1984" label="1984" <?php if (!(strcmp(1984, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1984</option>
              <option value="1985" label="1985" <?php if (!(strcmp(1985, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1985</option>
              <option value="1986" label="1986" <?php if (!(strcmp(1986, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1986</option>
              <option value="1987" label="1987" <?php if (!(strcmp(1987, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1987</option>
              <option value="1988" label="1988" <?php if (!(strcmp(1988, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1988</option>
<option value="1989" label="1989" <?php if (!(strcmp(1989, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1989</option>
              <option value="1990" label="1990" <?php if (!(strcmp(1990, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1990</option>
              <option value="1991" label="1991" <?php if (!(strcmp(1991, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1991</option>
              <option value="1992" label="1992" <?php if (!(strcmp(1992, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1992</option>
              <option value="1993" label="1993" <?php if (!(strcmp(1993, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1993</option>
              <option value="1994" label="1994" <?php if (!(strcmp(1994, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1994</option>
              <option value="1995" label="1995" <?php if (!(strcmp(1995, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1995</option>
              <option value="1996" label="1996" <?php if (!(strcmp(1996, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1996</option>
              <option value="1997" label="1997" <?php if (!(strcmp(1997, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1997</option>
              <option value="1998" label="1998" <?php if (!(strcmp(1998, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1998</option>
<option value="1999" label="1999" <?php if (!(strcmp(1999, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>1999</option>
              <option value="2000" label="2000" <?php if (!(strcmp(2000, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2000</option>
              <option value="2001" label="2001" <?php if (!(strcmp(2001, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2001</option>
              <option value="2002" label="2002" <?php if (!(strcmp(2002, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2002</option>
              <option value="2003" label="2003" <?php if (!(strcmp(2003, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2003</option>
              <option value="2004" label="2004" <?php if (!(strcmp(2004, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2004</option>
<option value="2005" label="2005" <?php if (!(strcmp(2005, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2005</option>
              <option value="2006" label="2006" <?php if (!(strcmp(2006, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2006</option>
              <option value="2007" label="2007" <?php if (!(strcmp(2007, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2007</option>
              <option value="2008" label="2008" <?php if (!(strcmp(2008, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2008</option>
              <option value="2009" label="2009" <?php if (!(strcmp(2009, $row_rsEdit['bYear']))) {echo "selected=\"selected\"";} ?>>2009</option>
            </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">City:</td>
        <td><input name="city" type="text" id="city" value="<?php echo $row_rsEdit['city']; ?>" size="12" maxlength="200" /></td>
      </tr>
      <tr>
        <td valign="top" align="right">State/ Province:</td>
        <td><input name="province" type="text" id="province" value="Maharashtra" size="20" maxlength="200" readonly="readonly" /></td>
      </tr>
      <tr>
        <td valign="top" align="right">Zipcode/ Pincode: </td>
        <td><input name="zipcode" type="text" id="zipcode" value="<?php echo $row_rsEdit['zipcode']; ?>" size="10" maxlength="10"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Country:</td>
        <td valign="top"><input name="country" type="text" id="country" value="India" size="10" readonly="readonly" /></td>
      </tr>
      <tr>
        <td valign="top" align="right">High School: </td>
        <td valign="top"><input name="highschool" type="text" id="highschool" value="<?php echo $row_rsEdit['highschool']; ?>" maxlength="255"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">College/ University: </td>
        <td valign="top"><input name="college" type="text" id="college" value="<?php echo $row_rsEdit['college']; ?>" maxlength="255"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Company/ Organization: </td>
        <td valign="top"><input name="company" type="text" id="company" value="<?php echo $row_rsEdit['company']; ?>"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Interested In: </td>
        <td valign="top"><input <?php if (!(strcmp($row_rsEdit['friends'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" value="1" id="friends" name="friends"/>
          friends<br/>
          <input <?php if (!(strcmp($row_rsEdit['activity_partners'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" value="1" id="activity_partners" name="activity_partners"/>
          activity partners<br/>
          <input <?php if (!(strcmp($row_rsEdit['business_networking'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" value="1" id="business_networking" name="business_networking"/>
          business networking<br/>
          <input <?php if (!(strcmp($row_rsEdit['dating'],1))) {echo "checked=\"checked\"";} ?> type="checkbox" value="1" id="dating" name="dating"/>
          dating
          <select id="dating_type" name="dating_type">
            <option value="1" <?php if (!(strcmp(1, $row_rsEdit['dating_type']))) {echo "selected=\"selected\"";} ?>>men and woman</option>
            <option value="2" <?php if (!(strcmp(2, $row_rsEdit['dating_type']))) {echo "selected=\"selected\"";} ?>>men</option>
            <option value="3" <?php if (!(strcmp(3, $row_rsEdit['dating_type']))) {echo "selected=\"selected\"";} ?>>woman</option>
          </select>
          <br/>
          <br/></td>
      </tr>
    </tbody>
  </table>
	        </div>
	    </div>
		  <div id="fragment-2" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Social</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
      <tr>
        <td valign="top" align="right">Children:</td>
        <td valign="top"><select id="children" name="children">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['children']))) {echo "selected=\"selected\"";} ?>>no answer</option>
          <option value="1" <?php if (!(strcmp(1, $row_rsEdit['children']))) {echo "selected=\"selected\"";} ?>>no</option>
<option value="2" <?php if (!(strcmp(2, $row_rsEdit['children']))) {echo "selected=\"selected\"";} ?>>yes - at home full time</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['children']))) {echo "selected=\"selected\"";} ?>>yes - at home part time</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['children']))) {echo "selected=\"selected\"";} ?>>yes - not at home</option>
        </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Religion:</td>
        <td valign="top"><select id="religion" name="religion">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Agnostic</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Atheist</option>
          <option value="16" <?php if (!(strcmp(16, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Baha'i</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Buddhist</option>
          <option value="19" <?php if (!(strcmp(19, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Cao Dai</option>
          <option value="26" <?php if (!(strcmp(26, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Christian/Anglican</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Christian/Catholic</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Christian/LDS</option>
          <option value="27" <?php if (!(strcmp(27, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Christian/Orthodox</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Christian/Other</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Christian/Protestant</option>
          <option value="8" <?php if (!(strcmp(8, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Hindu</option>
          <option value="17" <?php if (!(strcmp(17, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Jain</option>
          <option value="9" <?php if (!(strcmp(9, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Jewish</option>
          <option value="10" <?php if (!(strcmp(10, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Muslim</option>
          <option value="21" <?php if (!(strcmp(21, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Neo-Paganist</option>
          <option value="23" <?php if (!(strcmp(23, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Rastafarian</option>
          <option value="12" <?php if (!(strcmp(12, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Religious humanism</option>
          <option value="24" <?php if (!(strcmp(24, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Scientologist</option>
          <option value="18" <?php if (!(strcmp(18, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Shinto</option>
          <option value="15" <?php if (!(strcmp(15, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Sikh</option>
          <option value="11" <?php if (!(strcmp(11, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Spiritual but not religious</option>
          <option value="25" <?php if (!(strcmp(25, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Taoist</option>
          <option value="20" <?php if (!(strcmp(20, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Tenrikyo</option>
          <option value="22" <?php if (!(strcmp(22, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Unitarian Universalist</option>
          <option value="14" <?php if (!(strcmp(14, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Zoroastrian</option>
          <option value="13" <?php if (!(strcmp(13, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>other</option>
        </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Sexual Orientation: </td>
        <td valign="top"><select id="sexual_orientation" name="sexual_orientation">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['sexual_orientation']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['sexual_orientation']))) {echo "selected=\"selected\"";} ?>>straight</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['sexual_orientation']))) {echo "selected=\"selected\"";} ?>>gay</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['sexual_orientation']))) {echo "selected=\"selected\"";} ?>>bisexual</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['sexual_orientation']))) {echo "selected=\"selected\"";} ?>>bi-curious</option>
        </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Smoking:</td>
        <td valign="top"><select id="smoking" name="smoking">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>no answer</option>
          <option value="1" <?php if (!(strcmp(1, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>no</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>socially</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>occasionally</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>regularly</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>heavily</option>
<option value="6" <?php if (!(strcmp(6, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>trying to quit</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['smoking']))) {echo "selected=\"selected\"";} ?>>quit</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Drinking:</td>
        <td valign="top"><select id="drinking" name="drinking">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['drinking']))) {echo "selected=\"selected\"";} ?>>no answer</option>
          <option value="1" <?php if (!(strcmp(1, $row_rsEdit['drinking']))) {echo "selected=\"selected\"";} ?>>no</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['drinking']))) {echo "selected=\"selected\"";} ?>>socially</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['drinking']))) {echo "selected=\"selected\"";} ?>>occasionally</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['drinking']))) {echo "selected=\"selected\"";} ?>>regularly</option>
<option value="5" <?php if (!(strcmp(5, $row_rsEdit['drinking']))) {echo "selected=\"selected\"";} ?>>heavily</option>
        </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Pets:</td>
        <td valign="top"><select id="pets" name="pets">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['pets']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['pets']))) {echo "selected=\"selected\"";} ?>>i love my pet(s)</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['pets']))) {echo "selected=\"selected\"";} ?>>i like them at the zoos</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['pets']))) {echo "selected=\"selected\"";} ?>>i like pet(s)</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['pets']))) {echo "selected=\"selected\"";} ?>>i don't like pets</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Living:</td>
        <td valign="top"><select id="living" name="living">
          <option value="1" <?php if (!(strcmp(1, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>alone</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>with partner</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>with kid(s)</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>friends visit often</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>with roommate(s)</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>with pet(s)</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>with parents</option>
          <option value="8" <?php if (!(strcmp(8, $row_rsEdit['living']))) {echo "selected=\"selected\"";} ?>>party every night</option>
        </select>
        </td>
      </tr>
      <tr>
        <td valign="top" align="right">Hometown:</td>
        <td valign="top"><input name="hometown" type="text" id="hometown" value="<?php echo $row_rsEdit['hometown']; ?>" maxlength="100"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Webpage:</td>
        <td valign="top"><input name="webpage" type="text" id="webpage" value="<?php echo $row_rsEdit['webpage']; ?>" maxlength="255"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">About Me: </td>
        <td valign="top"><textarea id="aboutme" rows="3" cols="35" name="aboutme"><?php echo $row_rsEdit['aboutme']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">My Family: </td>
        <td valign="top"><textarea id="myfamily" rows="3" cols="35" name="myfamily"><?php echo $row_rsEdit['myfamily']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Sports: </td>
        <td valign="top"><textarea id="sports" rows="3" cols="35" name="sports"><?php echo $row_rsEdit['sports']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Activities:</td>
        <td valign="top"><textarea id="activities" rows="3" cols="35" name="activities"><?php echo $row_rsEdit['activities']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Books:</td>
        <td valign="top"><textarea id="books" rows="3" cols="35" name="books"><?php echo $row_rsEdit['books']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Music:</td>
        <td valign="top"><textarea id="music" rows="3" cols="35" name="music"><?php echo $row_rsEdit['music']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Tv Shows: </td>
        <td valign="top"><textarea id="tvshows" rows="3" cols="35" name="tvshows"><?php echo $row_rsEdit['tvshows']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Movies:</td>
        <td valign="top"><textarea id="movies" rows="3" cols="35" name="movies"><?php echo $row_rsEdit['movies']; ?></textarea></td>
      </tr>
    </tbody>
  </table>
	        </div>
	    </div>
		  <div id="fragment-3" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Contact</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
      <tr>
        <td align="right">IM Yahoo: </td>
        <td><input name="im_yahoo" type="text" id="im_yahoo" value="<?php echo $row_rsEdit['im_yahoo']; ?>" size="32" maxlength="200"/></td>
      </tr>
      <tr>
        <td align="right">IM MSN: </td>
        <td><input type="text" value="<?php echo $row_rsEdit['im_msn']; ?>" maxlength="200" size="32" id="im_msn" name="im_msn"/></td>
      </tr>
      <tr>
        <td align="right">IM Gmail:</td>
        <td><input name="im_gmail" type="text" id="im_gmail" value="<?php echo $row_rsEdit['im_gmail']; ?>" size="32" maxlength="255"/></td>
      </tr>
      <tr>
        <td align="right">IM Jabber: </td>
        <td><input type="text" value="<?php echo $row_rsEdit['im_jabber']; ?>" maxlength="255" size="32" id="im_jabber" name="im_jabber"/></td>
      </tr>
      <tr>
        <td align="right">IM Other: </td>
        <td><input type="text" value="<?php echo $row_rsEdit['im_other']; ?>" maxlength="255" size="32" id="im_other" name="im_other"/></td>
      </tr>
      <tr>
        <td align="right">Home Phone: </td>
        <td><input name="homephone" type="text" id="homephone" value="<?php echo $row_rsEdit['homephone']; ?>" size="15" maxlength="50"/></td>
      </tr>
      <tr>
        <td align="right">Cell Phone: </td>
        <td><input name="cellphone" type="text" id="cellphone" value="<?php echo $row_rsEdit['cellphone']; ?>" size="15" maxlength="50"/></td>
      </tr>
      <tr>
        <td align="right">Address Line 1: </td>
        <td><input name="address1" type="text" id="address1" value="<?php echo $row_rsEdit['address1']; ?>" size="45" maxlength="255"/></td>
      </tr>
      <tr>
        <td align="right">Address Line 2: </td>
        <td><input name="address2" type="text" id="address2" value="<?php echo $row_rsEdit['address2']; ?>" size="45" maxlength="255"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">City:</td>
        <td><input name="city" type="text" id="city" value="<?php echo $row_rsEdit['city']; ?>" size="12" maxlength="200" /></td>
      </tr>
      <tr>
        <td valign="top" align="right">State/ Province:</td>
        <td><input name="province" type="text" id="province" value="Maharashtra" size="20" maxlength="200" readonly="readonly" /></td>
      </tr>
      <tr>
        <td valign="top" align="right">Zipcode/ Pincode: </td>
        <td><input name="zipcode" type="text" id="zipcode" value="<?php echo $row_rsEdit['zipcode']; ?>" size="10" maxlength="10"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Country:</td>
        <td valign="top"><input name="country" type="text" id="country" value="India" size="10" readonly="readonly" /></td>
      </tr>
      
    </tbody>
  </table>
	        </div>
	    </div>
		  <div id="fragment-4" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Professional</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
      <tr>
        <td align="right">Education:</td>
        <td><select id="educationLevel" name="educationLevel">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Elementary</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>High School</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Some College</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Associates Degree</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Bachelor's Degree</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Master's Degree</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Ph.D.</option>
          <option value="8" <?php if (!(strcmp(8, $row_rsEdit['educationLevel']))) {echo "selected=\"selected\"";} ?>>Postdoctoral</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">High School: </td>
        <td valign="top"><input type="text" maxlength="255" value="<?php echo $row_rsEdit['highschool']; ?>" id="highschool" name="highschool"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">College/ University: </td>
        <td valign="top"><input type="text" maxlength="255" value="<?php echo $row_rsEdit['college']; ?>" id="college" name="college"/></td>
      </tr>
      <tr>
        <td align="right"></td>
        <td></td>
      </tr>
      <tr>
        <td align="right">Occupation:</td>
        <td><input type="text" value="<?php echo $row_rsEdit['occupation']; ?>" maxlength="200" id="occupation" name="occupation"/></td>
      </tr>
      <tr>
        <td align="right">Industry:</td>
        <td><select id="industry" name="industry">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Agriculture</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Arts</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Construction</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Consumer Goods</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Corporate Services</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Education</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Finance</option>
          <option value="8" <?php if (!(strcmp(8, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Government</option>
          <option value="9" <?php if (!(strcmp(9, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>High Tech</option>
          <option value="10" <?php if (!(strcmp(10, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Legal</option>
          <option value="11" <?php if (!(strcmp(11, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Manufacturing</option>
          <option value="12" <?php if (!(strcmp(12, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Media</option>
          <option value="13" <?php if (!(strcmp(13, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Medical and Health Care</option>
          <option value="14" <?php if (!(strcmp(14, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Non-Profit</option>
          <option value="15" <?php if (!(strcmp(15, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Recreation, Travel, and Entertainment</option>
          <option value="16" <?php if (!(strcmp(16, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Scientific</option>
          <option value="17" <?php if (!(strcmp(17, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Service Industry</option>
          <option value="18" <?php if (!(strcmp(18, $row_rsEdit['industry']))) {echo "selected=\"selected\"";} ?>>Transportation</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Company/ Organization: </td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['company']; ?>" id="company" name="company"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Company Webpage: </td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['company_webpage']; ?>" maxlength="255" id="company_webpage" name="company_webpage"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Title:</td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['company_title']; ?>" maxlength="200" id="company_title" name="company_title"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Job Description: </td>
        <td valign="top"><textarea id="job_description" rows="3" cols="45" name="job_description"><?php echo $row_rsEdit['job_description']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Work Phone: </td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['workphone']; ?>" maxlength="50" id="workphone" name="workphone"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Work Email: </td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['work_email']; ?>" maxlength="150" id="work_email" name="work_email"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Career Skills: </td>
        <td valign="top"><textarea id="career_skills" rows="3" cols="45" name="career_skills"><?php echo $row_rsEdit['career_skills']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Career Interests: </td>
        <td valign="top"><textarea id="career_interests" rows="3" cols="45" name="career_interests"><?php echo $row_rsEdit['career_interests']; ?></textarea></td>
      </tr>
    </tbody>
  </table>
	        </div>
	    </div>
		  <div id="fragment-5" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Personal</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
      <tr>
        <td valign="top" align="right">Headline:</td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['headline']; ?>" maxlength="200" id="headline" name="headline"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">First thing you will notice about me:</td>
        <td valign="top"><input type="text" value="<?php echo $row_rsEdit['firstthing']; ?>" maxlength="255" id="firstthing" name="firstthing"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Height:</td>
        <td valign="top"><select id="height" name="height">
          <option value="53" <?php if (!(strcmp(53, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 5in - 134cm</option>
          <option value="54" <?php if (!(strcmp(54, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 6in - 137cm</option>
          <option value="55" <?php if (!(strcmp(55, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 7in - 139cm</option>
          <option value="56" <?php if (!(strcmp(56, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 8in - 142cm</option>
          <option value="57" <?php if (!(strcmp(57, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 9in - 144cm</option>
          <option value="58" <?php if (!(strcmp(58, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 10in - 147cm</option>
          <option value="59" <?php if (!(strcmp(59, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>4ft 11in - 149cm</option>
          <option value="60" <?php if (!(strcmp(60, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 0in - 152cm</option>
          <option value="61" <?php if (!(strcmp(61, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 1in - 154cm</option>
          <option value="62" <?php if (!(strcmp(62, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 2in - 157cm</option>
          <option value="63" <?php if (!(strcmp(63, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 3in - 160cm</option>
          <option value="64" <?php if (!(strcmp(64, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 4in - 162cm</option>
          <option value="65" <?php if (!(strcmp(65, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 5in - 165cm</option>
          <option value="66" <?php if (!(strcmp(66, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 6in - 167cm</option>
          <option value="67" <?php if (!(strcmp(67, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 7in - 170cm</option>
          <option value="68" <?php if (!(strcmp(68, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 8in - 172cm</option>
          <option value="69" <?php if (!(strcmp(69, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 9in - 175cm</option>
          <option value="70" <?php if (!(strcmp(70, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 10in - 177cm</option>
          <option value="71" <?php if (!(strcmp(71, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>5ft 11in - 180cm</option>
          <option value="72" <?php if (!(strcmp(72, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 0in - 182cm</option>
          <option value="73" <?php if (!(strcmp(73, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 1in - 185cm</option>
          <option value="74" <?php if (!(strcmp(74, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 2in - 187cm</option>
          <option value="75" <?php if (!(strcmp(75, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 3in - 190cm</option>
          <option value="76" <?php if (!(strcmp(76, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 4in - 193cm</option>
          <option value="77" <?php if (!(strcmp(77, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 5in - 195cm</option>
          <option value="78" <?php if (!(strcmp(78, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 6in - 198cm</option>
          <option value="79" <?php if (!(strcmp(79, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 7in - 200cm</option>
          <option value="80" <?php if (!(strcmp(80, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 8in - 203cm</option>
          <option value="81" <?php if (!(strcmp(81, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 9in - 205cm</option>
          <option value="82" <?php if (!(strcmp(82, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 10in - 208cm</option>
          <option value="83" <?php if (!(strcmp(83, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>6ft 11in - 210cm</option>
          <option value="84" <?php if (!(strcmp(84, $row_rsEdit['height']))) {echo "selected=\"selected\"";} ?>>7ft 0in - 213cm</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Eye Color: </td>
        <td valign="top"><select id="eyecolor" name="eyecolor">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>no answer</option>
          <option value="1" <?php if (!(strcmp(1, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>black</option>
<option value="2" <?php if (!(strcmp(2, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>blue</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>brown</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>gray</option>
<option value="5" <?php if (!(strcmp(5, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>green</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['eyecolor']))) {echo "selected=\"selected\"";} ?>>hazel</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Hair Color: </td>
        <td valign="top"><select id="haircolor" name="haircolor">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>auburn</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>black</option>
<option value="3" <?php if (!(strcmp(3, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>blonde</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>light brown</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>dark brown</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>red</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>gray</option>
<option value="8" <?php if (!(strcmp(8, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>salt &amp; pepper</option>
          <option value="9" <?php if (!(strcmp(9, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>bald</option>
          <option value="10" <?php if (!(strcmp(10, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>changes often</option>
          <option value="11" <?php if (!(strcmp(11, $row_rsEdit['haircolor']))) {echo "selected=\"selected\"";} ?>>other</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Build:</td>
        <td valign="top"><select id="build" name="build">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['build']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['build']))) {echo "selected=\"selected\"";} ?>>slim</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['build']))) {echo "selected=\"selected\"";} ?>>athletic</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['build']))) {echo "selected=\"selected\"";} ?>>about average</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['build']))) {echo "selected=\"selected\"";} ?>>a few extra pounds</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['build']))) {echo "selected=\"selected\"";} ?>>large</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Looks:</td>
        <td valign="top"><select id="looks" name="looks">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['looks']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['looks']))) {echo "selected=\"selected\"";} ?>>beauty contest winner</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['looks']))) {echo "selected=\"selected\"";} ?>>very attractive</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['looks']))) {echo "selected=\"selected\"";} ?>>attractive</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['looks']))) {echo "selected=\"selected\"";} ?>>average</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['looks']))) {echo "selected=\"selected\"";} ?>>mirror-cracking material</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">Best Feature: </td>
        <td valign="top"><select id="bestfeature" name="bestfeature">
          <option value="0" <?php if (!(strcmp(0, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>no answer</option>
<option value="1" <?php if (!(strcmp(1, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>eyes</option>
          <option value="2" <?php if (!(strcmp(2, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>hair</option>
          <option value="3" <?php if (!(strcmp(3, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>lips</option>
          <option value="4" <?php if (!(strcmp(4, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>neck</option>
          <option value="5" <?php if (!(strcmp(5, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>arms</option>
          <option value="6" <?php if (!(strcmp(6, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>hands</option>
          <option value="7" <?php if (!(strcmp(7, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>chest</option>
          <option value="8" <?php if (!(strcmp(8, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>belly button</option>
          <option value="9" <?php if (!(strcmp(9, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>butt</option>
          <option value="10" <?php if (!(strcmp(10, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>legs</option>
          <option value="11" <?php if (!(strcmp(11, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>calves</option>
          <option value="12" <?php if (!(strcmp(12, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>feet</option>
          <option value="13" <?php if (!(strcmp(13, $row_rsEdit['bestfeature']))) {echo "selected=\"selected\"";} ?>>not on the list</option>
        </select></td>
      </tr>
      <tr>
        <td valign="top" align="right">My idea of a perfect first date:</td>
        <td valign="top"><textarea id="firstdate" rows="3" cols="25" name="firstdate"><?php echo $row_rsEdit['firstdate']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">From my past relationships i learned:</td>
        <td valign="top"><textarea id="pastrelation" rows="3" cols="25" name="pastrelation"><?php echo $row_rsEdit['pastrelation']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Five things i can't live without:</td>
        <td valign="top"><textarea id="fivethings" rows="3" cols="25" name="fivethings"><?php echo $row_rsEdit['fivethings']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">In my bedroom you will find:</td>
        <td valign="top"><textarea id="bedroomthings" rows="3" cols="25" name="bedroomthings"><?php echo $row_rsEdit['bedroomthings']; ?></textarea></td>
      </tr>
      <tr>
        <td valign="top" align="right">Ideal match:</td>
        <td valign="top"><textarea id="idealmatch" rows="3" cols="25" name="idealmatch"><?php echo $row_rsEdit['idealmatch']; ?></textarea></td>
      </tr>
    </tbody>
  </table>
	        </div>
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
mysql_free_result($rsEdit);
?>
