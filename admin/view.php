<?php
    require'dataBase.php';
    if(!empty($_GET['id'])){
        $id= VerifId($_GET['id']);
    }
    $db = DataBase::connect();
    $conexion=$db->prepare('SELECT items.name,items.description,items.price,items.image,categories.name AS category FROM items LEFT JOIN categories ON items.category =categories.id WHERE items.id=?');

    $conexion->execute(array($id));
    $result=$conexion->fetch();
    DataBase::Desconexte();



    function VerifId($donnee){
        $donnee=trim($donnee);
        $donnee=htmlspecialchars($donnee);
        $donnee=stripslashes($donnee);
        return $donnee;
    }

?>
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
        <div class="col-md-6 container">
            <h2>VOIR LES ITEMS  </h2>
                            <form action="">
                                <div class="form-group">
                                    <label for="">Nom :</label><?php echo(' '.$result['name'].'');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Description :</label><?php echo(' '.$result['description'].'');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Prix :</label><?php echo(' '.number_format((float)$result['price'],2,'.','').' fr');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Image :</label><?php echo(' '.$result['image'].' ');
                                    ?>
                                </div>
                            </form>
                            <div class="form-actions">
                                <a class='btn btn-info' href="index.php"><span class="glyphicon glyphicon-arrow-left"> </span> Retour</a>
                            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                                <img src="<?php echo"../images/".$result['image']."";?>" alt="...">
                                <div class="price"><?php echo number_format((float)$result['price'],2,'.','')?>frcf</div>
                                <div class="caption">
                                    <h4><?php echo("".$result['description'])?></h4>
                                    <p>text ici</p>
                                    <a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart "></span> commander</a>
                                </div>
                            </div>
            </div>
        </div>
        
    </div>
<body>
</html>