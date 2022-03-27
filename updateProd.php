<?php
// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";
//### Recebimento do POST do formulario ###
  // recebe os campos do form
  $produtoID = $_POST['produtoID'];
  $produtoNome = $_POST['produtoNome'];
  $quantidade = $_POST['quantidade'];
  $preco = $_POST['preco'];
  $categoriaID = $_POST['categoriaID'];  
  $fornecedorID = $_POST['fornecedorID'];  

$updateProduto =  "UPDATE produtos SET produtoNome='$produtoNome', fornecedorID='$fornecedorID', categoriaID='$categoriaID', quantidade='$quantidade', preco=$preco WHERE produtoID = '$produtoID'";

if(mysqli_query($con,$updateProduto)){
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
          window.location.href = 'produtos.php';
    })
        </script>
        
        </body>
        </html>
        ";
?>