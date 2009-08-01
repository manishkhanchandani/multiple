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
if($_POST['MM_Insert']=="general") {
	include("../Classes/db.php");
	$db = new db;
	$db->phpedit("users","user_id",$_POST,$_SESSION['user_id']);
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
<h1>Edit Profile: General</h1>
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
        <td valign="top" align="right">Country:</td>
        <td valign="top"><select id="country_id" name="country_id">
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
          <option selected="selected" value="93" label="India" <?php if (!(strcmp(93, $row_rsEdit['country_id']))) {echo "selected=\"selected\"";} ?>>India</option>
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
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
