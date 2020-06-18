<?php
	$db = new mysqli('localhost','root','sotoddlf0709A!','testdb');
	if(!isset($_SESSION)) { session_start(); }
	date_default_timezone_set('Asia/Seoul');
	$currdt = date("Y-m-d H:i:s");
	$userip = $_SERVER['REMOTE_ADDR'];
	if(isset($_SERVER['HTTP_REFERER']))
	{	$referer = $_SERVER['HTTP_REFERER'];}
	else
{	$referer = "";}
	if($db){
		// 처음 방문했는지 검사
		if(empty($_COOKIE['NaLeumblog'])) {
      setcookie('NaLeumblog', TRUE, time() + (60 * 60 * 24), '/');
			$query = "INSERT into tb_stat_visit (seq, regdate, regip, referer) values(NULL,'$currdt','$userip','$referer')";
			$result = $db->query($query);
		}



		// 오늘 방문자수

		$query = "SELECT count(*) as count from tb_stat_visit where DATE(regdate) = DATE('$currdt')";

		$data = $db->query($query)->fetch_array();

		$today_visit_count = $data['count'];



		// 전체 방문자수

		$query = "SELECT count(*) as count from tb_stat_visit";

		$data = $db->query($query)->fetch_array();

		$total_visit_count = $data['count'];



	}



?>
