<?php

session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente, Funcionario, Administrador);
cargo_protection($cargosAceites);

$id_user = $_SESSION["user"];

//seleciona o utilizador
$sql = "SELECT * FROM utilizador WHERE nome=\"$id_user\"";

$res = mysqli_query($conn, $sql); //Executa a query no banco de dados
$dados_user = mysqli_fetch_array($res); //Obtem os dados 
$nome = $dados_user['nome'];
$telemovel = $dados_user['telemovel'];
$morada = $dados_user['morada'];
$imagem = $dados_user['imagem'];
$email = $dados_user['mail'];


echo "
<form method='POST' action='update_dados.php'>
Nome de Utilizador:<br>
<input type = 'text' name='IdUser' value='$nome' readonly><br>
Email:<br>
<input type = 'email' name='email' value='$email'><br>


Password:<br>
<input type = 'password' name='pass'><br>


Confirmação da Password:<br>
<input type = 'password' name='conf_pass'><br>


Telemóvel:<br>
<input type = 'tel' name='telemovel' value='$telemovel'><br>

Morada:<br>
<input type = 'text' name='morada' value='$morada'><br>
Imagem:<br>
<input type = 'text' name='imagem' value='$imagem'><br>

<input type='submit' value='Actualizar' id='registo'>
</form>
";

?>