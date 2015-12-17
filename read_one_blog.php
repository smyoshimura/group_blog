<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');

if(!empty($_POST)) {
    $info = mysqli_query($conn, $query);
    $output=[];
    $id=$_POST['blog_id'];
    $token = $_SESSION['auth_token'];
    if (isset($token)){
        if($token === $_SESSION['token']){
            $query = "select `id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp` from `blogs` where `id`=$id";
        }
        else{
            $public = 1;
            $query = "select `id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp` from `blogs` where `id`=$id `public`=$public";
        }
    }
    if(mysqli_num_rows($info)>0){
        while($row=mysqli_fetch_assoc($info)){
            $output[$row['owner_id']][]=$row;
        };
    };
    print(json_encode($output));
}
?>