<?php
$blog = array('title'=>'this is the title', 'text'=>'text', 'tags'=>'tag 1, tag 2, tag 3', 'owner_id'=>'1', 'public'=>'1');
//IF BLOG IS CREATED AND PUBLISHED RIGHT AWAY AND PUBLIC
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text','string of tags',1,NOW(),NOW(),NOW(),1,0)";

//IF BLOG IS CREATED AND USER WANTS TO PUBLISH IT LATER
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text', 'string of tags',1,NOW(),null,NOW(),1,0)";

//IF BLOG IS CREATED AND PUBLISHED RIGHT AWAY AND PRIVATE
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text', 'string of tags',1,NOW(),NOW(),NOW(),0,0)";

//IF BLOG IS CREATED AND USER WANTS TO PUBLISH IT LATER AND IT IS PRIVATE
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text', 'string of tags',1,NOW(),null,NOW(),1,0)";

function seperateTags($blog){
?>
<pre>
<?php
$tags = explode(',',$blog['tags']);
foreach($tags as $tag){
    $query = "INSERT INTO `tags`(`blog_id`, `owner`, `tag`) VALUES ('blog id','owner id','{$tag}')";
    print_r($query . '<br>');
}

?>
    </pre>
<?
}

seperateTags($blog);
?>
<pre>
<?php
print_r($blog);
?>
    </pre>


