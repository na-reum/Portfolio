<?php
if (!isset($_SESSION)) {
    session_start();
}
// 파일을 직접 실행하면 동작되지 않도록 하기 위해서
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
	@extract($_POST); // $_POST['loginID'] 라고 쓰지 않고, $loginID 라고 써도 인식되게 함
  header('Content-Type: application/json; charset=utf8');

	//echo '<pre>';print_r($_POST);echo '</pre>';
	// exit; // 자바스크립트에서는 return false
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


    if ($row>0) {
  //    echo "<script>alert('이미 존재하는 ID입니다.');history.back();</script>";
  echo json_encode(array('result' => '0')); // echo '{"result":"0"}'; 와 동일

    } else {
      if($tel != ''){
        $tel = preg_replace("/[^0-9]/", "", $tel); }//전화번호 숫자만 남기고 제거
        // 회원 등록
        $sql = "INSERT INTO `blog_user` (`no`, `id`, `password`, `username`, `nickname`, `birth`, `gender`, `tel`, `addr`,`reddate`,`admin`)
                VALUES (NULL, '$id', '$pws', '$username', '$nickname', '$birth', '$gender', '$tel', '$addr',current_timestamp(),NULL)";
        // $sql에 담긴 sql문을 호출된 db에 실행시키기
        mysqli_query($conn, $sql);
        require ('_loginok.php');
    //    echo "<script>window.alert('회원가입이 완료되었습니다.')</script>";
      //  echo "<meta http-equiv='refresh' content='0;url=index.php'>";
      echo json_encode(array('result' => '1'));

    }
} else {// 입력받은 데이터에 문제가 있을 경우
//  echo "<script>alert('입력된 데이터에 문제가 있습니다');history.back();</script>";
echo json_encode(array('result' => '-2'));

}?>
