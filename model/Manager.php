<?php

class Manager
{
    const DB = "gamefinder";
    const PWD = "root";
    const LOGIN = "root";
    protected function dbConnect()
    {
        try {
            return  new PDO('mysql:host=localhost;dbname=' . self::DB . ';charset=utf8', self::LOGIN, self::PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }
}