<?php

ob_start();
session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);


$user = $_GET["IdRes"];
$horario = $_GET["horaInicio"];
$dia = $_GET["dia"];


$sql = "delete from reserva where n= \"$user\" and horaInicio=\"$horario\" and dia=\"$dia\"";
$retval = mysqli_query($conn, $sql); //Executa a consulta no banco de dados


header("Location:./pagina_reservas.php");

?>