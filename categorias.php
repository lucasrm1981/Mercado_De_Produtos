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
  $categoriaNome = $_POST['categoriaNome'];
  $status = $_POST['status'];
  
  //Executar o teste com o echo para verificar se o form esta passando os dados corretamente, para depois montar a parte do insert.
 
// Busca os categorias no banco de dados.
$consultaCat = "SELECT * FROM categorias";	
$resultListCat = mysqli_query($con,$consultaCat);
$rowListCat = mysqli_fetch_array($resultListCat); 
$novaCategoria =  "INSERT INTO categorias  VALUES (null,'$categoriaNome', $status)";
//Linha retirada depois de acrescentar o if
//$inserirCat = mysqli_query($con,$novaCategoria);

      // Busca os fornecedores no banco de dados.
      $verificaCat = "SELECT categoriaNome FROM categorias WHERE categoriaNome='$categoriaNome'";	
      $verificaListCat = mysqli_query($con,$verificaCat);

if(mysqli_query($con,$novaCategoria)){
        $msg = "Gravado com sucesso!";
        $type = "success";		
    }
    else if(mysqli_num_rows($verificaListCat)>0){
        $msg = "Categoria Existente!"; 
        $type = "error";       
    }
    else{
      $msg = "Erro ao Gravar!";   
      $type = "error";  
    }
	
}

//### FIM - Recebimento do POST do formulario ###



// Busca os fornecedors no banco de dados.
$consultaCat = "SELECT * FROM categorias";	
$resultListCat = mysqli_query($con,$consultaCat);
$rowListCat = mysqli_fetch_array($resultListCat);

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
  title: 'Deseja deletar a categoria?',
  text: "Essa ação não pode ser desfeita!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SIM !',
  cancelButtonText: 'NÃO !'
}).then((result) => {
  if (result.isConfirmed) {
    location.href='deleteCat.php?categoriaID='+id;
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
		  <th scope="col">Nome da Categoria</th>
		  <th scope="col">Status</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php	$i = 1; if(mysqli_num_rows($resultListCat)>0){
							// Irá separar o conteúdo do array em linhas
							foreach ($resultListCat as $rowListCat) {	
                
				?>
		<tr>
			
		  <th scope="row"><?php echo $i++ ?></th>
      <td><?php echo $rowListCat['categoriaID']; ?></td>
		  <td><?php echo $rowListCat['categoriaNome']; ?></td>
		  <td><?php echo $rowListCat['status']; ?></td>
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
        <h4 class="modal-title">Atualizar Categoria <?php echo $rowListCat['categoriaNome']; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" action="updateCat.php">
	  <div class="mb-3">
    <input name="categoriaID" value="<?php echo $rowListCat['categoriaID']; ?>" hidden="true">
    
		<label class="form-label">Nome da Categoria</label>
		<input type="text" class="form-control" name="categoriaNome" value="<?php echo $rowListCat['categoriaNome']; ?>">
		
		<label class="form-label">Status</label>
		<input type="text" class="form-control" name="status" value="<?php echo $rowListCat['status']; ?>">


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

		  <button  class="btn btn-danger" onclick="excluir(<?php echo $rowListCat['categoriaID']; ?>)">EXCLUIR
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
<label class="form-label"><strong>Cadastrar Nova Categoria</strong> </label>
  <!-- Envia toda informação do formulário para o mesmo arquivo -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <div class="mb-3">
		<label class="form-label">Nome da Categoria</label>
		<input type="text" class="form-control" name="categoriaNome">
		
		<label class="form-label">Status</label>
		
		<select class="form-select" aria-label="Default" name="status">
		<option >Escolha a categoria.</option>
		
        <!-- Se o status da categoria estiver como 0 desabilitada ela desabilita a seleção -->		  
		  <option value="1" >Habilitada </option>
      <option value="0" >Desabilitada </option>
     
    </option>		  
		
		</select>

	  
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
