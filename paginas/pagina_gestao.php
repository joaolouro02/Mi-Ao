<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="PG.css" />
    <title>Document</title>
</head>

<body>

    <?php

    session_start();
    include("../basedados/basedados.h");
    include("../paginas/funcoes.php");

    session_protection();
    $cargosAceites = array(Cliente, Funcionario, Administrador);
    cargo_protection($cargosAceites);

    $sql = "SELECT * FROM utilizador WHERE nome = \"" . $_SESSION["user"] . "\""; //$session tem de tar fora da "" mas o valor resultante tem de tar dentro de "" para ser comparado com a coluna nome
    
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }
    $row = mysqli_fetch_array($retval);


    echo "
            <div id=container>
            <header>

                <p> Mião</p> <img src=logo.png>

                
                <h1>Bem Vindo</h1>

                <nav>
                    <ul>
                        <img src=" . $row["imagem"] . ">
                        <a href=logout.php><button>Log Out</button></a>
                        
                    </ul>
                    

                </nav>
                
               
            </header>
            
            <a href=pagina_inicial.php><button>Página Inicial</button></a>
            
            </div>

    ";

    switch ($row["tipo"]) {

        case "1":
            echo "<div id=corpo>";
            printServico();
            printReservas();
            printDadosPessoais();
            echo "</div>";
            break;
        case "2":
            echo "<div id=corpo>";
            printReservas();
            printDadosPessoais();
            echo "</div>";
            break;
        case "3":
            echo "<div id=corpo>";
            printReservas();
            printUtilizadores();
            printDadosPessoais();
            printNovoFuncionario();
            echo "</div>";
            break;

    }


    function printServico()
    {
        echo "<div class=botao>
            <form action=pagina_servico.html>
            <button id=btCorpo> Serviço</button>
             </form>
        </div>";

    }

    function printReservas()
    {
        /*echo "<div class=botao><a href='pagina_reservas.php'>Reservas</a></div>";*/
        echo "<div class=botao>
        <form action=pagina_reservas.php method=get>
        <button id=btCorpo>Reservas</button>
        </form>
        </div>";
    }

    function printDadosPessoais()
    {
        echo "<div class=botao>
        <form action=dados_pessoais.php method=get>
        <button id=btCorpo>Dados Pessoais</button>
         </form>
    </div>";
    }

    function printUtilizadores()
    {
        echo "<div class=botao>
        <form action=gestao_utilizadores.php>
        <button id=btCorpo> Utilizadores</button>
         </form>
    </div>";
    }

    function printNovoFuncionario()
    {
        echo "
        <div class=botao>
       <a href=novofuncionario.php> <button id=btCorpo>Adicionar Funcionário</button></a> 
       </div>
       ";
    }

    ?>



</body>

</html>