<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
session_start();
if(!empty($_POST)){
    $query ="SELECT `id`, `username`, `email`, `picture`, `timestamp` FROM `users` WHERE `id`=$id";
    $id=$_POST['user_id'];
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
}
if(isset($result)){
    print_r(json_encode($result));
}
else{
    $result=['success'=>0, 'error'=>'Request not received'];
}
?>