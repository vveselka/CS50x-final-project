<?php
    require("helpers/store.php");
    require("helpers/helper.php");
    
    Store::saveAnswerToDb($_POST["answer"], $_POST["id"]);
    $questionData = Store::getQuestionById($_POST["id"]);
    redirect("answers.php");
?>
