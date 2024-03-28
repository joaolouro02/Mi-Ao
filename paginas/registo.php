<?php


include("../basedados/basedados.h");

if (!isset($_POST["nome"], $_POST["mail"], $_POST["imagem"], $_POST["morada"], $_POST["pass"], $_POST["telemovel"])) {
    header("Location:./pagina_inicial.php");
}
$nomeUtilizador = $_POST["nome"];
$mail = $_POST["mail"];
//$imagem = $_POST["imagem"];
$morada = $_POST["morada"];
$pass = $_POST["pass"];
$tlm = $_POST["telemovel"];


$sql = "INSERT INTO utilizador
 (nome,pass,tipo,imagem,telemovel,mail,morada) 
 VALUES 
 ('$nomeUtilizador', '" . md5($pass) . "', -1, 'cliente.png', '$tlm', '$mail', '$morada')";


$res = mysqli_query($conn, $sql);

if (!$res) {
    die('Could not get data: ' . mysqli_error($conn));
}

if ($res) {
    echo "<script>alert('Registo com Sucesso');setTimeout(function () { window.location.href = './pagina_inicial.php'; }, 2000);</script>";

} else {
    echo "Registo falhado";
}

?>