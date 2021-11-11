   <?php
   require_once("init.php");
   $stmt=$pdo->query("SELECT * FROM LOGEMENT");//PDO STATEMENT



    require_once("Haut_de_page.php")
    ?>
 
 <table class="table table-striped">
   <thead class="thead-dark">
     <tr>
      <?php  for($i=0;$i<$stmt->columnCount();$i++) {
            $col= $stmt->getColumnMeta($i);     ?>
          
          <th scope="col"><?php echo $col['name'] ?></th>
      
      <?php } ?>
      </tr>
  </thead>
  <tbody>

       <?php while ($logement= $stmt->fetch(PDO::FETCH_ASSOC)) {  ?>
        <tr>  
           <td><?php echo $logement['id_logement']; ?></td>
           <td><a href="fiche_Logement.php?id_logement=<?php echo $logement['id_logement']; ?>" ><?php echo $logement['titre']; ?></a></td>
           <td><?php echo $logement['adresse']; ?></td>
           <td><?php echo $logement['ville']; ?></td>
           <td><?php echo $logement['cp']; ?></td>
           <td><?php echo $logement['surface']; ?></td>
           <td><?php echo $logement['prix'] ?></td>
           <td><img src="<?php echo $logement['photo']; ?>" width="150"height="150"/></td>
           <td><?php echo $logement['type']; ?></td>
           <td><?php echo (strlen($logement["description"]) > 40) ?  substr($logement['description'] , 0 , 40) . "..." : $logement["description"] ; ?></td>
       </tr>  
     
     <?php  }   ?>

   
   
  </tbody>
</table>
 <?php
    require_once("Bas_de_page.php")
    ?>
