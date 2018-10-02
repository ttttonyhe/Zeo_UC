<script>
    //显示||关闭收藏窗口
    function open_report(){
        var change=document.getElementById('report');
        change.style.display="flex";
    }
    
    function close_report_display(){
        var change=document.getElementById('report');
        change.style.display="none";
    }
    
</script>
<div id="report" class="intro" style="display:none;">
    <div class="intro-bg animations-fadeIn-bg"></div>
    <div id="close_report" class="intro-area animations-fadeInUp-focus" style="border-radius: 3px;box-shadow:0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12)">
        <div class="intro-content" style="width: 610px;max-height: calc(100vh - 5px * 2);">
            <div class="intro-content-container" style="font-size: 18px;padding: 40px 30px;text-align:center" id="report_container">
                <a onclick="close_report_display();"><div class="close-focus" style="padding-left:0px"><svg width="25" height="25" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="CloseIcon-icon-2xww"><path d="M8.142 6.6l-5.53-5.53c-.42-.42-1.115-.425-1.54 0-.43.43-.427 1.117-.002 1.543l5.53 5.53-5.53 5.528c-.42.422-.425 1.117 0 1.543.43.43 1.117.427 1.543 0l5.53-5.528 5.528 5.53c.422.42 1.117.424 1.543-.002.43-.43.427-1.116 0-1.542L9.686 8.143l5.53-5.53c.42-.42.424-1.115-.002-1.54-.43-.43-1.116-.427-1.542-.002L8.143 6.6z" fill="#333" fill-rule="evenodd"></path></svg></div></a>
                <div class="intro-content-header">
                    <div class="intro-content-title">文章检举</div></div><p style="text-align: center;font-size: 19px;">你确定要举报此文章作者</p>
                <div class="uk-card uk-card-default" style="width: 60%;margin-left:  auto;margin-right:  auto;margin-top: 30px;margin-bottom: 45px;border-radius: 5px;">
                    <div class="uk-card-header" style="border-bottom: none;text-align: left;">
                        <div class="uk-grid-small uk-flex-middle uk-grid" uk-grid="">
                            <div class="uk-width-auto uk-first-column" style="padding: 0;padding-right: 12px;">
                            <?php $author_id = get_the_author_meta('ID'); //获取文章作者 ID
                                  $author_des = get_the_author_meta('description'); //获取文章作者描述
                                  if(empty($author_des)){
                                      $author_des = '我是本文作者'; //空描述则显示默认描述
                                  }
                            ?>
                            <?php echo get_avatar($author_id,96, '', 'user-avatar',array( 'width'=>50,'height'=>50,'rating'=>'X','class'=>array('uk-card','uk-card-default','uk-card-hover','uk-card-body','up-avatar-img'),'extra_attr'=>'title="user-avatar"','scheme'=>'https') ); ?>
                        </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom" style="font-size: 2rem;font-weight: 600;"><?php echo get_the_author() ?></h3>
                        <p class="uk-text-meta uk-margin-remove-top" style="width: 100%;text-overflow: ellipsis;height: 35px;overflow: auto;font-size: 1.6rem;font-weight: 500;"><time><?php echo $author_des; ?></time></p>
                    </div>
                        </div>
                        </div>
                </div>
                
<!-- 督查提交 -->
<script>

/* 
 * Ajax 提交举报 
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
    var count = "<?php echo get_the_author_meta('report_count'); ?>"; //获取作者已举报次数
    var id ="<?php echo get_the_author_meta('ID') ?>"; //获取作者 ID
    var xhr = create(); //获取xhr对象
    xhr.open("POST", "report_api", true); // 创建xhr请求
    xhr.onreadystatechange = function () { //设定readyState状态改变时执行的操作
        if (xhr.readyState == 4 && xhr.status == 200) {  //判断状态并修改页面元素
            var change=document.getElementById('report_container');
            change.innerHTML='<i class="icon-ok-circled2" style="border: solid 5px #4CAF50;border-radius: 10px;font-size: 85px;color: #4CAF50;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">举报已提交</p><p style="font-size: 19px;">我们将尽快处理</p><div class="intro-content-button"><button onclick="close_report_display();" class="intro-button">关闭提示</button></div>'; //显示通知
    }
    }
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");  //POST方式不可使用text/plain，故修改content-type
    xhr.send("count="+count+"&&id="+id);  //发送请求到php文件
}
/* Ajax 提交举报结束 */

function close_report(){
        var current_count = "<?php echo get_the_author_meta('report_count'); ?>";
        if(current_count<=56){ //大于56次举报则不继续提交(我也不知道为什么要这样做)
            doing();
    }else {
        var change=document.getElementById('report_container');
        change.innerHTML='<i class="icon-cancel-circled2" style="border: solid 5px #b5423e;border-radius: 10px;font-size: 85px;color: #b5423e;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">举报未提交</p><p style="font-size: 19px;">作者已被多人举报,我们正在处理</p><div class="intro-content-button"><button onclick="close_report_display();" class="intro-button">关闭提示</button></div>'; //显示通知
    }
}

</script>
<!-- 督查提交结束 -->

                <div class="intro-content-button">
                    <button onclick="close_report();" class="intro-button">提交</button>
                </div>
        </div>
    </div>
  </div>
</div>
