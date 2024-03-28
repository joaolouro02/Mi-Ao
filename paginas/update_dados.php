<?php

ob_start();
session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);

$sql = "SELECT pass FROM utilizador WHERE nome = \"" . $_SESSION["user"] . "\""; //$session tem de tar fora da "" mas o valor resultante tem de tar dentro de "" para ser comparado com a coluna nome

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}
$row = mysqli_fetch_array($retval);

if (strcmp($row["pass"], md5($_POST["pass"])) == 0) { //Se as password da tabela for igual à password introduzida
    if (strcmp($_POST["pass"], $_POST["conf_pass"]) == 0) { //Se pass==confirm faz update

        //Obtem os dados vindos do formulário do dados_pessoais
        $sql = sprintf("UPDATE utilizador 
SET 
mail='" . $_POST["email"] . "',
imagem='" . $_POST["imagem"] . "',
morada='" . $_POST["morada"] . "',
pass='" . md5($_POST["pass"]) . "',
telemovel='" . $_POST["telemovel"] . "' 
WHERE nome='" . $_POST["IdUser"] . "'");
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
        }
        echo "<script> setTimeout(function () { window.location.href = './pagina_gestao.php'; }, 0000)</script>";

    } else {
        echo "Imcompatíveis";
    }
} else {
    echo "Pasword Errada";
}
?>