<?php

    require_once './config.php';

class Modelo {
    protected $db;

    public function __construct(){
        $this->db = $this->createConection();
    }

    private function createConection(){
        $pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}