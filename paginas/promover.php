<?php
ob_start();
session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

$user = $_GET["IdUser"];

$sql = "UPDATE utilizador set tipo=3, imagem='admin.png' where nome=\"$user\"";

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}

if ($retval) {
    echo "<script>alert('Promoção com Sucesso');setTimeout(function () { window.location.href = './gestao_utilizadores.php'; }, 2000);</script>";

} else {
    echo "Promoção falhada";
}

?>