<?php 
 $conn = mysqli_connect('localhost', 'root', '', 'fooder');
 define('pags', 3);
 if (!$conn){
    die('error al conectar');
 }

 $page = (isset($_GET['page']) || $_GET['page'] < 1) ? $_GET['page'] : 1;

 $users = "SELECT * FROM users";
 $answer = mysqli_query($conn, $users);

 if(!$answer){
    die('error de consulta');
 }

 $pages_total = mysqli_num_rows($answer) / pags;
 $users .= " LIMIT ". pags * ($page -1) . " , " . pags;
 $answer = mysqli_query($conn, $users);

 $rows =  mysqli_fetch_all($answer, MYSQLI_ASSOC);
 $rows['pages_total'] = $pages_total;
 
 print_r(json_encode($rows));
 ?>