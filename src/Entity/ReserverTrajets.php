<?php

namespace App\Entity;

use DateTime;


class ReserverTrajets
{
    /**
     * @var integer $id_reserver_trajet  identifiant de reserver_trajet en auto incrémente
     */
    private int $id_reserver_trajet;

    /**
     * @var integer $num_trajet_reserve
     */
    private int $num_trajet_reserve;

    /**
     * @var DateTime $date_arrivee
     */
    private DateTime $date_arrivee;

    /**
     * @var DateTime $date_depart
     */
    private DateTime $date_depart;

    /**
     * @var DateTime $heure_depart
     */
    private DateTime $heure_depart;

    /**
     * @var DateTime $heure_arrivee
     */
    private DateTime $heure_arrivee;

    /**
     * @var string $ville_depart
     */
    private string $ville_depart;

    /**
     * @var string $ville_arrivee
     */
    private string $ville_arrivee;

    /**
     * @var string $etat_validation  return une enum de en attente, valide, refusé et par défaut en attente
     */
    private string $etat_validation;
    

    public function __construct(
        int $id_reserver_trajet,
        int $num_trajet_reserve,
        DateTime $date_arrivee,
        DateTime $date_depart,
        DateTime $heure_depart,
        DateTime $heure_arrivee,
        string $ville_depart,
        string $ville_arrivee


    )
    {
        $this->id_reserver_trajet = $id_reserver_trajet;
        $this->num_trajet_reserve = $num_trajet_reserve;
        $this->date_arrivee = $date_arrivee;
        $this->date_depart = $date_depart;
        $this->heure_depart = $heure_depart;
        $this->heure_arrivee = $heure_arrivee;
        $this->ville_depart = $ville_depart;
        $this->ville_arrivee = $ville_arrivee;
        
    }
    
    
    /**
     * Récupère l'id de  reserver_trajet      identifiant en auto incrémente
     *
     * @return id_reserver_trajet
     */
    public function getId_reserver_trajet()
    {
        return $this->id_reserver_trajet;
    }

    /**
     * Récupère la date d'arrivée
     *
     * @return date_arrivee
     */
    public function getDate_arrivee()
    {
        return $this->date_arrivee;
    }

    /**
     * Modifie/Affecte  la date d'arrivée
     *
     * @param DateTime $date_arrivee
     * @return date_arrivee
     */
    public function setDate_arrivee($date_arrivee)
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    /**
     * Récupère la date de départ
     *
     * @return date_depart
     */
    public function getDate_depart()
    {
        return $this->date_depart;
    }

    /**
     * Modifie/Affecte  la date de départ
     *
     * @param DateTime $date_depart
     * @return date_depart
     */
    public function setDate_depart($date_depart)
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    /**
     * Récupère l'heure de départ
     *
     * @return heure_depart
     */
    public function getHeure_depart()
    {
        return $this->heure_depart;
    }

    /**
     * Modifie/Affecte  l'heure de départ
     *
     * @param DateTime $heure_depart
     * @return heure_depart
     */
    public function setHeure_depart($heure_depart)
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    /**
     * Récupère l'heure d'arrivée
     *
     * @return heure_arrivee
     */
    public function getHeure_arrivee()
    {
        return $this->heure_arrivee;
    }

    /**
     * Modifie/Affecte  l'heure d'arrivée
     *
     * @param DateTime $heure_arrivee
     * @return heure_arrivee
     */
    public function setHeure_arrivee($heure_arrivee)
    {
        $this->heure_arrivee = $heure_arrivee;

        return $this;
    }

    /**
     * Récupère la ville de départ
     *
     * @return ville_depart
     */
    public function getVille_depart()
    {
        return $this->ville_depart;
    }

    /**
     * Modifie/Affecte  la ville de départ
     *
     * @param string $ville_depart
     * @return ville_depart
     */
    public function setVille_depart($ville_depart)
    {
        $this->ville_depart = $ville_depart;

        return $this;
    }

    /**
     * Récupère la ville arrivée
     *
     * @return ville_arrivee
     */
    public function getVille_arrivee()
    {
        return $this->ville_arrivee;
    }

    /**
     * Modifie/Affecte  la ville d'arrivée
     *
     * @param string $ville_arrivee
     * @return ville_arrivee
     */
    public function setVille_arrivee($ville_arrivee)
    {
        $this->ville_arrivee = $ville_arrivee;

        return $this;
    }

    /**
     * Récupère le numéro de trajet des trajets réservés
     *
     * @return num_trajet_reserve
     */
    public function getNum_trajet_reserve()
    {
        return $this->num_trajet_reserve;
    }

    /**
     * Modifie/Affecte  le numéro de trajet des trajets réservés
     *
     * @param int $num_trajet_reserve
     * @return num_trajet_reserve
     */
    public function setNum_trajet_reserve($num_trajet_reserve)
    {
        $this->num_trajet_reserve= $num_trajet_reserve;

        return $this;
    }

    /**
     * Récupère l'état de validation 
     *
     * @return etat_validation
     */
    public function getEtat_validation()
    {
        return $this->etat_validation;
    }

    /**
     * Modifie/Affecte  l'état de validation
     *
     * @param string $etat_validation
     * @return etat_validation
     */
    public function setEtat_validation($etat_validation)
    {
        $this->etat_validation = $etat_validation;

        return $this;
    }

    
}