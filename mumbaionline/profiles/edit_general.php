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
if($_POST['MM_Insert']=="general") {
	include("../Classes/db.php");
	$db = new db;
	$_POST['friends'] = ($_POST['friends'])?1:0;
	$_POST['activity_partners'] = ($_POST['activity_partners'])?1:0;
	$_POST['business_networking'] = ($_POST['business_networking'])?1:0;
	$_POST['dating'] = ($_POST['dating'])?1:0;
	$db->phpedit("users","user_id",$_POST,$_SESSION['user_id']);
	$db->phpedit("profile1","user_id",$_POST,$_SESSION['user_id']);
	$db->phpedit("profile2","user_id",$_POST,$_SESSION['user_id']);
}

$coluserid_rsEdit = "-1";
if (isset($_SESSION['user_id'])) {
  $coluserid_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsEdit = sprintf("SELECT * FROM users LEFT JOIN profile1 ON users.user_id = profile1.user_id LEFT JOIN profile2 ON users.user_id = profile2.user_id WHERE users.user_id = %s", $coluserid_rsEdit);
$rsEdit = mysql_query($query_rsEdit, $conn) or die(mysql_error());
$row_rsEdit = mysql_fetch_assoc($rsEdit);
$totalRows_rsEdit = mysql_num_rows($rsEdit);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Edit Profile: General</title>
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
            <h1 class="title"><a href="#">Edit Profile: General</a></h1>
		    <p class="byline"><small>Posted on July 26th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
<form id="myForm" action="" method="post" name="myForm">
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
      <tr>
        <td valign="top" align="right"></td>
        <td valign="top">
            <input type="submit" class="clickButton" value="Update" name="Submit"/>
            <input type="hidden" value="general" name="MM_Insert"/></td>
      </tr>
    </tbody>
  </table>
</form>
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
