<?php

ob_start();
session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);


$user = $_GET["IdUser"];

$sql1 = "DELETE FROM utilizador where nome= \"$user\"";
$sql2 = "SELECT * FROM utilizador where nome=\"$user\"";
$sql4 = "DELETE FROM funcionario where nome=\"$user\"";

$retval2 = mysqli_query($conn, $sql2); //Envia a consulta sql ao banco de dados


$row = mysqli_fetch_array($retval2); //Obtém os resultados da consulta linha a linha

//Insere nos apagados
$sql3 = "INSERT INTO apagados VALUES ('" . $row["nome"] . "','" . $row["pass"] . "','" . $row["tipo"] . "','" . $row["imagem"] . "','" . $row["telemovel"] . "','" . $row["mail"] . "','" . $row["morada"] . "')";

$retval3 = mysqli_query($conn, $sql3); //Executa a operação de inserir nos apagados

$retval4 = mysqli_query($conn, $sql4); //Apaga dos funcionários

$retval1 = mysqli_query($conn, $sql1); //Apaga do utilizador

//Se ocorreu um erro em alguma das consultas
if (!$retval1 || !$retval2 || !$retval3 || !$retval4) {
    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}


if ($retval1 && $retval2 && $retval3) {
    echo "<script>alert('Apagamento com Sucesso');setTimeout(function () { window.location.href = './gestao_utilizadores.php'; }, 2000);</script>";

} else {
    echo "Apagamento falhado";
}


//header("Location:./gestao_utilizadores.php");

?>