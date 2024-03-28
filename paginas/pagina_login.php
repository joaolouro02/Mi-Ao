<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="L.css" />
    <title>Document</title>
</head>

<body>

    <?php
    session_start();

    if (isset($_SESSION["user"]) && isset($_SESSION["tipo"])) { //Não pode voltar à página de login se já iniciou sessão
        echo "Já iniciou sessão";
        header("refresh:2;url = pagina_inicial.php");
        exit;
    }

    ?>

    <form action="login.php" method="post">
        <div class="formulario">
            <img src="login.jpg">
            <div id="login">
                <h1>Login</h1>

                <label for="utilizador">Nome de Utilizador:</label>
                <input type="text" id="utilizador" name="utilizador">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <input type="submit" value="Login">
                <p class="registo">Ainda não tem conta? <a href="pagina_registo.html">Registo</a></p>
                <a href="pagina_inicial.php">Voltar ao Inicío</a>
            </div>
        </div>
    </form>



</body>

</html>