<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require('connect.php');
$query = "select * from `blogs`";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        $output[]=$row;
    };
};
print(json_encode($output));
?>