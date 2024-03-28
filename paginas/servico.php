<?php

ob_start();
session_start();
include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Cliente);
cargo_protection($cargosAceites);


//Se não preencher os 2 campos
if (!isset($_GET["animal"]) || !isset($_GET["tipo"])) {
  echo "Introduza de forma correta";
  echo "<script> setTimeout(function () { window.location.href = './pagina_servico.html'; }, 1000)</script>";
  exit;
}

$animal = $_GET["animal"][0];
$tipo = $_GET["tipo"][0];
$resultado = $animal . " " . $tipo;
//echo $resultado;

//Seleciona o numero dos serviços onde a coluna tipo está contida na var resultado
$aux = "select servicoId from servico where locate(tipo,\"$resultado\")";

$var = "";
$retval2 = mysqli_query($conn, $aux);
while ($row2 = mysqli_fetch_array($retval2))
  $var .= $row2["servicoId"];

//echo $var;

//Recebe uma string e divide em um array, cada caracteter da string representa um elemento no array
$var_digits = str_split($var);

//print_r($var_digits);

//junta os elementos do array numa string separados pelo caracter | cria um padrão de expressão regular
$regex_pattern = implode('|', $var_digits); // Converte o array em um padrão: '1|5'

//echo $regex_pattern;


$sql = "
  SELECT f.nome
  FROM funcionario f
  INNER JOIN funcionario_servico fs ON f.nome = fs.idFuncionario
  WHERE fs.idServico IN (
  SELECT idServico
  FROM funcionario_servico
  WHERE idServico REGEXP '$regex_pattern'
  );
  ";
//REGEXP é uma função do MySql que permite fazer comparações usando padrões
//Se algum dos dígitos da variável $regex_pattern está no idServico seleciona esse idServiço, depois seleciona o funcionário 
//cujo a coluna idServico pertence ao idServiço retornados pela subconsulta


$retval = mysqli_query($conn, $sql);
if (!$retval) {
  die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
}
echo "Escolha o funcionário<br>";
while ($row = mysqli_fetch_array($retval)) {
  echo "
  <form action=inserir_reserva.php method=get>
  <input type=radio name=\"funcionario[]\" value=" . $row["nome"] . ">";
  echo $row["nome"] . "<br>";
}

$agora = date("Y-m-d");
$data_agora = date("Y-m-d", strtotime($agora . " + 1 days")) . "T" . date("H:i");
echo "Escolha a Data
  <input type=datetime-local min=$data_agora name=data><br><br>
  <input type=submit value=Reservar>
  <input type=hidden name=tipo value=$tipo>
  <input type=hidden name=animal value=$animal>
  </form>";


?>