<?php
    require("helpers/helper.php");
    require("helpers/store.php");
    $userName = isset($_POST["userName"]) ? $_POST["userName"] : null;
    $userEmail = isset($_POST["userEmail"]) ? $_POST["userEmail"] : null;
    $userQuestion = isset($_POST["userQuestion"]) ? $_POST["userQuestion"] : null;
    Store::addQuestion($userName, $userEmail, $userQuestion);
?>
