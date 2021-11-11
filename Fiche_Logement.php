    <?php
    require_once('init.php');
    if(isset($_GET['id_logement'])){
        $stmt=$pdo->query("SELECT * FROM LOGEMENT WHERE
         id_logement='$_GET[id_logement]' ");
        $logement=$stmt->fetch(PDO::FETCH_ASSOC);

    }
    require_once("Haut_de_page.php")
    
    ?>

<div class="card" style="width: 18rem;">
  <img src="<?php echo $logement['photo']; ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $logement['titre'] ; ?></h5>
    <p class="card-text"><?php echo $logement['description'] ; ?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><?php echo $logement['adresse'] ; ?></li>
    <li class="list-group-item"><?php echo $logement['ville']."  ". $logement['cp']  ; ?></li>
  </ul>
  <div class="card-body">
    <?php echo "Surface ".$logement['surface'] ; ?>
   <?php echo "Prix : ". $logement['prix']  ; ?>
  </div>
</div>
   <?php
    require_once("Bas_de_page.php")
    ?>