<?php

ob_start();
session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);

$id = $_POST["IdReserva"];
$idFuncionario = $_POST["IdFuncionario"];
$dia = $_POST["dia"];
$hora_inicio = $_POST["hora_inicio"];
$hora_fim = $_POST["hora_fim"];
$hora_fim_antiga = $_POST["horaFimAntiga"];
$hora_antiga = $_POST["hora"];
$dia_antigo = $_POST["diaAntigo"];


//Garante que o funcionário inserido existe
$funcionario_existe = "SELECT * FROM funcionario where nome=\"$idFuncionario\"";
$retval3 = mysqli_query($conn, $funcionario_existe);
if (mysqli_num_rows($retval3) == 0) {
    echo "<script>alert('Esse funcionário não existe');setTimeout(function () { window.location.href = './pagina_gestao.php'; }, 1000);</script>";
}



$dt_inicio = new DateTime($hora_antiga);
$dt_fim = new DateTime($hora_fim_antiga);
$diferenca = $dt_fim->diff($dt_inicio); //diferença das horas antigas


//Hora nova
$dt_inicio_nova = new DateTime($hora_inicio);

$dt_fim_nova = null;

if ($diferenca->i == 30) {
    $intervalo = new DateInterval('PT30M');
    $dt_inicio_nova_copia = clone $dt_inicio_nova; // Copia a data de início para nao alterar a hora nova
    $dt_fim_nova = $dt_inicio_nova_copia->add($intervalo); //Adiciona o tempo


} else {

    $intervalo = new DateInterval('PT60M');
    $dt_inicio_nova_copia = clone $dt_inicio_nova; // Copia a data de início
    $dt_fim_nova = $dt_inicio_nova_copia->add($intervalo);

    //echo $dt_fim_nova->format('H:i:s'); 
    //echo $dt_inicio_nova->format('H:i:s');

}

//Seleciona as reservas para aquele cliente feitas nos mesmo dia
$sql1 = "SELECT * FROM reserva where n=\"$id\" and dia=\"$dia\"";
$retval1 = mysqli_query($conn, $sql1);

while ($row = mysqli_fetch_array($retval1)) {

    if (
        //Se o funcionário for o mesmo, o dia também e a horaInicio for ! da horaInicio antiga(Própria reserva)
        $row["funcionarioId"] == $idFuncionario && $row["dia"] == $dia && $row["horaInicio"] != $dt_inicio->format('H:i:s') &&
        (($dt_inicio_nova->format('H:i:s') >= $row["horaInicio"] && $dt_inicio_nova->format('H:i:s') <= $row["horaFim"])
            || ($dt_fim_nova->format('H:i:s') >= $row["horaInicio"] && $dt_fim_nova->format('H:i:s') <= $row["horaFim"]) ||
            ($dt_inicio_nova->format('H:i:s') <= $row["horaInicio"] && $dt_fim_nova->format('H:i:s') >= $row["horaInicio"])
            || ($dt_inicio_nova->format('H:i:s') <= $row["horaInicio"] && $dt_fim_nova->format('H:i:s') >= $row["horaFim"]))
    ) {
        echo "<script>alert('Já está ocupado');setTimeout(function () { window.location.href = './pagina_reservas.php'; }, 1000);</script>";
        exit;
    }

}

$sql = sprintf(
    "UPDATE reserva set funcionarioId = \"%s\",dia = \"%s\",horaInicio=\"%s\",horaFim=\"%s\"
where n = \"%s\" and horaInicio=\"$hora_antiga\" and dia=\"$dia_antigo\"",
    $idFuncionario,
    $dia,
    $hora_inicio,
    $dt_fim_nova->format('H:i:s'),
    $id
);
$retval = mysqli_query($conn, $sql);


echo "<script>alert('Reserva Editada com Sucesso');setTimeout(function () { window.location.href = './pagina_reservas.php'; }, 1000);</script>";


?>