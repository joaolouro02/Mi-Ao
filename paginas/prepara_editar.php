<?php

session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

$user = $_GET["IdUser"];

$sql = "Select * from utilizador where nome = " . "\"$user\"";

$retval = mysqli_query($conn, $sql);

$res = mysqli_fetch_assoc($retval);

echo '
<form action="editar.php" method="post">
    Nome de Utilizador<input name="nomeUtilizador" value=' . $user . ' readonly><br>
    Mail<input name="mail" value=' . $res["mail"] . '><br>
    Imagem<input name="imagem" value=' . $res["imagem"] . '><br>
    Morada<input name="morada" value=' . $res["morada"] . '><br>
    Pass<input name="pass" value=' . $res["pass"] . '><br>
    Telemóvel<input name="telemovel" value=' . $res["telemovel"] . '><br>
    Tipo<input name="tipo" value=' . $res["tipo"] . '><br>

    <input type="submit" value="Entrar">
</form>

';

?>