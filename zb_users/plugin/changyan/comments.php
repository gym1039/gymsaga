<?php
global $changyanPlugin;
?>

<?php
if(!empty($changyan_comments_script)){
?>
    <!-- Changyan Comment JS -->
    <?php echo $changyan_comments_script;?>
<?php
} else {
?>
    请进入“Zblog后台” -> “畅言” 登陆你的畅言账号。
<?php
}
?>