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
if($_POST['MM_Insert']=="social") {
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
<h1>Edit Profile: Social</h1>
<form action="" method="post" name="frmSocial" id="frmSocial">
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
      <tr>
        <td valign="top" align="right"></td>
        <td valign="top">
            <input type="submit" class="clickButtonSocial" value="Update" name="Submit"/>
            <input type="hidden" value="social" name="MM_Insert"/></td>
      </tr>
    </tbody>
  </table>
</form>
<p>&nbsp; </p>
</body>

</html>
<?php
mysql_free_result($rsEdit);
?>
