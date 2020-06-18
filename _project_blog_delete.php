
<?php
$no = $_GET['no'];

if(!isset($_SESSION['nickname'])){
    echo "<script>alert('세션이 만료되었습니다. 다시로그인 해주세요.');history.back();</script>";
} else if($_SESSION['admin']!='yes') {
    echo "<script>alert('권한이 없습니다.');history.back();</script>";
}else {

    require ('_conn.php');
    $sql = "UPDATE `project_blog` SET `del_flg` = '1' WHERE no = $no";
    mysqli_query($conn,$sql);
    ?>

    <script>window.location.replace(document.referrer);</script>

  <?php }



 ?>
