<?php 
require_once 'db.php';
$result=$db->query("SELECT  * FROM projects");
$data=$result->fetchAll(PDO::FETCH_ASSOC);



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
  </head>
  <body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Baltic Talents</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="statistika.php">Įmonės statistika</a></li>
        
      </ul>
      
      
    </div>
  </div>
</nav>

<div class="container" id="content" tabindex="-1">
<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading" id="spalva">Vykdomi projektai</div>
	
	  <!-- Table -->
	  <table class="table">
	   	<tr>
	   		<th>Sutrumpinimas</th>
	   		<th>Metai</th>
	   		<th>Programa</th>
	   		<th>Suma</th>
	   	</tr>
	   <?php foreach($data as $projektai){?>
	   	<tr>
	   		<td><?=$projektai['name']?></td>
	   		<td><?=$projektai['year']?></td>
	   		<td><?=$projektai['program']?></td>
	   		<td><?=$projektai['price']?></td>
	   	</tr>
	   	<?php }?>
	   	
	  </table>
	</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  
	
	 
	</div>
	</div>
</div>


</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>