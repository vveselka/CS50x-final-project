<?php
    require("helpers/store.php");
    require("helpers/helper.php");
    require("helpers/configAuth.php");

    $allQuestions = Store::getQuestions();
    $questionsWithAnswer = array();
    $questionsWithoutAnswer = array();
    foreach ($allQuestions as $question) {
        if($question->getAnswer() == NULL)
        {
            array_push($questionsWithoutAnswer, $question);
        } else array_push($questionsWithAnswer, $question);
    }

    if(empty($questionsWithoutAnswer))
    {
        $template = $twig->loadTemplate("noPendingQuestions.html");
        $template->display(["title" => "Admin view. Answers"]);  
    } 
    else
    {
        $template = $twig->loadTemplate("admin.phtml");
        $template->display(["title" => "Admin view. Answers", "questionsWithoutAnswer" => $questionsWithoutAnswer]);    
    }  
?>
