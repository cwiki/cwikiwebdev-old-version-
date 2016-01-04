<?php
$db = new CRUD();
$setup = $db->dbSelect('setup', 'layout', 'setup');
$setup = $setup['0'];

?>
<header class="header back-trans">
    <a class="header-title fc-beta" href="http://www.cwikiwebdev.com">
    <div class="header-title fc-beta">

    <?php echo $setup['title'] ?>

    </div>
    <img class="header-logo" src="images/sig-header.png">
    <div class="header-sub fc-alpha">
        <?php echo $setup['subtitle'] ?>
    </div>
        </a>
</header>