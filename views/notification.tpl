<?php
$resaultOK = '';
$resaultNo = '';
?>


<?php if ($resaultOK != '') {?>
<div class="info"><?=$resaultOK?></div>
<?php }?>
<?php if ($resaultNo != '') {?>
<div class="info"><?=$resaultNo?></div>
<?php }?>

<?php if (@$info != '') {?>
<div class="notify notify--error"><?=$info?></div>
<?php }?>

