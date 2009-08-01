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
if($_POST['MM_Insert']=="contact") {
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
<h1>Edit Profile: Contacts</h1>
<form action="" method="post" name="myFormContact" id="myFormContact">
  <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
      <tr>
        <td align="right">IM Yahoo: </td>
        <td><input name="im_yahoo" type="text" id="im_yahoo" value="<?php echo $row_rsEdit['im_yahoo']; ?>" size="32" maxlength="200"/></td>
      </tr>
      <tr>
        <td align="right">IM Gmail:</td>
        <td><input name="im_gmail" type="text" id="im_gmail" value="<?php echo $row_rsEdit['im_gmail']; ?>" size="32" maxlength="255"/></td>
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
        <td><input type="text" maxlength="200" size="12" id="city" name="city"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">State/ Province:</td>
        <td><input type="text" maxlength="200" size="20" id="province" name="province"/></td>
      </tr>
      <tr>
        <td valign="top" align="right">Zipcode/ Pincode: </td>
        <td><input type="text" maxlength="10" size="10" id="zipcode" name="zipcode"/></td>
      </tr>
      <tr>
        <td align="right">Country:</td>
        <td><select id="country_id" name="country_id">
          <option value="1" label="United States" <?php if (!(strcmp(1, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>United States</option>
          <option value="2" label="Afghanistan" <?php if (!(strcmp(2, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Afghanistan</option>
          <option value="3" label="Albania" <?php if (!(strcmp(3, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Albania</option>
          <option value="4" label="Algeria" <?php if (!(strcmp(4, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Algeria</option>
          <option value="5" label="American Samoa" <?php if (!(strcmp(5, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>American Samoa</option>
          <option value="6" label="Andorra" <?php if (!(strcmp(6, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Andorra</option>
          <option value="7" label="Angola" <?php if (!(strcmp(7, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Angola</option>
          <option value="8" label="Anguilla" <?php if (!(strcmp(8, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Anguilla</option>
          <option value="9" label="Antigua and Barbuda" <?php if (!(strcmp(9, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Antigua and Barbuda</option>
          <option value="10" label="Argentina" <?php if (!(strcmp(10, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Argentina</option>
          <option value="11" label="Armenia" <?php if (!(strcmp(11, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Armenia</option>
          <option value="12" label="Ascension Island" <?php if (!(strcmp(12, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Ascension Island</option>
          <option value="13" label="Australia" <?php if (!(strcmp(13, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Australia</option>
<option value="14" label="Austria" <?php if (!(strcmp(14, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Austria</option>
          <option value="15" label="Azerbaijan" <?php if (!(strcmp(15, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Azerbaijan</option>
          <option value="16" label="Bahamas" <?php if (!(strcmp(16, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bahamas</option>
          <option value="17" label="Bahrain" <?php if (!(strcmp(17, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bahrain</option>
          <option value="18" label="Bangladesh" <?php if (!(strcmp(18, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bangladesh</option>
          <option value="19" label="Barbados" <?php if (!(strcmp(19, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Barbados</option>
          <option value="20" label="Belarus" <?php if (!(strcmp(20, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Belarus</option>
          <option value="21" label="Belgium" <?php if (!(strcmp(21, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Belgium</option>
          <option value="22" label="Belize" <?php if (!(strcmp(22, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Belize</option>
          <option value="23" label="Benin" <?php if (!(strcmp(23, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Benin</option>
          <option value="24" label="Bermuda" <?php if (!(strcmp(24, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bermuda</option>
          <option value="25" label="Bhutan" <?php if (!(strcmp(25, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bhutan</option>
          <option value="26" label="Bolivia" <?php if (!(strcmp(26, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bolivia</option>
          <option value="27" label="Bosnia and Herzegovina" <?php if (!(strcmp(27, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bosnia and Herzegovina</option>
          <option value="28" label="Botswana" <?php if (!(strcmp(28, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Botswana</option>
          <option value="29" label="Brazil" <?php if (!(strcmp(29, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Brazil</option>
          <option value="30" label="British Indian Ocean Territory" <?php if (!(strcmp(30, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>British Indian Ocean Territory</option>
          <option value="31" label="Brunei Darussalam" <?php if (!(strcmp(31, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Brunei Darussalam</option>
          <option value="32" label="Bulgaria" <?php if (!(strcmp(32, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Bulgaria</option>
          <option value="33" label="Burkina Faso" <?php if (!(strcmp(33, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Burkina Faso</option>
          <option value="34" label="Burundi" <?php if (!(strcmp(34, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Burundi</option>
          <option value="35" label="Cambodia" <?php if (!(strcmp(35, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cambodia</option>
          <option value="36" label="Cameroon" <?php if (!(strcmp(36, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cameroon</option>
          <option value="37" label="Canada" <?php if (!(strcmp(37, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Canada</option>
          <option value="38" label="Cape Verde" <?php if (!(strcmp(38, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cape Verde</option>
          <option value="39" label="Cayman Islands" <?php if (!(strcmp(39, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cayman Islands</option>
          <option value="40" label="Central African Republic" <?php if (!(strcmp(40, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Central African Republic</option>
          <option value="41" label="Chad" <?php if (!(strcmp(41, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Chad</option>
          <option value="42" label="Chile" <?php if (!(strcmp(42, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Chile</option>
          <option value="43" label="China" <?php if (!(strcmp(43, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>China</option>
          <option value="44" label="Colombia" <?php if (!(strcmp(44, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Colombia</option>
          <option value="45" label="Comoros" <?php if (!(strcmp(45, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Comoros</option>
          <option value="46" label="Congo" <?php if (!(strcmp(46, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Congo</option>
          <option value="47" label="Cook Islands" <?php if (!(strcmp(47, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cook Islands</option>
          <option value="48" label="Costa Rica" <?php if (!(strcmp(48, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Costa Rica</option>
          <option value="49" label="Cote D Ivoire" <?php if (!(strcmp(49, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cote D Ivoire</option>
          <option value="50" label="Croatia" <?php if (!(strcmp(50, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Croatia</option>
          <option value="51" label="Cuba" <?php if (!(strcmp(51, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cuba</option>
          <option value="52" label="Cyprus" <?php if (!(strcmp(52, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Cyprus</option>
          <option value="53" label="Czech Republic" <?php if (!(strcmp(53, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Czech Republic</option>
          <option value="54" label="Democratic Republic of Congo" <?php if (!(strcmp(54, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Democratic Republic of Congo</option>
          <option value="55" label="Denmark" <?php if (!(strcmp(55, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Denmark</option>
          <option value="56" label="Djibouti" <?php if (!(strcmp(56, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Djibouti</option>
          <option value="57" label="Dominica" <?php if (!(strcmp(57, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Dominica</option>
          <option value="58" label="Dominican Republic" <?php if (!(strcmp(58, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Dominican Republic</option>
          <option value="59" label="Ecuador" <?php if (!(strcmp(59, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Ecuador</option>
          <option value="60" label="Egypt" <?php if (!(strcmp(60, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Egypt</option>
          <option value="61" label="El Salvador" <?php if (!(strcmp(61, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>El Salvador</option>
          <option value="62" label="Equatorial Guinea" <?php if (!(strcmp(62, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Equatorial Guinea</option>
          <option value="63" label="Eritrea" <?php if (!(strcmp(63, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Eritrea</option>
          <option value="64" label="Estonia" <?php if (!(strcmp(64, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Estonia</option>
          <option value="65" label="Ethiopia" <?php if (!(strcmp(65, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Ethiopia</option>
          <option value="66" label="Falkland Islands" <?php if (!(strcmp(66, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Falkland Islands</option>
          <option value="67" label="Faroe Islands" <?php if (!(strcmp(67, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Faroe Islands</option>
          <option value="68" label="Federated States of Micronesia" <?php if (!(strcmp(68, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Federated States of Micronesia</option>
          <option value="69" label="Fiji" <?php if (!(strcmp(69, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Fiji</option>
          <option value="70" label="Finland" <?php if (!(strcmp(70, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Finland</option>
          <option value="71" label="France" <?php if (!(strcmp(71, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>France</option>
          <option value="72" label="French Guiana" <?php if (!(strcmp(72, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>French Guiana</option>
          <option value="73" label="French Polynesia" <?php if (!(strcmp(73, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>French Polynesia</option>
          <option value="74" label="Gabon" <?php if (!(strcmp(74, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Gabon</option>
          <option value="75" label="Georgia" <?php if (!(strcmp(75, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Georgia</option>
          <option value="76" label="Germany" <?php if (!(strcmp(76, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Germany</option>
          <option value="77" label="Ghana" <?php if (!(strcmp(77, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Ghana</option>
          <option value="78" label="Gibraltar" <?php if (!(strcmp(78, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Gibraltar</option>
          <option value="79" label="Greece" <?php if (!(strcmp(79, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Greece</option>
          <option value="80" label="Greenland" <?php if (!(strcmp(80, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Greenland</option>
          <option value="81" label="Grenada" <?php if (!(strcmp(81, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Grenada</option>
          <option value="82" label="Guadeloupe" <?php if (!(strcmp(82, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Guadeloupe</option>
          <option value="83" label="Guam" <?php if (!(strcmp(83, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Guam</option>
<option value="84" label="Guatemala" <?php if (!(strcmp(84, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Guatemala</option>
          <option value="85" label="Guinea" <?php if (!(strcmp(85, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Guinea</option>
          <option value="86" label="Guinea Bissau" <?php if (!(strcmp(86, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Guinea Bissau</option>
          <option value="87" label="Guyana" <?php if (!(strcmp(87, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Guyana</option>
          <option value="88" label="Haiti" <?php if (!(strcmp(88, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Haiti</option>
          <option value="89" label="Honduras" <?php if (!(strcmp(89, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Honduras</option>
          <option value="90" label="Hong Kong" <?php if (!(strcmp(90, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Hong Kong</option>
          <option value="91" label="Hungary" <?php if (!(strcmp(91, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Hungary</option>
          <option value="92" label="Iceland" <?php if (!(strcmp(92, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Iceland</option>
          <option value="93" label="India" <?php if (!(strcmp(93, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>India</option>
          <option value="94" label="Indonesia" <?php if (!(strcmp(94, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Indonesia</option>
          <option value="95" label="Iran" <?php if (!(strcmp(95, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Iran</option>
          <option value="96" label="Iraq" <?php if (!(strcmp(96, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Iraq</option>
          <option value="97" label="Ireland" <?php if (!(strcmp(97, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Ireland</option>
          <option value="98" label="Isle of Man" <?php if (!(strcmp(98, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Isle of Man</option>
          <option value="99" label="Israel" <?php if (!(strcmp(99, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Israel</option>
          <option value="100" label="Italy" <?php if (!(strcmp(100, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Italy</option>
          <option value="101" label="Jamaica" <?php if (!(strcmp(101, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Jamaica</option>
          <option value="102" label="Japan" <?php if (!(strcmp(102, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Japan</option>
          <option value="103" label="Jordan" <?php if (!(strcmp(103, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Jordan</option>
          <option value="104" label="Kazakhstan" <?php if (!(strcmp(104, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Kazakhstan</option>
          <option value="105" label="Kenya" <?php if (!(strcmp(105, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Kenya</option>
          <option value="106" label="Kiribati" <?php if (!(strcmp(106, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Kiribati</option>
          <option value="107" label="Korea (Peoples Republic of)" <?php if (!(strcmp(107, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Korea (Peoples Republic of)</option>
          <option value="108" label="Korea (Republic of)" <?php if (!(strcmp(108, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Korea (Republic of)</option>
          <option value="109" label="Kuwait" <?php if (!(strcmp(109, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Kuwait</option>
          <option value="110" label="Kyrgyzstan" <?php if (!(strcmp(110, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Kyrgyzstan</option>
          <option value="111" label="Laos" <?php if (!(strcmp(111, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Laos</option>
          <option value="112" label="Latvia" <?php if (!(strcmp(112, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Latvia</option>
          <option value="113" label="Lebanon" <?php if (!(strcmp(113, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Lebanon</option>
          <option value="114" label="Lesotho" <?php if (!(strcmp(114, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Lesotho</option>
          <option value="115" label="Liberia" <?php if (!(strcmp(115, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Liberia</option>
          <option value="116" label="Libya" <?php if (!(strcmp(116, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Libya</option>
          <option value="117" label="Liechtenstein" <?php if (!(strcmp(117, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Liechtenstein</option>
<option value="118" label="Lithuania" <?php if (!(strcmp(118, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Lithuania</option>
          <option value="119" label="Luxembourg" <?php if (!(strcmp(119, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Luxembourg</option>
<option value="120" label="Macau" <?php if (!(strcmp(120, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Macau</option>
          <option value="121" label="Macedonia" <?php if (!(strcmp(121, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Macedonia</option>
          <option value="122" label="Madagascar" <?php if (!(strcmp(122, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Madagascar</option>
          <option value="123" label="Malawi" <?php if (!(strcmp(123, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Malawi</option>
          <option value="124" label="Malaysia" <?php if (!(strcmp(124, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Malaysia</option>
          <option value="125" label="Maldives" <?php if (!(strcmp(125, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Maldives</option>
          <option value="126" label="Mali" <?php if (!(strcmp(126, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Mali</option>
          <option value="127" label="Malta" <?php if (!(strcmp(127, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Malta</option>
          <option value="128" label="Marshall Islands" <?php if (!(strcmp(128, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Marshall Islands</option>
          <option value="129" label="Martinique" <?php if (!(strcmp(129, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Martinique</option>
          <option value="130" label="Mauritius" <?php if (!(strcmp(130, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Mauritius</option>
          <option value="131" label="Mayotte" <?php if (!(strcmp(131, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Mayotte</option>
          <option value="132" label="Mexico" <?php if (!(strcmp(132, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Mexico</option>
          <option value="133" label="Moldova" <?php if (!(strcmp(133, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Moldova</option>
          <option value="134" label="Monaco" <?php if (!(strcmp(134, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Monaco</option>
          <option value="135" label="Mongolia" <?php if (!(strcmp(135, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Mongolia</option>
          <option value="136" label="Montenegro" <?php if (!(strcmp(136, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Montenegro</option>
          <option value="137" label="Montserrat" <?php if (!(strcmp(137, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Montserrat</option>
          <option value="138" label="Morocco" <?php if (!(strcmp(138, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Morocco</option>
          <option value="139" label="Mozambique" <?php if (!(strcmp(139, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Mozambique</option>
          <option value="140" label="Myanmar" <?php if (!(strcmp(140, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Myanmar</option>
          <option value="141" label="Namibia" <?php if (!(strcmp(141, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Namibia</option>
          <option value="142" label="Nauru" <?php if (!(strcmp(142, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Nauru</option>
          <option value="143" label="Nepal" <?php if (!(strcmp(143, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Nepal</option>
          <option value="144" label="Netherlands" <?php if (!(strcmp(144, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Netherlands</option>
          <option value="145" label="Netherlands Antilles" <?php if (!(strcmp(145, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Netherlands Antilles</option>
          <option value="146" label="New Caledonia" <?php if (!(strcmp(146, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>New Caledonia</option>
          <option value="147" label="New Zealand" <?php if (!(strcmp(147, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>New Zealand</option>
          <option value="148" label="Nicaragua" <?php if (!(strcmp(148, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Nicaragua</option>
          <option value="149" label="Niger" <?php if (!(strcmp(149, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Niger</option>
          <option value="150" label="Nigeria" <?php if (!(strcmp(150, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Nigeria</option>
          <option value="151" label="Niue" <?php if (!(strcmp(151, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Niue</option>
          <option value="152" label="Norfolk Island" <?php if (!(strcmp(152, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Norfolk Island</option>
          <option value="153" label="Northern Mariana Islands" <?php if (!(strcmp(153, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Northern Mariana Islands</option>
          <option value="154" label="Norway" <?php if (!(strcmp(154, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Norway</option>
          <option value="155" label="Oman" <?php if (!(strcmp(155, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Oman</option>
<option value="156" label="Pakistan" <?php if (!(strcmp(156, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Pakistan</option>
          <option value="157" label="Palau" <?php if (!(strcmp(157, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Palau</option>
          <option value="158" label="Panama" <?php if (!(strcmp(158, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Panama</option>
          <option value="159" label="Papua New Guinea" <?php if (!(strcmp(159, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Papua New Guinea</option>
          <option value="160" label="Paraguay" <?php if (!(strcmp(160, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Paraguay</option>
          <option value="161" label="Peru" <?php if (!(strcmp(161, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Peru</option>
          <option value="162" label="Philippines" <?php if (!(strcmp(162, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Philippines</option>
          <option value="163" label="Pitcairn" <?php if (!(strcmp(163, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Pitcairn</option>
          <option value="164" label="Poland" <?php if (!(strcmp(164, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Poland</option>
          <option value="165" label="Portugal" <?php if (!(strcmp(165, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Portugal</option>
          <option value="166" label="Puerto Rico" <?php if (!(strcmp(166, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Puerto Rico</option>
          <option value="167" label="Qatar" <?php if (!(strcmp(167, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Qatar</option>
<option value="168" label="Reunion" <?php if (!(strcmp(168, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Reunion</option>
          <option value="169" label="Romania" <?php if (!(strcmp(169, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Romania</option>
          <option value="170" label="Russian Federation" <?php if (!(strcmp(170, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Russian Federation</option>
          <option value="171" label="Rwanda" <?php if (!(strcmp(171, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Rwanda</option>
          <option value="172" label="Saint Vincent and the Grenadines" <?php if (!(strcmp(172, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Saint Vincent and the Grenadines</option>
          <option value="173" label="San Marino" <?php if (!(strcmp(173, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>San Marino</option>
          <option value="174" label="Sao Tome and Principe" <?php if (!(strcmp(174, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Sao Tome and Principe</option>
          <option value="175" label="Saudi Arabia" <?php if (!(strcmp(175, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Saudi Arabia</option>
          <option value="176" label="Senegal" <?php if (!(strcmp(176, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Senegal</option>
          <option value="177" label="Serbia" <?php if (!(strcmp(177, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Serbia</option>
          <option value="178" label="Seychelles" <?php if (!(strcmp(178, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Seychelles</option>
          <option value="179" label="Sierra Leone" <?php if (!(strcmp(179, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Sierra Leone</option>
          <option value="180" label="Singapore" <?php if (!(strcmp(180, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Singapore</option>
          <option value="181" label="Slovakia" <?php if (!(strcmp(181, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Slovakia</option>
          <option value="182" label="Slovenia" <?php if (!(strcmp(182, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Slovenia</option>
          <option value="183" label="Solomon Islands" <?php if (!(strcmp(183, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Solomon Islands</option>
          <option value="184" label="Somalia" <?php if (!(strcmp(184, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Somalia</option>
          <option value="185" label="South Africa" <?php if (!(strcmp(185, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>South Africa</option>
          <option value="186" label="South Georgia" <?php if (!(strcmp(186, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>South Georgia</option>
          <option value="187" label="Spain" <?php if (!(strcmp(187, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Spain</option>
<option value="188" label="Sri Lanka" <?php if (!(strcmp(188, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Sri Lanka</option>
          <option value="189" label="St. Kitts and Nevis" <?php if (!(strcmp(189, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>St. Kitts and Nevis</option>
          <option value="190" label="St. Lucia" <?php if (!(strcmp(190, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>St. Lucia</option>
          <option value="191" label="St. Pierre and Miquelon" <?php if (!(strcmp(191, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>St. Pierre and Miquelon</option>
          <option value="192" label="Sudan" <?php if (!(strcmp(192, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Sudan</option>
<option value="193" label="Suriname" <?php if (!(strcmp(193, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Suriname</option>
          <option value="194" label="Swaziland" <?php if (!(strcmp(194, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Swaziland</option>
          <option value="195" label="Sweden" <?php if (!(strcmp(195, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Sweden</option>
          <option value="196" label="Switzerland" <?php if (!(strcmp(196, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Switzerland</option>
          <option value="197" label="Syrian Arab Republic" <?php if (!(strcmp(197, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Syrian Arab Republic</option>
          <option value="198" label="Taiwan" <?php if (!(strcmp(198, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Taiwan</option>
          <option value="199" label="Tajikistan" <?php if (!(strcmp(199, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Tajikistan</option>
          <option value="200" label="Tanzania" <?php if (!(strcmp(200, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Tanzania</option>
          <option value="201" label="Thailand" <?php if (!(strcmp(201, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Thailand</option>
          <option value="202" label="The Gambia" <?php if (!(strcmp(202, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>The Gambia</option>
          <option value="203" label="Togo" <?php if (!(strcmp(203, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Togo</option>
          <option value="204" label="Tokelau" <?php if (!(strcmp(204, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Tokelau</option>
          <option value="205" label="Tonga" <?php if (!(strcmp(205, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Tonga</option>
          <option value="206" label="Trinidad and Tobago" <?php if (!(strcmp(206, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Trinidad and Tobago</option>
          <option value="207" label="Tunisia" <?php if (!(strcmp(207, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Tunisia</option>
          <option value="208" label="Turkey" <?php if (!(strcmp(208, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Turkey</option>
          <option value="209" label="Turkmenistan" <?php if (!(strcmp(209, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Turkmenistan</option>
          <option value="210" label="Turks and Caicos Islands" <?php if (!(strcmp(210, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Turks and Caicos Islands</option>
          <option value="211" label="Tuvalu" <?php if (!(strcmp(211, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Tuvalu</option>
          <option value="212" label="Uganda" <?php if (!(strcmp(212, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Uganda</option>
          <option value="213" label="Ukraine" <?php if (!(strcmp(213, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Ukraine</option>
          <option value="214" label="United Arab Emirates" <?php if (!(strcmp(214, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>United Arab Emirates</option>
          <option value="215" label="United Kingdom" <?php if (!(strcmp(215, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>United Kingdom</option>
          <option value="216" label="Uruguay" <?php if (!(strcmp(216, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Uruguay</option>
          <option value="217" label="Uzbekistan" <?php if (!(strcmp(217, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Uzbekistan</option>
          <option value="218" label="Vanuatu" <?php if (!(strcmp(218, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Vanuatu</option>
          <option value="219" label="Venezuela" <?php if (!(strcmp(219, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Venezuela</option>
          <option value="220" label="Viet Nam" <?php if (!(strcmp(220, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Viet Nam</option>
          <option value="221" label="Virgin Islands (U.K.)" <?php if (!(strcmp(221, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Virgin Islands (U.K.)</option>
          <option value="222" label="Virgin Islands (U.S.)" <?php if (!(strcmp(222, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Virgin Islands (U.S.)</option>
          <option value="223" label="Wallis and Futuna Islands" <?php if (!(strcmp(223, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Wallis and Futuna Islands</option>
          <option value="224" label="Western Samoa" <?php if (!(strcmp(224, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Western Samoa</option>
          <option value="225" label="Yemen" <?php if (!(strcmp(225, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Yemen</option>
<option value="226" label="Yugoslavia" <?php if (!(strcmp(226, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Yugoslavia</option>
          <option value="227" label="Zambia" <?php if (!(strcmp(227, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Zambia</option>
          <option value="228" label="Zimbabwe" <?php if (!(strcmp(228, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>Zimbabwe</option>
        </select></td>
      </tr>
      <tr>
        <td align="right"></td>
        <td valign="top">
            <input type="submit" class="clickButtonContact" value="Update" name="Submit"/>
            <input type="hidden" value="contact" name="MM_Insert"/></td>
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
