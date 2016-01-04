<?php
/** Grab required classes*/

$db = new CRUD();
$setup = $db->dbSelect('setup', 'layout', 'setup');
$setup = $setup['0'];

?>
<div class="splash">
    <div class="splash-body">
        <img class="splash-logo opacity-heavy" src="images/sig-splash.png">
        <div class="splash-body-text">
            <div class="eh-text fc-beta"><?php echo $setup['title'] ?></div>
            <div class="h-text fc-beta"><?php echo $setup['subtitle'] ?></div>
        </div>

    </div>
    <!--    Splash Body class End-->
</div>

<!--Splash Class end-->