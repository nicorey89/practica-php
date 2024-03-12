<?php
    //echo "informacion: " . file_get_contents('php://input');
        header("content-Type: application/json");
        include_once("../clases/class-usuario.php");
    //peticiones del usuario
        switch ($_SERVER['REQUEST_METHOD']) {
            //crear
            case 'POST':
                $_POST = json_decode(file_get_contents('php://input'), true);
                $usuario = new Usuario($_POST["nombre"],$_POST["apellido"],$_POST["fechaDeNacimiento"],$_POST["genero"]);
                $usuario->guardarUsuario();
                $resultado["mensaje"] = "Guardar el usuario, informacion: ". json_encode($_POST);
                echo json_encode($resultado);
            break;
            
            //obtener un usuario
            //obtener todos los usuarios
            case 'GET':
                if (isset($_GET['id'])){
                    Usuario::obtenerUsuario($_GET['id']);
                }else{
                    Usuario::obtenerUsuarios();
                }
            break;
            
            //actualizar un usuario
            case 'PUT':
                $_PUT = json_decode(file_get_contents('php://input'), true);
                $usuario = new Usuario($_PUT["nombre"],$_PUT["apellido"],$_PUT["fechaDeNacimiento"],$_PUT["genero"]);
                $usuario->actualizarUsuario($_GET['id']);
                $resultado["mensaje"] ="Actualizar el usuario con el id: ". $_GET['id'] . 
                                        ", Informacion a actualizar: ". json_encode($_PUT);
                echo json_encode($resultado);
            break;
            
            //eliminar un usuario
            case 'DELETE':
                Usuario::eliminarUsuario($_GET['id']);
                $resultado["mensaje"] = "Se elimino el usuario con id: " . $_GET['id'];
                echo json_encode($resultado);
            break;
        };

