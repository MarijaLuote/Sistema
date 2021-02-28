<?php 
require_once 'db.php';
if (isset($_GET['delete'])){
    $id=$_GET['delete'];
    $ps=$db->prepare('DELETE  FROM employees2 WHERE id=?');
    $ps->execute([$id]);
}
$result=$db->query("SELECT employees2. *,positions.name AS positionName FROM employees2 
LEFT JOIN positions ON positions.id = employees2.positions_id");
$data=$result->fetchAll(PDO::FETCH_ASSOC);

$kitaInfo=$db->query("SELECT positions.base_salary, positions.name, COUNT(*) AS quantity from employees2
LEFT JOIN positions ON positions.id = employees2.positions_id
GROUP BY positions.name");
$visosPareigos=$kitaInfo->fetchAll(PDO::FETCH_ASSOC);

$kitas=$db->query("SELECT MAX(salary) AS max,MIN(salary) AS min,
 COUNT(salary) AS quantity, AVG(salary) AS avg FROM employees2");
$data2=$kitas->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Baltic Talents</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
td {
	vertical-align: middle !important;
}
</style>

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					aria-expanded="false">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Baltic Talents</a>
			</div>

			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="statistika.php">Įmonės statistika</a></li>
				</ul>
			<ul class="nav navbar-nav">
					<li><a href="puslapis.php">Projektai</a></li>
				</ul>	

			</div>
		</div>
	</nav>

	<div class="container" id="content" tabindex="-1">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Visi įmonės darbuotojai</div>


					<!-- Table -->
					<table class="table">
						<tr>
							<th></th>
							<th>Vardas</th>
							<th>Pavardė</th>
							<th>Pareigos</th>
							<th>Tel. nr.</th>
							<th>Išsilavinimas</th>
							<th>Alga</th>
							<th></th>
						</tr>
						<?php foreach($data as $darbuotojai){?>
						<tr>
							<td><strong><?=$darbuotojai['id']?></strong></td>
							<td><?=$darbuotojai['name']?></td>
							<td><?=$darbuotojai['surname']?></td>
							<td><?=$darbuotojai['positionName']?></td>
							<td><?=$darbuotojai['phone']?></td>
							<td><?=$darbuotojai['education']?></td>
							<td><?=$darbuotojai['salary']?></td>
							<td><a href="darbuotojas.php?id=<?=$darbuotojai['id'] ?>"
							class="btn btn-primary">Plačiau</a></td>
							<td><a href="darbuotojasEdit.php?id=<?=$darbuotojai['id'] ?>"
							class="btn btn-primary">Koreguoti</a></td>
							<td><a href="statistika.php?delete=<?=$darbuotojai['id'] ?>"
							class="btn btn-primary">Ištrinti</a></td>
						</tr>
						<?php }?>
						
							
						
					</table>
				</div>
			</div>
		</div>
		
		<a href="darbuotojasAdd.php"
							class="btn btn-primary">Pridėti naują darbuotoją į sąrašą</a><br><br>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Baziniai darbo užmokesčiai:</div>

					<!-- Table -->
					<table class="table">
						<tr>
							<th>Pareigos</th>
							<th>Bazinis darbo užmokestis</th>
							<th>Darbuotojų skaičius</th>
							<th></th>
						</tr>
                       <?php foreach($visosPareigos as $pareigos){?>
						<tr>
							<td><?=$pareigos['name']?></td>
							<td><?=$pareigos['base_salary']?></td>
							<td><?=$pareigos['quantity']?></td>
							<td><a href="darbuotojai_pareigos.php?id=<?=$pareigos['id']?>" class="btn btn-primary">Rodyti darbuotojus</a></td>
						
						<?php }?>
					</table>
					
				</div>
				
			</div>
			<div class="col-md-6">
					<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Įmonės statistika</div>

				
					<table class="table  table-hover">
					 <?php foreach($data2 as $duomenis){?>
					<tr>
					<td>Įmonėje dirbančių žmonių skaičius</td>
					<td><?=$duomenis['quantity']?></td>
					</tr>
					<tr>
					<td>Vidutinis darbo užmokestis</td>
					<td><?=round($duomenis['avg'],2)?></td>
					</tr>
					<tr>
					<td>Minimalus darbo užmokestis</td>
					<td><?=$duomenis['min']?></td>
					</tr>
					<tr>
					<td>Maksimalus darbo užmokestis</td>
					<td><?=$duomenis['max']?></td>
					</tr>
					<?php }?>
					</table>
				
				
			
					</div>
			
					</div>
		</div>


	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>