<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
if(!empty($_POST)) {
    $id = $_POST['blog_id'];
    $token = null;
    if ($token === null){
       $public = 1;
    }
    if(isset($_SESSION['token'])){
        $token = $_SESSION['token'];
        $public = 0;
    }
    $query = "select * from `blogs` where `id`=$id `public`=$public";
    $result = mysqli_query($conn, $query);
    print_r($_POST);
}
?>