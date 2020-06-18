<?php
// _bbs_delete가 끝나서 돌아온 거라면 뒤로 한번 더 가기 : bbs 해당 리스트 상태로
if(isset($_SESSION['delback'])){
  unset($_SESSION['delback']);
  echo "<script>history.go(-1);</script>";
} else { // _bbs_delete 안했을 경우에 해당하는 페이지 전체 묶어버리기
?>
<?php // 윗줄하고 벌어지면 안됨(_view_cookie에 setcookie헤더있음 : 헤더는 echo html 출력 처리를 싫어한다. 심지어 줄바꿈같은 공백 html 출력처리도 중간에 끼는 것을 싫어한다.)
// <!-- 쿠키로 조회수 증가처리 : 아래의 순서로 세 줄을 입력하면 쿠키로 조회수 처리가 된다. -->
$no = $_GET['no'];
require('_conn.php');
require('_view_cookie.php');
?>

<?php require('lib/top.php'); ?>


    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent">

            <h2>자유게시판</h2>
            <button type="button" onclick="location.href='free_post.php'"  class="btn oneMusic-btn mt-30">목록</button>

        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">

                  <?php
                  // no값에 해당하는 게시물 호출
                  $sql = "SELECT * FROM `free_post` WHERE no = $no";
                  $result = mysqli_query($conn, $sql);
                  ?>

                  <?php foreach ($result as $v) { ?>
                    <?php
                    if ($v['del_flg']=='1') {
                      echo "<script>alert('삭제된 게시물입니다.');history.back();</script>";
                    }
                    ?>

                    <!-- Single Post Start -->
                    <div class="single-blog-post mb-100 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Post Thumb -->
                        <div class="blog-post-thumb mt-30">
                          <?php if(isset($v['img_file1'])){?>
                            <a href="#"><img src="blog_images/<?=$v['img_file1']?>" alt=""></a>
                          <?php } else {?>
                            <br><br>
                          <?php } ?>

                            <!-- Post Date -->
                            <div class="post-date">
                                <span>
                                  <?=DateTime::createFromFormat("Y-m-d H:i:s", "{$v['reg_date']}") ->format("d")?>
                                </span>
                                <?=DateTime::createFromFormat("Y-m-d H:i:s", "{$v['reg_date']}") ->format("F/y")?>
                            </div>
                        </div>

                        <!-- Blog Content -->
                        <div class="blog-content">
                            <!-- Post Title -->
                            <a href="#" class="post-title"><?=$v['title']?></a>
                            <!-- Post Meta -->
                            <div class="post-meta d-flex mb-30">
                                <p class="post-author">By<a href="#"> <?=$v['nickname']?></a></p>
                                <p class="tags">in<a href="free_post.php"> Blog</a></p>
                                <p class="tags"> 조회수 :  <?=$v['view']?></p>
                                <?php if(isset($v['update_date'])){echo "<p class='tags'>UpDated On ".DateTime::createFromFormat("Y-m-d H:i:s", "{$v['update_date']}")->format("y F d")."</p>";}else{}?>
                            </div>
                            <!-- Post Excerpt -->
                            <p><?=$v['content']?> </p>
                            <?php
                            if(isset($_SESSION['nickname'])&&$_SESSION['id'] == $v['id']){
                            ?>

                            <br><br>
                            <form action="free_post_modify.php" method="post">
                              <input type="hidden" name="id" value="<?=$v['id']?>">
                              <input type="hidden" name="no" value="<?=$v['no']?>">
                            <input type="submit" value="수정"/>&nbsp;
                              <button type="button"  onclick="location.href='_free_post_delete.php?no=<?=$v['no']?>'">삭제</button>&nbsp;
                          </form>
                          <!-- [2] 블로그 안에 총 댓글수 표시하기 -->
                          <br>

                            <?php
                          } else {

                          ?>
                        <?php
                            }
                        ?>

                        </div>
                    </div>
                    <?php
                    // 댓글 DB 테이블에서 댓글 cid가 블로그 blogid와 같고 댓글 no가 블로그 no과 같은 것을 검색해 나온 개수를 담는다.
                    // * 댓글 삭제 방식을 delflag 업데이트가 아닌 DELETE SQL문으로 할 경우 아래코드에서 delflag='0'은 삭제한다.
                    // * mq는 MOM(메시지기반미들웨어) 인프라를 구현한 시스템으로 DB 호출 경로를 분산시켜서 병목현상을 방지함 : mq("");로 쓸 수 있다만, 사전 인프라(소프트/하드) 설치필요.

                    $no = $v['no'];
                    $sql_count = "SELECT * FROM `post_comment` WHERE del_flg = '0' AND cid = 'free_post' AND no = '$no'";
                    $blog_c_count = mysqli_query($conn, $sql_count)->num_rows; // num_rows : 전체값을 센 수를 담아 정수형태로 출력
                    // [2] 댓글까지 $v를 모두 호출 했으므로 foreach문 닫기
                    ?>
                  <?php
                    }
                  ?>
                  <?php
                  echo "<hr>";
                  // [2] 댓글 수에 따른 출력 분기
                  if($blog_c_count > 0){ // 댓글 1개 이상인 경우
                  echo "전체 {$blog_c_count}개의 댓글이 있습니다.";
                  } else { // 댓글 0개인 경우
                    echo "현재 댓글이 없습니다. 첫 댓글을 남겨주세요.";
                  }
                  echo "<br>";
                  ?>

                  <!--[2] 댓글 -->
                  <?php require ('comment.php'); ?>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Login Area End ##### -->

<?php require('lib/bottom.php') ;?>
<?php } // "_bbs_delete 안했을 경우에 해당하는 페이지 전체(bottom까지) 묶어버리기" 닫기 ?>
