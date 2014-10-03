<?php

class Database {

    public function createConnection() {
        $connectData = array('host' => '127.0.0.1', 'usr' => 'tuprepae_prickie', 'pwd' => 'MeRc891026*', 'db' => 'tuprepae_prickie');
        $mysqli = new mysqli($connectData['host'], $connectData['usr'], $connectData['pwd'], $connectData['db']);
        if ($mysqli->connect_errno) {
            die("Fallo al conectar a la Base de Datos: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        } else {
            return $mysqli;
        }
    }

    public function saveData($data) {
        $con = Database::createConnection();
        $query = "INSERT INTO jugadores VALUES (" . $data['id'] . ", '" . $data['email'] . "',"
                . " '" . $data['first_name'] . "', '" . $data['middle_name'] . "', '" . $data['last_name'] . "', '" . $data['name'] . "', "
                . "'" . date("Y-m-d H:i:s") . "', '" . $data['gender'] . "', '" . $data['tel'] . "', "
                . " " . $data['estado'] . " , '1' )";
        if (!$con->query($query)) {
            echo '{ "message": "Hubo un problema al momento de crear el Registro, INFO: ' . str_replace('\'', '', $con->error) . $query . ' "}';
        } else {
            echo '{ "message": "Tus Datos han sido almacenados con exito", "nextStep" : "/site/index2.php"}';
        }
        $con->close();
    }

    public function checkRegister($fbid) {
        $con = new Database();
        $query = 'SELECT * FROM jugadores WHERE fbid = ' . $fbid;
        $exec = $con->createConnection()->query($query);
        if (count($resultado = $exec->fetch_assoc())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkSorteo($id) {
        $con = new Database();
        $query = 'SELECT * FROM eventos WHERE ideventos = ' . $id;
        $exec = $con->createConnection()->query($query);
        if (count($resultado = $exec->fetch_assoc())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getProfile($id) {
        $con = new Database();
        $query = 'SELECT * FROM jugadores WHERE fbid = ' . $id;
        $exec = $con->createConnection()->query($query);
        $resultado = $exec->fetch_assoc();
        return $resultado;
    }

    public function updateData($data) {
        $con = Database::createConnection();
        $query = "UPDATE jugadores set first_name = '" . $data['first_name'] . "', "
                . "last_name = '" . $data['last_name'] . "', "
                . "email = '" . $data['email'] . "', "
                . "username = '" . $data['username'] . "', "
                . "tel = '" . $data['tel'] . "', "
                . "idestados = " . $data['estado']
                . " WHERE fbid = " . $data['id'];
        if (!$con->query($query)) {
            echo '{ "message": "Hubo un problema al momento de crear el Registro, INFO: ' . str_replace('\'', '', $con->error) . $query . ' "}';
        } else {
            echo '{ "message": "Tus Datos han sido actualizados con exito", "nextStep" : "/site/index2.php"}';
        }
        $con->close();
    }

}
