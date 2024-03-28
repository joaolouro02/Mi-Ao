<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin: 0;
        }

        header {
            height: 200px;
            background: url(header.jpg) no-repeat;
            background-size: cover;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        header img {
            width: 70px;
            height: 70px;
            margin-right: 20px;
        }


        header p {
            font-size: 40px;
            margin-top: 5px;
        }

        nav ul {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            list-style: none;
        }

        nav ul li:first-child {
            margin-right: 20px;
        }

        nav button {
            margin-top: 10px;
            margin-right: 10px;
        }

        nav ul img {
            width: 70px;
            height: 70px;
        }







        table {
            margin-top: 10px;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .botao button {
            display: block;
            padding: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: rebeccapurple;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 300px;
            margin: 0;
            border: none;
            box-sizing: border-box;
            height: 100%;
        }
    </style>

</head>

<body>


    <?php

    session_start();

    include("../basedados/basedados.h");
    include("../paginas/funcoes.php");


    session_protection();
    $cargosAceites = array(Administrador);
    cargo_protection($cargosAceites);

    $user = $_SESSION["user"];

    $sql = "SELECT * FROM utilizador";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die('Could not get data: ' . mysqli_error($conn)); // se não funcionar dá erro
    }

    $row = mysqli_fetch_array($retval);


    echo " 
    <header>
    
    <p> Mião <span><img src=logo.png></span></p>

    <nav>
        <ul>
            <li><img src=admin.png></li>
            <li><a href=logout.php><button>Log Out</button></a><li>
        </ul>

    </nav>
   
</header>
        
        ";

    echo "<div class=botao>
        <form action=pagina_registo.html>
        <button id=btCorpo> Novo Utilizador</button>
         </form>
    </div>";

    echo "<table width=100%>
					<tr>
						<th>Nome Utilizador:</th>
						<th>Tipo:</th>
						<th>Telemóvel:</th>
						<th>Validar:</th>
						<th>Editar:</th>
						<th>Apagar</th>
						<th>Promover:</th>
                        <th>Despromover:</th>
					</tr>";
    while ($row = mysqli_fetch_array($retval)) {

        /*if ($row["apagado"] == 1) {
        continue;
        }*/
        echo "
		<tr>
		<td>" . $row["nome"] . "</td>
		<td>" . $row["tipo"] . "</td>
		<td>" . $row["telemovel"] . "</td>";

        //VALIDAR						
        if ($row["tipo"] == -1)
            echo "	<td><a href=./validar.php?IdUser=" . urlencode($row["nome"]) . "><img src=validar.png width=50 height=50></a></td>";
        else
            echo "<td></td>";

        //EDITAR
        echo "	<td><a href=prepara_editar.php?IdUser=" . $row["nome"] . " ><img src=editar.png width=50 height=50></a></td>";


        //Apagar
    
        echo "	<td><a href=apagar.php?IdUser=" . $row["nome"] . " ><img src=apagar.png width=50 height=50></a></td>";

        //PROMOVER
        if ($row["tipo"] == 2 || $row["tipo"] == 1)
            echo "	<td><a href=promover.php?IdUser=" . $row["nome"] . " ><img src=promover.png width=50 height=50></a></td>";
        else
            echo "<td></td>";
        //DESPROMOVER
        if ($row["tipo"] == 3 || $row["tipo"] == 2)
            echo "	<td><a href=despromover.php?IdUser=" . $row["nome"] . " ><img src=despromover.png width=50 height=50></a></td>";
        else
            echo "<td></td>";



        echo "</tr>";
    }
    echo "</table>";


    ?>


    </div>
    </div>

</body>

</html>