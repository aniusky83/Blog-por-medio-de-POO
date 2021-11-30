<?php

    include_once("Objeto_Blog.php");
    class Manejo_Objetos{ //Se instancia la clase
        
        private $conexion;

        //Se ejecuta el constructor
        public function __construct($conexion){ 
            $this->setConexion($conexion); /*Vamos a llamar a un método  dentro de esta clase que se va a encargar de establecer la 
                                           conexión.
                                           A ese método le mandamos un parámetro o argumento, que es a su vez el que hemos recibido en 
                                           el constructorque es $conexion*/
            }
            

        /*El constructor llama a este método desde el cual se establece la conexión por PDO
        Con esto la conexión a la BBDD estaría ya establecida.*/
        public function setConexion(PDO $conexion){
                $this->conexion=$conexion;
            }

        //Creamos método para obtener las entradas del blog
        public function getContenidoPorFecha(){
            $matriz=array(); //Para guardar las entradas de blog en un array
            $contador=0; //Para movernos de una a otra entrada de blog (de registro a registro)

            /*Creamos una variable $resultado y decimos que esto va a ser = $this->conexion y llamamos al método query. Y dentro de 
            este método query construimos la consulta*/
            $resultado=$this->conexion->query("SELECT * FROM contenido ORDER BY Fecha");

            //Recorrer y registro a registro guardar en el array
            //Una variable registro va a ser = a resultado y usamos un array asociativo
            while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
               
                $blog=new Objeto_Blog(); //Creamos una variable $blog que va a ser una instancia de Objeto_Blog

                //Creamos todas las propiedades y métodos de este objeto para crear una entrada de blog
                $blog->setId($registro["Id"]);
                $blog->setTitulo($registro["Titulo"]);
                $blog->setFecha($registro["Fecha"]);
                $blog->setComentario($registro["Comentario"]);
                $blog->setImagen($registro["Imagen"]);
                
                //Almacenar dentro del array este primer objeto creado
                $matriz[$contador]=$blog;
                $contador++;
            }
            return $matriz; //Estamos dentro de un método y tenemos que decirle que nos devuelva el contenido del blog
        }

        //Creamos otro método que lo que hace es insertar las nuevas entradas del blog
        public function insertaContenido(Objeto_Blog $blog){ /*Este método tiene que recibir por parámetro un objeto de tipo blog 
                                                             ($blog que es como se llama el objeto)
                                                             Objeto_Blog es el nombre de la clase y $blog es el nombre que le damos al objeto*/

            $sql="INSERT INTO CONTENIDO (Titulo, Fecha, Comentario, Imagen) VALUES ('" . $blog->getTitulo() . "',
            '" . $blog->getFecha() . "','" . $blog->getComentario() . "','" . $blog->getImagen() . "')";
            
            $this->conexion->exec($sql);//Para ejecutar la instrucción sql
        }
    }

?>