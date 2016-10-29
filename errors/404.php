<?php
    require_once("../helpers/addingTwig.php");
    $template = $twig->loadTemplate("404.html");
    $template->display(["title" =>"404 Page Not Found"]);
?>
