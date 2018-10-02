<?php 
/*
Template Name: 用户登录
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    if(is_user_logged_in()){
        wp_redirect( site_url("/updates") );
    }else{
?>
<?php

if(!isset($_SESSION))
  session_start();
  
if( isset($_POST['user_token']) && ($_POST['user_token'] == $_SESSION['user_token'])) {
  $error = '';
  $secure_cookie = false;
  $user_name = sanitize_user( $_POST['log'] );
  $user_password = $_POST['pwd'];
  if ( empty($user_name) || ! validate_username( $user_name ) ) {
    $error .= '<strong>错误</strong>：请输入有效的用户名。<br />';
    $user_name = '';
  }
  
  if( empty($user_password) ) {
    $error .= '<strong>错误</strong>：请输入密码。<br />';
  }
  
  if($error == '') {
    // If the user wants ssl but the session is not ssl, force a secure cookie.
    if ( !empty($user_name) && !force_ssl_admin() ) {
      if ( $user = get_user_by('login', $user_name) ) {
        if ( get_user_option('use_ssl', $user->ID) ) {
          $secure_cookie = true;
          force_ssl_admin(true);
        }
      }
    }
	  
    if ( isset( $_GET['r'] ) ) {
      $redirect_to = $_GET['r'];
      // Redirect to https if user wants ssl
      if ( $secure_cookie && false !== strpos($redirect_to, 'updates') )
        $redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
    }elseif($_GET['from']==1){ //来自评论的登录
        $redirect_to = 'https://www.zeo.im/updates?from=1';
    }elseif($_GET['from']==2){ //来自谈否的登录
        $redirect_to = 'https://www.zeo.im/updates?from=2';
    }else{
        $redirect_to = 'https://www.zeo.im/updates';
    }
	
    if ( !$secure_cookie && is_ssl() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
      $secure_cookie = false;
	
    $creds = array();
    $creds['user_login'] = $user_name;
    $creds['user_password'] = $user_password;
    $creds['remember'] = !empty( $_POST['rememberme'] );
    $user = wp_signon( $creds, $secure_cookie );
    if ( is_wp_error($user) ) {
      $error .= $user->get_error_message();
    }
    else {
      unset($_SESSION['user_token']);
      wp_safe_redirect($redirect_to);
    }
  }

  unset($_SESSION['user_token']);
}

$rememberme = !empty( $_POST['rememberme'] );
  
$token = md5(uniqid(rand(), true));
$_SESSION['user_token'] = $token;
?>
<?php the_content(); ?>
<style>
.user-form{
    display: block;
    margin-left: auto;
    margin-right: auto;
    background: #fff;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    width: 565px;
    padding: 70px 30px 70px 30px;
}
p.user-error {
  margin: 16px 0;
  padding: 12px;
  background-color: #ffebe8;
  border: 1px solid #c00;
  font-size: 12px;
  line-height: 1.4em;
}
.user-log label {
  color: #777;
  font-size: 16px;
  cursor: pointer;
  text-align: left;
  margin-bottom: 15px;
  margin-left: 105px;
}
.user-log .input {
    margin: 0;
    color: #555;
    font-size: 24px;
    padding: 10px;
    background: #fbfbfb;
    height: 45px;
    border: 1px solid #e1e3e5;
    border-radius: 4px;
    margin-top: 5px;
    margin-bottom: 10px;
    font-weight: 300;
    transition: all .3s;
}

.user-log .input:focus{
    border: 1px solid #444;
}

.user-log .input:hover{
    border: 1px solid #666;
}

.user-log{
    text-align: left;
    margin-top: 10%;
}
.submit{
    padding: 8px 30px 8px 30px;
    border-radius: 3px;
    border: 1px solid rgb(40, 40, 40);
    color: rgb(40, 40, 40);
    background: #fff;
    font-size: 16px;
    font-weight: 600;
    transition: all .3s;
}
.submit:hover{
    background: rgb(40, 40, 40);
    color: #fff;
}
.submit-reg{
    padding: 8px 20px 8px 20px;
    border-radius: 3px;
    border: 1px solid #9ea2a8;
    color: #7d7d7d;
    background: #fff;
    font-size: 16px;
    margin-left: 10px;
}

.form-div{
    text-align:  left;margin-left: 105px;margin-bottom: 40px;
}

.form-submit{
    margin-left: 105px;
}

@media screen and (max-width:767px){
    .user-form{
        margin-top: 20%;
        width: 100%;
    }
    .form-div{
        margin-left: 0px;
    }
    .user-log label{
        margin-left: 0px;
    }
    .form-submit{
        margin-left: 0px;
    }
}


</style>
<script>
    function close_error(){
        var change=document.getElementById('error');
        change.style.display="none";
    }
</script>
<?php if(!empty($error)) {
  echo '<div id="error" class="intro"><div class="intro-bg animations-fadeIn-bg"></div><div id="close_error" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)"><div class="intro-content" style="width: 510px;max-height: calc(100vh - 5px * 2);"><div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="report_container"><div class="intro-content-header"><div class="intro-content-title">提示</div></div><p style="text-align: center;font-size: 19px;">'.$error.'</p><div class="intro-content-button"><button onclick="close_error();" class="intro-button">关闭提示</button></div></div></div></div></div>';
}
if (!is_user_logged_in()) { ?>
<form class="user-form user-log" name="loginform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <div class="form-div">
        <h2 style="font-weight: 800;font-size: 4rem;">用户登录</h2>
        <p style="font-size: 2rem;color: #999;">已有账号?进入小半吧</p>
    </div>
    <p>
      <label for="log">用户名或邮箱<br />
        <input type="text" name="log" id="log" class="input" value="<?php if(!empty($user_name)) echo $user_name; ?>" size="25" />
      </label>
    </p>
    <p>
      <label for="pwd">密码(至少6位)<br />
        <input id="pwd" class="input" type="password" size="25" value="" name="pwd" />
      </label>
    </p>
    
    <p class="forgetmenot" style="margin-bottom: 30px;">
      <label for="rememberme">
        <input name="rememberme" type="checkbox" id="rememberme" value="1" <?php checked( $rememberme ); ?> />
        在此设备上记住我
      </label>
    </p>
    
    <p class="form-submit">
      <input type="hidden" name="redirect_to" value="<?php if(isset($_GET['r'])) echo $_GET['r']; ?>" />
      <input type="hidden" name="user_token" value="<?php echo $token; ?>" />
      <button class="submit" type="submit">现在登录</button>
      <?php if($_GET['from']==2){ //来自谈否的注册 ?>
        <a href="https://www.zeo.im/register?from=2" class="submit-reg">订阅者注册</a>
      <?php }else{ ?>
        <a href="https://www.zeo.im/register" class="submit-reg">订阅者注册</a>
      <?php } ?>
    </p>
</form>
<?php } else {
 echo '<p class="user-error">您已登录（<a href="'.wp_logout_url().'" title="登出">登出？</a>）</p>';
} ?>
<?php get_footer(); }?>