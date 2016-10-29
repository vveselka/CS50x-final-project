<?php 
require("addingTwig.php");

    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }
        header("Location: {$location}");
        exit;
    }

    function logout()
    {
        session_start();
        unset($_SESSION['id']);
        session_destroy();
    }

    function sendEmail($templateName, $to, $name, $questionId, $comment)
    {
        $template = $GLOBALS['twig']->loadTemplate($templateName);
        $body = $template->render(["name"=>$name, "id"=> $questionId, "comment"=>$comment]);
        $subject = "See the answer to your question in SmartQ";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $sending = mail($to, $subject, $body, $headers);

        if(!$sending)
        {
            error_log("Cannot send an email!");
        }
    }
?>
