<!DOCTYPE html>
<head>
  <meta http-http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>MYsql-php Test</title>
</head>
<body>
  <?php
  echo "MYsql Test<br>";
  $mysqli = new mysqli("localhost","admin","sotoddlf0709A!","testdb");
  if($mysqli -> connect_errno){
    printf("connect_errno",$mysqli -> connect_errno);
    exit();
  }
  $db_con = mysqli_connect("localhost","admin","sotoddlf0709A!","testdb");
  if($db_con){
    echo "connect";
  }else{
    echo "disconnect";
  }
  ?>
</body>
</html>
