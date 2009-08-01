<?php
include_once('config.php');
include_once('RESTClient.php');
if($_POST['MM_Insert']==1) {
	$post = '<users>
<user><email>'.$_POST['email'].'</email>
<password>'.$_POST['password'].'</password>
</user></users>';
	$client = new RESTClient();
	$input = $client->post("http://rest.webservices.net.in/users/login.php?user_key=".USERKEY."&app_id=".APPID, $post, "text/xml");
	$return = simplexml_load_string($input);
	$success = sprintf("%s", $return->success);
	if($success) {
		if($_POST['remember']==1) {
			$time = time()+(60*60*24*365);
		} else {
			$time = 0;
		}
		// do something
		foreach($return as $key => $value) {
			if($key == "details") {
				foreach($value as $key1 => $value1) {
					setcookie($key1, sprintf("%s", $value1), $time, "/");
				}
			} else {				
				setcookie($key, sprintf("%s", $value), $time, "/");
			}
		}
		echo 'You are successfully logged on our site.';
	} else {
		echo sprintf("%s", $return);
	}
}
?>