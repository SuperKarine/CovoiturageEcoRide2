<?php

namespace App\Entity;

use DateTime;

class Propose_trajet_passagers
{
    /**
     * @var int $id_propose_trajet_passagers     L'identifiant de propose_trajet_passagers en auto incrémente
     */
    private int $id_propose_trajet_passagers;

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
     * @var integer $nombre_passagers
     */
    private int $nombre_passagers;

    /**
     * @var boolean $fumeur
     */
    private bool $fumeur;

    /**
     * @var boolean $animal
     */
    private bool $animal;
    

    public function __construct(
        int $id_propose_trajet_passagers,
        DateTime $date_arrivee,
        DateTime $date_depart,
        DateTime $heure_depart,
        DateTime $heure_arrivee,
        string $ville_depart,
        string $ville_arrivee,
        int $nombre_passagers,
        bool $fumeur,
        bool $animal

    )
    {
        $this->id_propose_trajet_passagers = $id_propose_trajet_passagers;
        $this->date_arrivee = $date_arrivee;
        $this->date_depart = $date_depart;
        $this->heure_depart = $heure_depart;
        $this->heure_arrivee = $heure_arrivee;
        $this->ville_depart = $ville_depart;
        $this->ville_arrivee = $ville_arrivee;
        $this->nombre_passagers = $nombre_passagers;
        $this->fumeur = $fumeur;
        $this->animal= $animal;

    }

    /**
     * Récupère l'id de propose_trajet_passagers        en auto incrémente
     *
     * @return id_propose_trajet_passagers
     */
    public function getId_propose_trajet_passagers()
    {
        return $this->id_propose_trajet_passagers;
    }

    /**
     * récupère la date de l'arrivée
     *
     * @return date_arrivee
     */
    public function getDate_arrivee()
    {
        return $this->date_arrivee;
    }

    /**
     * Modifie/Affecte  la date de l'arrivée
     *
     * @param Datetime $date_arrivee
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
     * Récupère  l'heure de départ
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
     * Modifie/Affecte l'heure d'arrivée
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
     * Modifie/Affecte  la ville arrivée
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
     * Récupère le nombre de passagers
     *
     * @return nombre_passagers
     */
    public function getNombre_passagers()
    {
        return $this->nombre_passagers;
    }

    /**
     * Modifie/Affecte  le nombre de passagers
     *
     * @param int $nombre_passagers
     * @return nombre_passagers
     */
    public function setNombre_passagers($nombre_passagers)
    {
        $this->nombre_passagers= $nombre_passagers;

        return $this;
    }

    /**
     * Récupère les chauffeurs qui acceptent les fumeurs
     *
     * @return fumeur
     */
    public function getFumeur()
    {
        return $this->fumeur;
    }

    /**
     * Modifie/Affecte  les chauffeurs qui acceptent les fumeurs
     *
     * @param bool $fumeur
     * @return fumeur
     */
    public function setFumeur($fumeur)
    {
        $this->fumeur = $fumeur;

        return $this;
    }

    /**
     * Récupère les chauffeurs qui acceptent les animaux
     *
     * @return animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Modifie/Affecte  la liste des chauffeurs qui acceptent les animaux
     *
     * @param bool $animal
     * @return animal
     */
    public function setAnimal($animal)
    {
        $this->animal = $animal;

        return $this;
    }

    
}