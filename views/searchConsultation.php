<?php 
require_once  "../controller/ReservationC.php"; 
$reservationC = new ReservationC;
if($_SERVER[" REQUEST METHOD"]=="POST"){
  if(isset($_POST["reservation"]) && isset($_POST['search'])){
    $idReservation = $_POST['reservation'];
    $reservations = $reservationC->afficheConsultations($idReservation);
  }
}?>
<!DOCTYPE html >
<head> 
   <title>Recherche des consultations</title>
</head>
<body> 
  <h1>Recherche des consultatios par l'id de reservation</h1>
  <form action="" method="POST">
     <label for="idReservation">Selectionner un ide de reservation :</label> 
     <select name="idReservation" id="idReservation">
      <?<php
      foreach ($reservations as $reservation) {
        echo '<option value="' .$reservation['idReservation'] .'">' .$reservation['nom'] .
      }
      ?>
      </select>
      <input type="submit" value="Rechercher" name="search">

    </form>
    <?php if(isset($list)) {?>
      <br>
      <h2>Consultations correspondants au reservation selectionnée:</h2>
      <ul>
        <?php foreach($list as $consultation){ ?>
          <li><?=$consultation['id_consultation'] ?> - <?=$consultation['date_consultation'] ?>dt</li>
          <?php } ?>
        </ul>
        <?php } ?>
    
        </body>
        </html>