<?php
    class Question 
    {
        private $author;
        private $question;
        private $date;
        private $answer;
        private $id;
        private $email;

        public function __construct($id, $question, $author, $email,  $date, $answer)
        {
            $this->id = $id;
            $this->author = $author;
            $this->question = $question;
            $this->email = $email;
            $this->date = $date;
            $this->answer = $answer;
        }

        public function getAuthorName()
        {
            return $this->author;
        }

        public function getQuestion()
        {
            return $this->question;
        }

        public function getDate()
        {
            return $this->date;
        }

        public function getAnswer()
        {
            return $this->answer;
        }

        public function getId()
        {
            return $this->id;  
        }

        public function getEmail()
        {
            return $this->email;
        }
    }
?>
