<?php

ob_start();
session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

$user = $_POST["nomeUtilizador"];
$mail = $_POST["mail"];
$imagem = $_POST["imagem"];
$morada = $_POST["morada"];
$pass = md5($_POST["pass"]);
$telemovel = $_POST["telemovel"];
$tipo = $_POST["tipo"];

$sql = sprintf("UPDATE utilizador set  mail = \"%s\", imagem = \"%s\",morada = \"%s\" ,pass = \"%s\" ,telemovel = \"%s\" ,tipo = \"%s\"  
                    where nome = \"%s\"", $mail, $imagem, $morada, $pass, $telemovel, $tipo, $user);

$retval = mysqli_query($conn, $sql);

header("Location:./gestao_utilizadores.php");

?>