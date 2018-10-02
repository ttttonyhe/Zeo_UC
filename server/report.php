<?php
/* Template Name: report */ 
require 'header-user.php'; 
    wp_no_robots();
    
    header("charset=utf-8");  //设置字符串类型
    $id = $_POST['id']; //获取作者 ID
    $count = $_POST['count']; //获取作者已举报次数
    $count += 1; //增加已举报次数
    update_user_meta( $id, 'report_count', $count ); //更新作者字段

    get_footer();
?>