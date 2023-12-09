<?php

require '../config.php';

class JoueurC
{

    public function listJoueurs()
    {
        $sql = "SELECT * FROM joueur";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteJoueur($ide)
    {
        $sql = "DELETE FROM joueur WHERE idJoueur = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function addJoueur($joueur)
{
    $sql = "INSERT INTO joueur (nom, prenom, email, tel) VALUES (:nom, :prenom, :email, :tel)";
    $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nom' => $joueur->getNom(),
            'prenom' => $joueur->getPrenom(),
            'email' => $joueur->getEmail(),
            'tel' => $joueur->getTel(),
        ]);

        echo "Joueur ajouté avec succès!";
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


    function showJoueur($id)
    {
        $sql = "SELECT * from joueur where idJoueur = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $joueur = $query->fetch();
            return $joueur;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function toArray()
    {
        return [
            'idJoueur' => $this->idJoueur,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'tel' => $this->tel
        ];
    }
    function updateJoueur($joueur, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE joueur SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    tel = :tel
                WHERE idJoueur= :idJoueur'
            );
            
            $query->execute([
                'idJoueur' => $id,
                'nom' => $joueur->getNom(),
                'prenom' => $joueur->getPrenom(),
                'email' => $joueur->getEmail(),
                'tel' => $joueur->getTel(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
