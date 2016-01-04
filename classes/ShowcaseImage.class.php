<?php

/**
 * Gets the showcase image or returns a default
 */
class ShowcaseImage extends CRUD
{

    public $showcaseImage = null;

    function __construct($article)
    {

        if (file_exists("images/gallery/" . $article . "-1080p.png")) {
            $this->showcaseImage = "images/gallery/" . $article . "-1080p.png";
        } else {
            $this->showcaseImage = "images/sig-background.png";
        }
    }

    function getShowcaseImage()
    {
        return $this->showcaseImage;
    }
}