<?php
    session_start();

    //require authentication for all pages except /index.php, /admin.php
    if (!in_array($_SERVER["PHP_SELF"], ["/index.php", "/admin.php"]))
    {
        if (empty($_SESSION["id"]))
        {
           redirect("/");
        }
    }
?>
