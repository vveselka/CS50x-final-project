<?php
    require("helpers/helper.php");
    require("helpers/store.php");
    require("helpers/configAuth.php");

    class Admin {
        public $username = null;
        public $pwd = null;

        function __construct($data) {
            if(isset($data['username']) && isset($data['pwd'])) {
                $this->username = stripslashes($data['username']);
                $this->pwd  = stripslashes($data['pwd']);
            }
        }
        public function login() {
            if(!Store::checkCredentialsInDb($this->username, $this->pwd))
            {
                echo false;
            }
            else
            {
               echo true;
            }       
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_SESSION['id']))
        {
            redirect("/answers.php");
        } else
        {
            $template = $twig->loadTemplate("adminLoginForm.phtml");
            $template->display(["title"=>"Admin panel. Login Form"]);
        }
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $admin = new Admin(array("username" => $_POST['username'], 'pwd' => $_POST['pwd']));
        $admin->login();
    }

?>
