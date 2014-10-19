<?php
class Config
{
    private $db;

    public function __construct($dbuser='root', $dbpass='', $dbname='definitelynotfacebook') {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function getConnection() {
        return $this->db;
    }
}

