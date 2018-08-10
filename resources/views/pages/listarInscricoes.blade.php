

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
   		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

		<title>Listar Inscricoes</title>
	</head>
	<body>

		<div class="container">
			<div class="row justify-content-sm-center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">

					<table class="table">
					  	<thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Numero de Inscricao</th>
						      <th scope="col">Valor</th>
						      <th scope="col">Data de Inscricao</th>
						      <th scope="col">Usuario</th>
						      <th scope="col">Evento</th>


						    </tr>
						  </thead>
				  		<tbody>
							<?php
							$i = 0;
					  			foreach($inscricoes as $inscricao){
									$i++;
					  		?>
						    <tr>
						      <th scope="row"><?php echo $i ?></th>
							  <td><?php echo $inscricao->id ?></td>
							  <td><?php echo $inscricao->valor ?></td>
							  <td><?php echo $inscricao->dataInscricao ?></td>
							  <td><?php echo $inscricao->usuario->nome ?></td>
							  <td><?php echo $inscricao->evento->descricao ?></td>
                              
						    </tr>
							<?php
							}
							?>

					  	</tbody>
					</table>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>

		<h1>Boletos</h1>

		<div class="container">
			<div class="row justify-content-sm-center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">

					<table class="table">
					  	<thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Numero de Inscricao</th>
							  <th scope="col">Usuário</th>
						      <th scope="col">Numero Boleto</th>
						      <th scope="col">Data Vencimento</th>

						    </tr>
						  </thead>
				  		<tbody>
							<?php
							$i = 0;
				  			foreach($inscricoes as $inscricao){

								$boletos = $inscricao->boletos;
								foreach ($boletos as $boleto) {

								?>
								<tr>
							      <th scope="row"><?php echo $i ?></th>
								  <td><?php echo $inscricao->id ?></td>
								  <td><?php echo $inscricao->usuario->nome ?></td>
								  <td><?php echo $boleto->id ?></td>
								  <td><?php echo $boleto->dataVencimento ?></td>
							    </tr>
								<?php
								}
								?>

							<?php
							}
							?>

					  	</tbody>
					</table>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>


		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

	</body>
</html>
