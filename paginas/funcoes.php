<?php

define("Cliente_nao_validado", -1);
define("Cliente", 1);
define("Funcionario", 2);
define("Administrador", 3);


function session_protection()
{
    //se as variáveis de sessão estiverem vazias
    if (!isset($_SESSION["user"]) || !isset($_SESSION["tipo"])) { //Só entra se tiver sessão iniciada
        echo "Não pode estar aqui!";
        header("refresh:2;url = pagina_inicial.php");
        exit;
    }
}

function cargo_protection($cargos)
{
    //se o tipo do user não estiver no array
    if (!in_array($_SESSION["tipo"], $cargos)) {
        echo "O seu cargo não o permite estar aqui!";
        header("refresh:2;url = pagina_inicial.php");
        exit;
    }
}

?>