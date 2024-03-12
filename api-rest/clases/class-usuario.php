<?php
    class Usuario {
        private $nombre;
        private $apellido;
        private $fechaDeNacimiento;
        private $genero;

        public function __construct($nombre, $apellido, $fechaDeNacimiento, $genero){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->fechaDeNacimiento = $fechaDeNacimiento;
            $this->genero = $genero;

        }

        public function asignarNombre ($nombre){
            $this->nombre = $nombre;
        }
        
        public function obtenerNombre ($nombre){
            return $this->nombre;
        }

        public function asignarApellido ($apellido){
            $this->apellido = $apellido;
        }

        public function obtenerApellido ($apellido){
            return $this->apellido;
        }

        public function asignarFechaDeNacimiento ($fechaDeNacimiento){
            $this->fechaDeNacimiento = $fechaDeNacimiento;
        }

        public function obtenerFechaDeNacimiento ($fechaDeNacimiento){
            return $this->fechaDeNacimiento;
        }

        public function asignarGenero ($genero){
            $this->genero = $genero;
        }

        public function obtenerGenero ($genero){
            return $this->genero;
        }

        public function __toSring(){
            return $this->nombre ." ".$this->apellido.
            " (".$this->fechaDeNacimiento.", ".$this->genero.")";
        }

        public function guardarUsuario (){
        $contenidoArchivo = file_get_contents("../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        $usuarios[] = array(
                "nombre"=> $this->nombre,
                "apellido"=> $this->apellido,
                "fechaDeNacimiento"=> $this->fechaDeNacimiento,
                "genero"=> $this->genero
        );
        $archivo = fopen("../data/usuarios.json", "w");
        fwrite($archivo, json_encode($usuarios));
        fclose($archivo);
        }

        public static function obtenerUsuarios (){
            $contenidoArchivo = file_get_contents("../data/usuarios.json");
            echo $contenidoArchivo;
        }

        public static function obtenerUsuario ($indice){
            $contenidoArchivo = file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            echo json_encode($usuarios[$indice]);
        }

        public function actualizarUsuario ($indice){
            $contenidoArchivo = file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            $usuario = array(
                "nombre"=> $this->nombre,
                "apellido"=> $this->apellido,
                "fechaDeNacimiento"=> $this->fechaDeNacimiento,
                "genero"=> $this->genero
        );
        $usuarios[$indice] = $usuario;
        $archivo = fopen("../data/usuarios.json", "w");
        fwrite($archivo, json_encode($usuarios));
        fclose($archivo);
        }

        public static function eliminarUsuario ($indice){
            $contenidoArchivo = file_get_contents("../data/usuarios.json");
            $usuarios = json_decode($contenidoArchivo, true);
            array_splice($usuarios, $indice, 1);
            $archivo = fopen("../data/usuarios.json", "w");
            fwrite($archivo, json_encode($usuarios));
            fclose($archivo);
        }
    }
?>