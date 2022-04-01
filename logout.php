<?php
// Deleta o conteúdo da seção que foi aberta no Login
session_start();
session_destroy();
unset( $_SESSION );

// Arquivo de Configuracao com o Banco de Dados

$msg = "Logout Efetuado!";
$type = "success";

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
      window.location.href = 'login.php';
})
    </script>    
    </body>
    </html>
    ";	
?>

