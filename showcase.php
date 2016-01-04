<?php
$db = new CRUD();

/*Grabs the appropraite showcase item from the setup table*/
$setup = $db->dbSelect('setup', 'layout', 'setup');
$showcase = $setup['0']['article_id'];

/*Grabs the article information for the Showcase*/
$article = $db->dbSelect('article', 'article_id', $showcase);
$showcase = $article['0'];

/*Loads the background image location if it exists*/
$showcaseImage = new ShowcaseImage($showcase['image_name']);
$showcaseImage = $showcaseImage->getShowcaseImage();
?>

<div class="showcase">

    <img class="showcase-img" src="<?php echo $showcaseImage; ?>">

    <div class="border-box">
        <div class="showcase-body">
            <div class="showcase-text  back-trans">
                <div class="showcase-text-title fc-beta h-text">
                    <p><?php echo $showcase['title'];
                        if (isset($showcase['external_url'])) {
                            ?>
                            <a class="more-about-showcase fc-alpha s-text"
                               href="<?php echo $showcase['external_url']; ?>">
                                more about this project</a>

                        <?php } /*Ends the Insert External link*/ ?>
                    </p>

                </div>
                <div class="showcase-text-body fc-white n-text">
                    <p>
                        <?php echo $showcase['text']; ?>
                    </p>

                </div>
            </div>
        </div>
        <!--Showcase Body-->
    </div>
    <!--Border box-->
</div>
<!--showcase Class end-->
