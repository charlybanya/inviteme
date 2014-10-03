<?php

session_start();
/* error_reporting(E_ALL);
  ini_set('display_errors', true); */
include 'Lists.php';

class Printers {

    public function reviewData($graphObjectArray) {
        /* echo '<pre>';
          var_dump($graphObjectArray);
          echo '</pre>'; */
        $labels = array(
            'Nombre' => 'first_name',
            'Apellidos' => 'last_name',
            'Correo Electronico' => 'email',
            'Nombre para mostrar' => 'name',
            'Teléfono (Móvil o Fijo)' => 'tel'
        );

        echo '<form action= "saveData.php" id = "Form" method = "POST" >' . "\n";
        foreach ($labels as $key => $value) {
            if (key_exists($value, $graphObjectArray)) {
                if ($value == 'email' || $value == 'tel') {
                    echo "\t\t<label>" . $key . ':</label> <input type = "' . $value . '" class="form-control" name = "' . $value . '" value = "' . $graphObjectArray[$value] . '" required ><br />' . "\n";
                } else {
                    echo "\t\t<label>" . $key . ':</label> <input type = "text" class="form-control" name = "' . $value . '" value = "' . $graphObjectArray[$value] . '" required ><br />' . "\n";
                }
            } else {
                echo "\t\t<label>" . $key . ':</label> <input type = "text" class="form-control" name = "' . $value . '" required ><br />' . "\n";
            }
        }
        echo "\t\t" . '<label>Estado: </label><select class="form-control" name = "estado" required >' . "\n";
        getStatesList();
        echo "\t\t" . '<input type = "submit" class="btn btn-primary" value = "Guardar Registro"><br />' . "\n";
        echo "\t\t" . '<label>Al dar click en el botón "Guardar Registro" estas aceptando los Terminos y Condiciones de Uso </label><br />' . "\n";
        echo "\t" . '</form>' . "\n";
    }

    public function userData() {
        echo "\t" . '<div id="userPoints">' . "\n";
        //echo "Hola";
        echo "\t\t\t" . '</div>' . "\n";
        echo "\t\t\t" . '<div id="userPicture">' . "\n";
        echo "\t\t\t\t" . 'Bienvenido:<img class="circular" src="' . $_SESSION['url'] . '">';
        $db = new Database();
        $graphObjectArray = $db->getProfile($_SESSION['graphObjectArray']['id']);
        echo $graphObjectArray['username'];
        echo "\n";
        echo "\t\t\t" . '</div>' . "\n";
    }

    public function reviewProfile($id) {
        /* echo '<pre>';
          var_dump($graphObjectArray);
          echo '</pre>'; */
        $labels = array(
            'Nombre' => 'first_name',
            'Apellidos' => 'last_name',
            'Correo Electronico' => 'email',
            'Nombre para mostrar' => 'username',
            'Teléfono (Móvil o Fijo)' => 'tel'
        );
        $db = new Database();
        $graphObjectArray = $db->getProfile($id);
        echo '<form action= "updateData.php" id = "Form" method = "POST" >' . "\n";
        foreach ($labels as $key => $value) {
            if (key_exists($value, $graphObjectArray)) {
                if ($value == 'email' || $value == 'tel') {
                    echo "\t\t<label>" . $key . ':</label> <input type = "' . $value . '" class="form-control" name = "' . $value . '" value = "' . $graphObjectArray[$value] . '" required ><br />' . "\n";
                } else {
                    echo "\t\t<label>" . $key . ':</label> <input type = "text" class="form-control" name = "' . $value . '" value = "' . $graphObjectArray[$value] . '" required ><br />' . "\n";
                }
            } else {
                echo "\t\t<label>" . $key . ':</label> <input type = "text" class="form-control" name = "' . $value . '" required ><br />' . "\n";
            }
        }
        echo "\t\t" . '<label>Estado: </label><select class="form-control" name = "estado" required >' . "\n";
        getStatesList($graphObjectArray['idestados']);
        echo "\t\t" . '<input type = "submit" class="btn btn-primary" value = "Actualizar"><br />' . "\n";
        echo "\t" . '</form>' . "\n";
    }

    public function sorteosCard() {
        $con = new Database();
        $query = 'SELECT * FROM eventos WHERE disponible = 1';
        $exec = $con->createConnection()->query($query);
        $i = 0;
        while ($eventos = $exec->fetch_assoc()) {
            echo '<article class = "card-smf">' . "\n";
            echo '<div style = "display: block" class = "cardContent">' . "\n";
            echo '<img class = "imgCard" id = "concierto' . $i . '_out" src = "' . $eventos['imgurl'] . '_out.jpg" />' . "\n";
            echo '<a href = "?concurso=' . $eventos['ideventos'] . '"><img class = "imgCard" id = "concierto' . $i . '_on" style = "display:none" src = "' . $eventos['imgurl'] . '.jpg" /></a>' . "\n";
            echo '<div id = "descripcionCard' . $i . '" class = "cardDesc">' . "\n";
            echo utf8_encode($eventos['descripcion']);
            echo '</div>' . "\n";
            echo '</div>' . "\n";
            echo '</article>' . "\n";
            $i++;
        }

        if ($i <= 3) {
            while ($i <= 3) {
                echo '<article class = "card-smf">' . "\n";
                echo '<div style = "display: block" class = "cardContent">' . "\n";
                echo '<img class = "imgCard" id = "concierto' . $i . '_out" src = "images/proximamente_out.png" />' . "\n";
                echo '<a href = "#"><img class = "imgCard" id = "concierto' . $i . '_on" style = "display:none" src = "images/proximamente.png" /></a>' . "\n";
                echo '<div id = "descripcionCard' . $i . '" class = "cardDesc">' . "\n";
                echo 'Mas Eventos Proximamente!' . "\n";
                echo '</div>' . "\n";
                echo '</div>' . "\n";
                echo '</article>' . "\n";
                $i++;
            }
        }
    }

    public function showEvent($id) {
        $con = new Database();
        if ($con->checkSorteo($id)) {
            $query = 'SELECT * FROM eventos WHERE ideventos = '.$id;
            $exec = $con->createConnection()->query($query);
            while ($evento = $exec->fetch_assoc()) {
                echo '<div id="evento">';
                echo '<img src = "'.$evento['imgurl'].'.jpg">';
                echo '<p class="titulo">'.$evento['nombre'].'</p>';
                echo '<p class="fecha">'.$evento['fechainicio'].', '.$evento['fechafin'].'</p>';
                echo '<p class="descripcion">'.$evento['descripcion'].'</p>';
                echo '<h1>Estamos afinando los ultimos detalles,<br />Muy pronto podras participar</h1>';
                echo '</div>';
            }
        } else {
            header('Location: index2.php');
        }
    }

}
