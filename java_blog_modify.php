<?php require('lib/top.php');?>

<?php
require('_conn.php');
$no = $_POST['no'];
if(!isset($_POST['no'])){
echo "<script>alert('잘못된 접근입니다.');history.back();</script>";
}
$sql = "SELECT * FROM `java_blog` where no = $no";

$result = mysqli_query($conn,$sql);
$blog = mysqli_fetch_assoc($result);
 ?>




<section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url(img/bg-img/bg-2.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading white">
                    <p><?=$no?>번글 수정</p>
                    <h2>Edit Java Post</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Contact Form Area -->
                <div class="contact-form-area">
                    <form action="_java_blog_modify.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="no" value="<?=$no?>">
                        <input type="hidden" name="nickname" value="<?=$blog['nickname']?>">
                        <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="title" cols="30" rows="10" value="<?=$blog['title']?>" maxlength="99">
                                        </div>
                                    </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="content" cols="30" rows="10"><?php $bcontent = $blog['content']; $bcontent =str_replace("<br />","",$bcontent); echo $bcontent ?></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <div class="form-group">
                                <p>  <b> # 이 사진을 변경하려면 등록하세요 : <?=$blog['img_file1']?> </b><br>
                                  <input type="file" name="img1"><br></p>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn oneMusic-btn mt-30" type="submit">Send <i class="fa fa-angle-double-right"></i></button>&nbsp;
                                <button class="btn oneMusic-btn mt-30" type="button" onclick="location.href='java_blog.php'">back</button>&nbsp;

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require('lib/bottom.php'); ?>
