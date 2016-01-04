<?php


/**Major Function. This is the autoloader. It is Master and Commander*/
function my_autoloader($class)
{
    $theClass = 'classes/' . $class . '.class.php';

    if (file_exists($theClass)) {
        include_once 'classes/' . $class . '.class.php';
    } else {
        echo "failed to include class " . $theClass;
    }
}

/**Generates a Copy Right Code at the bottom of the page
 * It displays the current year
 * If the current year is not this year it displays the inital setup year
 */
function auto_copyright($year = 'auto')
{
    if (intval($year) == 'auto') {
        $year = date('Y');
    }
    if (intval($year) == date('Y')) {
        echo intval($year);
    }
    if (intval($year) < date('Y')) {
        echo intval($year) . ' - ' . date('Y');
    }
    if (intval($year) > date('Y')) {
        echo date('Y');
    }
}


/**Enqueue's stylesheets relevent to website*/
function enqueue_styles()
{
    $stylesheet = array(
        "styles/reset.css",
        "styles/style.css",
        "styles/mobile.css",
        "styles/tablet.css",
        "https://fonts.googleapis.com/css?family=Titillium+Web:400,700",
        "https://fonts.googleapis.com/css?family=Roboto+Slab:400,700",
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"
    );

    foreach ($stylesheet as $style) {
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $style . "\">";
    }
}