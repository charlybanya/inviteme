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
                echo "\t\t" . $key . ': <input type = "text" name = "' . $value . '" value = "' . $graphObjectArray[$value] . '" required ><br />' . "\n";
            } else {
                echo "\t\t" . $key . ': <input type = "text" name = "' . $value . '" required ><br />' . "\n";
            }
        }
        getStatesList();
        echo "\t\t" . '<input type = "checkbox" name = "verified" required >Acepto los Terminos y Condiciones de Uso <br />' . "\n";
        echo "\t\t" . '<input type = "submit" value = "Guardar">' . "\n";
        echo "\t" . '</form>' . "\n";
    }

}
