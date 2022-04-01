<?php
// Verifica se o login foi criado
session_start();
if(!isset($_SESSION["email"])==true){
  header("location: login.php");
}
// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";

$fornecedorID = $_GET["fornecedorID"];

    $delForn = "delete from fornecedores where fornecedorID = ".$fornecedorID;

    if(mysqli_query($con,$delForn)){
        $msg = "Deletado com sucesso!";
        $type = "success"; 
    }else{
        $msg = "Erro ao deletar!";
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

