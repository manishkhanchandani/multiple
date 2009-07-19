<?php require_once('../Connections/conn.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "role";
  $MM_redirectLoginSuccess = "loginsuccess.php";
  $MM_redirectLoginFailed = "loginfailure.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_conn, $conn);
  	
  $LoginRS__query=sprintf("SELECT email, password, role, user_id, name FROM users WHERE email='%s' AND password='%s'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'role');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	
    $_SESSION['user_id'] = mysql_result($LoginRS,0,'user_id'); 
    $_SESSION['name'] = mysql_result($LoginRS,0,'name');    

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/master.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<h1>Multiple Site </h1>
<!-- InstanceBeginEditable name="EditRegion3" -->
<h1>Login</h1>
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <td>Email:      </td>
      <td><input name="email" type="text" id="email" /></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input name="password" type="password" id="password" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit" /></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
<!-- InstanceEndEditable -->
<p>footer</p>
</body>
<!-- InstanceEnd --></html>
