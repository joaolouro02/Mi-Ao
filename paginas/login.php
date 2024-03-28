<?php

ob_start();
session_start();

//Se as pass tiverem sido enviadas pelo post(isset) e não forem vazias
if (isset($_POST["utilizador"]) && isset($_POST["password"]) && $_POST["utilizador"] !== "" && $_POST["password"] !== "") {

    $utilizador = $_POST["utilizador"];
    $password = $_POST["password"];

    include("../basedados/basedados.h");

    $sql = "SELECT * FROM utilizador WHERE nome = '$utilizador' AND pass = '" . md5($password) . "'";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($retval);

    if (!$row) { //Se não retornar nenhum resultado
        echo "Cliente Inválido";
        echo "<script> setTimeout(function () { window.location.href = './pagina_inicial.php'; }, 1000)</script>";
    } else if ($row["tipo"] == -1) {
        echo "Conta não validada";
        echo "<script> setTimeout(function () { window.location.href = './pagina_inicial.php'; }, 1000)</script>";
    } else if (strcmp($row["nome"], $utilizador) == 0 && strcmp($row["pass"], md5($password)) == 0) { //Cria sessão
        $_SESSION["user"] = $row["nome"];
        $_SESSION["tipo"] = $row["tipo"];
        header("refresh:1;url = pagina_gestao.php");
    }

} else {
    session_destroy();
    header("refresh:1;url = pagina_inicial.php");
}
?>