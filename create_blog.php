<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

/*When this is all put together, it should be wrapped in an if($_POST){} or if($_GET){}
and $blog should be equal to json_decode($_POST)
*/
//$blog = array('title' => 'title fun woooo', 'text' => 'text again and more', 'tags' => 'please, work', 'owner_id' => '2', 'public' => '1', 'publish' => 'yes');
$blog = array('title' => $_POST['title'], 'text' => $_POST['text'], 'tags' => $_POST['tags'], 'owner_id' => '2', 'public' => $_POST['public'], 'publish' => 'yes');

function create_blog($blog)
{
    require('db_connect.php');
    //require('blog_connect.php');
    //this checks the conditions of the blog and adds them to the table
    if (($blog['publish'] == null) && ($blog['public'] == 1)) {
        //Condition: this blog is public & will be published later
        $query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'{$blog['title']}','{$blog['text']}','{$blog['tags']}',1,NOW(),null,NOW(),1,0)";
    } elseif (($blog['publish'] == null) && ($blog['public'] == 0)) {
        //Condition: this blog is private and will be published later
        $query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'{$blog['title']}','{$blog['text']}','{$blog['tags']}',1,NOW(),null,NOW(),1,0)";
    } elseif (($blog['publish'] != null) && ($blog['public'] == 1)) {
        //Condition: this blog is public and will be published now
        $query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'{$blog['title']}','{$blog['text']}','{$blog['tags']}',1,NOW(),NOW(),NOW(),1,0)";
    } elseif (($blog['publish'] != null) && ($blog['public'] == 0)) {
        //Condition: this blog is private and will be published now
        $query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'{$blog['title']}','{$blog['text']}','{$blog['tags']}',1,NOW(),NOW(),NOW(),0,0)";

    }
    mysqli_query($conn, $query);
    //this query returns the id & timestamp of the blog
    $query3 = "SELECT `id`, `created_timestamp`, `owner_id` FROM blogs ORDER BY id DESC LIMIT 1";
    $rows = mysqli_query($conn, $query3);
    if (mysqli_num_rows($rows) > 0) {
        $success = true;
        while ($row = mysqli_fetch_assoc($rows)) {
            $data = array(
                'id' => $row['id'],
                'ts' => $row['created_timestamp']
            );
            $author = $row['owner_id'];

            $response = array('success'=>$success, 'data'=>$data);
        }
    } else {
        $errors = array();
        $errors[] = 'there was no id returned';
        $success = false;
        $response = array('success'=>$success, 'data'=>[], 'error' => $errors);

    }
    //this separates the tags and adds them into the tag table
    $tags = explode(',', $blog['tags']);
    foreach ($tags as $tag) {
        $query2 = "INSERT INTO `tags`(`blog_id`, `owner`, `tag`) VALUES ('{$data['id']}','{$author}','{$tag}')";
        mysqli_query($conn, $query2);
    }

    if (isset($response)) {
        print_r(json_encode($response));
    }
    else {
        $response = ['success'=>0, 'data'=>[], 'error'=>'operation error'];
        print_r(json_encode($response));
    }

//    $jsonresponse = json_encode($response);
//    //echo $jsonresponse;
//    return $jsonresponse;
}

create_blog($blog);

?>



