<?php
class hello {
	public function test($name) {
		echo $name;
	}
}
$name = 'amit';
$cl = new hello;
$cl->test($name);
?>
