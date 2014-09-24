<?php

class Database {

    public function createConnection() {
        $connectData = array('host' => '127.0.0.1', 'usr' => 'NegronJames', 'pwd' => 'yoyoyo', 'db' => 'inviteme');
        $mysqli = new mysqli($connectData['host'], $connectData['usr'], $connectData['pwd'], $connectData['db']);
        if ($mysqli->connect_errno) {
            die("Fallo al conectar a la Base de Datos: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        } else {
            return $mysqli;
        }
    }

    public function saveData($data) {
        $con = Database::createConnection();
        $query = "INSERT INTO jugadores VALUES ('" . $data['id'] . "', '" . $data['email'] . "',"
                . " '" . $data['first_name'] . "', '" . $data['middle_name'] . "', '" . $data['last_name'] . "', '" . $data['name'] . "', "
                . "'" . date("Y-m-d H:i:s") . "', '" . $data['gender'] . "', '" . $data['address'] . "', "
                . " " . $data['estado'] . " , '1' )";
        if (!$con->query($query)) {
            echo '{ "message": "Hubo un problema al momento de crear el Registro, INFO: ' . str_replace('\'', '', $con->error) . $query . ' "}';
        } else {
            echo '{ "message": "Tus Datos han sido almacenados con exito", "nextStep" : "/inviteme/index.php"}';
        }
        $con->close();
    }

}
