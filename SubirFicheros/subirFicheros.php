<?php
function numeroFicheros(){
    $numeroFicehros = count($_FILES['archivos']['name']);


    return $numeroFicehros;
}

function sizeTodosArchivos(){
    $tamanioFicheroT =0;
    for ($i=0; $i <numeroFicheros(); $i++) {  
        $tamanioFicheroT  += $_FILES['archivos']['size'][$i];
    }

    return $tamanioFicheroT;
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
     //diredtorio en linux
     $directorioSubida = "home/alumnoa/tallerphp/SubirFicheros/imgusers";
     //directorio en windos
     $directorioSubidaWin = "C:\Users\gonza\OneDrive\Escritorio\imguser";
    echo $directorioSubidaWin."<br>";
    if (is_dir($directorioSubidaWin) && is_writable($directorioSubidaWin)) {
        echo "Dir correcto y se puede escribir<br>";
        echo "Numero de ficheros=>".numeroFicheros()."<br>";
        echo "Tamaño total de ficheros=>".sizeTodosArchivos()."<br>";
    
        if(sizeTodosArchivos()<300000){        
            for ($i=0; $i <numeroFicheros(); $i++) { 
            $nombreFichero   = $_FILES['archivos']['name'][$i];
            $tipoFichero     = $_FILES['archivos']['type'][$i];
            $tamanioFichero  = $_FILES['archivos']['size'][$i];
            $temporalFichero = $_FILES['archivos']['tmp_name'][$i];
            $errorFichero    = $_FILES['archivos']['error'][$i];
                if($tipoFichero == "image/png" or $tipoFichero == "image/jpeg"){
                    if($tamanioFichero<=200000){
                        if(!file_exists($directorioSubidaWin.'/'.$nombreFichero)){
                            if (move_uploaded_file($temporalFichero,  $directorioSubidaWin .'/'. $nombreFichero) == true)
                            {
                                echo 'Archivo guardado en:=>' . $directorioSubidaWin .'/'. $nombreFichero . ' <br/>';
                            }else
                            {
                                echo  'Error al guardar el archivo=>'.$nombreFichero.' <br/>';
                            }
                        }else
                        {
                            echo "Error El fichero ya existe=>".$nombreFichero.' <br/>';
                        }
                    }else
                    {
                        echo "Error El tamaño del fichero es demasio grande=>".$nombreFichero.' <br/>';
                    }
                }else
                {
                    echo "Error El tipo de fichero no es valido o es demasiado grande=>".$nombreFichero.' <br/>';
                }          
            }
        }else
        {
            echo "Error El tamaño total de los archivos supera el valido";
        }

    }else{
        echo "El directorio no es correcto o no tiene permisos de escritura ";
    }


}

echo "<pre> <hr>";
var_dump($_FILES);
echo "</pre>";
?>