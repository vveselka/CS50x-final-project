<?php
$k = 90;
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$instance = new PDO('mysql:host=127.0.0.1;dbname=smartq', 'root', '123456!', $pdo_options);
      }
      return self::$instance;
    }
  }
?>
