<?php
session_start();
include('library/RSSParser.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Mumbai Online - A complete guide to Mumbai</title>
<!-- InstanceEndEditable -->
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/script.js"></script>
<script src="js/jquery-1.2.6.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->

<meta name="author" content="Manish Khanchandani">
<meta name="description" content="A complete information source on the city of Bombay, now known as Mumbai. Includes city maps, tourist information, magazine, shopping, entertainment, services, leisure, hotels and restaurants information.">
<meta name="keywords" content="Mumbai, Bombay, city-guide, tourism, city maps, India, tourist information, shopping, food plaza, hotels, Bollywood, entertainment, magazine, events, travel, Restaurants, Maharashtra">

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
							<li><a href="users/logout.php">Logout</a></li>						
						<?php } else { ?>
							<li><a href="users/login.php">Login</a></li>
							<li><a href="users/register.php">Register</a></li>
						<?php } ?>
					</ul>
				</li>
				<li>
					<h2>Profiles</h2>
					<ul>
						<?php if($_SESSION['user_id']) { ?>
						<li><a href="profiles/index.php">My Profile</a></li>	
						<?php } ?>
						<li><a href="profiles/browse.php">Browse Profiles</a></li>	
					</ul>
				</li>
				<?php if($_SESSION['user_id']) { ?>
				<li>
					<h2>Edit Profile</h2>
					<ul>
						<li><a href="profiles/edit_general.php">General</a></li>	
						<li><a href="profiles/edit_social.php">Social</a></li>	
						<li><a href="profiles/edit_personal.php">Personal</a></li>	
						<li><a href="profiles/edit_professional.php">Professional</a></li>	
						<li><a href="profiles/edit_contact.php">Contact</a></li>	
						<li><a href="profiles/edit_photo.php">Photo</a></li>		
					</ul>
				</li>
				<?php } ?>
				<li>
					<h2>Confession Room</h2>
					<ul>
						<li><a href="confession/index.php">Intro</a></li>
						<li><a href="confession/list.php">List All Confessions</a></li>
						<?php if($_SESSION['user_id']) { ?>
						<li><a href="confession/add.php">Add Confession</a></li>
						<li><a href="confession/myconfessions.php">My Confessions</a></li>
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
				<h1 class="title"><a href="#">Welcome to Mumbaionline.org.in!</a></h1>
					<p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
					<div class="entry">
						<p> Welcome to Mumbai. Twenty million people live in Mumbai - film-stars, workers, industrialists, artists, teachers etc. They come from diverse ethnic backgrounds and speak over a dozen tongues, adding colour, flavour and texture to the Great Mumbai.

MumbaiOnline.org.in is a gift to Mumbai's people, culture history and quirks! We hope you'll find the site useful and entertaining. Write to us and let us know what you think of the site.</p>
					</div>
			</div>
				<div class="post">
					<h2 class="title"><a href="#">Mumbai Latest</a></h2>
					<p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
					<div class="entry">
<?php
$myRss = new RSSParser("http://www.mid-day.com/rss_homepage.php?path=news/local/mumbai");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3><a href="javascript:;" onclick="tog('one_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="one_<?php echo $itemNum; ?>" style="display:none;">
<p><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p>Published On: <?php echo $myRss->channel_pubDate; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link" rel="nofollow">Read More</a></p></div>
<?php } ?>
					</div>
				</div>
				<div class="post">
					<h2 class="title"><a href="#">Mumbai</a></h2>
					<p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
					<div class="entry">
<?php
$myRss = new RSSParser("http://news.google.com/news?pz=1&ned=us&hl=en&output=rss&q=mumbai");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3><a href="javascript:;" onclick="tog('two_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="two_<?php echo $itemNum; ?>" style="display:none;">
<p><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p>Published On: <?php echo $myRss->pubDates[$itemNum]; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link" rel="nofollow">Read More</a></p></div>
<?php } ?>
					</div>
				</div>
				<div class="post">
					<h2 class="title"><a href="#">Mumbai More</a></h2>
					<p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
					<div class="entry">
<?php
$myRss = new RSSParser("http://news.google.com/news?pz=1&ned=us&hl=en&output=rss&q=mumbai+gay");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3><a href="javascript:;" onclick="tog('three_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="three_<?php echo $itemNum; ?>" style="display:none;">
<p><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p>Published On: <?php echo $myRss->pubDates[$itemNum]; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link" rel="nofollow">Read More</a></p></div>
<?php } ?>
					</div>
				</div>
				<div class="post">
					<h2 class="title"><a href="#">High Court Mumbai</a></h2>
					<p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
					<div class="entry">
<?php
$myRss = new RSSParser("http://news.google.com/news?pz=1&ned=us&hl=en&output=rss&q=High+Court+Mumbai");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3><a href="javascript:;" onclick="tog('four_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="four_<?php echo $itemNum; ?>" style="display:none;">
<p><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p>Published On: <?php echo $myRss->pubDates[$itemNum]; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link" rel="nofollow">Read More</a></p></div>
<?php } ?>
					</div>
				</div>
				<div class="post">
					<h2 class="title"><a href="#">Supreme Court</a></h2>
					<p class="byline"><small>Posted on July 20th, 2009 by <a href="#">Admin</a></small></p>
					<div class="entry">
<?php
$myRss = new RSSParser("http://news.google.com/news?pz=1&ned=us&hl=en&output=rss&q=Supreme+Court");
$myRss_RSSmax=0;
if($myRss_RSSmax==0 || $myRss_RSSmax>count($myRss->titles))$myRss_RSSmax=count($myRss->titles);
for($itemNum=0;$itemNum<$myRss_RSSmax;$itemNum++){?>
<h3><a href="javascript:;" onclick="tog('five_<?php echo $itemNum; ?>');" class="link"><?php echo $myRss->titles[$itemNum]; ?></a></h3>
<div id="five_<?php echo $itemNum; ?>" style="display:none;">
<p><?php echo $myRss->descriptions[$itemNum]; ?></p>
<p>Published On: <?php echo $myRss->pubDates[$itemNum]; ?> | <a href="<?php echo $myRss->links[$itemNum]; ?>" target="_new" class="link" rel="nofollow">Read More</a></p></div>
<?php } ?>
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
