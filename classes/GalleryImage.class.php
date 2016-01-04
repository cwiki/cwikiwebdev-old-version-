<?php

/**
 * Creates the tags and imports the gallery images
 */
class GalleryImage
{
    public $imgSrc = null;
    public $imgClass = null;

    function __construct($image, $loopIt, $currentIt)
    {    /*creates the path string for the Article Image*/
        $imageName = "images/gallery/" . $image . "-gall.png";

        /*Check to see if Article Image exists*/
        if (file_exists($imageName)) {
            $this->imgSrc = $imageName;
        } else {
            $this->imgSrc = "images/gallery/default-gall.png";
        }

        if ($loopIt == $currentIt) {
            $this->imgClass = "gallery-image gallery-active";
        } else {
            $this->imgClass = "gallery-image";
        }

    }

    function getImageSrc()
    {
        return $this->imgSrc;
    }

    function getImageClass()
    {
        return $this->imgClass;
    }

}