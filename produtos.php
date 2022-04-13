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
  $produtoNome = $_POST['produtoNome'];
  $quantidade = $_POST['quantidade'];
  $preco = $_POST['preco'];
  $categoriaID = $_POST['categoriaID'];
  $fornecedorID = $_POST['fornecedorID'];

  $foto = $_FILES['produtoImagem'];
  
  // Se a foto estiver sido selecionada
  if (!empty($foto["name"])) {
        
    // Largura máxima em pixels
    $largura = 400;
    // Altura máxima em pixels
    $altura = 400;
    // Tamanho máximo do arquivo em bytes
    $tamanho = 20000;

    $error = 0;

    // Verifica se o arquivo é uma imagem
    if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
      $msg = "Arquivo Inválido";
      $type = "error";
      $error = 1;
        } 

    // Pega as dimensões da imagem
    $dimensoes = getimagesize($foto["tmp_name"]);

    // Verifica se a largura da imagem é maior que a largura permitida
    if($dimensoes[0] > $largura) {
        $msg = "A largura da imagem não deve ultrapassar ".$largura." pixels";
        $type = "error";
        $error = 1;        
    }
    // Verifica se a altura da imagem é maior que a altura permitida
    if($dimensoes[1] > $altura) {
        $msg = "Altura da imagem não deve ultrapassar ".$altura." pixels";
        $type = "error";
        $error = 1;
    }
    
    // Verifica se o tamanho da imagem é maior que o tamanho permitido
    if($foto["size"] > $tamanho) {
            $msg = "A imagem deve ter no máximo ".$tamanho." bytes";
            $type = "error";
            $error = 1;
    }
    // Se não houver nenhum erro
    if ($error == 0) {
    
        // Pega extensão da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
        // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
        // Caminho de onde ficará a imagem
        $caminho_imagem = "uploads/" . $nome_imagem;
        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);
    
  //Executar o teste com o echo para verificar se o form esta passando os dados corretamente, para depois montar a parte do insert.
 //echo "$produtoNome $quantidade $preco";
 
// Busca os produtos no banco de dados.
$consultaProd = "SELECT * FROM produtos";	
$resultListProd = mysqli_query($con,$consultaProd);
$rowListProd = mysqli_fetch_array($resultListProd); 

$novoProduto =  "INSERT INTO produtos  VALUES (null,'$produtoNome', $fornecedorID, $categoriaID, $quantidade, $preco,'$nome_imagem')";
//Linha retirada depois de acrescentar o if
//$inserirProd = mysqli_query($con,$novoProduto);

      // Busca os produtos no banco de dados.
      $verificaProd = "SELECT produtoNome FROM produtos WHERE produtoNome='$produtoNome'";	
      $verificaList = mysqli_query($con,$verificaProd);    
     
if(mysqli_query($con,$novoProduto)){
        $msg = "Gravado com sucesso!";
        $type = "success";		
    }
    if(mysqli_num_rows($verificaList)>0){
        $msg = "Produto Existente!"; 
        $type = "error";       
    }  
  }	
  
}
if (empty($foto["name"])) {
  $msg = "Você não Escolheu uma Imagem!"; 
      $type = "error"; 
}
}

//### FIM - Recebimento do POST do formulario ###

// Busca os produtos no banco de dados.
$consultaProd = "SELECT * FROM produtos";	
$resultListProd = mysqli_query($con,$consultaProd);
$rowListProd = mysqli_fetch_array($resultListProd);

// Busca as categorias no banco de dados.
$consultaCat = "SELECT * FROM categorias";	
$resultListCat = mysqli_query($con,$consultaCat);
$rowListCat = mysqli_fetch_array($resultListCat);

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
    location.href='deleteProd.php?ProdutoID='+id;
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
      timer: 3000
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
		  <th scope="col">Produto</th>
		  <th scope="col">Quantidade</th>
		  <th scope="col">Preço</th>
		  <th scope="col">Ações</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php	$i = 1; if(mysqli_num_rows($resultListProd)>0){
							// Irá separar o conteúdo do array em linhas
							foreach ($resultListProd as $rowListProd) {	
                
				?>
		<tr>
			
		  <th scope="row"><?php echo $i++ ?></th>
      <td><?php echo $rowListProd['produtoID']; ?></td>
		  <td><?php echo $rowListProd['produtoNome']; ?></td>
		  <td><?php echo $rowListProd['quantidade']; ?></td>
		  <td><?php echo $rowListProd['preco']; ?></td>
		  <td>
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal-<?php echo $i ?>">
    EDITAR
  </button>
<!-- Formulário Modal do botão Editar-->
<div class="modal" id="myModal-<?php echo $i ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Atualizar Produto <?php echo $rowListProd['produtoNome']; ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" action="updateProd.php">
	  <div class="mb-3">
    <input name="produtoID" value="<?php echo $rowListProd['produtoID']; ?>" hidden="true">
    
		<label class="form-label">Produto</label>
		<input type="text" class="form-control" name="produtoNome" value="<?php echo $rowListProd['produtoNome']; ?>">
		
		<label class="form-label">Quantidade</label>
		<input type="text" class="form-control" name="quantidade" value="<?php echo $rowListProd['quantidade']; ?>">
		
		<label  class="form-label">Preço</label>
		<input type="text" class="form-control" name="preco" value="<?php echo $rowListProd['preco']; ?>">
		
    <label class="form-label">Fornecedor</label>
		
		<select class="form-select" aria-label="Default" name="fornecedorID">
		<option >Escolha o Fornecedor.</option>
		<?php if(mysqli_num_rows($resultListForn)>0){
							// Irá separar o conteúdo do array em linhas
                            foreach ($resultListForn as $rowListForn) {
				?>
        <!-- Se o status da categoria estiver como 0 desabilitada ela desabilita a seleção -->		  
		  <option value="<?php echo $rowListForn['fornecedorID']; ?>" <?php echo $rowListForn['fornecedorID']==$rowListProd['fornecedorID']?'selected':''; ?> >
      <?php echo $rowListForn['nomeFantasia']; ?>
    </option>		  
		  <?php
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultListForn).                
                ?>
		</select>

		<label class="form-label">Categoria</label>
		
		<select class="form-select" aria-label="Default" name="categoriaID">
		<option >Escolha a categoria.</option>
		<?php if(mysqli_num_rows($resultListCat)>0){
							// Irá separar o conteúdo do array em linhas
                            foreach ($resultListCat as $rowListCat) {
				?>
        <!-- Se o status da categoria estiver como 0 desabilitada ela desabilita a seleção -->		  
		  <option value="<?php echo $rowListCat['categoriaID']; ?>" <?php echo $rowListCat['status']==0?"disabled":""; ?> <?php echo $rowListCat['categoriaID']==$rowListProd['categoriaID']?'selected':''; ?> >
      <?php echo $rowListCat['categoriaNome']; ?>
    </option>		  
		  <?php
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultListCat).                
                ?>
		</select>

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

		  <button  class="btn btn-danger" onclick="excluir(<?php echo $rowListProd['produtoID']; ?>)">EXCLUIR
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
<label class="form-label"><strong>Cadastrar Novo Produto</strong> </label>
  <!-- Envia toda informação do formulário para o mesmo arquivo -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	  <div class="mb-3">

    <label class="form-label">Imagem do Produto</label>
		<input type="file" class="form-control" name="produtoImagem" value="<?php echo $produtoNome;?>" >

		<label class="form-label">Produto</label>
		<input type="text" class="form-control" name="produtoNome">
		
		<label class="form-label">Quantidade</label>
		<input type="text" class="form-control" name="quantidade">
		
		<label  class="form-label">Preço</label>
		<input type="text" class="form-control" name="preco">
		<label class="form-label">Fornecedor</label>
    <select class="form-select" aria-label="Default" name="fornecedorID">
		<option selected>Escolha o Fornecedor.</option>
		<?php if(mysqli_num_rows($resultListForn)>0){
							// Irá separar o conteúdo do array em linhas
                            foreach ($resultListForn as $rowListForn) {
				?>
        <!-- Se o status da categoria estiver como 0 desabilitada ela desabilita a seleção -->		  
		  <option value="<?php echo $rowListForn['fornecedorID']; ?>" >
      <?php echo $rowListForn['nomeFantasia']; ?>
    </option>		  
		  <?php
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultListCat).                
                ?>
		</select>

		<label class="form-label">Cagegoria</label>
		
		<select class="form-select" aria-label="Default" name="categoriaID">
		<option selected>Escolha a categoria.</option>
		<?php	    $i = 1; if(mysqli_num_rows($resultListCat)>0){
							// Irá separar o conteúdo do array em linhas
                            foreach ($resultListCat as $rowListCat) {
				?>		  
		  <option value="<?php echo $rowListCat['categoriaID']; ?>" <?php echo $rowListCat['status']==0?"disabled":""; ?> >
      <?php echo $rowListCat['categoriaNome']; ?>
    </option>		  
		  <?php
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultListCat).                
                ?>
				
		</select>
	  
		
	  </div>
	  
	  <button type="submit" class="btn btn-primary" >Enviar</button>
	  
</form>
</div>


</div>

</div>
  </section>
</main>

<?php include "footer.php"; ?>
      
  </body>
</html>
