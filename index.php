<?php 
    require("helpers/helper.php");
    require("helpers/store.php");
    require("helpers/configAuth.php");
    
    $allQuestions = Store::getQuestions();
    $templ = $twig->loadTemplate("home.phtml");
    $isAdmin = isset($_SESSION["id"]);
    $templ->display(["title"=>"Home page", "allQuestions"=>$allQuestions, "isAdmin"=>$isAdmin]);                 
?>
