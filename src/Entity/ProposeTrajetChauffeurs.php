<?php

namespace App\Entity;

use DateTime;


class ProposeTrajetChauffeurs
{
    /**
     * @var int $num_trajet   identifiant de la table  Propose_trajet_chauffeurs en auto increment
     */
    private int $num_trajet;

    /**
     * @var DateTime $date_arrivee     La date d'arrivée
     */
    private DateTime $date_arrivee;

    /**
     * @var DateTime $date_depart     La date de départ
     */
    private DateTime $date_depart;

    /**
     * @var DateTime $heure_depart L'heure de départ
     */
    private DateTime $heure_depart;

    /**
     * @var DateTime $heure_arrivee      L'heure d'arrivée
     */
    private DateTime $heure_arrivee;

    /**
     * @var string $ville_depart      La ville de départ
     */
    private string $ville_depart;

    /**
     * @var string $ville_arrivee      La ville d'arrivée
     */
    private string $ville_arrivee;

    /**
     * @var string $pseudo_chauffeur    Le pseudo du chauffeur
     */
    private string $pseudo_chauffeur;

    /**
     * @var string $marque               La marque de la voiture
     */
    private string $marque;

    /**
     * @var string $modele                Le modèle de la voiture
     */
    private string $modele;

    /**
     * @var integer $nbr_place_restantes    Nombre de places restantes disponible dans le véhicule
     */
    private int $nbr_place_restantes;

    /**
     * @var integer $nbr_place_trajet        Nombre de places pour le trajet
     */
    private int $nbr_place_trajet;

    /**
     * @var integer $prix_personne           Prix du trajet par personne
     */
    private int $prix_personne;

    /**
     * @var float $temps_trajets             Le temps du trajet
     * 
     */
    private float $temps_trajets;

    /**
     * @var string $information_sup           Les éventuelles informations supplémentaires du chauffeur
     */
    private string $information_sup;
    

    /**
     * Propose_trajet_chauffeurs
     * Méthode magique qui est appelé automatiquement lors de l'instanciation de Propose_trajet_chauffeurs
     */
    public function __construct(
        int $num_trajet,
        DateTime $date_arrivee,
        DateTime $date_depart,
        DateTime $heure_depart,
        DateTime $heure_arrivee,
        string $ville_depart,
        string $ville_arrivee,
        string $pseudo_chauffeur,
        string $marque,
        string $modele,
        int $nbr_place_restantes,
        int $nbr_place_trajet,
        int $prix_personne,
        float $temps_trajets,
        string $information_sup

    )
    {
         $this->num_trajet = $num_trajet;
         $this->date_arrivee = $date_arrivee;
         $this->date_depart = $date_depart;
         $this->heure_depart = $heure_depart;
         $this->heure_arrivee = $heure_arrivee;
         $this->ville_depart = $ville_depart;
         $this->ville_arrivee = $ville_arrivee;
         $this->pseudo_chauffeur = $pseudo_chauffeur;
         $this->marque = $marque;
         $this->modele = $modele;
         $this->$nbr_place_restantes = $nbr_place_restantes;
         $this->nbr_place_trajet = $nbr_place_trajet;
         $this->prix_personne = $prix_personne;
         $this->temps_trajets = $temps_trajets;
         $this->information_sup = $information_sup;

    }



    /**
     * Récupère l'id de propose_trajet_chauffeurs       identifiant en auto incrémente de propose_trajet_chauffeurs
     *
     * @return num_trajet
     */
    public function getNum_trajet()
    {
        return $this->num_trajet;
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
     * Modifie la date d'arrivée
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
     * Modifie la date de départ
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
     * Modifie l'heure de départ
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
     * Modifie l'heure d'arrivée
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
     * Modifie la ville de départ
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
     * Modifie la ville d'arrivée
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
     * Récupère le pseudo du chauffeur
     *
     * @return pseudo_chauffeur
     */
    public function getPseudo_chauffeur()
    {
        return $this->pseudo_chauffeur;
    }

    /**
     * Modifie le pseudo du chauffeur
     *
     * @param string $pseudo_chauffeur
     * @return pseudo_chauffeur
     */
    public function setPseudo_chauffeur($pseudo_chauffeur)
    {
        $this->pseudo_chauffeur= $pseudo_chauffeur;

        return $this;
    }

    /**
     * Récupère la marque de la voiture
     *
     * @return marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Modifie la marque de la voiture
     *
     * @param string $marque
     * @return marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Récupère le modèle de la voiture
     *
     * @return modele
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Modifie le modèle
     *
     * @param string $modele
     * @return modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Récupère le nombre de place restantes
     *
     * @return nbr_place_restantes
     */
    public function getNbr_place_restantes()
    {
        return $this->nbr_place_restantes;
    }

    /**
     * Modifie/Affecte  le nombre de places restantes
     *
     * @param int $nbr_place_restantes
     * @return nbr_place_restantes
     */
    public function setNbr_place_restantes($nbr_place_restantes)
    {
        $this->nbr_place_restantes = $nbr_place_restantes;

        return $this;
    }

    /**
     * Récupère le nombre de place de trajet
     *
     * @return nbr_place_trajet
     */
    public function getNbr_place_trajet()
    {
        return $this->nbr_place_trajet;
    }

    /**
     * Modifie/Affecte  le nombre de place trajet
     *
     * @param int $nbr_place_trajet
     * @return nbr_place_trajet
     */
    public function setNbr_place_trajet($nbr_place_trajet)
    {
        $this->nbr_place_trajet = $nbr_place_trajet;

        return $this;
    }

    /**
     * Récupère le prix du trajet par personne
     *
     * @return prix_personne
     */
    public function getPrix_personne()
    {
        return $this->prix_personne;
    }

    /**
     * Modifie/Affecte  le prix du trajet par personne
     *
     * @param int $prix_personne
     * @return prix_personne
     */
    public function setPrix_personne($prix_personne)
    {
        $this->prix_personne = $prix_personne;

        return $this;
    }

    /**
     * Récupère le temps de trajet
     *
     * @return temps_trajets
     */
    public function getTemps_trajets()
    {
        return $this->temps_trajets;
    }

    /**
     * Modifie/Affecte le temps du trajet
     *
     * @param float $temps_trajets
     * @return temps_trajets
     */
    public function setTemps_trajets($temps_trajets)
    {
        $this->temps_trajets = $temps_trajets;

        return $this;
    }

    /**
     * Récupère les informations supplémentaires
     *
     * @return information_sup
     */
    public function getInformation_sup()
    {
        return $this->information_sup;
    }

    /**
     * Modifie/Affecte  les informations supplémentaires
     *
     * @param string $information_sup
     * @return information_sup
     */
    public function setInformation_sup($information_sup)
    {
        $this->information_sup = $information_sup;

        return $this;
    }

    
}