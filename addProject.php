<?php 
require_once 'db.php';
$employees_id=$_GET['id'];

if(isset($_POST['id'])){
    $id=$_POST['id'];
    $projects_id=$_POST['projects_id'];
    $employees_id=$_POST['employees_id'];
    
    $ps=$db->prepare('INSERT INTO projects_employees(id,projects_id,employees_id)VALUES(?,?,?)');
    if(!$ps->execute([$id,$projects_id,$employees_id])){
        print_r($ps->errorInfo());
    }else{
        header('Location:statistika.php');
        die();
    }
    
    
}
$ps=$db->prepare("SELECT name, surname,positions_id FROM employees2 WHERE id=?");
$ps->execute([$employees_id]);

$darbuotojas=$ps->fetch(PDO::FETCH_ASSOC);

$ps2=$db->query("SELECT id, name FROM projects");
$data2=$ps2->fetchAll(PDO::FETCH_ASSOC);

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="reset.css" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" 
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title></title>
  </head>
  <body>
 

   <div class="container" id="content" tabindex="-1">

       <div class="row">
        
        <div class="col-md-12 order-md-1">
        <br>
          <h4 class="mb-3">Priskirti naują projektą</h4>
          <form method="post" action="addProject.php">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Vardas</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?=$darbuotojas['name']?>" required>
               
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Pavardė</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="" value="<?=$darbuotojas['surname']?>" required>
                
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Pareigos</label>
                <input type="text" class="form-control" name="positions_id" id="positions_id" placeholder="" value="<?=$darbuotojas['positions_id']?>" required>
                
              </div>
              
            </div>
            
             <div class="row">
            
              <div class="col-md-6 mb-3">
                <label for="lastName">Projekto pavadinimas</label>
                <select name= "projects_id" class="form-control" required>
                  <?php foreach($data2 as $projektai){?>
                <option value="<?=$projektai['id']?>"><?=$projektai['name']?></option>
                <?php }?>
                </select>
              
              
                
              </div>
              
               <div class="col-md-6 mb-3">
                <label for="lastName">Įrašo numeris</label>
                <input type="text" class="form-control" name="id" id="id" placeholder="" value="" required>
                
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Darbuotojo ID</label>
                <input type="text" class="form-control" name="employees_id" id="employees_id" placeholder="" value="<?=$employees_id?>" required>
                
              </div>
            </div>
            
            

            <hr class="mb-4">
            <button class="btn btn-primary" id="spalva" type="submit" name="insert">Išsaugoti</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
