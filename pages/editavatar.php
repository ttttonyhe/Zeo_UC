<?php 
/*
Template Name: 用户头像修改
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    if(!is_user_logged_in()){
        wp_redirect( site_url("/updates") );
    }else{
?>
<?php

//获取文件后缀函数
function getsuffix($files){
    $suffixarray= explode('.',$files);
    $suffixarray = array_reverse($suffixarray); 
    return $suffixarray [0];
}

$error = '';

if(!empty($_FILES['file']['name'])){
/* 变量赋值 */
$files_type = $_FILES["file"]["type"];
$files_error = $_FILES["file"]["error"];
$files_name = $_FILES["file"]["name"];
$files_suff = getsuffix($files_name);
$files_name = time().'.'.$files_suff;
$files_size = $_FILES["file"]["size"];

global $current_user;
$user_id = $current_user->ID;

/* 变量赋值结束 */

if ((($files_type == "image/png") || ($files_type == "image/gif") || ($files_type == "image/jpeg") || ($files_type == "image/pjpeg")) && ($files_size < 2097152)){
    
  if ($_FILES["file"]["error"] > 0)
    {
        $error .= '上传错误 | <a href="mailto:he@holptech.com">点此报告问题</a><br />';
    }
  else
    {
    if (file_exists("wp-content/uploads/avatar/" . $files_name))
      {
          $error .= '图片已存在 | <a href="mailto:he@holptech.com">点此报告问题</a><br />';
      }
    else
      {
          move_uploaded_file($_FILES["file"]["tmp_name"],
          "wp-content/uploads/avatar/" . $files_name);
          $files_url = 'https://www.zeo.im/wp-content/uploads/avatar/'.$files_name;
          $status = update_user_meta( $user_id, 'avatar', $files_url );
          if($status) $error .= '头像修改成功<br />'; else $error .='头像修改失败<br />';
      }
    }
  }
else
  {
      $error .= '图片类型不支持或图片超过2MB<br />';
  }
}
?>

<style>
.user-form{
    display: block;
    margin-left: auto;
    margin-right: auto;
    background: #fff;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    width: 25%;
    padding: 70px 0 70px 0;
}

@media screen and (max-width:767px){
    .user-form{
        width: 90%;
    }
}

.input{
    border: none !important;
    text-align: center !important;
    width: 217px !important;
    margin-left: auto !important;
    margin-right: auto !important;
    padding-top: 40px !important;
    padding-bottom: 80px !important;
}

p.user-error {
  margin: 16px 0;
  padding: 12px;
  background-color: #ffebe8;
  border: 1px solid #c00;
  font-size: 12px;
  line-height: 1.4em;
}

.user-reg{
    text-align: center;
    margin-top: 15%;
}
.submit{
    background: #333;
    color: #ffffff;
    padding: 8px 40px 8px 40px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 30px;
}

.submit-log{
    background: #999;
    color: #ffffff !important;
    padding: 8px 21px 8px 21px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 30px;
    margin-left: 10px;
}
</style>

<script>
    function close_error(){
        var change=document.getElementById('error');
        change.style.display="none";
    }
</script>


<?php the_content(); ?>
<?php if(!empty($error)) {
  echo '<div id="error" class="intro"><div class="intro-bg animations-fadeIn-bg"></div><div id="close_error" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)"><div class="intro-content" style="width: 510px;max-height: calc(100vh - 5px * 2);"><div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="report_container"><div class="intro-content-header"><div class="intro-content-title">提示</div></div><p style="text-align: center;font-size: 19px;">'.$error.'</p><div class="intro-content-button"><button onclick="close_error();" class="intro-button">关闭提示</button></div></div></div></div></div>';
} ?>
<?php 
    global $current_user;
	$author_id = $current_user->ID;
?>

<form class="user-reg user-form" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post" enctype="multipart/form-data">
    <?php echo get_avatar($author_id,96,'','user-avatar',array('width'=>120,'height'=>120,'rating'=>'X','class'=>array('uk-card','uk-card-default','uk-card-hover','uk-card-body','up-avatar-img'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); ?>
    <input class="input" type="file" name="file" id="file" /> 
    <input class="submit" type="submit" name="submit" value="修改头像" />
    <a href="https://www.zeo.im/updates" class="submit-log">返回用户中心</a>
</form>
<?php get_footer(); }?>