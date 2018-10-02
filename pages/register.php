<?php 
/*
Template Name: 用户注册
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    if(is_user_logged_in() || $_COOKIE['yoyocheckitout'] > 3){
        wp_redirect( site_url("/updates") );
    }else{
?>
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
.user-reg label {
  color: #777;
  font-size: 16px;
  cursor: pointer;
  text-align: left;
  margin-bottom: 15px;
  margin-left: 105px;
}
.user-reg .input {
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
.user-reg .input:focus{
    border: 1px solid #444;
}
.user-reg .input:hover{
    border: 1px solid #666;
}
.user-reg{
    text-align: left;
    margin-top: 10%;
    margin-bottom: 5%;
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
.submit-log{
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
    .user-reg label{
        margin-left: 0px;
    }
    .form-submit{
        margin-left: 0px;
    }
}


</style>
<?php 
/* 验证注册表单 */
if( !empty($_POST['user_reg']) ) {
  $error = '';
  $sanitized_user_login = sanitize_user( $_POST['user_login'] );
  $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

  // Check the username
  if ( $sanitized_user_login == '') {
    $error .= '<strong>错误</strong>：请输入用户名<br />';
  } elseif ( ! validate_username( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：此用户名包含无效字符，请输入有效的用户名<br />';
    $sanitized_user_login = '';
  } elseif ( username_exists( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：该用户名已被注册，请再选择一个<br />';
  } elseif( strlen($sanitized_user_login) > 20 ){
    $error .= '<strong>错误</strong>：用户名过长，请再选择一个<br />';
  } elseif ( preg_match("/[\x7f-\xff]/", $sanitized_user_login) ){
    $error .= '<strong>错误</strong>：用户名不可包含中文，请再选择一个<br />';
  }

  // Check the e-mail address
  if ( $user_email == '' ) {
    $error .= '<strong>错误</strong>：请填写电子邮件地址<br />';
  } elseif ( ! is_email( $user_email ) ) {
    $error .= '<strong>错误</strong>：电子邮件地址不正确<br />';
    $user_email = '';
  } elseif ( email_exists( $user_email ) ) {
    $error .= '<strong>错误</strong>：该电子邮件地址已经被注册，请换一个<br />';
  }
	
  // Check the password
  if(strlen($_POST['user_pass']) < 6)
    $error .= '<strong>错误</strong>：密码长度至少6位<br />';
  elseif($_POST['user_pass'] != $_POST['user_pass2'])
    $error .= '<strong>错误</strong>：两次输入的密码必须一致<br />';
	  
	if($error == '') {
    $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );
	
    if ( ! $user_id ) {
      $error .= sprintf( '<strong>错误</strong>：无法完成您的注册请求... 请联系小半管理员</a><br />', get_option( 'admin_email' ) );
    }
    else if (!is_user_logged_in()) {
      $user = get_user_by( 'login', $sanitized_user_login );
      $user_id = $user->ID;
  
      // 自动登录
      wp_set_current_user($user_id, $user_login);
      wp_set_auth_cookie($user_id);
      $cookie++;
      setcookie('yoyocheckitout',$cookie);
      do_action('wp_login', $user_login);
      
      if($_GET['from']==2){ //来自谈否的注册
          wp_redirect( site_url("/talklist") );
      }else{
          wp_redirect( site_url("/updates") );
      }
      
    }
  }
}
?>

<script>
    function close_error(){
        var change=document.getElementById('error');
        change.style.display="none";
    }
</script>


<?php the_content(); ?>
<?php 
/* 输出注册表单 */
if(!empty($error)) {
  echo '<div id="error" class="intro"><div class="intro-bg animations-fadeIn-bg"></div><div id="close_error" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)"><div class="intro-content" style="width: 510px;max-height: calc(100vh - 5px * 2);"><div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="report_container"><div class="intro-content-header"><div class="intro-content-title">提示</div></div><p style="text-align: center;font-size: 19px;">'.$error.'</p><div class="intro-content-button"><button onclick="close_error();" class="intro-button">关闭提示</button></div></div></div></div></div>';
}


if (!is_user_logged_in()) { ?>
<form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="user-reg user-form">
    <div class="form-div">
        <h2 style="font-weight: 800;font-size: 4rem;">用户注册</h2>
        <p style="font-size: 2rem;color: #999;">即刻拥有一个小半账户吧</p>
    </div>
    <p>
      <label for="user_login">用户名<br />
        <input type="text" name="user_login" tabindex="1" id="user_login" class="input" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" size="25"/>
      </label>
    </p>

    <p>
      <label for="user_email">电子邮件<br />
        <input type="text" name="user_email" tabindex="2" id="user_email" class="input" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="25" />
      </label>
    </p>
    
    <p>
      <label for="user_pwd1">密码(至少6位)<br />
        <input id="user_pwd1" class="input" tabindex="3" type="password" tabindex="21" size="25" value="" name="user_pass" />
      </label>
    </p>
    
    <p style="margin-bottom: 30px;">
      <label for="user_pwd2">重复密码<br />
        <input id="user_pwd2" class="input" tabindex="4" type="password" tabindex="21" size="25" value="" name="user_pass2" />
      </label>
    </p>
    
    <p class="form-submit">
      <input type="hidden" name="user_reg" value="ok" />
      <button class="submit" type="submit">立刻注册</button>
        <a href="https://www.zeo.im/login" class="submit-log">返回登录</a>
    </p>
</form>
<?php } else {
  echo '<p class="user-error">注册成功,欢迎加入小半</p>';
} ?>
<?php get_footer(); }?>