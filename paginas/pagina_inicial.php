<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link
        href='https://fonts.googleapis.com/css2?family=Delicious+Handrawn&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap'
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="PI.css" />
    <title>Trabalho 1</title>
</head>

<body>

    <div id="marca">
        <h1>MIÃO</h1><img src="logo.png">
    </div>

    <div id="links">
        <nav>

            <ul>
                <li><a href="#contactos">Contactos</a></li>
                <li><a href="#social">Social</a></li>

                <?php


                session_start();

                //Se não tiver a sessão iniciada
                if (!isset($_SESSION["user"]) && !isset($_SESSION["tipo"])) {
                    echo '
                <form action=pagina_registo.html>
                <button><a>Registe-se</a></button>
                </form>
                <form action=pagina_login.php>
                <button><a>Login</a></button>
                </form>
                ';
                } else {
                    echo "
                    <form action=pagina_gestao.php>
                    <button><a>Voltar</a></button>
                    </form>
                    ";
                }
                ?>
            </ul>
        </nav>
    </div>

    <div id="imagem"><img src="caoGato.png"></div>



    <div class="precario">
        <h1>Consulte os nossos preços incríveis!</h1>
        <table width="35%" height="300px" border="1px">
            <tr>
                <td rowspan="2" colspan="1"></td>
                <!--colspan nºcolunas que o input vai ocupar; rowspan nº de linhas em que se subdivide-->
            </tr>
            <tr>
                <th><img src="caot.png"></th>
                <th><img src="gatot.png"></th>
            </tr>
            <tr>
                <th><img src="tesourat.png"></th>
                <td>10€</td>
                <td>8€</td>
            <tr>
                <th><img src="esponja.png"></th>
                <td>8€</td>
                <td>5€</td>
            </tr>
            <tr>
                <th><img src="double.png"></th>
                <td>15€</td>
                <td>10€</td>
            </tr>
        </table>
    </div>









    <div class="container">
        <section class="contactos" id="contactos">

            <p>
            <h1>Contactos:</h1>
            Telemóvel:999999999<br>
            Rua Gato Lote Cão<br>
            </p>
            <h1>Horário de Funcionamento</h1>
            <table border="1px">

                <tr>
                    <td rowspan="2" colspan="2"></td>
                    <!--colspan nºcolunas que o input vai ocupar; rowspan nº de linhas em que se subdivide-->
                </tr>
                <tr>
                    <th>Segunda-Sexta</th>
                    <th>Sábado</th>
                    <th>Domingo</th>
                </tr>
                <tr>
                    <th colspan="2">Manhã</th>
                    <td>09:00-13:00</td>
                    <td>09:00-12:00</td>
                    <td bgcolor="red">Encerrados</td>
                </tr>
                <tr>
                    <th colspan="2">Tarde</th>
                    <td>14:00-19:00</td>
                    <td>15:00-18:00</td>
                    <td bgcolor="red">Encerrados</td>
                </tr>
                <tr>
                    <th colspan="2">Noite</th>
                    <td>20:00-22:00</td>
                    <td>20:00-21:00</td>
                    <td bgcolor="red">Encerrados</td>
                </tr>



            </table>
        </section>

        <section class="social" id="social">

            <p>Visite-nos nas redes Socias!</p>
            <a href="https://pt-pt.facebook.com/"><img src="face.png"></a>
            <a href="https://www.instagram.com/"><img src="insta.jpg"></a>
            <a href="https://twitter.com/?lang=pt"><img src="twt.png"></a>
        </section>

    </div>






</body>

</html>