<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');

if(!empty($_POST)) {

    $output=[];
    $id=$_POST['blog_id'];
    $token =$_POST['token'];

    if (isset($token)){
        if($token === $_SESSION['token']){
            $query = "select `id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp` from `blogs` where `id`=$id";
        }
        else{
            $public = 1;
            $query = "select `id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp` from `blogs` where `id`=$id and `public`=$public";
        }
    }
    $info = mysqli_query($conn, $query);
    if(mysqli_num_rows($info)>0){
        while($row=mysqli_fetch_assoc($info)){
            //$output[$row['owner_id']][]=$row;
            $output[] = $row;
        };
    };

    print_r(json_encode($output));
}
?>