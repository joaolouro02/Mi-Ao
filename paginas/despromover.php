<?php
ob_start();
session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

//Obtem o nome do user
$user = $_GET["IdUser"];

//Faz a atualização para cliente
$sql1 = "UPDATE utilizador set tipo=1, imagem='cliente.png' where nome=\"$user\"";

//Apaga do funcionario e consequentemente do funcionarioServiço e reserva
$sql3 = "DELETE FROM funcionario where nome=\"$user\"";


$retval1 = mysqli_query($conn, $sql1);

$retval3 = mysqli_query($conn, $sql3);

if (!$retval1 || !$retval3) {
    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}

if ($retval1 && $retval3) {
    echo "<script>alert('Despromoção com Sucesso');setTimeout(function () { window.location.href = './gestao_utilizadores.php'; }, 2000);</script>";

} else {
    echo "Despromoção falhada";
}

?>