<?php
$db = new CRUD;
/*grabs Biography data*/
$bio = $db->dbSelect('bio', 'bio_version', '0');
$bio = $bio['0'];

/*creates workable object for social links*/
$social = $db->dbSelect('social', 'enabled_bool', true);
$author = $db->dbSelect('author', 'username', 'cwikidev');
$author = $author['0'];
?>

<div class="contact">
    <img class="ci-portrait" src="images/sig-background-p.png">
    <img class="ci-landscape" src="images/sig-background.png">

    <div class="contact-body">
        <div class="contact-text">
            <div class="contact-text-title fc-beta eh-text">
                <p><?php echo $bio['title'] ?></p>
            </div>
            <!--see more link-->
            <div class="contact-text-body ff-reading text text-size-norm">
                <p><?php echo $bio['text'] ?></p>
            </div>

            <div class="contact-box fc-white">
                <p>For Help, Hire or Collaboration</p>

                <p>By Email:
                    <a class="fc-black fs-bold"
                       href="mailto:<?php echo $author['email']; ?>"><?php echo $author['email']; ?></a>
                </p>

                <p>By Phone:
                    <a id="" class="social-tel fc-black n-text fs-bold"
                       href="tel:<?php echo $author['phone_num']; ?>"><?php echo $author['phone_num']; ?></a>
                </p>

                <p class="menu-social ff-awesome">
                    <?php
                    foreach ($social as $links) {
                        echo "<a href=\"" . $links['link'] . "\"></a>";
                    }


                    ?>

                </p>

                <p>Created by <span class="fc-black"><?php echo $author['name']; ?></span></p>

                <p>CWIKI WEB DEV <span class="ff-reading">&copy; </span>
                    <span class="ff-default"><?php auto_copyright('2015') ?></span>
                </p>

            </div>
        </div>
        <img class="my-image" src="images/avatar.png">
    </div>
    <!--    contact Body class End-->
</div>
<!--contact Class end-->