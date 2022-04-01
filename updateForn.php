<?php
// Verifica se o login foi criado
session_start();
if(!isset($_SESSION["email"])==true){
  header("location: login.php");
}

// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";
//### Recebimento do POST do formulario ###
  // recebe os campos do form
  $fornecedorID = $_POST['fornecedorID'];
  $nomeFantasia = $_POST['nomeFantasia'];
  $razaoSocial = $_POST['razaoSocial'];
  $ie = $_POST['ie'];
  $cnpj = $_POST['cnpj'];  
  $cnae = $_POST['cnae'];  
  $endereco = $_POST['endereco'];  

$updateFornecedor =  "UPDATE fornecedores SET nomeFantasia='$nomeFantasia', razaoSocial='$razaoSocial', ie='$ie', cnpj='$cnpj', cnae=$cnae, endereco=$endereco WHERE fornecedorID = '$fornecedorID'";

if(mysqli_query($con,$updateFornecedor)){
        $msg = "Atualizado com sucesso!";
        $type = "success"; 
    }
    else{
      $msg =  "Erro ao Atualizar!";
      $type = "error"; 
    }

    echo "
        <html>
        <head>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js'></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css'>
        </head>
        <body>
        <script>
        swal({
          position: 'top',
          type: '".$type."',
          title: '".$msg."',
          showConfirmButton: false,
          timer: 2000          
        },
        function(){
          window.location.href = 'fornecedores.php';
    })
        </script>
        
        </body>
        </html>
        ";
?>