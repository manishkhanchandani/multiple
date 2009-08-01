<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mumbaionline.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Confession Room</title>
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
						<li><a href="index.php">Intro</a></li>
						<li><a href="list.php">List All Confessions</a></li>
						<?php if($_SESSION['user_id']) { ?>
						<li><a href="add.php">Add Confession</a></li>
						<li><a href="myconfessions.php">My Confessions</a></li>
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
            <h1 class="title"><a href="#">Welcome to Confession Room</a></h1>
		    <p class="byline"><small>Posted on July 30th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <p>This confessions room is dedicated to allowing people from around the world to confess their sins anonymously. <br />
                <br />
So if you feel that you need to get anything of your chest, no matter how stupid it may seem then please do not hesitate to tell the world of your confession that you want to share on this confessions room. </p>
              <p>People from around the world will suggest you remedies against your sins and then it is upto you whether you want to accept that suggestion or not.<br />
                <br />
                If you may just want to read and comment on other peoples confessions, whatever you do we hope you enjoy our online confessions site. All posts are 100% anonymous. Get it off your chest and post it here.	</p>
              <p>Have a secret burning you up? Did something you're not proud of? Want to confess, but can't share your secret with friends &amp; family? You're definitely not alone. Add your confession <a href="add.php">here</a>! </p>
		    </div>
	    </div>
		<div class="post">
            <h1 class="title"><a href="#">A Guide for Confession</a></h1>
		    <p class="byline"><small>Posted on July 30th, 2009 by <a href="#">Admin</a></small></p>
		    <div class="entry">
              <p>The basic requirement for a good confession is to have the intention of returning to God like the "prodigal son" and to acknowledge our sins with true sorrow before the priest.</p>
              <p><strong>Sin in my Life</strong></p>
		      <p>Modern society has lost a sense of sin. As a Catholic follower of Christ, I must make an effort to recognize sin in my daily actions, words and omissions.</p>
		      <p>The Gospels show how important is the forgiveness of our sins. Lives of saints prove that the person who grows in holiness has a stronger sense of sin, sorrow for sins, and a need for the Sacrament of Penance or Confession.</p>
		      <p><strong>The Differences in Sins</strong></p>
		      <p>As a result of Original Sin, human nature is weakened. Baptism, by imparting the life of Christ's grace, takes away Original Sin, and turns us back toward God. The consequences of this weakness and the inclination to evil persist, and we often commit personal or actual sin.</p>
		      <p>Actual sin is sin which people commit. There are two kinds of actual sin, mortal and venial.</p>
		      <p>Mortal sin is a deadly offense against God, so horrible that it destroys the life of grace in the soul. Three simultaneous conditions must be fulfilled for a mortal sin: 1) the act must be something very serious; 2) the person must have sufficient understanding of what is being done; 3) the person must have sufficient freedom of the will.</p>
		      <p><strong>Remember</strong></p>
		      <p>If you need help&ndash;especially if you have been away for some time&ndash;simply ask the priest and he will help you by &quot;walking&quot; you through the steps to make a good confession.</p>
		      <p><strong>Before Confession</strong></p>
		      <p>Be truly sorry for your sins. The essential act of Penance, on the part of the penitent, is contrition, a clear and decisive rejection of the sin committed, together with a resolution not to commit it again, out of the love one has for God and which is reborn with repentance. The resolution to avoid committing these sins in the future (amendment) is a sure sign that your sorrow is genuine and authentic. This does not mean that a promise never to fall again into sin is necessary. A resolution to try to avoid the near occasions of sin suffices for true repentance. God's grace in cooperation with the intention to rectify your life will give you the strength to resist and overcome temptation in the future.</p>
		      <p><strong>Examination of Conscience</strong></p>
		      <p>Before going to Confession you should make a review of mortal and venial sins since your last sacramental confession, and should express sorrow for sins, hatred for sins and a firm resolution not to sin again.</p>
		      <p>A helpful pattern for examination of conscience is to review the Commandments of God and the Precepts of the Church:</p>
		      <ol>
                <li> Have God and the pursuit of sanctity in Christ been the goal of my life? Have I denied my faith? Have I placed my trust in false teachings or substitutes for God? Did I despair of God's mercy?<br />
                </li>
		        <li> Have I avoided the profane use of God's name in my speech? Have I broken a solemn vow or promise?<br />
                </li>
		        <li> Have I honored every Sunday by avoiding unnecessary work, celebrating the Mass (also holydays)? Was I inattentive at, or unnecessarily late for Mass, or did I leave early? Have I neglected prayer for a long time?<br />
                </li>
		        <li> Have I shown Christlike respect to parents, spouse, and family members, legitimate authorities? Have I been attentive to the religious education and formation of my children?<br />
                </li>
		        <li> Have I cared for the bodily health and safety of myself and all others? Did I abuse drugs or alcohol? Have I supported in any way abortion, &quot;mercy killing,&quot; or suicide?<br />
                </li>
		        <li> Was I impatient, angry, envious, proud, jealous, revengeful, lazy? Have I forgiven others?<br />
                </li>
		        <li> Have I been just in my responsibilities to employer and employees? Have I discriminated against others because of race or other reasons?<br />
                </li>
		        <li> Have I been chaste in thought and word? Have I used sex only within marriage and while open to procreating life? Have I given myself sexual gratification? Did I deliberately look at impure TV, pictures, reading?<br />
                </li>
		        <li> Have I stolen anything from another, from my employer, from government? If so, am I ready to repay it? Did I fulfill my contracts? Did I rashly gamble, depriving my family of necessities?<br />
                </li>
		        <li> Have I spoken ill of any other person? Have I always told the truth? Have I kept secrets and confidences?<br />
                </li>
		        <li> Have I permitted sexual thoughts about someone to whom I am not married?<br />
                </li>
		        <li> Have I desired what belongs to other people? Have I wished ill on another?<br />
                </li>
		        <li> Have I been faithful to sacramental living (Holy Communion and Penance)?<br />
                </li>
		        <li> Have I helped make my parish community stronger and holier? Have I contributed to the support of the Church?<br />
                </li>
		        <li> Have I done penance by abstaining and fasting on obligatory days? Have I fasted before receiving communion?<br />
                </li>
		        <li> Have I been mindful of the poor? Do I accept God's will for me?</li>
	          </ol>
		      <p><strong>During Confession</strong></p>
		      <p>After examining your conscience and telling God of your sorrow, go into the confessional. You may kneel at the screen or sit to talk face-to-face with the priest.</p>
		      <p>Begin your confession with the sign of the cross, &quot;In the name of the Father, and of the Son, and of the Holy Spirit. My last confession was _________ weeks (months, years) ago.&quot;</p>
		      <p>The priest may read a passage from holy Scripture.</p>
		      <p>Say the sins that you remember. Start with the one(s) that is most difficult to say. (In order to make a good confession the faithful must confess all mortal sins, according to kind and number.) After confessing all the sins you remember since your last good confession, you may conclude by saying, &quot;I am sorry for these and all the sins of my past life.&quot;</p>
		      <p>Listen to the words of the priest. He will assign you some penance. Doing the penance will diminish the temporal punishment due to sins already forgiven. When invited, express some prayer of sorrow or Act of Contrition such as:</p>
		      <blockquote>
                <p><strong><em>An Act of Contrition</em></strong></p>
		        <p><em>O my God, I am heartily sorry for having offended you and I detest all my sins, because I dread the loss of heaven and the pains of hell. But most of all because I have offended you, my God, who are all good and deserving of all my love. I firmly resolve with the help of your grace, to confess my sins, to do penance and to amend my life. Amen.</em></p>
	          </blockquote>
		      <p><strong>At the End of Confession</strong></p>
		      <p>Listen to the words of absolution, the sacramental forgiveness of the Church through the ordained priest.</p>
		      <p>As you listen to the words of forgiveness you may make the sign of the cross with the priest. If he closes by saying, &quot;Give thanks to the Lord for He is good,&quot; answer, &quot;For His mercy endures forever.&quot;</p>
		      <p><strong>After Confession</strong></p>
		      <p>Give thanks to God for forgiving you again. If you recall some serious sin you forgot to tell, rest assured that it has been forgiven with the others, but be sure to confess it in your next Confession.</p>
		      <p>Do your assigned Penance.</p>
		      <p>Resolve to return to the Sacrament of Reconciliation often. We Catholics are fortunate to have the Sacrament of Reconciliation. It is the ordinary way for us to have our sins forgiven. This sacrament is a powerful help to get rid of our weaknesses, grow in holiness, and lead a balanced and virtuous life.</p>
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
