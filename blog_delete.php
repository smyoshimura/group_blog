<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('db_connect.php');

$user_id = $_SESSION['user_id'];
$blog_ids = $_POST['blog_ids'];

foreach ($blog_ids as $values) {
    $query = "DELETE FROM blogs WHERE id=$values";
    mysqli_query($conn, $query);
}

if (mysqli_affected_rows($conn)>0) {
    $result = ['success'=>true, 'data'=>['ids'=>$blog_ids]];
    print_r(json_encode($result));
}
else {
    $errors = ['DB error', 'ID error'];
    $result = ['success'=>true, 'data'=>['ids'=>$blog_ids], 'errors'=>$errors];
    print_r(json_encode($result));
}

?>