<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>transacciones</title>
    </head>

    <body>
        <?php

            include_once("../modelo/Objeto_Blog.php");
            include_once("../modelo/Manejo_Objetos.php");

            try{
                $miconexion=new PDO('mysql:host=127.0.0.1; dbname=porfolio','root','');
                $miconexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                if($_FILES['imagen']['error']){
                    switch($_FILES['imagen']['error']){
                        case 1: //error exceso de tamaño de archivo
                            echo "El tamaño del archivo supera el límite permitido por el servidor (param upload_max_size de php.ini)";
                            break;
                        case 2: //Error de exceso de tamaño de archivo
                            echo "el tamaño del archivo supera el tamaño permitido por el formulario (post_max_size de php.ini)";
                            break;
                        case 3: //Error interrupción durante la subida
                            echo "El tamaño del archivo es nulo o no se ha enviado archivo";
                            break;
                    }

                }else{

                    echo "Imagen subida correctamente. <br/>";

                    if(isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK)){

                        $destino_de_ruta='../imagenes/';

                        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_de_ruta . $_FILES['imagen']['name']);
                        
                        echo "El archivo ". $_FILES['imagen']['name']. " Se ha copiado en el directorio de imágenes";

                    }else{

                        echo "El archivo no se ha copiado en el directorio de imágenes";
                    }
                                    
                }
                $Manejo_Objetos = new Manejo_Objetos($miconexion);
                $blog = New Objeto_Blog();
                $blog->setTitulo(htmlentities(addslashes($_POST["campo_titulo"]),ENT_QUOTES));
                $blog->setFecha(Date("y-m-d H:i:s"));
                $blog->setComentario(htmlentities(addslashes($_POST["area_comentarios"]),ENT_QUOTES));
                $blog->setImagen($_FILES["imagen"]["name"]);
                $Manejo_Objetos->insertaContenido($blog);
                echo "<br>Entrada agregada con éxito a BBDD<br>";

            }catch(Exception $e){
                die("Error: ". $e->getMessage());
        }
        
        ?>
    </body>
</html>