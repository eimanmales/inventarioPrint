<?php
    function usuarioAutenticado(){
        if(!verificarUsuario()){
            header("location:index.php");
            exit();
        }
    }
    function verificarUsuario(){
        return isset($_SESSION["documentoUsu"]);
    }
    session_start();
    usuarioAutenticado();

?>