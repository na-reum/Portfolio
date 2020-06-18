<?php
 //$mailto="받는주소";
 $mailto="sotoddlf0709@naver.com";
 $subject="mail test";
 $content="test";
 $result=mail($mailto, $subject, $content);
 if($result){
  echo "mail success";
  }else  {

  error_log($mailto, 0);

  echo "mail fail";
 }
?>
