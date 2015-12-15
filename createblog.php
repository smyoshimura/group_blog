<?php
$blog = array('title'=>'', 'text'=>'', 'tags'=>'', 'owner_id'=>'', 'public'=>'');
//IF BLOG IS CREATED AND PUBLISHED RIGHT AWAY AND PUBLIC
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text','string of tags',1,NOW(),NOW(),NOW(),1,0)";

//IF BLOG IS CREATED AND USER WANTS TO PUBLISH IT LATER
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text', 'string of tags',1,NOW(),null,NOW(),1,0)";
    //When the user updates the post set 'id' to the id of the post
$query = "UPDATE `blogs` SET `published_timestamp`= NOW() WHERE `id` = 2";

//IF BLOG IS CREATED AND PUBLISHED RIGHT AWAY AND PRIVATE
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text', 'string of tags',1,NOW(),NOW(),NOW(),0,0)";

//IF BLOG IS CREATED AND USER WANTS TO PUBLISH IT LATER AND IT IS PRIVATE
$query = "INSERT INTO `blogs`(`id`, `title`, `text`, `tags`, `owner_id`, `created_timestamp`, `published_timestamp`, `edited_timestamp`, `public`, `soft_delete`) VALUES (null,'title','text', 'string of tags',1,NOW(),null,NOW(),1,0)";