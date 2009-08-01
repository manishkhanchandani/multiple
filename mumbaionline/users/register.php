<?php require_once('../Connections/conn.php'); ?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if(!trim($_POST['email'])) {
		$error .= "Please fill the email. ";
		unset($_POST["MM_insert"]);
	}
	if(!trim($_POST['password'])) {
		$error .= "Please fill the password. ";
		unset($_POST["MM_insert"]);
	}
	if(!trim($_POST['confirm_password'])) {
		$error .= "Please fill the confirm password. ";
		unset($_POST["MM_insert"]);
	}
	if(!trim($_POST['name'])) {
		$error .= "Please fill the name. ";
		unset($_POST["MM_insert"]);
	}
	if(trim($_POST['password'])!=trim($_POST['confirm_password'])) {
		$error .= "Password should match with confirm password. ";
		unset($_POST["MM_insert"]);
	}
}
?>
<?php
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="register_failure.php";
  $loginUsername = $_POST['email'];
  $LoginRS__query = "SELECT email FROM users WHERE email='" . $loginUsername . "'";
  mysql_select_db($database_conn, $conn);
  $LoginRS=mysql_query($LoginRS__query, $conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO users (email, password, name, created_dt) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['created_dt'], "date"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$uid = mysql_insert_id();
	$sql = "insert into profile1(user_id) values('".$uid."')";
	mysql_query($sql) or die(mysql_error());
	$sql = "insert into profile2(user_id) values('".$uid."')";
	mysql_query($sql) or die(mysql_error());

  $insertGoTo = "register_success.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Register New User</title>
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
							<li><a href="logout.php">Logout</a></li>						
						<?php } else { ?>
							<li><a href="login.php">Login</a></li>
							<li><a href="register.php">Register</a></li>
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
            <h1 class="title"><a href="#">Register New User</a></h1>
		    <p class="byline"><small>Posted on July 26th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
<?php echo $error; ?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo $_POST['email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="password" name="password" value="<?php echo $_POST['password']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Confirm Password: </td>
      <td><input name="confirm_password" type="password" id="confirm_password" value="<?php echo $_POST['confirm_password']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="name" value="<?php echo $_POST['name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="created_dt" value="<?php echo date('Y-m-d H:i:s'); ?>">
  <input type="hidden" name="MM_insert" value="form1">
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
