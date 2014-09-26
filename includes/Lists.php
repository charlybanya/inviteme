<?php

include 'Database.php';

function getStatesList() {
    $con = Database::createConnection();
    $query = 'SELECT * FROM estados';
    $exec = $con->query($query);
    $resultado = $exec->fetch_assoc();
    echo "\t\t" . '<select name = "estado" required >' . "\n";
    foreach ($resultado as $key => $value) {
        echo "\t\t\t" . '<option value="' . $value[0] . '">' . $value[0] . ' - ' . $value[1] . '</option>' . "\n";
    }
    echo "\t\t" . '</select><br />' . "\n";
    $con->close();
    //echo "Hola!";
}

?>