<?php require('lib/top.php'); ?>



    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent">
<style>
a {
	text-decoration: none;
	color:#333;
}
ul li {
	list-style:none;
}

/* 공통 */
.fl {
	float:left;
}
.tc {
	text-align:center;
}

#board_area {
	width: 900px;
	position: relative;
}
.list-table {
	margin-top: 40px;
}
.list-table thead th{
  text-align:center;
	height:40px;
	border-top:2px solid #09C;
	border-bottom:1px solid #CCC;
	font-weight: bold;
	font-size: 17px;
}
.list-table tbody td{
	text-align:center;
	padding:10px 0;
	border-bottom:1px solid #CCC; height:20px;
	font-size: 14px
}
#write_btn {
	position: absolute;
	margin-top:20px;
	right: 0;
}
#search_box {
	margin-top:30px;
	text-align: center;
}
</style>
<?php

  /* 검색 변수 */
  $catagory = $_GET['catgo'];
  $search_con = $_GET['search'];
?>


          <?php if(isset($_SESSION['nickname'])&&$_SESSION['nickname']=='Admin'){?>
            <!-- #####내가 로그인한 경우 ##### -->

          <p>FreePost Page</p>
            <h2>관리자 모드</h2>
            <button onclick="location.href='free_post.php'" class="btn oneMusic-btn mt-30">전체목록</button>

            <?php
          }else{
            ?>
                  <!-- #####그 ##### -->
            <p>FreePost Page</p>
            <h2>자유게시판</h2>
            <button onclick="location.href='free_post.php'" class="btn oneMusic-btn mt-30">전체목록</button>

          <?php }
          ?>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <?php
require('_conn.php');

if(isset($_GET['current_page'])){
  $current_page=$_GET['current_page'];
} else {
  $current_page=1;
}

$start = ($current_page-1)*10;

$sqlall = "SELECT * FROM `free_post` where del_flg = '0' and $catagory like '%$search_con%' ";
$count = mysqli_query($conn, $sqlall)->num_rows;
$end_page = ceil($count/10);

$sql = "SELECT * FROM `free_post` where del_flg = '0' and $catagory like '%$search_con%' order by no desc limit $start, 10";

$result = mysqli_query($conn,$sql);

$prev_page = $current_page-1;
$next_page = $current_page+1;

     ?>

    <!-- ##### Post Area Start ##### -->


    <div class="login-area section-padding-100">
    <!-- ##### Post Area End ##### -->
    <div class="container">
        <div class="row justify-content-center">
    <div id="board_area">
      <?php
      echo "현 페이지".$current_page;
              echo " / 총 페이지".$end_page; ?>
    <table class="list-table">
      <!-- // 게시판 컬럼별 길이 조정
       <colgroup>
        <col width="50">
        <col width="50">
        <col width="200">
        <col width="50">
        <col width="50">
      </colgroup> -->
      <thead>
        <tr >
        <th width="70">번호</th>
        <th width="500">제목</th>
        <th width="120">닉네임</th>
        <th width="100">날짜</th>
        <th width="100">조회수</th>
        </tr>
      </thead>
      <tbody>
        <?php // $result_bbs에서 페이지네이션 결과값 빼오기
        foreach($result as $v){
          echo "<tr style='text-align:center;'>";
          echo "<td>{$v['no']}</td>";


          // 제목을 $limited_title 로 바꾸기 : title이 30을 넘어서면 "..."로 출력
          $limited_title = $v["title"];
          if(strlen($limited_title)>30){
            $limited_title=str_replace($v["title"], mb_substr($v["title"],0,30,"utf-8")."...", $v["title"]);
          } else {}
          echo "<td><a href='free_post_view.php?no={$v['no']}' style='color:black;'>{$limited_title}</a></td>";
          echo "<td>{$v['nickname']}</td>";
          // 수정시간, 등록시간 입력 : 수정시간 있을 땐 수정시간, 없을 땐 등록시간이 뜨도록 함
          // 시간포맷 참조 : https://m.blog.naver.com/PostView.nhn?blogId=fromyongsik&logNo=40122607490&proxyReferer=https%3A%2F%2Fwww.google.com%2F
          if(isset($v['update_date'])){
            echo "<td>".DateTime::createFromFormat("Y-m-d H:i:s", "{$v['update_date']}")->format("y/m/d")."</td>";
          } else { echo "<td>".DateTime::createFromFormat("Y-m-d H:i:s", "{$v['reg_date']}")->format("y/m/d")."</td>"; }

          echo "<td>{$v['view']}</td>";
          echo "</tr>";}
        ?>
      </tbody>
    </table>
    <div class="oneMusic-pagination-area wow fadeInUp" data-wow-delay="300ms">
        <nav>
            <ul class="pagination">
              <?php if($current_page==1){?>
                <li class="page-item active"><a class="page-link"  href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">앞</a></li>
              <?php } else {?>
                <li class="page-item"><a class="page-link" href="free_post.php?current_page=1">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="free_post.php?current_page=<?=$prev_page?>"><앞</a></li>
              <?php } ?>
              <?php if($current_page==$end_page){ ?>
                    <li class="page-item"><a class="page-link" href="#">끝</a></li>
                <li class="page-item active"><a class="page-link"  href="#">&raquo;</a></li>
                <?php } else {?>
                    <li class="page-item"><a class="page-link" href="free_post.php?current_page=<?=$next_page?>">뒤</a></li>
                  <li class="page-item"><a class="page-link" href="free_post.php?current_page=<?=$end_page?>">&raquo;</a></li>
                <?php } ?>

            </ul>
        </nav>
    </div>
    <br>

    <!-- 글 등록 버튼 -->

    <div id="search_box">
      <form action="free_post_search.php" method="get">
        <select name="catgo">
          <option value="title">제목</option>
          <option value="nickname">닉네임</option>
          <option value="content">내용</option>
        </select>
        <input type="text" name="search" size="40" required="required" /> <button>검색</button>
      </form>
      </div>
</div>
</div>
</div>
</div>
    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url(img/bg-img/bg-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading white">
                        <p>메일 보내기.</p>
                        <h2>Get In Touch</h2>
                    </div>
                </div>
            </div>

<?php
require('lib/letter.php');
?>
    <!-- ##### Contact Area End ##### -->

  <?php require('lib/bottom.php') ;?>
