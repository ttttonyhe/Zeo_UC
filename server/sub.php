<?php
//关注作者
function sub_author() {
 // 如果 action ID 是 load_post, 并且传入的必须参数存在, 则执行响应方法
 if($_GET['author'] != '' && $_GET['id'] != '') {
 $id = $_GET["id"];
 $author = $_GET["author"];
 $authors = get_the_author_meta('mark_author',$id);
 $authors .= ','.$author;
 $authors_array = explode(',',$authors);
 $authors_array = array_unique($authors_array);
 $authors_array = array_filter($authors_array); //删除数组空值
 $authors = implode(',',$authors_array);
 update_user_meta( $id, 'mark_author', $authors );
 
 echo 'success';
 die();
 }
}
// 将接口加到 init 中
add_action('init', 'sub_author');

    
    
//取消关注作者
function sub_de_author() {
 // 如果 action ID 是 load_post, 并且传入的必须参数存在, 则执行响应方法
 if($_GET['author_de'] != '' && $_GET['id'] != '') {
     
    $id = $_GET['id'];
    $author_de = $_GET['author_de'];
    $authors = get_the_author_meta('mark_author',$id);
    
    //获得现有数组
    $authors_array = explode(',',$authors);
    
    //获取现有数组长度
    $authors_array_length = count($authors_array);
    
    if($authors_array_length == 1){
        $authors_array[0] = $authors;
        $authors_array_length = 0;
    }else {
        $authors_array_length = ($authors_array_length - 1);
    }
    
    //交换数组下标与值
    $authors_array_temp = array_flip($authors_array);
    
    //获取要删除的值的下标
    $author_de_key = $authors_array_temp[$author_de];
    
    //交换要删除的值与数组最后一个下标的值
    $temp = $authors_array[$author_de_key];
    $authors_array[$author_de_key] = $authors_array[$authors_array_length];
    $authors_array[$authors_array_length] = $temp;
    
    //删除数组最后一个下标
    array_pop($authors_array);
    
    //删除数组空值
    $authors_array = array_filter($authors_array);
    
    //转换数组为字符串
    $authors = implode(',',$authors_array);
    
    //更新用户数据
    update_user_meta( $id, 'mark_author', $authors );
    
    echo 'success';
    die();
 }
}
// 将接口加到 init 中
add_action('init', 'sub_de_author');
?>