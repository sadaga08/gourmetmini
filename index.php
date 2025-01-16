<?php
if (isset($_POST["Envoyer"])){
    
   if (!empty($_POST["name"])&&!empty($_POST["email"])
   &&!empty($_POST["phone"])&&!empty($_POST["date"])
   &&!empty($_POST["time"])&&!empty($_POST["menu"])
   &&!empty($_POST["preferences"])&&!empty($_POST["payment"])){

   $name=htmlspecialchars($_POST["name"]);
   $email=htmlspecialchars($_POST["email"]);
   $phone=htmlspecialchars($_POST["phone"]);
   $date=htmlspecialchars($_POST["date"]);
   $time=htmlspecialchars($_POST["time"]);
   $menu=htmlspecialchars($_POST["menu"]);
   $preferences=htmlspecialchars($_POST["preferences"]);
   $payment=htmlspecialchars($_POST["payment"]);
   echo "votre commande est bien pris en charge merci pour la confiance" ."</br>";
   echo"votre nom est ".$_POST["name"]."</br>";
   echo"votre email est ".$_POST["email"]."</br>";
   echo"votre numéro de téléphone est ".$_POST["phone"]."</br>";
   echo"votre date de réservation est ".$_POST["date"]."</br>";
   echo"votre heurs de réservation est ".$_POST["time"]."</br>";
   echo"votre menu de réservation est ".$_POST["menu"]."</br>";
   echo"votre menu de préference est ".$_POST["preferences"]."</br>";
   echo"votre systeme de payment est ".$_POST["payment"] ."</br>";
   }
}
   try {
   $server = "localhost";
   $login = "root";
   $password ="";
   $connexion = new PDO("mysql:host=$server", $login , $password);
   //$connexion->setAttribute(POD::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
   echo "la connexion vers votre base de donnée est bien établi félicitation "."</br>";

   /*cette partie est réserver pour les requête sql*/
   //base de donnée 
   $mysql = "CREATE DATABASE  IF NOT EXISTS reservation ";
   $connexion->exec($mysql);
   echo "votre base de bonnée est créer félicitation "."</br>";
   //table de la base de donnée
   $connexion->exec("use reservation");
   $mysql = "CREATE TABLE IF NOT EXISTS clients (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nom VARCHAR(50) NOT NULL,
      email VARCHAR(70) NOT NULL,
      phone VARCHAR(15) NOT NULL,
      dates DATE NOT NULL,
      heures TIME NOT NULL,
      menu VARCHAR(50) NOT NULL,
      preferences VARCHAR(255),
      payment VARCHAR(50) NOT NULL
  )";
  $connexion->exec($mysql);
  echo"vous avez crée une table pour votre base de donnée félicitation"."</br>";
 
  //insertion des donner de reservation dans la base de donnée
   $mysql="INSERT INTO clients(nom , email ,phone,dates,heures,menu,preferences,payment)
            VALUE(:nom , :email ,:phone,:dates,:heures,:menu,:preferences,:payment)";

   $sql=$connexion->prepare($mysql);
   $sql->execute([
      ':nom' => $name,
      ':email' => $email,
      ':phone' => $phone,
      ':dates' => $date,
      ':heures' => $time, 
      ':menu' => $menu,
      ':preferences' => $preferences,
      ':payment' => $payment,
  ]);


  echo"les données de reservation ont été inserer dans la bases de données avec succès";





   } catch (PDOException $e) {
      echo "une erreur est détecter quelque part veuillez vérifier".$e->getMessage();
   }

























?>