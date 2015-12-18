<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('db_connect.php');

//$email = 'bishop@gmail.com';
//$d_name = 'bishop_dude';
//$pass = 'bishop1';

$email = $_POST['email'];
$d_name = $_POST['display_name'];
$pass = md5($_POST['password']);

$query = "INSERT INTO users (username, password, email, timestamp) VALUES('$d_name','$pass','$email',CURRENT_TIMESTAMP)";
mysqli_query($conn, $query);

if (mysqli_affected_rows($conn) > 0) {
    $uid = mysqli_insert_id($conn);
    $result = ['success'=>1, 'data'=>['uid'=>$uid, 'email'=>$email, 'display_name'=>$d_name]];
} else {
    $result = ['success'=>0, 'data'=>[], 'error'=>'database error'];
}

if (isset($result)) {
    print_r(json_encode($result));
}
else {
    $result = ['success'=>0, 'data'=>[], 'errors'=>'fatal operation error'];
    print_r(json_encode($result));
}