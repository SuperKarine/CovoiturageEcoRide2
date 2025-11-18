<?php

namespace App\Entity;

use DateTime;

class Trajets
{
   
   /**
    * @var int $id_trajets              identifiant du trajet en auto incrément
    */
    private $id_trajets;

    /**
     * @var DateTime $date_arrivee          Date d'arrivée du trajet 
     */
    private $date_arrivee;

    /**
     * @var DateTime $date_depart          Date de départ du trajet
     */
    private $date_depart;

    /**
     * @var DateTime  $heure_depart         L'heure du départ du trajet
     */
    private $heure_depart;

    /**
     * @var DateTime $heure_arrivee      L'heure d'arrivée du trajet
     */
    private $heure_arrivee;

    /**
     * @var string $ville_depart           Ville du départ du trajet
     */
    private $ville_depart;

    /**
     * @var string $ville_arrivee            ville d'arrivée du trajet
     */
    private $ville_arrivee;

    /**
     * @var int $id_trajets_effectues       L'identifiant du trajets effectués pour le relier à la classe trajet
     */
    private $id_trajets_effectues;

    /**
     * @var int $num_trajet        L'identifiant de la classe trajet
     */
    private $num_trajet;
    

    /**
     * Constructor
     */
    public function __construct(
        int $id_trajets,
        DateTime $date_arrivee,
        DateTime $date_depart,
        DateTime  $heure_depart,
        DateTime $heure_arrivee,
        string $ville_depart,
        string $ville_arrivee,
        int $id_trajets_effectues,
        int $num_trajet

    )
    {
        $this->id_trajets = $id_trajets;
        $this->date_arrivee = $date_arrivee;
        $this->date_depart = $date_depart;
        $this->heure_depart = $heure_depart;
        $this->heure_arrivee = $heure_arrivee;
        $this->ville_depart = $ville_depart;
        $this->ville_arrivee = $ville_arrivee;
        $this->id_trajets_effectues = $id_trajets_effectues;
        $this->num_trajet = $num_trajet;
        
    }

    /**
     * Récupère l'id du trajet     Identifiant du trajet en auto incrément
     *
     * @return id_trajets
     */
    public function getId_trajets()
    {
        return $this->id_trajets;
    }

    
    /**
     * récupère la date de l'arrivée
     *
     * @return 
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
     * récupère la date du départ
     *
     * @return date_depart
     */
    public function getDate_depart()
    {
        return $this->date_depart;
    }


    /**
     * Modifie/Affecte  la date du départ
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
     * Récupère l'heure du départ
     *
     * @return heure_depart
     */
    public function getHeure_depart()
    {
        return $this->heure_depart;
    }


    /**
     * Modifie/Affecte  l'heure du départ
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
     * récupère l'heure de l'arrivée
     *
     * @return heure_arrivee
     */
    public function getHeure_arrivee()
    {
        return $this->heure_arrivee;
    }

    /**
     * Modifie/Affecte  l'heure de l'arrivée
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
     * Récupère la ville du départ
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
     * Récupère la ville d'arrivée
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
     * Récupère l'id des trajets effectués
     *
     * @return id_trajets_effectues
     */
    public function getId_trajets_effectues()
    {
        return $this->id_trajets_effectues;
    }


    /**
     * récupère l'id du trajet qui est sous le nom de num_trajet
     *
     * @return num_trajet
     */
    public function getNum_trajet()
    {
        return $this->num_trajet;
    }

    
}