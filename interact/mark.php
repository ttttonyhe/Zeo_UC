<?php 
global $current_user;
$user_id = $current_user->ID;
$posts_array = get_mark_posts($user_id);
if( in_array( "$postid",$posts_array ) ){ //如果用户已收藏本文章 ?>

<script>
    //修改按钮 icon 样式为「已收藏」
    var change = document.getElementById('markbutton');
    change.innerHTML = '<i class="icon-bookmark"></i>';
    
    //显示||关闭收藏窗口
    function open_mark(){
        var change=document.getElementById('mark');
        change.style.display="flex";
    }
    
    function close_mark_display(){
        var change=document.getElementById('mark');
        change.style.display="none";
    }
</script>

<div id="mark" class="intro" style="display:none;">
    <div class="intro-bg animations-fadeIn-bg"></div>
    <div id="close_mark" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)">
        <div class="intro-content" style="width: 610px;max-height: calc(100vh - 5px * 2);">
            <div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="mark_container">
                <a onclick="close_mark_display();"><div class="close-focus" style="padding-left:0px"><svg width="25" height="25" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="CloseIcon-icon-2xww"><path d="M8.142 6.6l-5.53-5.53c-.42-.42-1.115-.425-1.54 0-.43.43-.427 1.117-.002 1.543l5.53 5.53-5.53 5.528c-.42.422-.425 1.117 0 1.543.43.43 1.117.427 1.543 0l5.53-5.528 5.528 5.53c.422.42 1.117.424 1.543-.002.43-.43.427-1.116 0-1.542L9.686 8.143l5.53-5.53c.42-.42.424-1.115-.002-1.54-.43-.43-1.116-.427-1.542-.002L8.143 6.6z" fill="#333" fill-rule="evenodd"></path></svg></div></a>
                <div class="intro-content-header">
                    <div class="intro-content-title">取消收藏</div></div><p style="text-align: center;font-size: 19px;">你确定要取消收藏本文章</p>
                
<!-- 文章收藏 -->
<script>

/* 
 * Ajax 提交收藏 
 * js原生的，不好意思当时写收藏功能的时候还不会jquery
 */
function create() {  //创建XHR对象
    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else xhr = new ActiveXObject("Microsoft XMLHttp");  //适配IE8以下浏览器
    return xhr;
}
function doing() {  //连接XHR并操作
    var post = "<?php echo $postid; ?>"; //本文 ID
    var user_id ="<?php echo $user_id; ?>"; //收藏本文的用户 ID
    var xhr = create(); //获取xhr对象
    xhr.open("POST", "mark_de_api", true); // 创建xhr请求
    xhr.onreadystatechange = function () { //设定readyState状态改变时执行的操作
        if (xhr.readyState == 4 && xhr.status == 200) {  //判断状态并修改页面元素
            var change=document.getElementById('mark_container');
            var change_button=document.getElementById('markbutton');
            change.innerHTML='<i class="icon-flag-2" style="font-size: 85px;color: #4CAF50;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">文章已取消收藏</p><p style="font-size: 19px;">本文将不会在用户中心出现</p><div class="intro-content-button"><button onclick="close_mark_display();" class="intro-button">数据加载中</button></div>'; //展示通知
            change_button.innerHTML = '<i class="icon-bookmark-empty"></i>'; //修改按钮 icon
            location.reload(); //刷新页面
    }
    }
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");  //POST方式不可使用text/plain，故修改content-type
    xhr.send("post_de="+post+"&&id="+user_id);  //发送请求到php文件
}
/* ajax 提交收藏结束 */

</script>
<!-- 文章收藏结束 -->

                <div class="intro-content-button">
                    <button onclick="doing();" class="intro-button">取消收藏</button>
                </div>
        </div>
    </div>
  </div>
</div>












<?php }else{ ?>











<script>
    function open_mark(){
        var change=document.getElementById('mark');
        change.style.display="flex";
    }
    
    function close_mark_display(){
        var change=document.getElementById('mark');
        change.style.display="none";
    }
    
</script>
<div id="mark" class="intro" style="display:none;">
    <div class="intro-bg animations-fadeIn-bg"></div>
    <div id="close_mark" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)">
        <div class="intro-content" style="width: 610px;max-height: calc(100vh - 5px * 2);">
            <div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="mark_container">
                <a onclick="close_mark_display();"><div class="close-focus" style="padding-left:0px"><svg width="25" height="25" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="CloseIcon-icon-2xww"><path d="M8.142 6.6l-5.53-5.53c-.42-.42-1.115-.425-1.54 0-.43.43-.427 1.117-.002 1.543l5.53 5.53-5.53 5.528c-.42.422-.425 1.117 0 1.543.43.43 1.117.427 1.543 0l5.53-5.528 5.528 5.53c.422.42 1.117.424 1.543-.002.43-.43.427-1.116 0-1.542L9.686 8.143l5.53-5.53c.42-.42.424-1.115-.002-1.54-.43-.43-1.116-.427-1.542-.002L8.143 6.6z" fill="#333" fill-rule="evenodd"></path></svg></div></a>
                <div class="intro-content-header">
                    <div class="intro-content-title">文章收藏</div></div><p style="text-align: center;font-size: 19px;">你确定要收藏本文章</p>
                
<!-- 文章收藏 -->
<script>

/* ajax 提交收藏 */
function create() {  //创建XHR对象
    var xhr;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else xhr = new ActiveXObject("Microsoft XMLHttp");  //适配IE8以下浏览器
    return xhr;
}
function doing() {  //连接XHR并操作
    var post = "<?php echo $postid; ?>";
    var user_id ="<?php echo $user_id; ?>";
    var xhr = create(); //获取xhr对象
    xhr.open("POST", "mark_api", true); // 创建xhr请求
    xhr.onreadystatechange = function () { //设定readyState状态改变时执行的操作
        if (xhr.readyState == 4 && xhr.status == 200) {  //判断状态并修改页面元素
            var change=document.getElementById('mark_container');
            var change_button=document.getElementById('markbutton');
            change.innerHTML='<i class="icon-bookmark-2" style="font-size: 85px;color: #4CAF50;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">文章已收藏</p><p style="font-size: 19px;">您可以前往用户中心查看收藏的文章</p><div class="intro-content-button"><button onclick="close_mark_display();" class="intro-button">数据加载中</button></div>';
            change_button.innerHTML = '<i class="icon-bookmark"></i>';
            location.reload();
    }
    }
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");  //POST方式不可使用text/plain，故修改content-type
    xhr.send("post="+post+"&&id="+user_id);  //发送请求到php文件
}
/* ajax 提交收藏结束 */

function close_mark(){
        var count = <?php echo count( get_mark_posts($user_id) ); ?>;
        if(count <= 50){
            doing();
    }else {
        var change=document.getElementById('mark_container');
        change.innerHTML='<i class=" icon-flag-2" style="font-size: 85px;color: #b5423e;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">收藏失败</p><p style="font-size: 19px;">已达到订阅用户收藏上限(50篇文章)<br/><a href="apply">点此申请成为 原创作者/认证媒体</a></p><div class="intro-content-button"><button onclick="close_mark_display();" class="intro-button">关闭提示</button></div>';
    }
}

</script>
<!-- 文章收藏结束 -->

                <div class="intro-content-button">
                        <button onclick="close_mark();" class="intro-button">添加到收藏</button>
                </div>
        </div>
    </div>
  </div>
</div>
<?php } ?>


<a <?php if($is_wap){ echo 'style="display:none;"';} ?> class="report" onclick="open_report();"><i class="icon-volume-low"></i></a>


<!-- 文章收藏 -->
<?php if(is_user_logged_in()){ ?>
<a <?php if($is_wap){ echo 'style="display:none;"';} ?> class="report" style="bottom:92px" onclick="open_mark();" id="markbutton"><i class="icon-bookmark-empty"></i></a>
<?php require 'interact/mark.php'; } ?>
<!-- 文章收藏 -->