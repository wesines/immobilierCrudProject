    <?php
    require_once('init.php');
    
    if($_POST){
        //photo
        //var_dump($_FILES);

        //echo 'Je soumet mon formulaire';
       //echo '<pre>';
        // var_dump($_POST);
       // echo '</pre>';
       $erreur="";
     if(empty($_POST["titre"])){
       $erreur.="<div class='alert alert-danger' role='alert'>
        le titre est obligatoire
        </div>";
     }
      if(empty($_POST["adresse"])){
       $erreur.="<div class='alert alert-danger' role='alert'>
        l'adresse est obligatoire
        </div>";
     }
      if(empty($_POST["ville"])){
       $erreur.="<div class='alert alert-danger' role='alert'>
        la ville est obligatoire
        </div>";
     }
      if(empty($_POST["cp"])){
       $erreur.="<div class='alert alert-danger' role='alert'>
        le code postal est obligatoire
        </div>";
     }elseif(!ctype_digit($_POST["cp"]) || strlen($_POST["cp"])<4 ){
        $erreur.="<div class='alert alert-warning' role='alert'>
        Veuillez renseinger un code postal à 4 chiffre!
        </div>";
     }
      if(empty($_POST["surface"])){
       $erreur.="<div class='alert alert-danger' role='alert'>
        la surface est obligatoire
        </div>";
     }elseif(!ctype_digit($_POST['surface'])){
        $erreur.="<div class='alert alert-warning' role='alert'>
                Veuillez renseinger un chiffre entier pour la surface

        </div>";
     }
      if(empty($_POST["prix"])){
       $erreur.="<div class='alert alert-danger' role='alert'>
        le prix est obligatoire
        </div>";
     }elseif(!ctype_digit($_POST['prix'])){
        $erreur.="<div class='alert alert-warning' role='alert'>
                Veuillez renseinger un chiffre entier pour le prix

        </div>";
     }

     //EXTENSION
     $extensions=['.png','.jpeg','.jpg'];
     $extension= strchr($_FILES['photo']['name'],".");
     echo $extension;
     if(!in_array( $extension, $extensions)){
        $erreur.="<div class='alert alert-danger' role='alert'>
                Veuillez choisir une image d'extension jpeg, jpg ou png

        </div>";
     }

   $maxSize=1000000;
   if($_FILES['photo']['size']>1000000){
         $erreur.="<div class='alert alert-danger' role='alert'>
                Veuillez uploader une image moins lourde (max 1Mo)

        </div>";
   }
      
      $content.=$erreur;
      if(empty($erreur)){
        if(isset($_FILES) && !empty($_FILES['photo']['name'])){
        // nom de la photo

        //$pictureName=$_FILES['photo']['name'];
        $pictureName="logement_".time().$extension;
        //copier le chemin vers le serveur en BDD
        $pathPhotoDB=URL."photo/".$pictureName;
   
        //copier sur le serveur
        $pathFolder=RACINE_SITE."photo/".$pictureName;
       // echo $pathFolder."<br>";
      
       copy($_FILES['photo']['tmp_name'],$pathFolder);
      

      }
      $count= $pdo->exec("INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description)
        VALUES (
        '$_POST[titre]',
        '$_POST[adresse]',
        '$_POST[ville]',
        '$_POST[cp]',
        '$_POST[surface]',
        '$_POST[prix]',
         '$pathPhotoDB',
        '$_POST[type]',
        '$_POST[description]'
        )");

        if($count>0)
        $content="<div class='alert alert-success'
                  role='alert'>'Isertion réussie'
                </div>";


        }
        
    }
    $titre=(!empty($_POST['titre']) ? $_POST['titre'] : "");
     $adresse=(!empty($_POST['adresse']) ? $_POST['adresse'] : "");
     $ville=(!empty($_POST['ville']) ? $_POST['ville'] : "");
     $cp=(!empty($_POST['cp']) ? $_POST['cp'] : "");
     $surface=(!empty($_POST['surface']) ? $_POST['surface'] : "");
     $prix=(!empty($_POST['prix']) ? $_POST['prix'] : "");
     $photo=(!empty($_POST['photo']) ? $_POST['photo'] : "");
     $type=(!empty($_POST['type']) ? $_POST['type'] : "");
     $description=(!empty($_POST['description']) ? $_POST['description'] : "");



    require_once("Haut_de_page.php");
    ?>
    <h2> Ajouter un logement</h2>
    <?php    echo  $content; ?>
        <form class="col-md-12 d-flex flex-wrap" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-6">
            <label for="titre">Titre</label>
            <input type="text" name="titre" class="form-control"
             id="titre" aria-describedby="titre" value="<?php echo $titre  ?>"
              placeholder="Entrer un titre">
        </div>
         <div class="form-group col-md-6">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" class="form-control"
             id="adresse" aria-describedby="adresse" value="<?php echo $adresse  ?>"
              placeholder="Entrer une adresse">
        </div>
         <div class="form-group col-md-6">
            <label for="ville">Ville</label>
            <input type="text" name="ville" class="form-control"
             id="ville" aria-describedby="ville"  value="<?php echo $ville  ?>"
              placeholder="Entrer une ville">
        </div>
         <div class="form-group col-md-6">
            <label for="cp">Code postal</label>
            <input type="text"name="cp" class="form-control"
             id="cp" aria-describedby="cp"  value="<?php echo $cp  ?>"
              placeholder="Entrer un code postal">
        </div>
         <div class="form-group col-md-6">
            <label for="surface">Surface</label>
            <input type="text" name="surface" class="form-control"
             id="surface" aria-describedby="surface" value="<?php echo $surface  ?>"
              placeholder="Entrer une surface">
        </div>
         <div class="form-group col-md-6">
            <label for="prix">Prix</label>
            <input type="text" name="prix" class="form-control"
             id="prix" aria-describedby="prix" value="<?php echo $prix  ?>"
              placeholder="Entrer un prix">
        </div>
         <div class="form-group col-md-6">
            <label for="photo">Photo</label>
            <div class="w-100"></div>
            <input type="file" name="photo" >

        </div>
        <div class="form-group col-md-5">
        <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="location" value="location" checked>
        <label class="form-check-label" for="location">
            Location
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="vente" value="vente">
        <label class="form-check-label" for="vente">
            Vente
        </label>
        </div>
        </div>
         <div class="form-group col-md-6">
             <label for="description" >description</label>
           <textarea name="description" class="form-control" rows="3" id="description"><?php echo $description  ?></textarea>
          </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">
                Ajouter un logement</button>
        </div>
    </form>
      <?php
    require_once("Bas_de_page.php")
    ?>