<?php

    class Objeto_Blog{
        
        //Propiedades del Objeto_Blog
        private $id;
        private $Titulo;
        private $Fecha;
        private $Comentario;
        private $Imagen;
        
        //Métodos de acceso getters y setters
        public function getId(){
            return $this->id;  //Devuelveme el id del objeto (de la entrada de blog) donde me encuentro.
        }
        public function setId($id){ //A este método se pasa por parámetro un argumento. Será el valor
            $this->id=$id; //Será el valor que le de a la propiedad id del propio objeto.
            //Con $this-> id hace referencia a la propiedad id del objeto
            //y con $id hace referencia al parámetro o argumento que le he pasado a este método en su llamada
        }
        public function getTitulo(){
            return $this->Titulo;
        }
        public function setTitulo($Titulo){
            $this->Titulo=$Titulo;
        }
        public function getComentario(){
            return $this->Comentario;
        }
        public function setComentario($Comentario){
            $this->Comentario=$Comentario;
        }
        public function getFecha(){
            return $this->Fecha;
        }
        public function setFecha($Fecha){
            $this->Fecha=$Fecha;
        }
        public function getImagen(){
            return $this->Imagen;
        }
        public function setImagen($Imagen){
            $this->Imagen=$Imagen;
        }
                
    }
?>