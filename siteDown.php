<?php
$db = new CRUD();
$setup = $db->dbSelect('setup', 'layout', 'setup');
$setup = $setup['0'];
?>

<div class="site-down gallery">

    <div class="gallery-body">
        <div class="gallery-text">
            <div class="gallery-text-subtitle fc-beta el-text">
                <p><?php echo $setup['title']; ?> is currently undergoing maintenance.
                    <br/>
                    <br/>
                    <span class="fc-beta">Service well return shortly.</span></p>
            </div>
        </div>
    </div>
</div>