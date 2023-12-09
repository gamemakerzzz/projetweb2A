<?php
class Consultation
{
    private ?int $idConsultation = null;
    private ?int $idReservation = null;
    private ?string $dateReservation = null;
    private ?string $dateConsultation = null;
    private ?int $age = null;

    public function __construct($id = null, $idRes, $dateRes, $dateCons, $age)
    {
        $this->idConsultation = $id;
        $this->idReservation = $idRes;
        $this->dateReservation = $dateRes;
        $this->dateConsultation = $dateCons;
        $this->age = $age;
    }

    public function getIdConsultation()
    {
        return $this->idConsultation;
    }

    public function getIdReservation()
    {
        return $this->idReservation;
    }

    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;
        return $this;
    }

    public function getDateConsultation()
    {
        return $this->dateConsultation;
    }

    public function setDateConsultation($dateConsultation)
    {
        $this->dateConsultation = $dateConsultation;
        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function toArray()
    {
        return [
            'idConsultation' => $this->idConsultation,
            'idReservation' => $this->idReservation,
            'dateReservation' => $this->dateReservation,
            'dateConsultation' => $this->dateConsultation,
            'age' => $this->age,
        ];
    }
}
