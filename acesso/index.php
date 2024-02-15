<?php
include('conexao.php');

$mensagem = 'Preencha os campos primeiro';

if (isset($_POST['nome']) || isset($_POST['senha'])) {

    if (strlen($_POST['nome']) == 0) {
        echo "$mensagem";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $nome = $mysqli->real_escape_string($_POST['nome']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {

            $usuario = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else {
            echo "Falha ao logar! Nome ou senha incorretos";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pagina de login</title>
</head>

<body>
    <section class="area-login">
        <div class="login">

            <div>
                <img src="img/mus.png">
            </div>

            <form method="post">
                <input type="text" name="nome" placeholder="nome de usuario" autofocus>
                <input type="password" name="senha" placeholder="sua senha">

                <input type="submit" value="entrar">

            </form>
            <p>Ainda não tem uma conta? <a href="#">Criar uma conta</a></p>
        </div>
    </section>
</body>

</html>