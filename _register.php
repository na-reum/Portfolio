<?php
// <!-- DB 호출 -->
require ('_conn.php');

// <!-- 입력값 변수에 담기 -->
// ID는 대소문자 섞일 경우 소문자로만 인식되게 하기 (비번은 대소문자 구분되게 해야하므로 수정할 필요없음)
// * PHP 문자열 대소문자 변환함수 : 소문자 변환 strtolower(), 대문자 변환 strtoupper(), 첫글자만 대문자로 ucfirst(), 각 단어 첫글자를 대문자로 ucwords();
$id = $_POST['id'];
//$id = strtolower($id);
// 비번 암호화
$pws = $_POST['password'];
//$pw = md5($pws);
// 비번 암호화 (체크비번)
$pwcs = $_POST['passwordcheck'];
//$pwc = md5($pwcs);
// 이름, 닉네임, 주소란에 태그금지 (XSS 해킹 예방)
$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$nickname = htmlspecialchars($_POST['nickname'], ENT_QUOTES, 'UTF-8');
$addr = htmlspecialchars($_POST['addr'], ENT_QUOTES, 'UTF-8');
// 아래는 인풋박스에서부터 통제했기 때문에 그대로 써도 안전한 변수들
$birth = $_POST['birth'];
$gender = $_POST['gender'];
$tel = $_POST['tel'];

// <!-- 중복된 아이디 걸러내기 사전작업 -->
$checkid = "SELECT * FROM `blog_user` WHERE id='$id'";
$result = mysqli_query($conn, $checkid);
// ↑ 쿼리문 실행결과를 $result 객체에 담는다.
$row = $result->num_rows; // num_rows는 size와 같다. 1건 취득되면 1 안되면 0
// $result라는 검색취득건수는 몇개일지 모르니까 배열의 형태로(->num_rows) $row에 담는다.

// <!-- 잘못 입력된 경우 걸러내기 -->
if($row > 0){    // 중복된 아이디 걸러내기
  echo "<script>alert('이미 존재하는 ID입니다.');history.back();</script>";
} else if($_POST['id']==''||$_POST['password']==''||$_POST['nickname']==''||$_POST['username']==''||$_POST['passwordcheck']==''){ // 필수항목 미입력 걸러내기
  echo "<script>alert('필수항목을 모두 작성해주세요.');history.back();</script>";
} else if($_POST['password']!=$_POST['passwordcheck']){ // 비밀번호 1과 2 입력이 틀린 경우 걸러내기
  echo "<script>alert('비밀번호를 정확히 입력해주세요.');history.back();</script>";
} else {

// <!-- 회원가입 성공시 -->
// DB에 업로드
$sql = "INSERT INTO `blog_user` (`no`, `id`, `password`, `username`, `nickname`, `birth`, `gender`, `tel`, `addr`,`reddate`,`admin`)
        VALUES (NULL, '$id', '$pws', '$username', '$nickname', '$birth', '$gender', '$tel', '$addr',current_timestamp(),NULL)";
// $sql에 담긴 sql문을 호출된 db에 실행시키기
mysqli_query($conn, $sql);
// 로그인 처리
require ('_loginok.php');
// 성공 알림후 메인으로 이동
echo "<script>window.alert('회원가입이 완료되었습니다.')</script>";
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}
?>
