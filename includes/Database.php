<?php

class Database {

    public function createConnection() {
        $connectData = array(host => 'localhost', usr => 'root', pwd => 'MeRc891026*', db => 'inviteme');
        $mysqli = new mysqli($connectData['host'], $connectData['usr'], $connectData['pwd'], $connectData['db']);
        if ($mysqli->connect_errno) {
            die("Fallo al conectar a la Base de Datos: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        } else {
            return $mysqli;
        }
    }

}
