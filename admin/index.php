<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
  <script src="../bootstrap-3.3.7-dist/jquery.min.js"></script> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <!-- SECTION GRAND TITRE  -->
<h1 class="text_logo"><span class="glyphicon glyphicon-cutlery" ></span> Bergeur Code <span class="glyphicon glyphicon-cutlery" ></span></h1>
  <!-- DEBUT DE LA PAGE ADMIN  -->
    <div class="container " id="admin">
        <div class="row">
          <h1>Liste des items <a href="insert.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus"> </span> Ajouter</h1></a>
        </div>
        <!-- SECTION TABLE -->
        <table class="table table-striped table-berdered">
          <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Categirie</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
              <?php
                require 'dataBase.php';
                $conect =DataBase::connect();
                // $request = $conect->query('SELECT  name , description , price FROM items ');
                $request = $conect->query('SELECT items.name ,items.description , items.price, categories.name  AS category ,items.id FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');
                while ($row = $request->fetch() ){
                    echo'<tr>';
                    echo'<td>'. $row['name'] .'</td>';
                    echo'<td>'. $row['description'] .'</td>';
                    echo' <td>'. number_format((float)$row['price'],2,'.','') .' fr </td>';
                    echo' <td>'. $row['category'] .'</td>';
                    echo' <td width=300px>';
                        echo'<a href="view.php?id='. $row['id'] .'" class="btn btn-default"> <span class="glyphicon glyphicon-eye-open"></span> voir</a>&nbsp';
                        echo'<a href="update.php?id='. $row['id'] .'" class="btn btn-success"> <span class="glyphicon glyphicon-pencil"></span> modifier</a> &nbsp';
                        echo'<a href="delete.php?id='. $row['id'] .'" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> supprimer</a>';
                        echo'</td>';
                    echo'</tr>'; 
                }
              ?>
          </tbody>
           
        </table>
    </div>


<body>
</html>