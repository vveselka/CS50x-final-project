<?php
    require_once("../composer/vendor/twig/twig/lib/Twig/Autoloader.php");
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem("templates/");
    $twig = new Twig_Environment($loader);
    $GLOBALS['twig'] = $twig;
?>
