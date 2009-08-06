<?php require_once('Connections/conn.php'); ?>
<?php
session_start();
if($_GET['user_id']) {
	$uid = $_GET['user_id'];
} else {
	$uid = $_SESSION['user_id'];
	if(!$uid) {
		header("Location: ../users/login.php");
		exit;
	}
}
?>
<?php
$coluserid_rsEdit = "1";
if (isset($uid)) {
  $coluserid_rsEdit = (get_magic_quotes_gpc()) ? $uid : addslashes($uid);
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
<div id="container-1">
	<ul class="tabs-nav">
		<li class="tabs-selected"><a href="#fragment-6"><span>Main</span></a></li>
		<li class=""><a href="#fragment-7"><span>Friends</span></a></li>
		<li class=""><a href="#fragment-1"><span>General</span></a></li>
		<li class=""><a href="#fragment-2"><span>Social</span></a></li>
		<li class=""><a href="#fragment-3"><span>Contact</span></a></li>
		<li class=""><a href="#fragment-4"><span>Professional</span></a></li>
		<li class=""><a href="#fragment-5"><span>Personal</span></a></li>
	</ul>
	<div id="fragment-6" class="tabs-container" style="">
		<div class="mainPage">
	<table width="100%" cellspacing="1" cellpadding="5" border="1">
		<tbody><tr>
		  <td width="100" valign="top" class="tdhead">Description</td>
		  <td valign="top" class="tdhead">Summary</td>
	  </tr>
	  <tr>
	  <td valign="top">
	    <table cellspacing="1" cellpadding="5" border="0">
          <tbody><tr>
            <td>
			  	
		  <div class="img"><img src="../../uploadDir/profiles/original/<?php echo $row_rsEdit['image']; ?>"/></div>
			<div class="status">
<?php echo $row_rsEdit['gender']; ?>						Married		  </div>
			<div class="status">
				mumbai, India			</div>		    </td>
          </tr>
        </tbody></table>		</td>
		<td valign="top">
			<table cellspacing="1" cellpadding="5" border="0">
                  <tbody><tr>
                    <th valign="top" align="right"><span class="strng">aboutme:</span></th>
                    <td valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <th valign="top" align="right"><span class="strng">location:</span></th>
                    <td valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <th valign="top" align="right"><span class="simpleText"><span class="strng">relationship status: </span> <span class="tdsimpleText"> </span></span></th>
                    <td valign="top">&nbsp;</td>
                  </tr>
                </tbody></table>    </td>
    </tr></tbody></table>
</div>	</div>
	<div id="fragment-7" class="tabs-container tabs-hide" style="">
		friends	</div>
	<div id="fragment-1" class="tabs-container tabs-hide" style="">
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
      <td valign="top"><?php if($row_rsEdit['status']==1) echo 'Single'; else if($row_rsEdit['status']==2) echo 'Seperated'; else if($row_rsEdit['status']==3) echo 'Divorced'; else if($row_rsEdit['status']==4) echo 'Widowed'; else if($row_rsEdit['status']==5) echo 'Married';  ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Birth Date: </th>
      <td valign="top"><?php echo $row_rsEdit['bYear']; ?>-<?php echo $row_rsEdit['bMonth']; ?>-<?php echo $row_rsEdit['bDay']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">City:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">State/ Province:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Zipcode/ Pincode: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Country:</th>
      <td valign="top">
        
          <?php if($row_rsEdit['country_id']=="1") { ?>United States<?php } ?>
          <?php if($row_rsEdit['country_id']=="2") { ?>Afghanistan<?php } ?>
          <?php if($row_rsEdit['country_id']=="3") { ?>Albania<?php } ?>
          <?php if($row_rsEdit['country_id']=="4") { ?>Algeria<?php } ?>
          <?php if($row_rsEdit['country_id']=="5") { ?>American Samoa<?php } ?>
          <?php if($row_rsEdit['country_id']=="6") { ?>Andorra<?php } ?>
          <?php if($row_rsEdit['country_id']=="7") { ?>Angola<?php } ?>
          <?php if($row_rsEdit['country_id']=="8") { ?>Anguilla<?php } ?>
          <?php if($row_rsEdit['country_id']=="9") { ?>Antigua and Barbuda<?php } ?>
          <?php if($row_rsEdit['country_id']=="10") { ?>Argentina<?php } ?>
          <?php if($row_rsEdit['country_id']=="11") { ?>Armenia<?php } ?>
          <?php if($row_rsEdit['country_id']=="12") { ?>Ascension Island<?php } ?>
          <?php if($row_rsEdit['country_id']=="13") { ?>Australia<?php } ?>
          <?php if($row_rsEdit['country_id']=="14") { ?>Austria<?php } ?>
          <?php if($row_rsEdit['country_id']=="15") { ?>Azerbaijan<?php } ?>
          <?php if($row_rsEdit['country_id']=="16") { ?>Bahamas<?php } ?>
          <?php if($row_rsEdit['country_id']=="17") { ?>Bahrain<?php } ?>
          <?php if($row_rsEdit['country_id']=="18") { ?>Bangladesh<?php } ?>
          <?php if($row_rsEdit['country_id']=="19") { ?>Barbados<?php } ?>
          <?php if($row_rsEdit['country_id']=="20") { ?>Belarus<?php } ?>
          <?php if($row_rsEdit['country_id']=="21") { ?>Belgium<?php } ?>
          <?php if($row_rsEdit['country_id']=="22") { ?>Belize<?php } ?>
          <?php if($row_rsEdit['country_id']=="23") { ?>Benin<?php } ?>
          <?php if($row_rsEdit['country_id']=="24") { ?>Bermuda<?php } ?>
          <?php if($row_rsEdit['country_id']=="25") { ?>Bhutan<?php } ?>
          <?php if($row_rsEdit['country_id']=="26") { ?>Bolivia<?php } ?>
          <?php if($row_rsEdit['country_id']=="27") { ?>Bosnia and Herzegovina<?php } ?>
          <?php if($row_rsEdit['country_id']=="28") { ?>Botswana<?php } ?>
          <?php if($row_rsEdit['country_id']=="29") { ?>Brazil<?php } ?>
          <?php if($row_rsEdit['country_id']=="30") { ?>British Indian Ocean Territory<?php } ?>
          <?php if($row_rsEdit['country_id']=="31") { ?>Brunei Darussalam<?php } ?>
          <?php if($row_rsEdit['country_id']=="32") { ?>Bulgaria<?php } ?>
          <?php if($row_rsEdit['country_id']=="33") { ?>Burkina Faso<?php } ?>
          <?php if($row_rsEdit['country_id']=="34") { ?>Burundi<?php } ?>
          <?php if($row_rsEdit['country_id']=="35") { ?>Cambodia<?php } ?>
          <?php if($row_rsEdit['country_id']=="36") { ?>Cameroon<?php } ?>
          <?php if($row_rsEdit['country_id']=="37") { ?>Canada<?php } ?>
          <?php if($row_rsEdit['country_id']=="38") { ?>Cape Verde<?php } ?>
          <?php if($row_rsEdit['country_id']=="39") { ?>Cayman Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="40") { ?>Central African Republic<?php } ?>
          <?php if($row_rsEdit['country_id']=="41") { ?>Chad<?php } ?>
          <?php if($row_rsEdit['country_id']=="42") { ?>Chile<?php } ?>
          <?php if($row_rsEdit['country_id']=="43") { ?>China<?php } ?>
          <?php if($row_rsEdit['country_id']=="44") { ?>Colombia<?php } ?>
          <?php if($row_rsEdit['country_id']=="45") { ?>Comoros<?php } ?>
          <?php if($row_rsEdit['country_id']=="46") { ?>Congo<?php } ?>
          <?php if($row_rsEdit['country_id']=="47") { ?>Cook Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="48") { ?>Costa Rica<?php } ?>
          <?php if($row_rsEdit['country_id']=="49") { ?>Cote D Ivoire<?php } ?>
          <?php if($row_rsEdit['country_id']=="50") { ?>Croatia<?php } ?>
          <?php if($row_rsEdit['country_id']=="51") { ?>Cuba<?php } ?>
          <?php if($row_rsEdit['country_id']=="52") { ?>Cyprus<?php } ?>
          <?php if($row_rsEdit['country_id']=="53") { ?>Czech Republic<?php } ?>
          <?php if($row_rsEdit['country_id']=="54") { ?>Democratic Republic of Congo<?php } ?>
          <?php if($row_rsEdit['country_id']=="55") { ?>Denmark<?php } ?>
          <?php if($row_rsEdit['country_id']=="56") { ?>Djibouti<?php } ?>
          <?php if($row_rsEdit['country_id']=="57") { ?>Dominica<?php } ?>
          <?php if($row_rsEdit['country_id']=="58") { ?>Dominican Republic<?php } ?>
          <?php if($row_rsEdit['country_id']=="59") { ?>Ecuador<?php } ?>
          <?php if($row_rsEdit['country_id']=="60") { ?>Egypt<?php } ?>
          <?php if($row_rsEdit['country_id']=="61") { ?>El Salvador<?php } ?>
          <?php if($row_rsEdit['country_id']=="62") { ?>Equatorial Guinea<?php } ?>
          <?php if($row_rsEdit['country_id']=="63") { ?>Eritrea<?php } ?>
          <?php if($row_rsEdit['country_id']=="64") { ?>Estonia<?php } ?>
          <?php if($row_rsEdit['country_id']=="65") { ?>Ethiopia<?php } ?>
          <?php if($row_rsEdit['country_id']=="66") { ?>Falkland Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="67") { ?>Faroe Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="68") { ?>Federated States of Micronesia<?php } ?>
          <?php if($row_rsEdit['country_id']=="69") { ?>Fiji<?php } ?>
          <?php if($row_rsEdit['country_id']=="70") { ?>Finland<?php } ?>
          <?php if($row_rsEdit['country_id']=="71") { ?>France<?php } ?>
          <?php if($row_rsEdit['country_id']=="72") { ?>French Guiana<?php } ?>
          <?php if($row_rsEdit['country_id']=="73") { ?>French Polynesia<?php } ?>
          <?php if($row_rsEdit['country_id']=="74") { ?>Gabon<?php } ?>
          <?php if($row_rsEdit['country_id']=="75") { ?>Georgia<?php } ?>
          <?php if($row_rsEdit['country_id']=="76") { ?>Germany<?php } ?>
          <?php if($row_rsEdit['country_id']=="77") { ?>Ghana<?php } ?>
          <?php if($row_rsEdit['country_id']=="78") { ?>Gibraltar<?php } ?>
          <?php if($row_rsEdit['country_id']=="79") { ?>Greece<?php } ?>
          <?php if($row_rsEdit['country_id']=="80") { ?>Greenland<?php } ?>
          <?php if($row_rsEdit['country_id']=="81") { ?>Grenada<?php } ?>
          <?php if($row_rsEdit['country_id']=="82") { ?>Guadeloupe<?php } ?>
          <?php if($row_rsEdit['country_id']=="83") { ?>Guam<?php } ?>
          <?php if($row_rsEdit['country_id']=="84") { ?>Guatemala<?php } ?>
          <?php if($row_rsEdit['country_id']=="85") { ?>Guinea<?php } ?>
          <?php if($row_rsEdit['country_id']=="86") { ?>Guinea Bissau<?php } ?>
          <?php if($row_rsEdit['country_id']=="87") { ?>Guyana<?php } ?>
          <?php if($row_rsEdit['country_id']=="88") { ?>Haiti<?php } ?>
          <?php if($row_rsEdit['country_id']=="89") { ?>Honduras<?php } ?>
          <?php if($row_rsEdit['country_id']=="90") { ?>Hong Kong<?php } ?>
          <?php if($row_rsEdit['country_id']=="91") { ?>Hungary<?php } ?>
          <?php if($row_rsEdit['country_id']=="92") { ?>Iceland<?php } ?>
          <?php if($row_rsEdit['country_id']=="93") { ?>India<?php } ?>
          <?php if($row_rsEdit['country_id']=="94") { ?>Indonesia<?php } ?>
          <?php if($row_rsEdit['country_id']=="95") { ?>Iran<?php } ?>
          <?php if($row_rsEdit['country_id']=="96") { ?>Iraq<?php } ?>
          <?php if($row_rsEdit['country_id']=="97") { ?>Ireland<?php } ?>
          <?php if($row_rsEdit['country_id']=="98") { ?>Isle of Man<?php } ?>
          <?php if($row_rsEdit['country_id']=="99") { ?>Israel<?php } ?>
          <?php if($row_rsEdit['country_id']=="100") { ?>Italy<?php } ?>
          <?php if($row_rsEdit['country_id']=="101") { ?>Jamaica<?php } ?>
          <?php if($row_rsEdit['country_id']=="102") { ?>Japan<?php } ?>
          <?php if($row_rsEdit['country_id']=="103") { ?>Jordan<?php } ?>
          <?php if($row_rsEdit['country_id']=="104") { ?>Kazakhstan<?php } ?>
          <?php if($row_rsEdit['country_id']=="105") { ?>Kenya<?php } ?>
          <?php if($row_rsEdit['country_id']=="106") { ?>Kiribati<?php } ?>
          <?php if($row_rsEdit['country_id']=="107") { ?>Korea (Peoples Republic of)<?php } ?>
          <?php if($row_rsEdit['country_id']=="108") { ?>Korea (Republic of)<?php } ?>
          <?php if($row_rsEdit['country_id']=="109") { ?>Kuwait<?php } ?>
          <?php if($row_rsEdit['country_id']=="110") { ?>Kyrgyzstan<?php } ?>
          <?php if($row_rsEdit['country_id']=="111") { ?>Laos<?php } ?>
          <?php if($row_rsEdit['country_id']=="112") { ?>Latvia<?php } ?>
          <?php if($row_rsEdit['country_id']=="113") { ?>Lebanon<?php } ?>
          <?php if($row_rsEdit['country_id']=="114") { ?>Lesotho<?php } ?>
          <?php if($row_rsEdit['country_id']=="115") { ?>Liberia<?php } ?>
          <?php if($row_rsEdit['country_id']=="116") { ?>Libya<?php } ?>
          <?php if($row_rsEdit['country_id']=="117") { ?>Liechtenstein<?php } ?>
          <?php if($row_rsEdit['country_id']=="118") { ?>Lithuania<?php } ?>
          <?php if($row_rsEdit['country_id']=="119") { ?>Luxembourg<?php } ?>
          <?php if($row_rsEdit['country_id']=="120") { ?>Macau<?php } ?>
          <?php if($row_rsEdit['country_id']=="121") { ?>Macedonia<?php } ?>
          <?php if($row_rsEdit['country_id']=="122") { ?>Madagascar<?php } ?>
          <?php if($row_rsEdit['country_id']=="123") { ?>Malawi<?php } ?>
          <?php if($row_rsEdit['country_id']=="124") { ?>Malaysia<?php } ?>
          <?php if($row_rsEdit['country_id']=="125") { ?>Maldives<?php } ?>
          <?php if($row_rsEdit['country_id']=="126") { ?>Mali<?php } ?>
          <?php if($row_rsEdit['country_id']=="127") { ?>Malta<?php } ?>
          <?php if($row_rsEdit['country_id']=="128") { ?>Marshall Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="129") { ?>Martinique<?php } ?>
          <?php if($row_rsEdit['country_id']=="130") { ?>Mauritius<?php } ?>
          <?php if($row_rsEdit['country_id']=="131") { ?>Mayotte<?php } ?>
          <?php if($row_rsEdit['country_id']=="132") { ?>Mexico<?php } ?>
          <?php if($row_rsEdit['country_id']=="133") { ?>Moldova<?php } ?>
          <?php if($row_rsEdit['country_id']=="134") { ?>Monaco<?php } ?>
          <?php if($row_rsEdit['country_id']=="135") { ?>Mongolia<?php } ?>
          <?php if($row_rsEdit['country_id']=="136") { ?>Montenegro<?php } ?>
          <?php if($row_rsEdit['country_id']=="137") { ?>Montserrat<?php } ?>
          <?php if($row_rsEdit['country_id']=="138") { ?>Morocco<?php } ?>
          <?php if($row_rsEdit['country_id']=="139") { ?>Mozambique<?php } ?>
          <?php if($row_rsEdit['country_id']=="140") { ?>Myanmar<?php } ?>
          <?php if($row_rsEdit['country_id']=="141") { ?>Namibia<?php } ?>
          <?php if($row_rsEdit['country_id']=="142") { ?>Nauru<?php } ?>
          <?php if($row_rsEdit['country_id']=="143") { ?>Nepal<?php } ?>
          <?php if($row_rsEdit['country_id']=="144") { ?>Netherlands<?php } ?>
          <?php if($row_rsEdit['country_id']=="145") { ?>Netherlands Antilles<?php } ?>
          <?php if($row_rsEdit['country_id']=="146") { ?>New Caledonia<?php } ?>
          <?php if($row_rsEdit['country_id']=="147") { ?>New Zealand<?php } ?>
          <?php if($row_rsEdit['country_id']=="148") { ?>Nicaragua<?php } ?>
          <?php if($row_rsEdit['country_id']=="149") { ?>Niger<?php } ?>
          <?php if($row_rsEdit['country_id']=="150") { ?>Nigeria<?php } ?>
          <?php if($row_rsEdit['country_id']=="151") { ?>Niue<?php } ?>
          <?php if($row_rsEdit['country_id']=="152") { ?>Norfolk Island<?php } ?>
          <?php if($row_rsEdit['country_id']=="153") { ?>Northern Mariana Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="154") { ?>Norway<?php } ?>
          <?php if($row_rsEdit['country_id']=="155") { ?>Oman<?php } ?>
          <?php if($row_rsEdit['country_id']=="156") { ?>Pakistan<?php } ?>
          <?php if($row_rsEdit['country_id']=="157") { ?>Palau<?php } ?>
          <?php if($row_rsEdit['country_id']=="158") { ?>Panama<?php } ?>
          <?php if($row_rsEdit['country_id']=="159") { ?>Papua New Guinea<?php } ?>
          <?php if($row_rsEdit['country_id']=="160") { ?>Paraguay<?php } ?>
          <?php if($row_rsEdit['country_id']=="161") { ?>Peru<?php } ?>
          <?php if($row_rsEdit['country_id']=="162") { ?>Philippines<?php } ?>
          <?php if($row_rsEdit['country_id']=="163") { ?>Pitcairn<?php } ?>
          <?php if($row_rsEdit['country_id']=="164") { ?>Poland<?php } ?>
          <?php if($row_rsEdit['country_id']=="165") { ?>Portugal<?php } ?>
          <?php if($row_rsEdit['country_id']=="166") { ?>Puerto Rico<?php } ?>
          <?php if($row_rsEdit['country_id']=="167") { ?>Qatar<?php } ?>
          <?php if($row_rsEdit['country_id']=="168") { ?>Reunion<?php } ?>
          <?php if($row_rsEdit['country_id']=="169") { ?>Romania<?php } ?>
          <?php if($row_rsEdit['country_id']=="170") { ?>Russian Federation<?php } ?>
          <?php if($row_rsEdit['country_id']=="171") { ?>Rwanda<?php } ?>
          <?php if($row_rsEdit['country_id']=="172") { ?>Saint Vincent and the Grenadines<?php } ?>
          <?php if($row_rsEdit['country_id']=="173") { ?>San Marino<?php } ?>
          <?php if($row_rsEdit['country_id']=="174") { ?>Sao Tome and Principe<?php } ?>
          <?php if($row_rsEdit['country_id']=="175") { ?>Saudi Arabia<?php } ?>
          <?php if($row_rsEdit['country_id']=="176") { ?>Senegal<?php } ?>
          <?php if($row_rsEdit['country_id']=="177") { ?>Serbia<?php } ?>
          <?php if($row_rsEdit['country_id']=="178") { ?>Seychelles<?php } ?>
          <?php if($row_rsEdit['country_id']=="179") { ?>Sierra Leone<?php } ?>
          <?php if($row_rsEdit['country_id']=="180") { ?>Singapore<?php } ?>
          <?php if($row_rsEdit['country_id']=="181") { ?>Slovakia<?php } ?>
          <?php if($row_rsEdit['country_id']=="182") { ?>Slovenia<?php } ?>
          <?php if($row_rsEdit['country_id']=="183") { ?>Solomon Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="184") { ?>Somalia<?php } ?>
          <?php if($row_rsEdit['country_id']=="185") { ?>South Africa<?php } ?>
          <?php if($row_rsEdit['country_id']=="186") { ?>South Georgia<?php } ?>
          <?php if($row_rsEdit['country_id']=="187") { ?>Spain<?php } ?>
          <?php if($row_rsEdit['country_id']=="188") { ?>Sri Lanka<?php } ?>
          <?php if($row_rsEdit['country_id']=="189") { ?>St. Kitts and Nevis<?php } ?>
          <?php if($row_rsEdit['country_id']=="190") { ?>St. Lucia<?php } ?>
          <?php if($row_rsEdit['country_id']=="191") { ?>St. Pierre and Miquelon<?php } ?>
          <?php if($row_rsEdit['country_id']=="192") { ?>Sudan<?php } ?>
          <?php if($row_rsEdit['country_id']=="193") { ?>Suriname<?php } ?>
          <?php if($row_rsEdit['country_id']=="194") { ?>Swaziland<?php } ?>
          <?php if($row_rsEdit['country_id']=="195") { ?>Sweden<?php } ?>
          <?php if($row_rsEdit['country_id']=="196") { ?>Switzerland<?php } ?>
          <?php if($row_rsEdit['country_id']=="197") { ?>Syrian Arab Republic<?php } ?>
          <?php if($row_rsEdit['country_id']=="198") { ?>Taiwan<?php } ?>
          <?php if($row_rsEdit['country_id']=="199") { ?>Tajikistan<?php } ?>
          <?php if($row_rsEdit['country_id']=="200") { ?>Tanzania<?php } ?>
          <?php if($row_rsEdit['country_id']=="201") { ?>Thailand<?php } ?>
          <?php if($row_rsEdit['country_id']=="202") { ?>The Gambia<?php } ?>
          <?php if($row_rsEdit['country_id']=="203") { ?>Togo<?php } ?>
          <?php if($row_rsEdit['country_id']=="204") { ?>Tokelau<?php } ?>
          <?php if($row_rsEdit['country_id']=="205") { ?>Tonga<?php } ?>
          <?php if($row_rsEdit['country_id']=="206") { ?>Trinidad and Tobago<?php } ?>
          <?php if($row_rsEdit['country_id']=="207") { ?>Tunisia<?php } ?>
          <?php if($row_rsEdit['country_id']=="208") { ?>Turkey<?php } ?>
          <?php if($row_rsEdit['country_id']=="209") { ?>Turkmenistan<?php } ?>
          <?php if($row_rsEdit['country_id']=="210") { ?>Turks and Caicos Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="211") { ?>Tuvalu<?php } ?>
          <?php if($row_rsEdit['country_id']=="212") { ?>Uganda<?php } ?>
          <?php if($row_rsEdit['country_id']=="213") { ?>Ukraine<?php } ?>
          <?php if($row_rsEdit['country_id']=="214") { ?>United Arab Emirates<?php } ?>
          <?php if($row_rsEdit['country_id']=="215") { ?>United Kingdom<?php } ?>
          <?php if($row_rsEdit['country_id']=="216") { ?>Uruguay<?php } ?>
          <?php if($row_rsEdit['country_id']=="217") { ?>Uzbekistan<?php } ?>
          <?php if($row_rsEdit['country_id']=="218") { ?>Vanuatu<?php } ?>
          <?php if($row_rsEdit['country_id']=="219") { ?>Venezuela<?php } ?>
          <?php if($row_rsEdit['country_id']=="220") { ?>Viet Nam<?php } ?>
          <?php if($row_rsEdit['country_id']=="221") { ?>Virgin Islands (U.K.)<?php } ?>
          <?php if($row_rsEdit['country_id']=="222") { ?>Virgin Islands (U.S.)<?php } ?>
          <?php if($row_rsEdit['country_id']=="223") { ?>Wallis and Futuna Islands<?php } ?>
          <?php if($row_rsEdit['country_id']=="224") { ?>Western Samoa<?php } ?>
          <?php if($row_rsEdit['country_id']=="225") { ?>Yemen<?php } ?>
          <?php if($row_rsEdit['country_id']=="226") { ?>Yugoslavia<?php } ?>
          <?php if($row_rsEdit['country_id']=="227") { ?>Zambia<?php } ?>
          <?php if($row_rsEdit['country_id']=="228") { ?>Zimbabwe<?php } ?>
       </td>
    </tr>
    <tr>
      <th valign="top" align="right">High School: </th>
      <td valign="top"><?php echo $row_rsEdit['highschool']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">College/ University: </th>
      <td valign="top"><?php echo $row_rsEdit['college']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Company/ Organization: </th>
      <td valign="top"><?php echo $row_rsEdit['company']; ?></td>
    </tr>
    <tr>
      <th valign="top" align="right">Interested In: </th>
      <td valign="top"><?php if($row_rsEdit['friends']==1) echo 'Friends<br />';if($row_rsEdit['activity_partners']==1) echo 'Activity Partners<br />';if($row_rsEdit['business_networking']==1) echo 'Business Networking<br />';if($row_rsEdit['dating']==1) echo 'Dating: ';
	  if($row_rsEdit['dating_type']==1) echo 'men and women';
	  if($row_rsEdit['dating_type']==2) echo 'men';
	  if($row_rsEdit['dating_type']==3) echo 'women';
	  echo '<br />'; ?></td>
    </tr>
  </tbody></table>	</div>
	<div id="fragment-2" class="tabs-container tabs-hide" style="">
		  <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th valign="top" align="right">Children:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Religion:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Sexual Orientation: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Smoking:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Drinking:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Living:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Hometown:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">About Me: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">My Family: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Sports: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Activities:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Books:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Music:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Tv Shows: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Movies:</th>
      <td valign="top">&nbsp;</td>
    </tr></tbody></table>	
	</div>
	<div id="fragment-3" class="tabs-container tabs-hide" style="">
		  <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th align="right">IM Yahoo: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">IM Gmail:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">IM Other: </th>
      <td> </td>
    </tr>
    <tr>
      <th align="right">Home Phone: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Cell Phone: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Address Line 1: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th align="right">Address Line 2: </th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">City:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">State/ Province:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Zipcode/ Pincode: </th>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <th align="right">Country:</th>
      <td>&nbsp;</td>
    </tr>
  </tbody></table>	
	</div>
	<div id="fragment-4" class="tabs-container tabs-hide" style="">
		  <table cellspacing="1" cellpadding="5" border="0">
    <tbody><tr>
      <th valign="top" align="right">Education:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">High School: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">College/ University: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right"> </th>
      <td> </td>
    </tr>
    <tr>
      <th valign="top" align="right">Occupation:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Industry:</th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Company/ Organization: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Job Description: </th>
      <td valign="top">&nbsp;</td>
    </tr>
  </tbody></table>	
	</div>
	<div id="fragment-5" class="tabs-container tabs-hide" style="">
		  <table cellspacing="1" cellpadding="5" border="0">
    <tbody>
    <tr>
      <th valign="top" align="right">Height:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Best Feature: </th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">My idea of a perfect first date:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">From my past relationships i learned:</th>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <th valign="top" align="right">Ideal match:</th>
      <td valign="top">&nbsp;</td>
    </tr>
  </tbody></table>	
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($rsEdit);
?>
