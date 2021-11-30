<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>

    <body>

        <?php

            include_once("../modelo/Manejo_Objetos.php");

            try{
                $miconexion=new PDO('mysql:host=127.0.0.1; dbname=porfolio','root','');
                $miconexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $Manejo_Objetos=new Manejo_Objetos($miconexion);
                    $tabla_blog=$Manejo_Objetos->getContenidoPorFecha();
                    if(empty($tabla_blog)){
                        echo "no hay entradas de blog todavía";
                    }else{
                        foreach($tabla_blog as $valor){
                            echo "<h3>" .$valor->getTitulo() ."</h3>";
                            echo "<h3>" .$valor->getFecha() ."</h3>";
                            echo "<div >";
                            echo $valor->getComentario() . "</div>" ;
                                if($valor->getImagenes()!=""){
                                    
                                    echo "<img src='../imagenes/";
                                    echo $valor->getImagen() . "' width='300px' height='200px'/>";
                                }
                            echo "<hr/>";
                        }
                    }        
                            
            }catch(exception $e){
                
                die("Error: " . $e->getMessage());
            }
            
        ?>
            <a href="formulario.php">volver a la página de insercion"</a>
    
        </body>
    </html>