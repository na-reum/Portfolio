<?php
$charset='UTF-8';
$to = "wognsdl931@gmail.com";
$name = $_POST['name'];
$name = str_replace("'","",$name);
$Email = $_POST['email'];
$subject = $_POST['subject'];
$subject= str_replace("'","",$subject);
//$subject= "=?".$charset."?B?".base64_decode($subject)."?=\n";
$message= "작성자: ".$name."\n내용: ".$_POST['message'];
$message= str_replace("'","",$message);

$headers="From: ".$Email."\r\n";
if( $_POST['name']==''||$_POST['email']==''||$_POST['subject']==''||$_POST['message']==''){
  echo "<script>alert('항목을 모두 작성해주세요.');history.back();</script>";

}else{

  $mail_result = mail($to,$subject,$message,$headers);
  if($mail_result){
    echo "<script>alert('메일 발송이 완료되었습니다.');</script>";
    echo "<script>window.location.replace(document.referrer);</script>>";

  }
}?>
