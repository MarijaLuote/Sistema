<?php
require_once 'db.php';
if(isset($_GET['id'])){
 $id=$_GET['id'];
}
$ps=$db->prepare("SELECT employees2.id, employees2.name, employees2.surname , 
employees2.phone, employees2.salary ,employees2.education ,
positions.name AS positionName FROM employees2
 LEFT JOIN positions ON positions.id = employees2.positions_id WHERE positions.id = $id");

if(!$ps->execute([$id])){
    print_r($ps->errorInfo());
}else{
    //header('Location: statistika.php');
    //die();
}
$ps->execute([$id]);
$data=$ps->fetchAll(PDO::FETCH_ASSOC);


$a=1;
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


			</div>
		</div>
	</nav>

	<div class="container" id="content" tabindex="-1">
		<div class="row">
		
			<div class="col-md-12">
				<div class="page-header">
				
					<h1>Darbuotojai pagal pareigas: <strong><?php foreach($data as $darbuotojai){
					   echo $darbuotojai['positionName'];
					   break;
					}
					?> 
					
				</strong> </h1>
				</div>




			</div>
			<div class="col-md-12">
				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Darbuotojų sąrašas</div>


					<!-- Table -->
					<table class="table">
						<tr>
							<th></th>
							<th>Vardas</th>
							<th>Pavardė</th>
							<th>Tel. nr.</th>
							<th>Išsilavinimas</th>
							<th>Alga</th>
							<th></th>
						</tr>
						<?php foreach($data as $darbuotojai){?>
						<tr>
							<td><strong><?=$a++;?></strong></td>
							<td><?=$darbuotojai['name']?></td>
							<td><?=$darbuotojai['surname']?></td>
							<td><?=$darbuotojai['phone']?></td>
							<td><?=$darbuotojai['education']?></td>
							<td><?=$darbuotojai['salary']?></td>
							<td><a href="darbuotojas.php?id=<?=$darbuotojai['id'] ?>" class="btn btn-primary">Plačiau</a></td>
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