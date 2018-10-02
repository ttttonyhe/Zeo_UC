<?php 

/* Template Name: 自媒体中心 */ 

require 'header-user.php'; 

?>
<?php if(wp_is_mobile()){ ?>
<div class="uk-animation-toggle uk-align-center up-avatar">
    <img src="https://static.zeo.im/gh_0aef3deaf163_430.jpg" style="width: 100px;height: 100px;">
</div>
<div style="text-align: center;">
        <h2 class="up-author-name" style="font-size: 1.65rem;">扫描二维码使用微信小程序</h2>
 <em class="up-author-status" style="margin-top: 10px;font-size: 1.2rem;font-weight: 600;"><i class="icon-star-empty" style="
    color: #CDDC39;
"></i>Zeo小半</em>
    <p></p>
</div>
<?php }else{ ?>
<?php if(!is_user_logged_in()) { ?>
<script type="text/javascript">
    window.location.href = 'https://www.zeo.im/login';
</script>
<?php }else{ ?>
<?php     
        global $current_user; 
        $author_id = $current_user->ID; 
        $author_name = $current_user->nickname; 
        $user_email = $current_user->user_email; 
        $des = $current_user->description;
        $ranking = get_user_sort($author_id); 
    
        /*获取作者信息的几个函数
            //获取用户评论总数
            function get_user_comments_count( $user_id ) {
	           global $wpdb;
	           $user_id = (int) $user_id;
	           $sql     = "SELECT COUNT(*) FROM {$wpdb->comments} WHERE user_id='$user_id' AND         comment_approved = 1";
	           $coo     = $wpdb->get_var( $sql );
	           return ( $coo ) ? $coo-1: 0;
            }

            //获取用户发表的文章数量
            function num_of_author_posts( $user_id ){ //根据作者ID获取该作者的文章数量
                global $wpdb;
                $user_id = (int) $user_id;
                $sql = "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_author='$user_id' AND post_status = 'publish' ";
                $coo = $wpdb->get_var( $sql );
                return ( $coo ) ? $coo: 0;
            }
            function get_user_sort( $user_id ){
	       //获取所有用户
	       $users = get_users( array( 'fields' => 'ID') );
	       $user_post_num = array();
	       foreach ($users as $user) {
		      $user_posts = num_of_author_posts($user);
		      $user_post_num[next($users)] = $user_posts;
	       }
	       //获取当前用户的文章数量
	       $current_user_posts = num_of_author_posts( $user_id );
	       //根据文章数量排列用户数组
	       sort($user_post_num);
	       $sort = array_search( $current_user_posts, $user_post_num );
	       $percent_sort = round( ( ( $sort / (count( $user_post_num ) - 1) ) * 100 ), 0) . '%';
	       return $percent_sort;
        }
        */
    
        if(user_can($author_id,'subscriber')){
?>
<script type="text/javascript">
    window.location.href = 'https://www.zeo.im/updates';
</script>
<?php }else{ ?>
<div class="uk-container" style="height: 1293.09px;">
    <div class="uk-card uk-card-default uk-width-1-2@m wt-info">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle uk-grid uk-flex">
                <div class="uk-width-auto uk-first-column">
                    <a href="https://www.zeo.im/editavatar">
                        <?php echo get_avatar($author_id,96, '', 'user-avatar',array( 'width'=>70,'height'=>70,'rating'=>'X','class'=>array('uk-card','uk-card-default','uk-card-hover','uk-card-body','up-avatar-img'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); ?></a>
                </div>
                <div class="uk-width-expand">
                     <h3 class="uk-card-title uk-margin-remove-bottom wt-info-name"><?php echo "$author_name"; ?></h3>
 
                    <p class="uk-text-meta uk-margin-remove-top">
<em class="up-author-status wt-info-status"><i class="icon-star-empty" style="color: #CDDC39;"></i><?php echo user_level($author_id); ?></em>
                    </p>
                </div>
                <div><a href="https://www.zeo.im/editinfo" style="background: #ea1f62;padding: 14px 11px 10px 14px;border-radius: 100%;color: #fff;font-size: 3rem;box-shadow: 0 1px 2px rgba(0,0,0,0.1);"><i class="icon-edit"></i></a></div>
            </div>
        </div>
        <div class="uk-card-body">
            <p style="width: 100%;text-overflow: ellipsis;height: 53px;overflow: auto;">
                <?php echo "$des"; ?>
            </p>
        </div>
        <div class="uk-card-footer"> <a href="<?php echo wp_logout_url(get_permalink()); ?>" class="uk-button uk-button-text" style="font-size: 1.4rem;"><i class="icon-lock-open"></i>退出登录</a>
 
        </div>
    </div>
    <div class="uk-align-right wt-card-posts">
        <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 145px;">
            <div class="uk-flex">
                <div>
                    <h1 style="font-weight: 600;">文章发表</h1>
 
<span style="padding-left: 3px;">Posts</span>
                </div>
                <div class="uk-margin-left"><i class="icon-align-right wt-icon-posts"></i><em class="wt-card-posts-post"><?php echo num_of_author_posts($author_id); ?></em>
                </div>
            </div>
        </div>
        <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 145px">
            <div class="uk-flex">
                <div>
                    <h1 style="font-weight: 600;">评论总数</h1>
 
<span style="padding-left: 3px;">Comments</span>
                </div>
                <div class="uk-margin-left"><i class=" icon-comment-3 wt-icon-comments"></i><em class="wt-card-comments-comment"><?php echo $author_comments = get_user_comments_count($author_id); ?></em>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-align-left wt-card-author-posts">
        
        <?php $args=array( 'showposts'=>3, 'author' => $author_id ); query_posts($args); while ( have_posts() ) : the_post(); ?>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="<?php the_permalink(); ?>" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title"><?php the_title(); ?></h3></a>
 
                    <p class="wt-card-author-posts-des">
                        <?php echo wp_trim_words(get_the_excerpt(), 35); ++$count; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endwhile; wp_reset_query(); ?>
        <?php 
            /*
            * 接下来的是一些粗暴的操作
            * 不喜勿喷
            */
        ?>
        <?php if($count==1){ ?>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="#" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title">示例文章</h3></a>
 
                    <p class="wt-card-author-posts-des">此处将展示文章的描述，本列表只展示最新3篇文章。查看和修改更多文章请<a href="https://www.zeo.im/capturer"><b> 点击此处 </b></a>进入创作中心</p>
                </div>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="#" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title">示例文章</h3></a>
 
                    <p class="wt-card-author-posts-des">此处将展示文章的描述，本列表只展示最新3篇文章。查看和修改更多文章请<a href="https://www.zeo.im/capturer"><b> 点击此处 </b></a>进入创作中心</p>
                </div>
            </div>
        </div>
        <?php }elseif($count==2){ ?>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="#" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title">示例文章</h3></a>
 
                    <p class="wt-card-author-posts-des">此处将展示文章的描述，本列表只展示最新3篇文章。查看和修改更多文章请<a href="https://www.zeo.im/capturer"><b> 点击此处 </b></a>进入创作中心</p>
                </div>
            </div>
        </div>
        <?php }elseif($count==0){ ?>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="#" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title">示例文章</h3></a>
 
                    <p class="wt-card-author-posts-des">此处将展示文章的描述，本列表只展示最新3篇文章。查看和修改更多文章请<a href="https://www.zeo.im/capturer"><b> 点击此处 </b></a>进入创作中心</p>
                </div>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="#" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title">示例文章</h3></a>
 
                    <p class="wt-card-author-posts-des">此处将展示文章的描述，本列表只展示最新3篇文章。查看和修改更多文章请<a href="https://www.zeo.im/capturer"><b> 点击此处 </b></a>进入创作中心</p>
                </div>
            </div>
        </div>
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-grid uk-grid-stack" style="border-top: 2px solid #333;height: 177.7px;">
            <div class="uk-first-column" style="width: 90%;">
                <div class="uk-card-body"> <a href="#" target="_blank"><h3 class="uk-card-title wt-card-author-posts-title">示例文章</h3></a>
 
                    <p class="wt-card-author-posts-des">此处将展示文章的描述，本列表只展示最新3篇文章。查看和修改更多文章请<a href="https://www.zeo.im/capturer"><b> 点击此处 </b></a>进入创作中心</p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="uk-align-right" style="width: 45%;">
        <div style="margin-top: -818.7px;">
            <div class="uk-light uk-background-secondary uk-padding">
                <div class="uk-flex uk-flex-center">
                    <div class="uk-flex-left" style="margin-right: 145px;">
                        <h1 style="font-weight: 600;font-size: 3.6rem;"><?php if($ranking<=50){ echo '<i class="icon-award" style="color:#54FF9F;margin-left: -10px;"></i>铜牌'; }elseif($ranking<=90){ echo '<i class="icon-award" style="color:#FFFFF0;margin-left: -10px;"></i>银牌'; }else echo '<i class="icon-award" style="color:#FFD700;margin-left: -10px;"></i>金牌';  ?>作者</h1>
 
<span style="padding-left: 3px;">贡献已超过其余入驻作者</span>
                    </div>
                    <div class="uk-flex-right">
                        <button class="uk-button uk-button-default" style="margin-top: 15px;font-size: 1.5rem;font-weight: 800;">
                            <?php echo $ranking; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 223px;">
            <div class="uk-flex">
                <a href="https://www.zeo.im/commentlist" style="margin-right: 5px;margin-left: 5px;">
                    <div class="uk-card-hover uk-card uk-card-default uk-card-body up-card" style="padding: 48.5px 46.5px;">
                        <i class="icon-chat-3 up-button-1" style="font-size:4.3rem"></i>
                        <p class="up-text-1">我的评论</p>
                    </div>
                </a>
                <a href="https://www.zeo.im/usermark" style="margin-right: 5px;">
                    <div class="uk-card-hover uk-card uk-card-default uk-card-body uk-margin-left up-card" style="padding: 48.5px 46.5px;">
                        <i class="icon-bookmarks up-button-2" style="font-size:4.3rem"></i>
                         <p class="up-text-2">我的收藏</p>
                    </div>
                </a>
                <a href="https://www.zeo.im/capturer">
                    <div class="uk-card-hover uk-card uk-card-default uk-card-body uk-margin-left up-card" style="padding: 48.5px 46.5px;">
                        <i class="icon-pencil up-button-3" style="font-size:4.3rem"></i>
                         <p class="up-text-3">创作中心</p>
                    </div>
                </a>
            </div>
        </div>
        <?php if(!empty(get_the_author_meta('report_count',$author_id))){?>
        <div class="uk-margin uk-card uk-card-default uk-card-body" style="height: 55px;">
            <div class="uk-flex">
                <div>
                    <p style="font-weight: 600;margin-top: -15px;font-size: 20px;"><i class=" icon-attention" style="font-size: 25px;margin-right: 10px;"></i>您所发表的文章已被 <?php echo get_the_author_meta('report_count',$author_id); ?> 人举报</p>
                </div>
                </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php }}} ?>
<?php get_footer(); ?>