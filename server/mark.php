<?php
/* Template Name: mark */ 
require 'header-user.php'; 
    wp_no_robots();
    
    header("charset=utf-8");  //设置字符串类型
    $id = $_POST['id']; //获取用户 ID
    $post = $_POST['post']; //获取要收藏的文章 ID
    $posts = get_the_author_meta('mark_post',$id); //获取用户收藏字段
    $posts .= ','.$post; //在字段后添加当前文章 ID
    $posts_array = explode(',',$posts); //转换为数组
    $posts_array = array_unique($posts_array); //删除数组重复值
    $posts_array = array_filter($posts_array); //删除数组空值
    $posts = implode(',',$posts_array); //转换回字符串
    update_user_meta( $id, 'mark_post', $posts ); //更新字段

    get_footer();
?>