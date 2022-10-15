<?php
function numeroFicheros(){
    $numeroFicehros = count($_FILES['archivos']['name']);


    return $numeroFicehros;
}

if (count($_POST) == 0 ){
        echo "Error: se supera el tamaño máximo de un petición POST ";
    }
// si no se reciben el directorio de alojamiento y el archivo, se descarta el proceso
else if ((!isset($_FILES['archivos']['name']))) {
  echo "ERROR: No se indicó el archivo";
}
else{
     // se reciben el directorio de alojamiento y el archivo
     $directorioSubida = "home/alumnoa/tallerphp/SubirFicheros/imgusers";
     $directorioSubidaWin = "";
    echo $directorioSubida."<br>";
    if (is_dir($directorioSubida) && is_writable($directorioSubida)) {
        echo "Dir correcto y se puede escribir";
        for ($i=0; $i <numeroFicheros(); $i++) { 
            $nombreFichero   = $_FILES['archivos']['name'][$i];
            $tipoFichero     = $_FILES['archivos']['type'][$i];
            $tamanioFichero  = $_FILES['archivos']['size'][$i];
            $temporalFichero = $_FILES['archivos']['tmp_name'][$i];
            $errorFichero    = $_FILES['archivos']['error'][$i];
            if (move_uploaded_file($temporalFichero,  $directorioSubida .'/'. $nombreFichero) == true) {
            echo 'Archivo guardado en: ' . $directorioSubida .'/'. $nombreFichero . ' <br/>';
            }       
        }
    }else{
        echo "El directorio no es correcto o no tiene permisos de escritura ";
    }


}

echo "<pre> <hr>";
var_dump($_FILES);
echo "</pre>";
?>