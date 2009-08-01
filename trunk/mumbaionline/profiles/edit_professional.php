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
if($_POST['MM_Insert']=="professional") {
	include("../Classes/db.php");
	$db = new db;
	$db->phpedit("profile1","user_id",$_POST,$_SESSION['user_id']);
	$db->phpedit("profile2","user_id",$_POST,$_SESSION['user_id']);
}
?>
<?php
$coluserid_rsEdit = "1";
if (isset($_SESSION['user_id'])) {
  $coluserid_rsEdit = (get_magic_quotes_gpc()) ? $_SESSION['user_id'] : addslashes($_SESSION['user_id']);
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
<title>Edit Profile: Professional</title>
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
            <h1 class="title"><a href="#">Edit Profile: Professional</a></h1>
		    <p class="byline"><small>Posted on July 26th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
<form action="" method="post" name="formProfessional" id="formProfessional">
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
      <tr>
        <td valign="top" align="right"></td>
        <td valign="top">
            <input type="submit" class="clickButtonProfessional" value="Update" name="Submit"/>
            <input type="hidden" value="professional" name="MM_Insert"/></td>
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
