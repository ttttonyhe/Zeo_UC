<?php
/* Template Name: mark_delete */ 
require 'header-user.php'; 
    wp_no_robots();
    
    header("charset=utf-8");  //设置字符串类型
    $id = $_POST['id']; //获取用户 ID
    $post = $_POST['post_de']; //获取要删除的文章 ID
    $posts = get_the_author_meta('mark_post',$id); //获取用户收藏字段
    
    //获得现有数组
    $posts_array = explode(',',$posts);
    
    //获取现有数组长度
    $posts_array_length = count($posts_array);
    
    if($posts_array_length == 1){ //如果长度为1
        $posts_array[0] = $posts; //直接复制到0下标
        $posts_array_length = 0; //长度为零
    }else {
        $posts_array_length = ($posts_array_length - 1); //否则获取长度
    }
    
    //交换数组下标与值
    $posts_array_temp = array_flip($posts_array);
    
    //获取要删除的值的下标
    $post_de_key = $posts_array_temp[$post];
    
    //交换要删除的值与数组最后一个下标的值
    $temp = $posts_array[$post_de_key];
    $posts_array[$post_de_key] = $posts_array[$posts_array_length];
    $posts_array[$posts_array_length] = $temp;
    
    //删除数组最后一个下标
    array_pop($posts_array);
    
    //删除数组空值
    $posts_array = array_filter($posts_array);
    
    //转换数组为字符串
    $posts = implode(',',$posts_array);
    
    //更新用户数据
    update_user_meta( $id, 'mark_post', $posts );

    get_footer();
?>