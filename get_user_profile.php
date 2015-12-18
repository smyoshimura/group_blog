<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
session_start();
if(!empty($_POST)){
    $id=$_POST['user_id'];
    $token = $_POST['token'];

    if(isset($token)){
        if ($token === $_SESSION['token']) {
            $query ="SELECT `id`, `username`, `email`, `picture`, `timestamp` FROM `users` WHERE `id`=$id";
            $info=mysqli_query($conn, $query);
            if(mysqli_num_rows($info)>0){
                while($row=mysqli_fetch_assoc($info)){
                    $output[]=$row;
                }
                $result=['success'=>1, 'data'=>$output];
            }
            else{
                $result=['success'=>0, 'error'=>'No user information'];
            }
        } else {
            $result=['success'=>0, 'No token access'];
        }
    }
}
if(isset($result)){
    print_r(json_encode($result));
}
else{
    $result=['success'=>0, 'error'=>'Request not received'];
}
?>