<?php

include 'Lists.php';

class Printers {

    public function reviewData($graphObjectArray) {
        /*echo '<pre>';
        var_dump($graphObjectArray);
        echo '</pre>';*/
        $labels = array(
            'Nombre' => 'first_name',
            'Apellidos' => 'last_name',
            'Correo Electronico' => 'email',
            'Nombre para mostrar' => 'name',
            'Dirección' => 'address'
        );

        echo '<form action= "saveData.php" id = "Form" method = "POST" >' . "\n";
        foreach ($labels as $key => $value) {
            if (key_exists($value, $graphObjectArray)) {
                echo "\t\t<label>" . $key . ':</label> <input type = "text" class="form-control" name = "' . $value . '" value = "' . $graphObjectArray[$value] . '" required ><br />' . "\n";
            } else {
                echo "\t\t<label>" . $key . ':</label> <input type = "text" class="form-control" name = "' . $value . '" required ><br />' . "\n";
            }
        }
        getStatesList();
        echo "\t\t" . '<input type = "submit" class="btn btn-primary" value = "Guardar Registro"><br />' . "\n";
        echo "\t\t" . '<label>Al dar click en el botono "Guardar Registro" estas aceptando los Terminos y Condiciones de Uso </label><br />' . "\n";
        echo "\t" . '</form>' . "\n";
    }

}
