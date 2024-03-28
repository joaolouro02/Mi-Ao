<?php

session_start();


//Variáveis de sessão do user
$id = $_SESSION["user"];
$tipo = $_SESSION["tipo"];


include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);

//seleciona as reservas consoante o seu tipo de user
if ($tipo == Administrador) {
    $sql = "select * from reserva inner join utilizador on n=nome";
} else if ($tipo == Funcionario) {
    $sql = "select * from reserva inner join utilizador on n=nome where funcionarioId=\"$id\"";
} else {
    $sql = "select * from reserva inner join utilizador on n=nome where n=\"$id\"";
}

$retval = mysqli_query($conn, $sql);
if (!$retval) {
    die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}

echo "<table border=1px style=\"text-align:center\">";

while ($row = mysqli_fetch_array($retval)) {
    echo "
<tr>
<th>Cliente</th>
<th>funcionario</th>
<th>Dia</th>
<th>Hora Inicio</th>
<th>Hora Fim</th>
<th>Preço</th>
<th>Editar</th>
<th>Concluída</th>
<tr>
<td>$row[n]
<td>$row[funcionarioId]
<td>$row[dia]
<td>$row[horaInicio]
<td>$row[horaFim]
<td>$row[preco]
<td><a href=preparaEditarR.php?IdRes=" . urlencode($row["n"]) . "&horaInicio=" . urlencode($row["horaInicio"]) . "&dia=" . urlencode($row["dia"]) . "&horaFimAntiga=" . urlencode($row["horaFim"]) . "><img src=editar.png width=50 height=50></a>
<td><a href=apagarR.php?IdRes=" . urlencode($row["n"]) . "&horaInicio=" . urlencode($row["horaInicio"]) . "&dia=" . urlencode($row["dia"]) . "><img src=apagar.png width=50 height=50></a>";
}

//Para o editar Reserva mandamos: ID, HoraInicio(Antiga), HoraFim(Antiga) e Dia
//Para apagar Reserva mandamos: ID, HoraInicio e Dia


echo "</table>";

?>