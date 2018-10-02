<?php

/*
Template Name: 个人动态
*/

require 'header-user.php'; ?>
<?php if($_GET['from']==1){ ?>
    <script language=javascript>history.go(-2);</script>
<?php }elseif($_GET['from']==2){ ?>
    <script language=javascript>location.href="https://www.zeo.im/talklist";</script>
<?php } ?>
<?php if(wp_is_mobile()){ ?>
<div class="uk-animation-toggle uk-align-center up-avatar">
    <img src="https://static.zeo.im/gh_0aef3deaf163_430.jpg" style="width: 100px;height: 100px;">
</div>
<div style="text-align: center;">
	<h2 class="up-author-name" style="font-size: 1.65rem;">扫描二维码使用微信小程序</h2>
    <em class="up-author-status" style="margin-top: 10px;font-size: 1.2rem;font-weight: 600;"><i class="icon-star-empty" style="
    color: #CDDC39;
"></i>Zeo小半</em><p>
</p></div>
<?php }else{ ?>
<?php 
if(!is_user_logged_in()) {
?>
<script>window.location.href='login';</script>
<?php }else{ ?>
<?php 
    global $current_user;
    wp_get_current_user();
	$author_id = $current_user->ID;
	$author_name = $current_user->nickname;
	$user_email = $current_user->user_email;
	if($current_user->description){
	    $des = $current_user->description;
	}else{
	    $des = '一位小半订阅者';
	}
	if(user_can($author_id,'editor') || user_can($author_id,'manager') || user_can($author_id,'capturer')){
?>	
<script type="text/javascript"> window.location.href = 'https://www.zeo.im/writers';</script>
<?php } ?>

<!-- 头像更换 -->
<script>
    function goingchange(){
        var change = document.getElementById('hover');
        change.style.display = 'initial';
    }
    function neverchange(){
        var change = document.getElementById('hover');
        change.style.display = 'none';
    }
</script>
<!-- 头像更换结束 -->



<div class="cap-title" style="margin-top: 10%;margin-bottom: 40px;">
    <h1>用户动态</h1>
    <p>您在小半的足迹</p>
    <a href="<?php echo wp_logout_url(get_permalink()); ?>"><em class="up-author-status-1" style="display: block;margin-top: -40px;margin-left: 160px;width: 110px;"><i class="icon-lock-open"></i>退出登录</em></a>
</div>
<div class="uk-container cap-sin-container" style="margin-top: 1%;">
    <div>
        <div style="width: 100%;">
            <div class="uk-card uk-card-default uk-width-1-2@m" style="height: 300px;width: 100%;">
                <div class="uk-card-header uk-flex" style="border:  none;height: 100%;padding-top: 0px;">
                    <div class="uk-grid-small uk-flex-middle uk-grid" style="width: 100%;">
                        <div class="uk-width-auto uk-first-column" onmouseover="goingchange();" onmouseout="neverchange();">
                            <?php echo get_avatar($author_id,96,'','user-avatar',array('width'=>120,'height'=>120,'rating'=>'X','class'=>array('uk-card','uk-card-default','uk-card-hover','uk-card-body','up-avatar-img'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); ?>
                            <div style="position: absolute;top: 80px;left: 55px;background-color: rgba(0,0,0,.6);transition: all .5s;width: 120px;height: 120px;border-radius: 50%;text-align:  center;padding-top: 37px;font-size: 3.5rem;color: #fff;display:none" id="hover"><a style="color:#fff" href="https://www.zeo.im/editavatar" class="uk-animation-fade"><i class="icon-camera"></i></a></div>
                        </div>
                        <div class="uk-width-expand">
                            <div>
                                <h3 class="uk-card-title uk-margin-remove-bottom up-info-name" style="display:  inline-block;font-size: 4rem;font-weight:600;"><?php echo $author_name; ?></h3>
                                <em class="up-author-status-1"><i class="icon-ok-circled2"></i><?php echo user_level($author_id); ?></em>
                            </div>
                            <p class="cap-sin-des"><?php echo "$des"; ?></p>
                        </div>
                    </div>
                    <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 223px;margin-top: 40px !important;box-shadow: none;">
                        <div class="uk-flex">
                            <a href="https://www.zeo.im/editinfo" style="margin-right: 5px;margin-left: 5px;">
                                <div class="uk-card-hover uk-card uk-card-default uk-card-body" style="padding: 48.5px 46.5px;border: 3px solid #f1506e;"><i class="icon-pencil up-button-3"></i>
 
                                </div>
                            </a>
                            <a href="https://www.zeo.im/usermark" style="margin-right: 5px;">
                                <div class="uk-card-hover uk-card uk-card-default uk-card-body uk-margin-left" style="padding: 48.5px 46.5px;"><i class="up-button-2 icon-bookmarks"></i>
 
                                </div>
                            </a>
                            <a href="https://www.zeo.im/commentlist">
                                <div class="uk-card-hover uk-card uk-card-default uk-card-body uk-margin-left" style="padding: 48.5px 46.5px;"><i class="icon-chat-3 up-button-1"></i>
 
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-card-header uk-flex" style="border:  none;height: 100%;padding: 0;margin-top: 60px;margin-bottom: 200px;">
                <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 205px;padding-top: 65px;width: 49%;">
                    <div class="uk-flex">
                        <div>
                             <h1 style="font-weight: 600;">总评论</h1>
 
<span style="padding-left: 3px;">Comments</span>
 
                        </div>
                        <div class="uk-margin-left" style="
    margin-left: 90px !important;
"><i class="icon-chat-3 wt-icon-posts" style="colo:#ff85c0"></i><em class="wt-card-posts-post"><?php echo $author_comments = get_user_comments_count($author_id); ?></em></div>
                    </div>
                </div>
                <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 205px;padding-top: 65px;margin-top:  0 !important;width: 49%;margin-left: 2%;">
                    <div class="uk-flex">
                        <div>
                             <h1 style="font-weight: 600;">人气值</h1>
 
<span style="padding-left: 3px;">Popularity</span>
 
                        </div>
                        <div class="uk-margin-left" style="
    margin-left: 90px !important;
"><i class=" icon-award-2 wt-icon-posts" style="color:#5cdbd3"></i><em class="wt-card-posts-post"><?php $count=(int)$author_comments; echo $echo=(int)($count/3)+10; ?></em>
 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }} ?>
<?php get_footer(); ?>
