<?php
    require(__DIR__."/../models/question.php");
    require("connection.php");

    class Store
    {
        public static function getQuestions()
        {            
            $conn = Store::createConnection();
            $query = "SELECT * FROM questions";
            $res = mysqli_query($conn, $query);
            Store::closeDbConnection($conn);
            $questions = [];
            if($res === FALSE)
            {
                throw new StoreExeption("Error. Failed to query questions");
            }
            while($row = $res->fetch_assoc())
            {
                $timestamp = strtotime($row["date"]);
                $new_date = date('F j, Y',$timestamp );
                array_unshift($questions, new Question($row["id"], $row["question"], $row["name"], $row["email"], $new_date , $row["answer"]));
            }
            return $questions;
        }

        public static function getQuestionById($questionId)
        {
            $conn = Store::createConnection();
            $query = "SELECT * FROM questions where id='$questionId'";
            $res = mysqli_query($conn, $query);
            Store::closeDbConnection($conn);
            if($res === FALSE)
            {
                throw new StoreExeption("Error. Failed to query question by id");
            }
            $row = $res->fetch_assoc();

            $timestamp = strtotime($row["date"]);
            $new_date = date('F j, Y',$timestamp );

            $questionDetails = new Question($row["id"], $row["question"], $row["name"], $row["email"], $new_date , $row["answer"]);
            return $questionDetails;
        }

        public static function addQuestion($name, $email, $question)
        {
            $conn = Store::createConnection();
            $currDate = date("Y-m-d H:i:s");
            $stmt = $conn-> prepare("INSERT INTO questions (question, name, email, date) VALUES(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $question, $name, $email, $currDate);
            $stmt->execute();
            Store::closeDbConnection($conn);
        }


        public static function checkCredentialsInDb($name, $psw)
        {
            $conn = Store::createConnection();
            $query = "SELECT * from admin where username = '$name'";
            $res = mysqli_query($conn, $query);
            Store::closeDbConnection($conn);
            if($res === FALSE)
            {
                throw new StoreExeption("Error. Failed to query admin");
            }

            $numResults = $res->num_rows;

            if($numResults == 1)
            {
                $row = $res->fetch_assoc();
                $passHash = $row["hash"];
                if(password_verify($psw, $passHash))
                {
                    $_SESSION["id"] = $row["id"];
                    return true;
                } else return false;
            } else return false;
        }

        public static function saveAnswerToDb($answer, $questionId)
        {
            $conn = Store::createConnection();
            $stmt = $conn-> prepare("UPDATE questions SET answer = ? where id = ? ");
            $stmt->bind_param("si", $answer, $questionId);
            $stmt->execute();
            Store::closeDbConnection($conn);
        }

        public static function removeQuestion($questionId)
        {
            $conn = Store::createConnection();
            $stmt = $conn-> prepare("DELETE FROM questions where id = ? ");
            $stmt->bind_param("i", $questionId);
            $stmt->execute();
            Store::closeDbConnection($conn);
        }

        public static function createAdmin($adminName, $adminPass)
        {
            $conn = Store::createConnection();
            $hash = password_hash($adminPass, PASSWORD_DEFAULT);
            $stmt = $conn-> prepare("INSERT INTO admin (username, hash) VALUES(?, ?)");
            $stmt->bind_param("ss", $adminName, $hash);
            $stmt->execute();
            Store::closeDbConnection($conn);
        }


        private  function createConnection()
        {
            $conn = mysqli_connect("127.0.0.1", "root", "123456!", "smartq");
            if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_query($conn, "SET NAMES 'utf8'");
            return $conn;
        }

        private static function closeDbConnection($conn)
        {
            mysqli_close($conn);
        }
    }

    class StoreExeption extends Exception
    {

    }
?>
