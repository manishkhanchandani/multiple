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
function children($status) {
	switch($status) {
		case 0:
			return 'no answer';
			break;
		case 1:
			return 'no';
			break;
		case 2:
			return 'yes - at home full time';
			break;
		case 3:
			return 'yes - at home part time';
			break;
		case 4:
			return 'yes - not at home';
			break;
	}
}
          
          <option value="25" <?php if (!(strcmp(25, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Taoist</option>
          <option value="20" <?php if (!(strcmp(20, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Tenrikyo</option>
          <option value="22" <?php if (!(strcmp(22, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Unitarian Universalist</option>
          <option value="14" <?php if (!(strcmp(14, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>Zoroastrian</option>
          <option value="13" <?php if (!(strcmp(13, $row_rsEdit['religion']))) {echo "selected=\"selected\"";} ?>>other</option>
function religion($status) {
	switch($status) {
		case 0:
			return 'no answer';
			break;
		case 1:
			return 'Agnostic';
			break;
		case 2:
			return 'Atheist';
			break;
		case 16:
			return 'Baha'i';
			break;
		case 3:
			return 'Buddhist';
			break;
		case 19:
			return 'Cao Dai';
			break;
		case 26:
			return 'Christian/Anglican';
			break;
		case 4:
			return 'Christian/Catholic';
			break;
		case 5:
			return 'Christian/LDS';
			break;
		case 27:
			return 'Christian/Orthodox';
			break;
		case 7:
			return 'Christian/Other';
			break;
		case 6:
			return 'Christian/Protestant';
			break;
		case 8:
			return 'Hindu';
			break;
		case 17:
			return 'Jain';
			break;
		case 9:
			return 'Jewish';
			break;
		case 10:
			return 'Muslim';
			break;
		case 21:
			return 'Neo-Paganist';
			break;
		case 23:
			return 'Rastafarian';
			break;
		case 12:
			return 'Religious humanism';
			break;
		case 24:
			return 'Scientologist';
			break;
		case 18:
			return 'Shinto';
			break;
		case 15:
			return 'Sikh';
			break;
		case 11:
			return 'Spiritual but not religious';
			break;
		case 25:
			return 'Taoist';
			break;
		case 20:
			return 'Tenrikyo';
			break;
		case 3:
			return 'Buddhist';
			break;
		case 3:
			return 'Buddhist';
			break;
		case 3:
			return 'Buddhist';
			break;
		case 3:
			return 'Buddhist';
			break;
		case 3:
			return 'Buddhist';
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
    <tbody><tr>
      <th valign="top" align="right">Name:</th>
      <td valign="top"><?php echo $row_rsEdit['name']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Gender:</th>
      <td valign="top"><?php echo $row_rsEdit['gender']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Relationship Status: </th>
      <td valign="top"><?php echo marital_status($row_rsEdit['marital_status']); ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Birth Date: </th>
      <td valign="top"><?php echo $row_rsEdit['bDay']; ?>-<?php echo $row_rsEdit['bMonth']; ?>-<?php echo $row_rsEdit['bYear']; ?> </td>
    </tr>
    <tr>
      <th valign="top" align="right">City:</th>
      <td><?php echo $row_rsEdit['city']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">State/ Province:</th>
      <td><?php echo $row_rsEdit['province']; ?> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Zipcode/ Pincode: </th>
      <td><?php echo $row_rsEdit['zipcode']; ?> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Country:</th>
      <td valign="top"><?php echo $row_rsEdit['country']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">High School: </th>
      <td valign="top"><?php echo $row_rsEdit['highschool']; ?> </td>
    </tr>
    <tr>
      <th valign="top" align="right">College/ University: </th>
      <td valign="top"><?php echo $row_rsEdit['college']; ?> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Company/ Organization: </th>
      <td valign="top"><?php echo $row_rsEdit['company']; ?> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Interested In: </th>
      <td valign="top">
	  					<?php if($row_rsEdit['friends']) { ?>
							friends<br/>
						<?php } ?>
	  					<?php if($row_rsEdit['activity_partners']) { ?>
							activity partners<br/>
						<?php } ?>
	  					<?php if($row_rsEdit['business_networking']) { ?>
							business networking<br/>
						<?php } ?> 
	  					<?php if($row_rsEdit['dating']) { ?>
							dating: <?php echo $row_rsEdit['dating_type']; ?>
						<?php } ?> </td>
    </tr>
  </tbody></table>
	        </div>
	    </div>
		  <div id="fragment-2" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Social</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th valign="top" align="right">Children:</th>
      <td valign="top"><?php echo children($row_rsEdit['children']); ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Religion:</th>
      <td valign="top">																								Hindu																														      </td>
    </tr>
    <tr>
      <th valign="top" align="right">Sexual Orientation: </th>
      <td valign="top">		straight						      </td>
    </tr>
    <tr>
      <th valign="top" align="right">Smoking:</th>
      <td valign="top">		no													  </td>
    </tr>
    <tr>
      <th valign="top" align="right">Drinking:</th>
      <td valign="top">no answer
			no												      </td>
    </tr>
    <tr>
      <th valign="top" align="right">Pets:</th>
      <td valign="top">																				i don't like pets	  </td>
    </tr>
    <tr>
      <th valign="top" align="right">Living:</th>
      <td valign="top">                                                with parents              </td>
    </tr>
    <tr>
      <th valign="top" align="right">Hometown:</th>
      <td valign="top">mumbai </td>
    </tr>
    <tr>
      <th valign="top" align="right">Webpage:</th>
      <td valign="top">mumbaionline.org.in </td>
    </tr>
    <tr>
      <th valign="top" align="right">About Me: </th>
      <td valign="top">I am software professional working on making php related websites. Leading a team of six people. </td>
    </tr>
    <tr>
      <th valign="top" align="right">My Family: </th>
      <td valign="top">I have my brother staying in us. I have my mom, dad, wife and son </td>
    </tr>
    <tr>
      <th valign="top" align="right">Sports: </th>
      <td valign="top">i like chess. </td>
    </tr>
    <tr>
      <th valign="top" align="right">Activities:</th>
      <td valign="top">I am not into any kind of activites. </td>
    </tr>
    <tr>
      <th valign="top" align="right">Books:</th>
      <td valign="top">I like reading spiritual and subconscious related books. </td>
    </tr>
    <tr>
      <th valign="top" align="right">Music:</th>
      <td valign="top">I like old bhajans. </td>
    </tr>
    <tr>
      <th valign="top" align="right">Tv Shows: </th>
      <td valign="top">I watch big boss, ramayan, mahabharat shows. </td>
    </tr>
    <tr>
      <th valign="top" align="right">Movies:</th>
      <td valign="top">I like china gate movie. others on list are incredibles, kungfu hunk. </td>
    </tr>
    <tr>
  </tr></tbody></table>
	        </div>
	    </div>
		  <div id="fragment-3" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Contact</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th align="right">IM Yahoo: </th>
      <td>naveenkhanchandani </td>
    </tr>
    <tr>
      <th align="right">IM MSN: </th>
      <td> </td>
    </tr>
    <tr>
      <th align="right">IM Gmail:</th>
      <td>naveenkhanchandani </td>
    </tr>
    <tr>
      <th align="right">IM Jabber: </th>
      <td> </td>
    </tr>
    <tr>
      <th align="right">IM Other: </th>
      <td> </td>
    </tr>
    <tr>
      <th align="right">Home Phone: </th>
      <td>02225666057 </td>
    </tr>
    <tr>
      <th align="right">Cell Phone: </th>
      <td>9323532886 </td>
    </tr>
    <tr>
      <th align="right">Address Line 1: </th>
      <td>D 3-5, 306, Jalaram park, </td>
    </tr>
    <tr>
      <th align="right">Address Line 2: </th>
      <td>sonapur, lbs marg, bhandup(w) </td>
    </tr>
    <tr>
      <th valign="top" align="right">City:</th>
      <td>mumbai </td>
    </tr>
    <tr>
      <th valign="top" align="right">State/ Province:</th>
      <td>maharashtra </td>
    </tr>
    <tr>
      <th valign="top" align="right">Zipcode/ Pincode: </th>
      <td>400078</td>
    </tr>
    
    <tr>
      <th align="right">Country:</th>
      <td>India </td>
    </tr>
  </tbody></table>
	        </div>
	    </div>
		  <div id="fragment-4" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Professional</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th valign="top" align="right">Education:</th>
      <td>Master's Degree</td>
    </tr>
    <tr>
      <th valign="top" align="right">High School: </th>
      <td valign="top">new era high school </td>
    </tr>
    <tr>
      <th valign="top" align="right">College/ University: </th>
      <td valign="top">mku </td>
    </tr>
    <tr>
      <th valign="top" align="right"> </th>
      <td> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Occupation:</th>
      <td>software </td>
    </tr>
    <tr>
      <th valign="top" align="right">Industry:</th>
      <td>High Tech</td>
    </tr>
    <tr>
      <th valign="top" align="right">Company/ Organization: </th>
      <td valign="top">xoriant </td>
    </tr>
    <tr>
      <th valign="top" align="right">Company Webpage: </th>
      <td valign="top">xoriant.com </td>
    </tr>
    <tr>
      <th valign="top" align="right">Title:</th>
      <td valign="top">php professional </td>
    </tr>
    <tr>
      <th valign="top" align="right">Job Description: </th>
      <td valign="top">php, mysql </td>
    </tr>
    <tr>
      <th valign="top" align="right">Work Phone: </th>
      <td valign="top"> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Work Email: </th>
      <td valign="top">manish.khanchandani@xoriant.com </td>
    </tr>
    <tr>
      <th valign="top" align="right">Career Skills: </th>
      <td valign="top">php </td>
    </tr>
    <tr>
      <th valign="top" align="right">Career Interests: </th>
      <td valign="top">Interested in technical lead in php. </td>
    </tr>
  </tbody></table>
	        </div>
	    </div>
		  <div id="fragment-5" class="tabs-container tabs-hide post">
            <h1 class="title"><a href="#">Personal</a></h1>
		    <p class="byline"><small>Posted on July 28th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th valign="top" align="right">Headline:</th>
      <td valign="top">PHP Tech Lead </td>
    </tr>
    <tr>
      <th valign="top" align="right">First thing you will notice about me:</th>
      <td valign="top">my structure </td>
    </tr>
    <tr>
      <th valign="top" align="right">Height:</th>
      <td valign="top">average      </td>
    </tr>
    <tr>
      <th valign="top" align="right">Best Feature: </th>
      <td valign="top">eyes      </td>
    </tr>
    <tr>
      <th valign="top" align="right">My idea of a perfect first date:</th>
      <td valign="top">no idea </td>
    </tr>
    <tr>
      <th valign="top" align="right">From my past relationships i learned:</th>
      <td valign="top">no idea </td>
    </tr>
    <tr>
      <th valign="top" align="right">Five things i can't live without:</th>
      <td valign="top">will let u know </td>
    </tr>
    <tr>
      <th valign="top" align="right">In my bedroom you will find:</th>
      <td valign="top">bed </td>
    </tr>
    <tr>
      <th valign="top" align="right">Ideal match:</th>
      <td valign="top">no idea </td>
    </tr>
  </tbody></table>
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
