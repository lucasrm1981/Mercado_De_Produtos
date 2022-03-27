<?php
/* Arquivo com as configurações do banco */
// Variáveis do banco
$servidor='localhost';
$banco='mercado';
$usuarioBd='root';
$senhaBd='';


// Variavel que ira efetuar a conexão com o banco de dados atraves dos valores recebidos das variaveis, caso haja falha ira exibir a menssagem Sem conexao
$con = mysqli_connect($servidor,$usuarioBd,$senhaBd,$banco) or die
 ("Sem conexão com o servidor!");
 
 

?>



