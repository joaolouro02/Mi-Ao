<?php

ob_start();
session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente);
cargo_protection($cargosAceites);

//Se não tiver preenchido a data ou o funcionário
if (empty($_GET["data"]) || !isset($_GET['funcionario'][0])) {
    echo "Introduza os dados corretamente";
    header("refresh:3;url = pagina_servico.html");
    exit;
}

$tipo = $_GET["tipo"];
$animal = $_GET["animal"];


$nome = $_SESSION["user"];
$data_hora_inicio = strtotime($_GET["data"]);
if ($tipo == "Lavar") {
    $duracao_segundos = 0.5 * 3600;
    if ($animal == 'Cao') {
        $preco = 8;
    } else {
        $preco = 5;
    }
} else {
    $duracao_segundos = 1 * 3600;
    if ($animal == 'Cao') {
        $preco = 10;
    } else {
        $preco = 8;
    }
}

//Data final
$data_hora_fim = $data_hora_inicio + $duracao_segundos;
$hora_fim = date("H:i:s", $data_hora_fim);

$data_inicio = date("Y-m-d", $data_hora_inicio);
$hora_inicio = date("H:i:s", $data_hora_inicio);


$funcionario = $_GET['funcionario'][0];
//Seleciona as reservas para aquele funcionário
$con_horas_inicio = "select dia,horaInicio,horaFim from reserva where funcionarioId = \"$funcionario\"";
$retval2 = mysqli_query($conn, $con_horas_inicio);

while ($row = mysqli_fetch_array($retval2)) {
    //echo "Horas de Início: " . $row["horaInicio"] . "<br>";
    if ($data_inicio == $row["dia"] && $hora_inicio >= $row["horaInicio"] && $hora_inicio <= $row["horaFim"]) {
        echo "<script>alert('Horario indisponivel');setTimeout(function () { window.location.href = './pagina_servico.html'; }, 0);</script>";
        exit;
    }
}
$sql = "insert into reserva (n, funcionarioId,dia,horaInicio,horaFim,preco) values(\"$nome\",\"$funcionario\",\"$data_inicio\",\"$hora_inicio\",\"$hora_fim\",\"$preco\")";
$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}
if ($retval) {
    echo "<script>alert('Reserva com Sucesso');setTimeout(function () { window.location.href = './pagina_reservas.php'; }, 0);</script>";
} else {
    echo "insert falhado";
}

?>