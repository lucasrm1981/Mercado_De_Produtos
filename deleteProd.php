<?php
    
// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";

$ProdutoID = $_GET["ProdutoID"];

    $delProd = "delete from produtos where ProdutoID = ".$ProdutoID;

    if(mysqli_query($con,$delProd)){
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
      window.location.href = 'produtos.php';
})
    </script>    
    </body>
    </html>
    ";	
?>

