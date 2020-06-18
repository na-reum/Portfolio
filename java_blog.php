<?php require('lib/top.php'); ?>


    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent">

          <?php if(isset($_SESSION['nickname'])&&$_SESSION['admin']=='yes'){?>
            <!-- #####내가 로그인한 경우 ##### -->

            <p>Java Admin</p>
            <h2>관리자 모드</h2>
            <button onclick="location.href='java_blog_wirte.php'" class="btn oneMusic-btn mt-30">등록</button>

            <?php
          }else{
            ?>
                  <!-- #####그 ##### -->
            <p>Java Page</p>
            <h2>Java</h2>
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

$start = ($current_page-1)*3;

$sqlall = "SELECT * FROM `java_blog` where del_flg = '0'";
$count = mysqli_query($conn, $sqlall)->num_rows;
$end_page = ceil($count/3);

$sql = "SELECT * FROM `java_blog` where del_flg = '0' order by no desc limit $start, 3";

$result = mysqli_query($conn,$sql);

$prev_page = $current_page-1;
$next_page = $current_page+1;

     ?>

    <!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                  <?php foreach ($result as $v) { ?>

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
                                <p class="tags">in<a href="java_blog.php"> Blog</a></p>
                                <?php if(isset($v['update_date'])){echo "<p class='tags'>UpDated On ".DateTime::createFromFormat("Y-m-d H:i:s", "{$v['update_date']}")->format("y F d")."</p>";}else{}?>
                            </div>
                            <!-- Post Excerpt -->
                            <p><?=$v['content']?> </p>
                            <?php
                            if(isset($_SESSION['nickname'])&&$_SESSION['nickname']=='Admin'){
                            ?>

                            <br><br>
                            <form action="java_blog_modify.php" method="post">
                              <input type="hidden" name="no" value="<?=$v['no']?>">
                            <input type="submit" value="수정"/>
                                <button type="button"onclick="location.href='_java_blog_delete.php?no=<?=$v['no']?>'">삭제</button>&nbsp;
                          </form>

                            <?php
                          } else {

                          ?>
                        <?php
                            }
                        ?>
                        </div>
                    </div>
                  <?php
                    }
                  ?>



                    <!-- Pagination -->
                    <div class="oneMusic-pagination-area wow fadeInUp" data-wow-delay="300ms">
                        <nav>
                            <ul class="pagination">
                              <?php if($current_page==1){?>
                                <li class="page-item active"><a class="page-link"  href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">앞</a></li>
                              <?php } else {?>
                                <li class="page-item"><a class="page-link" href="java_blog.php?current_page=1">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="java_blog.php?current_page=<?=$prev_page?>"><앞</a></li>
                              <?php } ?>
                              <?php if($current_page==$end_page){ ?>
                                    <li class="page-item"><a class="page-link" href="#">끝</a></li>
                                <li class="page-item active"><a class="page-link"  href="#">&raquo;</a></li>
                                <?php } else {?>
                                    <li class="page-item"><a class="page-link" href="java_blog.php?current_page=<?=$next_page?>">뒤</a></li>
                                  <li class="page-item"><a class="page-link" href="java_blog.php?current_page=<?=$end_page?>">&raquo;</a></li>
                                <?php } ?>

                            </ul>
                        </nav>
                    </div>
                </div>

  <?php require('lib/side_widget.php'); ?>
            </div>
        </div>
    </div>
    <!-- ##### Blog Area End ##### -->



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
