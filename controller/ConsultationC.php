<?php
require '../config.php';

class ConsultationC
{
    public function listConsultations()
    {
        $sql = "SELECT * FROM consultation";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    public function afficherConsultations($idReservation)
    {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM consultation WHERE idReservation = :id");
            $query->execute(['id' => $idReservation]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteConsultation($id)
    {
        $sql = "DELETE FROM consultation WHERE idConsultation = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
    
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    

    public function addConsultation($consultation)
    {
        $sql = "INSERT INTO consultation (idReservation, dateReservation, dateConsultation, age) 
                VALUES (:idReservation, :dateReservation, :dateConsultation, :age)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idReservation' => $consultation->getIdReservation(),
                'dateReservation' => $consultation->getDateReservation(),
                'dateConsultation' => $consultation->getDateConsultation(),
                'age' => $consultation->getAge(),
            ]);

            echo "Consultation ajoutée avec succès!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showConsultation($id)
    {
        $sql = "SELECT * FROM consultation WHERE idConsultation = $id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $consultation = $query->fetch();
            return $consultation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateConsultation($consultation, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE consultation SET 
                    idReservation = :idReservation, 
                    dateReservation = :dateReservation, 
                    dateConsultation = :dateConsultation, 
                    age = :age
                WHERE idConsultation = :id'
            );

            $query->execute([
                'id' => $id,
                'idReservation' => $consultation->getIdReservation(),
                'dateReservation' => $consultation->getDateReservation(),
                'dateConsultation' => $consultation->getDateConsultation(),
                'age' => $consultation->getAge(),
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
