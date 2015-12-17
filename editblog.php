<?php

//$updates will be changed to the json object that is posted
$updates = array('blog id' => 1, 'auth_token' => 1, 'data' => array(
    'title' => '', 'text' => 'this is updated text', 'tags' => 'these are the updated tags', 'public' => 'false'));

function update_blog($updates)
{
    $data = array();
    //potential errors with the blog id
    if (empty($updates['blog id'])) {
        $error_messages[] = 'There needs to be a blog id to make an update';
        $success_id = false;
    } elseif (!is_int($updates['blog id'])) {
        $error_messages[] = 'This is not a valid blog';
        $success_id = false;
    } else {
        $blog_id = $updates['blog id'];
        /*TODO WRITE QUERY TO CHECK THIS BLOG ID ACTUALLY EXISTS.
       In this statement write another if statement and check if blog associated with blog id exists.
        if not, success is false and error message is 'this blog post does not exist'
        */
        $success_id = true;
    }
    //potential errors with the auth_token
    if (empty($updates['auth_token'])) {
        $error_messages[] = 'An authorization token is needed to edit a blog';
        $success_auth = false;
    } //i'm not sure how the auth token is supposed to be validated. This condition will need to be edited
    elseif (!is_int($updates['auth_token'])) {
        $error_messages[] = 'This authorization token is incorrect';
        $success_auth = false;
    } else {
        $success_auth = true;
    }

    if ((!$success_id) || (!$success_auth)) {
        $success = false;
    } elseif (($success_id) && ($success_auth)) {
        $success = true;
        $updateString = array();
        foreach ($updates['data'] as $editedItem => $edit) {
            if (!empty($edit)) {
                array_push($updateString, "`$editedItem` = '{$edit}' ");
                $data[] = $editedItem;
            }
        }
        $updateString = implode(',', $updateString);
        require ('blog_connect.php');
        $query = 'UPDATE `blogs` SET ' . "{$updateString}" . 'WHERE `id` = ' . $blog_id;
        $rows = mysqli_query($conn, $query);
        if (mysqli_num_rows($rows) > 0) {
            while ($row = mysqli_fetch_assoc($rows)) {
                print_r($row);
            }
        } else {
            $success = false;
            $error_messages[] = 'unable to connect';
        }
    }


    if (!$success) {
        $response = array('success' => $success, 'data' => $data, 'errors' => $error_messages);
    } else {
        $response = array('success' => $success, 'data' => $data);
    }

    return json_encode($response);
}

update_blog($updates);