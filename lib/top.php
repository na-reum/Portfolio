
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>NaLeum Blog</title>

    <!-- Favicon 홈페이지 마크-->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet 스타일지정-->
    <link rel="stylesheet" href="style.css">

    <!--팝업창으로 채팅방 생성 -->
    <script>
      // content, cate, index를 인수로 받아 form 태그로 전송하는 함수
      function goPage(nickname) {
        window.open("", "pop", "width=600, height=800");
        // name이 paging인 태그
        var f = document.paging;

        // form 태그의 하위 태그 값 매개 변수로 대입
        f.nickname.value = nickname;


        // input태그의 값들을 전송하는 주소
        f.action = "http://localhost:8005"
        f.target = "pop"
        // 전송 방식 : post
        f.method = "post"
        f.submit();
      };
      </script>
</head>

<body>
    <!-- Preloader 로딩부분-->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start 헤더부분 시작 ##### -->
    <header class="header-area">
        <!-- Navbar Area -->
        <div class="oneMusic-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="oneMusicNav">

                        <!-- Nav brand onesound 부분-->
                        <a href="index.php" class="nav-brand" style="color: #ffffff">NaLeum</a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="profile.php">About</a></li>
                                    <li><a href="project_blog.php">Works</a></li>

                                    <li><a href="#">Skills</a>
                                        <ul class="dropdown">
                                            <li><a href="skill_blog.php">Skill Trees</a></li>
                                            <li><a href="#">Codes</a>
                                                <ul class="dropdown">
                                                    <li><a href="java_blog.php">JAVA</a></li>
                                                    <li><a href="#">Android</a></li>
                                                    <li><a href="#">PHP</a></li>

                                                </ul>
                                                <?php if(isset($_SESSION['nickname'])){?>

                                                      <?php if($_SESSION['nickname']=='Admin'){?>
                                                                            <li><a href="#">Even Dropdown</a>
                                                                              <ul class="dropdown">
                                                                                <li><a href="#">Deeply Dropdown</a></li>
                                                                                <li><a href="#">Deeply Dropdown</a></li>
                                                                                <li><a href="#">Deeply Dropdown</a></li>
                                                                                <li><a href="#">Deeply Dropdown</a></li>
                                                                                <li><a href="#">Deeply Dropdown</a></li>
                                                                              </ul>
                                                                            </li>

                                                                            <?php}  else{?>
                                                                            <?php  }?>

                                                                      <?php}  else{?>
                                                                           <?php  }?>

                                            </li>
                                        </ul>
                                    </li>





                                                      <li><a href="free_blog.php">Blog</a></li>
                                                      <li><a href="free_post.php">Free Board</a></li>
                                                      <li>
                                                        <?php if(isset($_SESSION['nickname'])){ ?>
                                                          <form name="paging">
                                                          <input type="hidden" name="nickname"/>
                                                          </form>
                                                          <a href="javascript:goPage('<?=$_SESSION['nickname']?>');">
                                                            Chat</a>
                                                      <?php  } else  { ?>
                                                        <a href="login.php">
                                                          Chat</a>
                                                      <?php } ?>

                                                              </li>

                                                      <li><a href="contact.php">Tel.</a></li>

                                </ul>

                                <!-- Login/Register & Cart Button -->
                                <div class="login-register-cart-button d-flex align-items-center">
                                    <!-- Login/Register -->
                                    <div class="login-register-btn mr-50">
                                      <?php
                                        if(isset($_SESSION['nickname'])){
                                        echo "<a href='_logout.php' id='loginBtn'>Logout</a>";
                                      }else {
                                        echo " <a href='login.php' id='loginBtn'>Login</a>";
                                      }

                                      ?>

                                    </div>

                                </div>
                            </div>
                            <!-- Nav End -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->
