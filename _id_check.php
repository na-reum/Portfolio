<?php
require ('_conn.php');
	if($_POST['id'] != NULL){
	$id_check = mq("select * from `blog_user` where id='{$_POST['id']}'");
	$id_check = $id_check->fetch_array();

	if($id_check >= 1){
		echo "존재하는 아이디입니다.";
	} else {
		echo "존재하지 않는 아이디입니다.";
	}
} ?>
