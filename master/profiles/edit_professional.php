<?php require_once('../../Connections/conn.php'); ?>
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1>Edit Profile: Professional</h1>
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
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
