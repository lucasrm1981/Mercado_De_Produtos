<?php
// Verifica se o login foi criado
session_start();
if(!isset($_SESSION["email"])==true){
  header("location: login.php");
}
// Arquivo de Configuracao com o Banco de Dados
include "assets/src/cfg.php";


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
//}
//else{
//  header("location: login.php");
//}
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

 
    
  </head>
  <body>  
 
    
<?php include "header.php"; ?>

<main>
  <section class="py-5 text-center container">
<div class="container text-center" >
<div class="row">
<div class="col-sm-12">
    <table class="table text-center align-middle">
	  <thead>
		<tr>
		  <th scope="col">#</th>
      <th scope="col">ID</th>
		  <th scope="col">Produto</th>
		  <th scope="col">Quantidade</th>
		  <th scope="col">Preço</th>
		  <th scope="col">Fornecedor</th>
      <th scope="col">Categoria</th>
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
      <?php if(mysqli_num_rows($resultListForn)>0){
							// Irá separar o conteúdo do array em linhas
                            foreach ($resultListForn as $rowListForn) {
				?>
        <!-- Se o status da categoria estiver como 0 desabilitada ela desabilita a seleção -->		  
		  <?php echo $rowListForn['fornecedorID']==$rowListProd['fornecedorID']? $rowListForn['nomeFantasia']:'' ;
    
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultListForn).
        ?>
      </td>
      <td>
      <?php if(mysqli_num_rows($resultListCat)>0){
							// Irá separar o conteúdo do array em linhas
                            foreach ($resultListCat as $rowListCat) {
				?>
        <!-- Se o status da categoria estiver como 0 desabilitada ela desabilita a seleção -->		  
		  <?php echo $rowListCat['categoriaID']==$rowListProd['categoriaID']? $rowListCat['categoriaNome']:'' ;
    
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultListForn).
        ?>
      </td>
 
	  </div>
      </div>
    </div>
  </div>
</div>

    </td>
		</tr>
		<?php
                 } //Fim do Loop do foreach.
				} // Fim do if(mysqli_num_rows($resultList).
                
                ?>
		
	  </tbody>
	</table>
	
</div>	


</div>

</div>
  </section>
</main>

<?php include "footer.php"; 

?>
      
  </body>
</html>
