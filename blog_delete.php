<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('db_connect.php');

$user_id = $_SESSION['user_id'];
$article_id = $_POST['article_id'];


$query = "DELETE FROM blogs WHERE id=$article_id";
mysqli_query($conn, $query);

if (mysqli_affected_rows($conn)>0) {
    $result = ['success'=>true, 'del_id'=>$article_id];
    print_r(json_encode($result));
}
else {
    $result = ['success'=>false, 'error'=>'Operation failed'];
    print_r(json_encode($result));
}

?>