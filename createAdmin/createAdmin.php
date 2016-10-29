<!-- 
    console command for creating new admin credentials
-->
<?php 
    require("../helpers/store.php");
    if(count($argv)!= 3) print("You need to use 2 parameters: <admin username> <password>");
    else 
    {
        Store::createAdmin($argv[1], $argv[2]);
        print("New admin ". $argv[1]." has been successully created.");
    }
?>
