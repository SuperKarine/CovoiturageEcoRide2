<?php

class Passagers
{
    private $id_passagers;
    private $date_trajet;
    private $heure_trajet;
    private $nbre_places;
    private $date_crédit_en_cours;
    private $credit_en_cours;
    private $debit;
    private $date_debit;
    private $credit_restant;

    public function getid()
    {
        return$this->id_passagers;
    }

    public function setid($id)
    {
        $this->id_passagers=$id;

    }

    public function get_date_trajet()
    {
        return$this->date_trajet;
    }

    public function set_date_trajet($date_trajet)
    {
        $this->date_trajet = $date_trajet;
    }

     
}