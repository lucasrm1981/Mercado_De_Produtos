<?php
// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";
    // pega dados via POST
    // Recebe o valo do email
    $email = $_POST["email"];
    // Recebe o valo do email
    $senha = $_POST["senha"];
    // Converte a senha em um hash criptografado de MD5
    $senha = md5($senha);

    //montar a instrução para ir ao banco
    //e selecionar o usuario que tenha este email
    $sql = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha' ";

    //executar conexao e roda a query sql
    $resultado = mysqli_query($con, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        session_start(); //faz o arquivo iniciar a sessao com o browser
        // Variavel $row recebe o conteudo do array gerado pelo banco
        $row = mysqli_fetch_array($resultado);
        //enviar dados recebidos do banco de dados para a sessão iniciada
        $_SESSION["email"] = $row["email"];
        //$_SESSION["restricao"] = $row["restricao"];
        $_SESSION["tempo"] = time();
        //econtrou
        //vou redirecionar o usuario para a pasta do sistema
        header("location: index.php");
    } else {
        // Cria um alerta informando que o usuário ou senha é inválido
        
            unset ($_SESSION['email']);
            
        echo "<script>alert ('Email ou Senha Invalidos!'); location.href='login.php';</script>";

        

    }

    ?>
