<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
session_start();
require('db_connect.php');

$user_id = $_SESSION['user_id'];
$blog_ids = $_POST['blog_ids'];

// Query to delete blog based on blog IDs selected
$query = "DELETE FROM blogs WHERE id=$values";

// Iterate through blog IDs to delete while running the query
foreach ($blog_ids as $values) {
    mysqli_query($conn, $query);
}

// Check if query operation deleted at least 1 row, otherwise output errors
if (mysqli_affected_rows($conn)>0) {
    $result = ['success'=>true, 'data'=>['ids'=>$blog_ids]];
    print_r(json_encode($result));
}
else {
    $errors = ['DB error', 'ID error', 'Operation error'];
    $result = ['success'=>false, 'data'=>['ids'=>$blog_ids], 'errors'=>$errors];
    print_r(json_encode($result));
}

?>