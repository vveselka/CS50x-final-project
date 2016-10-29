<?php
    require("helpers/store.php");
    require("helpers/helper.php");

    $questionId = $_POST["questionId"];
    Store::removeQuestion($questionId);
    redirect("answers.php");
?>


