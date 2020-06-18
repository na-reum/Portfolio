<div class="col-12 col-lg-3">
    <div class="blog-sidebar-area">


        <!-- Widget Area -->
        <div class="single-widget-area mb-30">
            <div class="widget-title">
                <h5>Links</h5>
            </div>
            <div class="widget-content">
                <ul>
                    <li><a href="https://www.inflearn.com/">인프런</a></li>
                    <li><a href="https://opentutorials.org/course/1">생활코딩</a></li>
                    <li><a href="https://teamnova.co.kr/">팀노바</a></li>

                </ul>
            </div>
        </div>

        <?php
        $db = new mysqli('localhost','root','sotoddlf0709A!','testdb');

        $currdt = date("Y-m-d H:i:s");

        $query = "SELECT count(*) as count from tb_stat_visit where DATE(regdate) = DATE('$currdt')";

		      $data = $conn->query($query)->fetch_array();

		        $today_visit_count = $data['count'];
            $query = "SELECT count(*) as count from tb_stat_visit";

            $data = $conn->query($query)->fetch_array();

            $total_visit_count = $data['count'];


         ?>
        <div class="single-widget-area mb-30">
            <div class="widget-title">
                <h5>방문자수</h5>
            </div>
            <div class="widget-content">
                <ul>
                    <li>오늘 : <?=$today_visit_count?> 명</li>
                    <li>총 : <?=$total_visit_count?> 명</li>

                </ul>
            </div>
        </div>




        <!-- Widget Area -->
        <div class="single-widget-area mb-30">
            <a href="#"><img src="img/bg-img/add.gif" alt=""></a>
        </div>

        <!-- Widget Area -->
        <div class="single-widget-area mb-30">
            <a href="#"><img src="img/bg-img/add2.gif" alt=""></a>
        </div>

    </div>
</div>
