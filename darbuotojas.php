<?php
require_once 'db.php';
if(isset($_GET['id'])){
 $id=$_GET['id'];
}

$ps=$db->prepare("SELECT employees2. *,positions.name AS positionName FROM employees2 
LEFT JOIN positions ON positions.id = employees2.positions_id
WHERE employees2.id=?");
if(!$ps->execute([$id])){
    print_r($ps->errorInfo());
}else{
    //header('Location: statistika.php');
    //die();
}
$ps->execute([$id]);
$data=$ps->fetchAll(PDO::FETCH_ASSOC);

$ps2=$db->prepare("SELECT projects_employees.*,employees2.name,employees2.surname,projects.name 
AS project_name FROM projects_employees 
LEFT JOIN employees2 ON employees2.id = projects_employees.employees_id
LEFT JOIN projects ON projects.id = projects_employees.projects_id
WHERE projects_employees.employees_id = ?");
$ps2->execute([$id]);
$data2=$ps2->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="reset.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
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
.curr {
	text-align: right;
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
<?php foreach($data as $darbuotojai){?>
			<div class="col-md-12">
				<div class="page-header">
				
					<h1><?=$darbuotojai['name']." ".$darbuotojai['surname']?></h1>
				</div>




			</div>

			<div class="col-md-6">

				<p>
					<b>Pareigos</b> <br /><?=$darbuotojai['positionName']?> 
				
				</p>
				<p>
					<b>Mėnesinė alga: </b> <br /><?=$darbuotojai['salary']?>
				</p>

			</div>
			<div class="col-md-6">

				<p>
					<b>Telefonas: </b> <br /> <?=$darbuotojai['phone']?>
				</p>
				


			</div>
			<div class="clearfix"></div>
			<div class="col-md-6">

				<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Mokesčiai</div>


					<table class="table  table-hover">

						<tr>
							<td>Priskaičiuotas atlyginimas „ant popieriaus“:</td>
							<td class="curr"><?=$darbuotojai['salary']?></td>


						</tr>
						<tr>
							<td>Pritaikytas NPD</td>
							<td class="curr">149.00 EUR</td>


						</tr>
						<tr>
							<td>Pajamų mokestis 15 %</td>
							<td class="curr"><?=round(($darbuotojai['salary']-149)*0.15,2)?></td>


						</tr>
						<tr>
							<td>Sodra. Sveikatos draudimas 6 %</td>
							<td class="curr"><?=round(($darbuotojai['salary']-149)*0.06,2)?></td>


						</tr>
						<tr>
							<td>Sodra. Pensijų ir soc. draudimas 3 %</td>
							<td class="curr"><?=round(($darbuotojai['salary']-149)*0.03,2)?></td>


						</tr>

						<tr class="info">
							<td>Išmokamas atlyginimas „į rankas“:</td>
							<td class="curr"><b><?=round($darbuotojai['salary']-(($darbuotojai['salary']-149)*0.15)-
							(($darbuotojai['salary']-149)*0.06)-(($darbuotojai['salary']-149)*0.03),2)?></b></td>
						</tr>

						<tr>
							<td colspan="2"><b>Darbo vietos kaina</b></td>
						</tr>

						<tr>
							<td>Sodra 30.98 %:</td>
							<td class="curr"><?=round($darbuotojai['salary']*0.3098,2)?></td>
						</tr>

						<tr>
							<td>Įmokos į garantinį fondą 0.2 % :</td>
							<td class="curr"><?=round($darbuotojai['salary']*0.002,2)?></td>

						</tr>
						<tr class="info">
							<td>Visa darbo vietos kaina :</td>
							<td class="curr"><b><?=round($darbuotojai['salary']+($darbuotojai['salary']*0.3098)+
							($darbuotojai['salary']*0.002),2)?></b></td>

						</tr>
					</table>
				</div>
			</div>
<?php }?>

		<div class="col-md-6">
			<div class="panel panel-primary">
					<!-- Default panel contents -->
					<div class="panel-heading">Vykdomų projektų sąrašas</div>

				<?php foreach($data2 as $projektai){?>
					<table class="table  table-hover">
					<tr>
					<td  id="spalva2"><?=$projektai['project_name']?></td>
					</tr>
					</table>
				<?php }?>
				
			
			</div>
			<a href="addProject.php?id=<?=$darbuotojai['id'] ?>"
							class="btn btn-primary">Pridėti naują projektą</a><br><br>
		</div>
		</div>
	</div>
			
			




	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
