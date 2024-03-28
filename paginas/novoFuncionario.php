<?php

session_start();

include("../basedados/basedados.h");
include("../paginas/funcoes.php");

session_protection();
$cargosAceites = array(Administrador);
cargo_protection($cargosAceites);

echo " <form action=inserirNovoFuncionario.php method=POST>
Introduza o Nome<input type=text name=nome><br>
Introduza a password<input type=text name=password><br>

Selecione os serviços que o funcionário é capaz de realizar:<br>
Cão Lavar<input type=checkbox name=habilidade[] value=1><br>
Cão Cortar<input type=checkbox name=habilidade[] value=2><br>
Gato Lavar<input type=checkbox name=habilidade[] value=3><br>
Gato Cortar<input type=checkbox name=habilidade[] value=4><br>
Lavar<input type=checkbox name=habilidade[] value=5><br>
Cortar<input type=checkbox name=habilidade[] value=6><br>
<input type=submit value=Inserir>";


?>