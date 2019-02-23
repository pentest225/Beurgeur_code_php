<?php
    require 'dataBase.php';
    $Nom=$description=$prix=$image=$DescriptionError=$NameError=$PriceError=$ImageError=$cotegorie=$imagePath=$categorie="";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        // VERIFIONS SI LA $_POST[] N'EST PAS VIDE 
        if(!empty ($_POST)){
            $NOM=VerifInfo($_POST['name']);
            $description=VerifInfo($_POST['description']);
            $prix=VerifInfo($_POST['price']);
            $categorie=$_POST['categorie'];
            $image= $_FILES['image']['name'];
            $imagePath="../images/". baseName($image) ;
            $imageExtanssion =pathinfo($imagePath,PATHINFO_EXTENSION);

            $IsSuccess=TRUE;
            $IsUploaded=TRUE;
            if(empty($NOM) ==""){
                $NameError="veillez saissir le Nom du poduit";
                $IsSuccess=false;
            }
            if(empty($description) ==""){
                $NameError="veillez saissir le DESCRIPTION  du poduit";
                $IsSuccess=false;
            }
            if(empty($prix) ==""){
                $NameError="veillez saissir le PRIX du poduit";
                $IsSuccess=false;
            }
            if(empty($image) ==""){
                $NameError="veillez saissir le Nom du poduit";
                $IsSuccess=false;
            }
            if(empty ($image))
            {
                $ImageError="Veillez charger le fichier ";
                $IsSuccess=false;
            }
            else{
                if(file_exists($imagePath)){
                    $ImageError='ce fichier existe dejat';
                    $IsUploaded=false;
                }
                if($_FILES['image']['size']>50000){
                    $ImageError="fichier trop lourd";
                    $IsUploaded=false;
                }
                if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagePath)){
                    $ImageError="Probleme de chargement du fichier";
                    $IsUploaded=false;
                }

            }
            if($IsSuccess=true && $IsUploaded=true){
                // INSERTION DES DONNE DANS LA DATA BASE 
                $db= DataBase::connect();
                $statement=$db->prepare("INSERT INTO items (name,description,price,image) VALUES ( ? , ? , ? , ?)");
                $statement->execute(array($Nom,$description,$prix,$image,));
                DataBase::Desconexte();
                header('Location:index.php');   
            }

           
        }
    }




    function VerifInfo($info){
        $info=trim($info);
        $info=htmlspecialchars($info);
        $info=stripslashes($info);
        return $info;
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
        <div class="">
            <h2>AJOUTER UN ITEMS </h2>
            <form action='<?php echo($_SERVER['PHP_SELF']) ?>' method="POST" rol="form" enctype='multipart/form-data'>
                                <div class="form-group">
                                <div class="" >                    
                                   <label for="name">Nom :</label>                                    
                                        <input class="form-control" type="text" placeholder="Entre le nom de l'items" id="name"name="name">
                                    </div>
                                    <div class="erreur container"><?php echo $NameError?></div>
                                </div>
                                <div class="form-group">
                                    <div >
                                    <label for="description">Description :</label>                                    
                                        <input class="form-control" type="text" placeholder="Entre la description de l'items" id="description" name="description">
                                    </div>
                                    <div class="erreur container"><?php echo $DescriptionError?></div>
                                </div>
                                <div class="form-group">
                                    <div >                    
                                        <label for="price">Prix :</label>                                    
                                        <input class="form-control" type="number" placeholder="prix" id="price" name="price">
                                    </div>
                                    <div class="erreur container"><?php echo $PriceError?></div>
                                </div>
                                <div class="form-group">
                                    <div >                    
                                        <label for="categorie">Categorie:</label>                                    
                                        <select name="categorie" id="categorie" class="form-control">
                                            <?php
                                                $db=DataBase::connect();
                                                foreach($db->query('SELECT * FROM categories') as $row){
                                                    echo('<option value="' .$row['id'] .' ">'.$row['name'] .'</option>');
                                                };
                                                DataBase::Desconexte(); 
                                            ?>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div >                    
                                    <label for="image">Image :</label>                                    
                                        <input  type="file" value="Selectionne une image" id="image" name="image">
                                    </div>
                                    <div class="erreur container"><?php echo $ImageError?></div>
                                </div>
                            <div class="form-actions">
                                <a class='btn btn-info' href="index.php"><span class="glyphicon glyphicon-arrow-left"> </span> Retour</a>
                                <button type="submit" class='btn btn-warning ' value="" ><span class="glyphicon glyphicon-pencil"></span> AJOUTER</button>

                            </div>
                            </form>
        </div>

    </div>
<body>
</html>