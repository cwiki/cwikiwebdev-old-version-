<?php
$db = new CRUD();
$article = $db->dbSelect('article', 'display_bool', true);


/*Sets  default Gallery item*/
if (isset($_POST['cur_gal_item'])) {
    $current = $_POST['cur_gal_item'];
} else {
    $current = 0;
}

?>
<div class="gallery">

    <div class="gallery-body">
        <div class="gallery-text">
            <div class="gallery-text-title fc-beta el-text">
                <p>Project</p>
            </div>
            <div class="gallery-text-subtitle fs-bold fc-alpha el-text">
                <p>
                    <?php echo $article[$current]['title']; ?>
                </p>
            </div>

            <?php
            /*Inserts a external link if it exists in the article*/
            if (isset($article[$current]['external_url'])) {

                ?>
                <div class="gallery-see-more gallery-text-title ">
                    <a class="more-about fc-beta l-text" href="<?php echo $article[$current]['external_url']; ?>">
                        <p>more about this project</p>
                    </a>
                </div>

            <?php } /*Ends the Insert External link*/ ?>

            <div class="gallery-text-body ff-reading text text-size-norm">
                <p>
                    <?php echo $article[$current]['text']; ?>
                </p>
            </div>
        </div>
        <!--Containing Element for images-->
        <div class="gallery-images">
            <ul class="ul-gallery">

                <?php
                echo $current;

                //loops through possible article elements and displays up to 6
                for ($i = 0; $i < 6; $i++) {
                    if (isset($article[$i])) {
                        ?>


                        <!--                            <input class="" type="submit" name="" value="">-->
                        <li class="gallery-image-container">
                            <form action="" method="post">
                                <input class="" type="hidden" name="theContent" value="gallery">
                                <input class="" type="hidden" name="cur_gal_item" value="<?php echo $i; ?>">
                                <button class="gallery-button" type="submit">
                                    <?php
                                    /*Attempts to find the gallery image and checks to see if it's active*/
                                    $galleryImage = new GalleryImage($article[$i]["image_name"], $current, $i);

                                    ?>
                                    <img class="<?php echo $galleryImage->getImageClass() ?>"
                                         src="<?php echo $galleryImage->getImageSrc() ?>">

                                </button>
                            </form>

                            <div class="gallery-image-dev fc-white n-text"><?php echo $article[$i]['type']; ?></div>
                            <p class="gallery-image-text fc-alpha fs-bold h-text"><?php echo $article[$i]['title'] ?></p>

                        </li>

                        <?php
                    } else {
                        /*Inserts empty containers to keep styles and spacing consistent*/
                        echo "<li class=\"gallery-image-container\"></li>";
                    }
                } ?>


            </ul>
        </div>

    </div>
    <!--    gallery Body class End-->
</div>
<!--gallery Class end-->