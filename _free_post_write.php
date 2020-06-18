
<?php
// <!-- 변수설정 -->
// title, content는 태그적용/미적용을 선택할 수 있게 한다. 줄바꿈은 항상 적용한다.
// <!-- [Toggle] 줄바꿈은 항상 적용, HTML 태그는 적용 ON/OFF 선택 Start -->
#$title = nl2br($_POST['title']);$content = nl2br($_POST['content']);$title = str_replace("'", "''", $title);$content = str_replace("'", "''", $content);
$id = $_SESSION['id'];
$title = nl2br(htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'));
$content = nl2br(htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8'));
// [참조] 게시글 자료 불러오기 문법 설명
//        1. nl2br : php 내 게시글에 자동 줄바꿈을 적용.
//        2. str_replace : 치환으로서, ''일때 '하나 정상뜨고, ' 한개일 때 에러 뜨는 문제 해결2. (태그를 켤 경우에는 htmlspecialchars를 안 쓰므로, 4번의 ENT_QUOTES 적용 대신이다.)
//        3. htmlspecialchars : php 내 게시글에 태그 적용 끄기. ('&'(앰퍼샌드)는 '&amp;'가 됩니다, '<'(미만)은 '&lt;'가 됩니다. '>'(이상)은 '&gt;'가 됩니다.)
//        4. ENT_QUOTES : ' " 모두 앞에 \ 붙임 (기본옵션).  ('"'(겹따옴표)는 ENT_NOQUOTES를 설정하지 않았을 때 '&quot;'가 됩니다. '''(홑따옴표)는 ENT_QUOTES가 설정되었을 때만 '&#039;'가 됩니다.)
// blogid는 수동 지정했으므로 태그적용에 대한 걱정은 없다.
$nickname = $_POST['nickname'];

// 이미지는 파일의 형태이므로 태그적용에 대한 걱정은 없다.
$img1 = $_FILES['img1'];
$img_size1 = $_FILES['img1']['size'];

// <!-- 잘못 입력된 경우 걸러내기 -->
if(!$title||!$content){   // 필수항목 미입력 걸러내기
  echo "<script>alert('필수항목을 모두 작성해주세요.');history.back();</script>";
} else if(!isset($_SESSION['nickname'])) {
  echo "<script>alert('세션이 만료되었습니다. 다시로그인 해주세요.');history.back();</script>";
}else {  // 여기서부터 페이지 끝까지 담아버리기

if(isset($img1)){
  $dir = "blog_images/";
  $file_name = basename($img1['name']);
  $tmp_name1 = $img1['tmp_name'];

  $addName = strtotime(date("Y-m-d H:i:s"));
  $file_name1 = $addName . "_".$file_name;

  $imageFileType = pathinfo($file_name,PATHINFO_EXTENSION);

  if(move_uploaded_file($tmp_name1, $dir.$file_name1)){
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
      echo "<script>alert('jpg,png,jpeg 파일만 업로드 가능합니다.');history.back();</script>";

  }else{
    require ('_conn.php');
    $sql = "INSERT INTO `free_post` (`no`, `id`,`pw` ,`title`, `content`, `view` ,`nickname`, `reg_date`, `update_date`, `img_file1`, `img_size1`, `del_flg`) VALUES (NULL,'$id',NULL,'$title','$content',0,'$nickname', current_timestamp(), NULL,'$file_name1', '$img_size1','0')";
    mysqli_query($conn, $sql);
    header("refresh:0.1 url=free_post.php");
    }
  }else {
    require ('_conn.php');
    $sql = "INSERT INTO `free_post` (`no`, `id`,`pw` ,`title`, `content`, `view` ,`nickname`, `reg_date`, `update_date`, `img_file1`, `img_size1`, `del_flg`) VALUES (NULL,'$id',NULL,'$title','$content',0,'$nickname', current_timestamp(), NULL,NULL,NULL,'0')";
    mysqli_query($conn, $sql);
    header("refresh:0.1 url=free_post.php");
  }
}else{
  require ('_conn.php');
  $sql = "INSERT INTO `free_post` (`no`, `id`,`pw` ,`title`, `content`, `view` ,`nickname`, `reg_date`, `update_date`, `img_file1`, `img_size1`, `del_flg`) VALUES (NULL,'$id',NULL,'$title','$content',0,'$nickname', current_timestamp(), NULL,NULL,NULL,'0')";
  mysqli_query($conn, $sql);
  header("refresh:0.1 url=free_post.php");

}

}
?>
