<?php

include 'Database.php';

function getStatesList($idestados) {

    $con = new Database();
    $query = 'SELECT * FROM estados';
    $exec = $con->createConnection()->query($query);
    echo "\t\t\t" . '<option value="">Selecciona...</option>' . "\n";
    while ($resultado = $exec->fetch_assoc()){
        echo "\t\t\t" . '<option value="' . $resultado['idestados'] . '" ';
        echo ($resultado['idestados'] == $idestados ? 'selected' : '');
        echo '>' . $resultado['idestados'] . ' - ' . utf8_encode($resultado['estado']) . '</option>' . "\n";
    }
    echo "\t\t" . '</select><br />' . "\n";
    $exec->close();
}

?>