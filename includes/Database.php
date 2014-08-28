<?php

/**
 * Description of Database
 *
 * @author root
 */
class Database {
    public $a = "cadena";
    function createConnection() {
        $mysqli = new mysqli("localhost", "root", "MeRc891026*", "inviteme");
        return $mysqli;
    }
}