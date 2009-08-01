<?php
include_once('config.php');
include_once('RESTClient.php');
if($_POST['MM_Insert']==1) {
	$post = '<users>
<user>
<email>'.$_POST['email'].'</email>
<password>'.$_POST['password'].'</password>
<cpassword>'.$_POST['cpassword'].'</cpassword>
<created>'.date('Y-m-d H:i:s').'</created>
<status>'.$_POST['status'].'</status>
<xtras>
<first_name>'.$_POST['first_name'].'</first_name>
<last_name>'.$_POST['last_name'].'</last_name>
</xtras>
</user>
</users>';
	$client = new RESTClient();
	$input = $client->post("http://rest.webservices.net.in/users/register.php?user_key=".USERKEY."&app_id=".APPID, $post, "text/xml");
	$return = simplexml_load_string($input);
	if($return->success) {
		// do something
		echo sprintf("%s", $return->message);
	} else {
		echo sprintf("%s", $return);
	}
}
?>