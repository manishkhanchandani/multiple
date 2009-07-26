<?php
include('../../Connections/conn.php');
include('../Classes/forum.php');
$forum = new forum;
$forum->tree(0, 1);
echo $forum->tree;
?>