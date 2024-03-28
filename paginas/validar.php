<?php

ob_start();
session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

$user = $_GET["IdUser"];

$sql = "UPDATE utilizador set tipo=1 where nome=\"$user\"";

mysqli_query($conn, $sql);
header("refresh:0;url = gestao_utilizadores.php");

?>