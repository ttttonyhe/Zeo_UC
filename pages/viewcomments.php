<?php 
/*
Template Name: 用户评论列表
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    if(!is_user_logged_in()){
        wp_redirect( site_url("/updates") );
    }else{
?>

<div class="cap-title" style="margin-top: 10%;margin-bottom: 80px;width: 810px;">
    <h1>用户评论</h1>
    <p>您在小半的所有评论</p>
    <a href="updates"><em class="up-author-status-1" style="display: block;margin-top: -40px;margin-left: 190px;width: 110px;"><i class="icon-left-big"></i>返回中心</em></a>
</div>
<?php
    global $current_user;
    $id = $current_user -> ID; //获取当前用户 ID
    $args = array(
        'user_id' => $id,
    );
    $comments = get_comments( $args ); //获取用户所有评论
    if(count($comments)>=1){
?>
<div style="margin-bottom: 10%;">
<?php 
    foreach ( $comments as $comment ) : //输出数组
        $content = $comment->comment_content; //获取评论内容
        $title = get_post($postid)->post_title; //获取评论文章名
        $url = get_post($postid)->post_name; //获取评论文章 URL
        $time = lb_time_since(strtotime($comment->comment_date)); //获取评论发布时间
?>
<a href="<?php echo $url; ?>">
<div class="uk-grid-match" uk-grid style="margin-bottom: 25px;">
    <div style="margin-left: auto;margin-right: auto;">
        <div class="uk-card uk-card-default uk-card-hover uk-card-body" style="width: 850px;border-radius: 5px;">
            <div style="padding-left: 20px;border-left: #F2F2F2 solid 4px;color: #757575;">
                <span style="font-size: 1.8rem;line-height: 30px;"><?php echo $time; ?></span>
                <h2 class="uk-card-title" style="font-size: 2rem;font-weight: 600;color:#777">于文章: <?php echo $title; ?> 中说道</h2>
            </div>
            <p style="font-size: 3rem;margin-top: 15px;color: #333;font-weight: 600;"><?php echo $content; ?></p>
        </div>
    </div>
</div>
</a>
<?php
    endforeach;
?>
</div>
<?php }else{ //为空则输出占位 ?>
<div class="uk-placeholder uk-text-center" style="width: 810px;margin-left: auto;margin-right: auto;">暂 无 评 论</div>
<?php } ?>

<?php get_footer(); }?>