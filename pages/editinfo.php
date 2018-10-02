<?php 
/*
Template Name: 用户资料修改
*/
get_header();?>
<?php wp_no_robots(); ?>
<?php
    if(!is_user_logged_in()){
        wp_redirect( site_url("/updates") );
    }else{
?>
<?php
/* 读取表单数据 */
if( !empty($_POST['edit_info'])) {
    global $current_user;
    $user_id = $current_user->ID;
    $user_old_email = $current_user->user_email;
    $user_old_name = $current_user->nickname;
    $user_old_des = $current_user->description;
    $sanitized_user_login = sanitize_user( $_POST['user_name'] );
    $user_email = $_POST['user_email'];
    $user_des = $_POST['user_des'];
    $error = '';
    $current_pass = '';
    $current_user_name ='';
    $current_user_email = '';
    $current_user_des = '';

    /* 修改密码 */
    if($_POST['user_pass']==''){ 
        $error='';
    }else{
        if(strlen($_POST['user_pass']) < 6)
        { 
            $error .= '<strong>错误</strong>：密码长度至少6位!<br />'; 
        }
    else{
        if($_POST['user_pass'] != $_POST['user_pass2']){
        $error .= '<strong>错误</strong>：两次输入的密码必须一致!<br />';}
    else {
        $enter_pass = $_POST['user_pass']; 
        $current_pass = md5($enter_pass); }}}
        
    if(!$current_pass == ''){
       header("charset=utf-8");
    @$con=mysqli_connect('127.0.0.1','root','Goodhlp616877','zeo',3306);
    if (mysqli_errno($con)) {
        $error .='数据库连接失败<br />';
        exit;
    }else{
        $sql_change = 'UPDATE xb_users SET user_pass="'.$current_pass.'" WHERE ID ='.$user_id;
        @$result=mysqli_query($con,$sql_change);
        if ($result) {
            $error .= '密码修改成功<br />';
        } else {
            $error .= '密码修改失败<br />';
        }
    @mysqli_close($con);
}
    }
    /* 修改密码结束 */
    
    /* 修改用户名 */
  if ( $sanitized_user_login == '' || $sanitized_user_login == $user_old_name) {
    $error .= '';
  } elseif ( ! validate_username( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：此用户名包含无效字符，请输入有效的用户名<br />。';
    $sanitized_user_login = '';
  } elseif ( username_exists( $sanitized_user_login ) ) {
    $error .= '<strong>错误</strong>：该用户名已被注册，请再选择一个。<br />';
  }else $current_user_name = $sanitized_user_login;
  
  if(!$current_user_name ==''){
      $status = update_user_meta( $user_id, 'nickname', $current_user_name );
      if($status) $error .= '用户名修改成功<br />'; else $error .='用户名修改失败<br />';
      $status = '';
  }
  /* 修改用户名结束 */
  
  /* 修改用户邮箱 */
  /*if ( $user_email == '' || $user_email == $user_old_email ) {
    $error .= '';
  } elseif ( ! is_email( $user_email ) ) {
    $error .= '<strong>错误</strong>：电子邮件地址不正确。！<br />';
    $user_email = '';
  } elseif ( email_exists( $user_email ) ) {
    $error .= '<strong>错误</strong>：该电子邮件地址已经被注册，请换一个。<br />';
  }else $current_user_email = $user_email;
  
  if(!$current_user_email ==''){
      $status = update_user_meta( $user_id, 'email', $current_user_email );
      if($status) $error .= '邮箱修改成功,需要一杯咖啡的时间生效<br />'; else $error .='邮箱修改失败<br />';
  } */
  /* 修改用户邮箱结束 */
  
  /* 修改个人简介 */
  if ( $user_des == '' || $user_des == $user_old_des ) {
    $error .= '';
  }else{ $current_user_des = $user_des;
         $status = update_user_meta( $user_id, 'description', $current_user_des );
         if($status) $error .= '个人简介修改成功<br />'; else $error .='个人简介修改失败<br />';
  }
  /* 修改个人简介 */

}
?>
<style>
.user-form{
    display: block;
    margin-left: auto;
    margin-right: auto;
    background: #fff;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    width: 30%;
    padding: 60px 0 70px 0;
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
.tip{
    margin-bottom: 50px;
    margin-left: 105px;
    color: #7d7d7d;
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
	$author_name = $current_user->nickname;
	$user_email = $current_user->user_email;
	if($current_user->description){
	    $des = $current_user->description;
	}else{
	    $des = '一位小半订阅者';
	}
?>
<form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="user-reg user-form">
    <div style="text-align:  left;margin-left: 105px;margin-bottom: 40px;">
        <h2 style="font-weight: 800;font-size: 4rem;">信息修改</h2>
        <p style="font-size: 2rem;color: #999;">更新你的账户信息</p>
    </div>
    
    <p>
      <label for="user_avatar">用户头像<br />
        <a class="up-author-status-1" style="border-radius: 2px;margin-top: 3px;height: 45px;font-size: 1.8rem;padding-top: 8px;margin-left: 0;" href="https://www.zeo.im/editavatar">点击修改</a>
      </label>
    </p>
    
    <p>
      <label for="user_login">用户昵称<br />
        <input type="text" name="user_name" tabindex="1" id="user_login" class="input" value="<?php echo $author_name; ?>" size="25"/>
      </label>
    </p>

    <!-- <p>
      <label for="user_email">电子邮件<br />
        <input type="text" name="user_email" tabindex="2" id="user_email" class="input" value="<?php echo $user_email; ?>" size="25" />
      </label>
    </p> -->
    
    <p>
      <label for="user_des">个人简介<br />
        <input type="text" name="user_des" tabindex="1" id="user_des" class="input" value="<?php echo $des; ?>" size="25"/>
      </label>
    </p>
    
    <p>
      <label for="user_pwd1">密码(至少6位)<br />
        <input id="user_pwd1" class="input" tabindex="3" type="password" tabindex="21" size="25" name="user_pass" />
      </label>
    </p>
    
    <p>
      <label for="user_pwd2" style="margin-bottom:0px">重复密码<br />
        <input id="user_pwd2" class="input" tabindex="4" type="password" tabindex="21" size="25" name="user_pass2" />
      </label>
    </p>
    
    <div class="tip">
        <i class="icon-info-circled"></i>用户电子邮箱不可修改
    </div>
    
    <p style="margin-left: 105px;">
      <input type="hidden" name="edit_info" value="ok" />
      <button class="submit" type="submit">保存修改</button>
      <a href="https://www.zeo.im/updates" class="submit-log">返回资料</a>
    </p>
</form>
<?php get_footer(); }?>