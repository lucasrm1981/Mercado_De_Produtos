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
  $categoriaID = $_POST['categoriaID'];
  $categoriaNome = $_POST['categoriaNome'];
  $status = $_POST['status']; 

$updateCategoria=  "UPDATE categorias SET categoriaNome='$categoriaNome', status=$status WHERE categoriaID = '$categoriaID'";

if(mysqli_query($con,$updateCategoria)){
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
          window.location.href = 'categorias.php';
    })
        </script>
        
        </body>
        </html>
        ";
?>