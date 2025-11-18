<?php

namespace App\Entity;

use DateTime;

Class Voitures
{
    /**
     * @var integer id_voitures    identifiant en auto incremente
     */
    private int $id_voitures;

    /**
     * @var string $modele
     */
    private string $modele;

    /**
     * @var string $marque
     */
    private string $marque;

    /**
     * @var string $couleur
     */
    private string $couleur;

    /**
     * @var integer $kilometrages
     */
    private int $kilometrages;

    /**
     * @var DateTime $date_1_mise_en_circulation
     */
    private DateTime $date_1_mise_en_circulation;

    /**
     * @var string $plaque_immatriculation
     */
    private string $plaque_immatriculation;


    
    /**
     * Constructor
     */
    public function __construct(
        int $id_voitures,
        string $modele,
        string $marque,
        string $couleur,
        int $kilometrages,
        DateTime $date_1_mise_en_circulation,
        string $plaque_immatriculation
    )
    {
        $this->id_voitures =$id_voitures;
        $this->modele =$modele;
        $this->marque =$marque;
        $this->couleur =$couleur;
        $this->kilometrages =$kilometrages;
        $this->date_1_mise_en_circulation =$date_1_mise_en_circulation;
        $this->plaque_immatriculation =$plaque_immatriculation;

    }

    /**
     * Récupère $plaque_immatriculation
     *
     * @return  string
     */ 
    public function getPlaque_immatriculation()
    {
        return $this->plaque_immatriculation;
    }

    /**
     * Modifie/Affecte  $plaque_immatriculation
     *
     * @param  string  $plaque_immatriculation  $plaque_immatriculation
     *
     * @return  plaque_immatriculation
     */ 
    public function setPlaque_immatriculation(string $plaque_immatriculation)
    {
        $this->plaque_immatriculation = $plaque_immatriculation;

        return $this;
    }

    /**
     * Récupère $date_1_mise_en_circulation
     *
     * @return  DateTime
     */ 
    public function getDate_1_mise_en_circulation()
    {
        return $this->date_1_mise_en_circulation;
    }

    /**
     * Modifie/Affecte  $date_1_mise_en_circulation
     *
     * @param  DateTime  $date_1_mise_en_circulation  $date_1_mise_en_circulation
     *
     * @return  date_1_mise_en_circulation
     */ 
    public function setDate_1_mise_en_circulation(DateTime $date_1_mise_en_circulation)
    {
        $this->date_1_mise_en_circulation = $date_1_mise_en_circulation;

        return $this;
    }

    /**
     * Get the value of kilometrages    Récupère
     *
     * @return int kilometrages
     */
    public function getKilometrages(): int
    {
        return $this->kilometrages;
    }

    /**
     * Set the value of kilometrages         Modifie
     *
     * @param int $kilometrages
     *
     * @return kilometrages
     */
    public function setKilometrages(int $kilometrages): self
    {
        $this->kilometrages = $kilometrages;

        return $this;
    }

    /**
     * Récupère $couleur
     *
     * @return  string couleur
     */ 
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Modifie/Affecte  $couleur
     *
     * @param  string  $couleur  
     *
     * @return  couleur
     */ 
    public function setCouleur(string $couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Récupère $marque
     *
     * @return  string marque
     */ 
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Modifie/Affecte  $marque
     *
     * @param  string  $marque  
     *
     * @return  marque
     */ 
    public function setMarque(string $marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Récupère $modele
     *
     * @return  string modele
     */ 
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Modifie/Affecte  $modele
     *
     * @param  string  $modele  
     *
     * @return  modele
     */ 
    public function setModele(string $modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get id_voitures identifiant en auto incremente   Récupère
     *
     * @return  integer id_voitures
     */ 
    public function getId_voitures()
    {
        return $this->id_voitures;
    }

    /**
     * Set id_voitures identifiant en auto incremente      Modifie
     *
     * @param  integer  $id_voitures  
     *
     * @return  id_voitures
     */ 
    public function setId_voitures($id_voitures)
    {
        $this->id_voitures = $id_voitures;

        return $this;
    }
}