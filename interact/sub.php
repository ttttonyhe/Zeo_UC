<?php 
global $current_user;
$user_id = $current_user->ID;
$authors_array = get_mark_authors($user_id);
if( in_array( "$owner_id",$authors_array ) ){ //如果用户已收藏此作者 ?>

<script>
    //修改按钮 icon 样式为「取消关注」
    var change = document.getElementById('markbutton');
    change.innerHTML = '取消关注';
    
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
                    <div class="intro-content-title">取消关注</div></div><p style="text-align: center;font-size: 19px;">你确定要取消关注此作者</p>
                
<!-- 作者取消关注 -->
<script>

/* 
 * Ajax 提交关注
 * jquery写的，这时候会了
 */
function doing() {  //连接XHR并操作
    var author = "<?php echo $owner_id; ?>"; //获取作者 ID
    var user_id ="<?php echo $user_id; ?>"; //获取当前用户 ID
    jQuery.ajax({
         type:     'GET'
         ,url:     '?action=sub_de_author&author_de='+author+'&id='+user_id //服务端添加了接口(server/sub.php)
         ,cache:    false
         ,dataType:  'html'
         ,contentType: 'application/json; charset=utf-8'
         ,success:   function(data){
             var change=document.getElementById('mark_container');
             var change_button=document.getElementById('markbutton');
             change.innerHTML='<i class="icon-user-delete" style="font-size: 85px;color: #4CAF50;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">已取消关注</p><p style="font-size: 19px;">此作者将不会在用户中心出现</p><div class="intro-content-button"><button onclick="close_mark_display();" class="intro-button">数据加载中</button></div>';
             change_button.innerHTML = '关注作者';
             setTimeout(location.reload(),600); //显示通知后刷新页面
         }
         ,error:    function(data){change.innerHTML = 'ERROR'}
        });
}
/* ajax 提交关注结束 */

</script>
<!-- 作者取消关注结束 -->

                <div class="intro-content-button">
                    <button onclick="doing();" class="intro-button">取消关注</button>
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
                    <div class="intro-content-title">作者关注</div></div><p style="text-align: center;font-size: 19px;">你确定要关注此作者</p>
                
<!-- 作者关注 -->
<script>

/* ajax 提交关注 */
function doing() {  //连接XHR并操作
    var author = "<?php echo $owner_id; ?>";
    var user_id ="<?php echo $user_id; ?>";
    jQuery.ajax({
         type:     'GET'
         ,url:     '?action=sub_author&author='+author+'&id='+user_id
         ,cache:    false
         ,dataType:  'html'
         ,contentType: 'application/json; charset=utf-8'
         ,success:   function(){
             var change=document.getElementById('mark_container');
             var change_button=document.getElementById('markbutton');
             change.innerHTML='<i class="icon-user-add-1" style="font-size: 85px;color: #4CAF50;"></i><p style="font-size: 29px;font-weight: 600;margin-bottom: 0;margin-top: 10px;">已关注</p><p style="font-size: 19px;">你可以在用户中心找到此作者</p><div class="intro-content-button"><button onclick="close_mark_display();" class="intro-button">数据加载中</button></div>';
             change_button.innerHTML = '取消关注';
             setTimeout(location.reload(),600);
         }
         ,error:    function(){change.innerHTML = 'ERROR'}
        });
}
/* ajax 提交关注结束 */

</script>
<!-- 文章收藏结束 -->

                    <div class="intro-content-button">
                        <button onclick="doing();" class="intro-button">添加到关注</button>
                </div>
        </div>
    </div>
  </div>
</div>
<?php } ?>