<?php

ob_start();
session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

//Se não preencher tudo
if (!isset($_POST["habilidade"]) || empty($_POST["nome"]) || empty($_POST["password"])) {
    echo "Introduza de forma correta";
    echo "<script> setTimeout(function () { window.location.href = './novoFuncionario.php'; }, 1000)</script>";
    exit;
}

$nome = $_POST["nome"];
$pass = $_POST["password"];
$selecionadas = "";

//Recebe um array com todas as habilidades selecionadas
$habilidades = $_POST["habilidade"];
//print_r($habilidades);

foreach ($habilidades as $habilidade) {
    $selecionadas .= $habilidade;
}

//echo $selecionadas;


$sql0 = "SELECT nome from utilizador where nome=\"$nome\"";
$retval0 = mysqli_query($conn, $sql0);

$sql5 = "SELECT nome from funcionario where nome=\"$nome\"";
$retval5 = mysqli_query($conn, $sql5);
$sql1 = "INSERT INTO utilizador(nome, pass, tipo,imagem) VALUES ('$nome', '" . md5($pass) . "', 2,'func.png')";
$sql2 = "INSERT INTO funcionario VALUES(\"$nome\")";
$sql3 = "INSERT INTO funcionario_servico values(\"$nome\",\"$selecionadas\")";


if (mysqli_num_rows($retval5) > 0) { // Se já existir funcionário
    echo "<script>alert('Esse funcionário já existe');setTimeout(function () { window.location.href = './novoFuncionario.php'; }, 2000);</script>";
    exit;
}

if (mysqli_num_rows($retval0) > 0) { //Se já existir utilizador
    $retval2 = mysqli_query($conn, $sql2);
    $retval3 = mysqli_query($conn, $sql3);

    $sql4 = "UPDATE utilizador set tipo=2, imagem='func.png' where nome=\"$nome\"";

    $retval4 = mysqli_query($conn, $sql4);

    if ($retval2 && $retval3 && $retval4) {
        echo "<script>alert('Inserção com Sucesso');setTimeout(function () { window.location.href = './gestao_utilizadores.php'; }, 2000);</script>";
    } else {
        echo "ERRO 1";
    }
} else { //Não existe nenhum
    $retval1 = mysqli_query($conn, $sql1);
    $retval2 = mysqli_query($conn, $sql2);
    $retval3 = mysqli_query($conn, $sql3);
    if ($retval1 && $retval2 && $retval3) {
        echo "<script>alert('Inserção com Sucesso');setTimeout(function () { window.location.href = './gestao_utilizadores.php'; }, 2000);</script>";
    } else {
        echo "ERRO 2";
    }
}

?>