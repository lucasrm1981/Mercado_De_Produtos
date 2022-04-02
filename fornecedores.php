<?php

// Verifica se o login foi criado
session_start();
if(!isset($_SESSION["email"])==true){
  header("location: login.php");
}
// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";

//### Recebimento do POST do formulario ###
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // recebe os campos do form
  $nomeFantasia = $_POST['nomeFantasia'];
  $razaoSocial = $_POST['razaoSocial'];
  $ie = $_POST['ie'];
  $cnpj = $_POST['cnpj'];
  $cnae = $_POST['cnae'];
  $endereco = $_POST['endereco'];
  
  //Executar o teste com o echo para verificar se o form esta passando os dados corretamente, para depois montar a parte do insert.
 
// Busca os fornecedores no banco de dados.
$consultaForn = "SELECT * FROM fornecedores";	
$resultListForn = mysqli_query($con,$consultaForn);
$rowListForn = mysqli_fetch_array($resultListForn); 
$novoFornecedor =  "INSERT INTO fornecedores  VALUES (null,'$nomeFantasia', '$razaoSocial', $ie, $cnpj, $cnae, $endereco)";
//Linha retirada depois de acrescentar o if
//$inserirProd = mysqli_query($con,$novoProduto);

      // Busca os fornecedores no banco de dados.
      $verificaForn = "SELECT razaoSocial FROM fornecedores WHERE razaoSocial='$razaoSocial'";	
      $verificaList = mysqli_query($con,$verificaForn);

if(mysqli_query($con,$novoFornecedor)){
        $msg = "Gravado com sucesso!";
        $type = "success";		
    }
    else if(mysqli_num_rows($verificaList)>0){
        $msg = "Fornecedor Existente!"; 
        $type = "error";       
    }
    else{
      $msg = "Erro ao Gravar!";   
      $type = "error";  
    }
	
}

//### FIM - Recebimento do POST do formulario ###



// Busca os fornecedors no banco de dados.
$consultaForn = "SELECT * FROM fornecedores";	
$resultListForn = mysqli_query($con,$consultaForn);
$rowListForn = mysqli_fetch_array($resultListForn);

?>

<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    
    <title>PHP + Banco de Dados</title>

    <!-- Bootstrap core CSS -->
    
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.7/sweetalert2.all.js" integrity="sha512-dF7ro6GMO4363S7UqfqyIjiWug1bub5JAEi6jpRNzpHk0gZa8BGrhJKMeLegzgamf2nA8GGw/j80Bre1Bx8hdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body{padding-top: 60px !important} 
      .navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background: #ddd;
  color: black;
}

.main {
  padding: 16px;
  margin-top: 30px;
  height: 1500px; /* Used in this example to enable scrolling */
}
    </style>

 <script>
        function excluir(id){
    //Exemplo com Confirm
    Swal.fire({
  title: 'Deseja deletar o produto?',
  text: "Essa ação não pode ser desfeita!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SIM !',
  cancelButtonText: 'NÃO !'
}).then((result) => {
  if (result.isConfirmed) {
    location.href='deleteForn.php?fornecedorID='+id;
  }
})
}
            
        </script>
    
  </head>
  <body>
  
 <?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {	 
	 if($msg!="" or $type!=""){
    echo "
    <script>
    Swal.fire({
      position: 'center',
      icon: '".$type."',
      title: '".$msg."',
      showConfirmButton: false,
      timer: 1500
    })
    </script>";
    }
 }
 	 
?>
    
<?php include "header.php"; ?>

<main>
  <section class="py-5 text-center container">
<div class="container text-center" >
<div class="row">
<div class="col-sm-8">
    <table class="table text-center align-middle">
	  <thead>
		<tr>
		  <th scope="col">#</th>
      <th scope="col">ID</th>
		  <th scope="col">Nome Fantasia</th>
		  <th scope="col">Razão Social</th>
		  <th scope="col">I.E.</th>
		  <th scope="col">CNPJ</th>
      <th scope="col">CNAE</th>
      <th scope="col">Endereço</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php	$i = 1; if(mysqli_num_rows($resultListForn)>0){
							// Irá separar o conteúdo do array em linhas
							foreach ($resultListForn as $rowListForn) {	
                
				?>
		<tr>
			
		  <th scope="row"><?php echo $i++ ?></th>
      <td><?php echo $rowListForn['fornecedorID']; ?></td>
		  <td><?php echo $rowListForn['nomeFantasia']; ?></td>
		  <td><?php echo $rowListForn['razaoSocial']; ?></td>
		  <td><?php echo $rowListForn['ie']; ?></td>
      <td><?php echo $rowListForn['cnpj']; ?></td>
      <td><?php echo $rowListForn['cnae']; ?></td>
      <td><?php echo $rowListForn['endereco']; ?></td>
		  <td>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal-<?php echo $i ?>">
         EDITAR &nbsp;
  </button>
<!-- Formulário Modal do botão Editar-->
<div class="modal" id="myModal-<?php echo $i ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Atualizar Fornecedor <?php echo $rowListForn['razaoSocial']; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" action="updateForn.php">
	  <div class="mb-3">
    <input name="fornecedorID" value="<?php echo $rowListForn['fornecedorID']; ?>" hidden="true">
    
		<label class="form-label">Razão Social</label>
		<input type="text" class="form-control" name="razaoSocial" value="<?php echo $rowListForn['razaoSocial']; ?>">
		
		<label class="form-label">Nome Fantasia</label>
		<input type="text" class="form-control" name="nomeFantasia" value="<?php echo $rowListForn['nomeFantasia']; ?>">
		
		<label  class="form-label">I.E.</label>
		<input type="text" class="form-control" name="ie" value="<?php echo $rowListForn['ie']; ?>">

    <label  class="form-label">CNPJ</label>
		<input type="text" class="form-control" name="cnpj" value="<?php echo $rowListForn['cnpj']; ?>">

    <label  class="form-label">CNAE</label>
		<input type="text" class="form-control" name="cnae" value="<?php echo $rowListForn['cnae']; ?>">

    <label  class="form-label">Endereço</label>
		<input type="text" class="form-control" name="endereco" value="<?php echo $rowListForn['endereco']; ?>">

	  </div>
	  
	  <button type="submit" class="btn btn-primary">ATUALIZAR</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
<!-- Final do Modal -->

		  <button  class="btn btn-danger" onclick="excluir(<?php echo $rowListForn['fornecedorID']; ?>)">EXCLUIR
      </button>
    </td>
		</tr>
		<?php
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultList).
                
                ?>
		
	  </tbody>
	</table>
	
</div>	


<div class="col-4">
<label class="form-label"><strong>Cadastrar Novo Fornecedor</strong> </label>
  <!-- Envia toda informação do formulário para o mesmo arquivo -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <div class="mb-3">
		<label class="form-label">Nome Fantasia</label>
		<input type="text" class="form-control" name="nomeFantasia">
		
		<label class="form-label">Razão Social</label>
		<input type="text" class="form-control" name="razaoSocial">
		
		<label  class="form-label">Inscrição Estadual</label>
		<input type="text" class="form-control" name="ie">

    <label  class="form-label">CNPJ</label>
		<input type="text" class="form-control" name="cnpj">

    <label  class="form-label">CNAE</label>
		<input type="text" class="form-control" name="cnae">

    <label  class="form-label">Endereço:</label>
		<input type="text" class="form-control" name="endereco">
	  </div>
    
	  
	  <button type="submit" class="btn btn-primary">Enviar</button>
	  
</form>
</div>


</div>

</div>
  </section>
</main>

<?php include "footer.php"; ?>
      
  </body>
</html>
