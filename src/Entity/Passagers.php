<?php

namespace App\Entity;

use DateTime;

class Passagers extends Utilisateurs
{
    /**
     * @var integer $id_passagers     identifiant du passager en auto increment
     */
    protected int $id_passagers;

    /**
     * @var DateTime $date_trajet      Date du trajet
     */
    protected DateTime $date_trajet;

    /**
     * @var DateTime $heure_trajet     heure du trajet
     */
    protected DateTime $heure_trajet;

    /**
     * @var integer $nbre_places     nombre de places disponible dans le véhicule
     */
    protected int $nbre_places;

    /**
     * @var DateTime $date_crédit_en_cours      Date du crédit en cours
     */
    protected DateTime $date_crédit_en_cours;

    /**
     * @var integer $credit_en_cours       Le montant du Crédit en cours
     */
    protected int $credit_en_cours;

    /**
     * @var integer $debit        Le montant du débit
     */
    protected int $debit;

    /**
     * @var DateTime $date_debit         Date du débit
     */
    protected DateTime $date_debit;

    /**
     * @var integer $credit_restant    Le montant du crédit restant
     */
    protected int $credit_restant;


    public function __construct(
        int $id_passagers,
        DateTime $date_trajet,
        DateTime $heure_trajet,
        int $nbre_places,
        DateTime $date_crédit_en_cours,
        int $credit_en_cours,
        int $debit,
        DateTime $date_debit,
        int $credit_restant
    )
    {
         $this->id_passagers = $id_passagers;
         $this->date_trajet = $date_trajet;
         $this-> heure_trajet= $heure_trajet;
         $this->nbre_places = $nbre_places;
         $this->date_crédit_en_cours = $date_crédit_en_cours;
         $this->credit_en_cours = $credit_en_cours;
         $this->debit = $debit;
         $this->date_debit = $date_debit;
         $this->credit_restant = $credit_restant;
    }

    
    /**
     * Récupère identifiant du passager        identifiant du passager en auto incrément
     *
     * @return id_passagers
     */
    public function getId_passagers()
    {
        return $this->id_passagers;
    }

    /**
     * Récupère la date du trajet
     *
     * @return date_trajet
     */
    public function getDate_trajet()
    {
        return $this->date_trajet;
    }

    /**
     * Modifie/Affecte  la date du trajet
     *
     * @param DateTime $date_trajet
     * @return date_trajet
     */
    public function setDate_trajet($date_trajet)
    {
        $this->date_trajet = $date_trajet;

        return $this;
    }


    /**
     * Modifie/Affecte  l'heure du trajet
     *
     * @param DateTime $heure_trajet
     * @return heure_trajet
     */
    public function setHeure_trajet($heure_trajet)
    {
        $this->heure_trajet = $heure_trajet;

        return $this;
    }

    /**
     * récupère l'heure du trajet
     *
     * @return heure_trajet
     */
    public function getHeure_trajet()
    {
        return $this->heure_trajet;
    }

    /**
     * Récupère le nombre de places disponible dans la voiture
     *
     * @return nbre_places
     */
    public function getNbre_places()
    {
        return $this->nbre_places;
    }

    /**
     * Modifie/Affecte  le nombre de places disponible dans la voiture
     *
     * @param int $nbre_places
     * @return nbre_places
     */
    public function setNbre_places($nbre_places)
    {
        $this->nbre_places = $nbre_places;

        return $this;
    }

    /**
     * Récupère la date de crédit en cours
     *
     * @return date_crédit_en_cours
     */
    public function getDate_crédit_en_cours()
    {
        return $this->date_crédit_en_cours;
    }

    /**
     * Modifie/Affecte  la date de crédit en cours
     *
     * @param DateTime $date_crédit_en_cours
     * @return date_crédit_en_cours
     */
    public function setDate_crédit_en_cours($date_crédit_en_cours)
    {
        $this->date_crédit_en_cours = $date_crédit_en_cours;

        return $this;
    }

    /**
     * Récupère le crédit en cours
     *
     * @return credit_en_cours
     */
    public function getCredit_en_cours()
    {
        return $this->credit_en_cours;
    }

    /**
     * Modifie/Affecte  le crédit en cours
     *
     * @param int $credit_en_cours
     * @return credit_en_cours
     */
    public function setCredit_en_cours($credit_en_cours)
    {
        $this->credit_en_cours = $credit_en_cours;

        return $this;
    }

    /**
     * Récupère le débit
     *
     * @return debit
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * Modifie/Affecte  le débit
     *
     * @param int $debit
     * @return debit
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * Récupère la date du débit
     *
     * @return date_debit
     */
    public function getDate_debit()
    {
        return $this->date_debit;
    }

    /**
     * Modifie /Affecte la date du débit
     *
     * @param DateTime $date_debit
     * @return date_debit
     */
    public function setDate_debit($date_debit)
    {
        $this->date_debit = $date_debit;

        return $this;
    }

    /**
     * Récupère le crédit restant
     *
     * @return credit_restant
     */
    public function getCredit_restant()
    {
        return $this->credit_restant;
    }

    /**
     * Modifie/Affecte  le crédit restant
     *
     * @param int $credit_restant
     * @return credit_restant
     */
    public function setCredit_restant($credit_restant)
    {
        $this->credit_restant = $credit_restant;

        return $this;
    }

}