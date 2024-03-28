<?php


session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);

//Recebe os valores necessários para editar a reserva
$id = $_GET["IdRes"];
$hora = $_GET["horaInicio"];
$dia = $_GET["dia"];
$horaFimAntiga = $_GET["horaFimAntiga"];


/*
echo $id;
echo $hora;
echo $dia;
echo $horaFimAntiga;*/

//Seleciona a reserva específica
$sql = "select * from reserva where n=\"$id\" and horaInicio=\"$hora\" and dia=\"$dia\"";
$retval = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($retval);

//se tiver algum erro vai para a página de gestão adicionado porcausa que dava erro se voltasse para tras ele ja n tinha dados no sql
if (!$res) {
    header("Location: pagina_gestao.php");
    exit();
}

echo '
<form action="editarR.php" method="POST">
<input name="IdReserva" value=' . $id . ' hidden><br>
Funcionario Id<input name="IdFuncionario" value=' . $res["funcionarioId"] . '><br>
Dia<input name="dia" value=' . $res["dia"] . '><br>
Hora Inicío<input name="hora_inicio" value=' . $res["horaInicio"] . '><br>
Hora Fim<input name="hora_fim" value="' . $res["horaFim"] . '" readonly><br>
<input name="hora" value=' . $hora . ' hidden><br>
<input name="horaFimAntiga" value=' . $horaFimAntiga . ' hidden><br>
<input name="diaAntigo" value=' . $dia . ' hidden><br>
<input type="submit" value="Entrar">
</form>
';

?>