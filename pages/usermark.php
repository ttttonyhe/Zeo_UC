<?php 
/*
Template Name: 用户收藏列表
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    if(!is_user_logged_in()){
        wp_redirect( site_url("/updates") );
    }else{
?>

<div class="cap-title" style="margin-top: 10%;margin-bottom: 80px;width: 810px;">
    <h1>用户收藏</h1>
    <p>您在小半的收藏内容</p>
    <a href="updates"><em class="up-author-status-1" style="display: block;margin-top: -40px;margin-left: 190px;width: 110px;"><i class="icon-left-big"></i>返回中心</em></a>
</div>
<?php
    global $current_user;
    $id = $current_user -> ID;
    
    /* 文章收藏 */
    $posts = get_the_author_meta('mark_post',$id);
    $posts_array = explode(',',$posts);
    $posts_array_length = count($posts_array);
    if($posts_array_length == 1){ //当只存在一个长度时
        if($posts_array[0] == ''){ //判断是否为空
            $av = 1;
        }else{
            $posts_array[0] = $posts; //否则不做处理
        }
    }
    /* 文章收藏结束 */
    
    /* 作者收藏 */
    $authors = get_the_author_meta('mark_author',$id);
    $authors_array = explode(',',$authors);
    $authors_array_length = count($authors_array);
    if($authors_array_length == 1){ //当只存在一个长度时
        if($authors_array[0] == ''){ //判断是否为空
            $av1 = 1;
        }else{
            $authors_array[0] = $authors; //否则不做处理
        }
    }
    /* 作者收藏结束 */
?>
<h1 class="usermark_cate">文章收藏</h1>
<?php
if(count($posts_array)>=1 && !$av){ //判断是否存在内容
    for($i=0;$i<count($posts_array);$i++){ //循环输出数组
        $postid = $posts_array[$i]; //获取文章 ID
        $img_id = get_post_thumbnail_id($postid); //获取文章特色图像 ID
        $img_url = wp_get_attachment_image_src($img_id); //获取图像
        $img_url = $img_url[0]; //获取图像 URL
        $author = get_post($postid)->post_author; //获取文章作者 ID
        $author = get_the_author_meta('display_name',$author); //获取文章作者名
        $title = get_post($postid)->post_title; //获取文章 ID
        $url = get_post($postid)->post_name; //获取文章 URL
        $time = get_post($postid)->post_date; //获取文章发布时间
?>
<div class="warp-post-embed" style="width: 805px;">
    <a href="<?php echo $url; ?>" target="_blank" >
        <div class="embed-bg" style="background-repeat: no-repeat;background-size:cover;background-position:center;background-image:url(<?php echo $img_url; ?>?imageView2/2/w/120/h/120/format/jpg/interlace/1/q/100|imageslim)">
        </div>
        <div class="embed-content">
            <span><?php echo $time; ?></span>
            <h2 style="margin-top: 2%;"><?php echo $title; ?></h2>
            <p><?php echo $author; ?></p>
        </div>
    </a>
</div>
<?php }}else{ //无内容则输出占位 ?>
<div class="uk-placeholder uk-text-center" style="width: 805px;margin-left: auto;margin-right: auto;">暂 无 收 藏</div>
<?php } ?>

<br/><br/>

<h1 class="usermark_cate">作者关注</h1>
<div style="width: 805px;margin-left:auto;margin-right:auto;margin-bottom: 100px;">
<?php
if(count($authors_array)>=1 && !$av1){ //判断是否存在内容
    for($i=0;$i<count($authors_array);$i++){ //循环输出数组
        $authorid = $authors_array[$i]; //获取作者 ID
        $author_meta = get_userdata($authorid); //获取作者信息
        $author_avatar = get_avatar($authorid,96,'','user-avatar',array('width'=>80,'height'=>80,'rating'=>'X','class'=>array('mark-avatar'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); //获取作者头像 HTML
        $author_name = $author_meta -> display_name; //获取作者名
	    $author_url = 'https://www.zeo.im/author/'.$author_meta -> user_nicename; //获取作者 URL
	    $author_des = $author_meta -> description; //获取作者描述
	    if(empty($author_des)){
	        $author_des = '一位小半作者'; //描述为空则为默认
	    }
?>

<a class="sub-div" href="<?php echo $author_url; ?>" target="_blank">
<div style="display:flex">
    <div>
        <?php echo $author_avatar; ?>
    </div>
    <div style="margin-left: 20px;padding-top: 6px;">
        <p class="sub-name"><?php echo $author_name; ?></p>
        <p class="sub-des"><?php echo $author_des; ?></p>
        </div>
    </div>
</a>

<?php }}else{ //为空则输出占位 ?>
<div class="uk-placeholder uk-text-center" style="width: 805px;margin-left: auto;margin-right: auto;">暂 无 关 注</div>
<?php } ?>
</div>
<?php get_footer(); }?>