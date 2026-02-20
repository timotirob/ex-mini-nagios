<?php
namespace App;

class Serveur extends EquipementReseau
{
    private string $os;

    // NOUVEAU : Un tableau pour stocker les objets "Service"
    private bool $maintenance = false;



    private array $services = [];
    public function __construct(string $hostname, string $ip, string $os)
    {


        parent::__construct($hostname, $ip); //
        if (!Validator::isOsSupported($os)) {
            // Si l'IP est pourrie, on lance une Exception (une erreur fatale contrôlée)
            throw new \Exception("ERREUR DE CONFIGURATION OS : L'os '$os' n'est pas valide !");
        }
        $this->os = $os; //
    }

    /**
     * C'est ici que la COMPOSITION opère.
     * On injecte un objet "Service" à l'intérieur du Serveur.
     */
    public function ajouterService(Service $service): void
    {
        // On ajoute l'objet reçu dans notre tableau
        $this->services[] = $service;
    }

    public function verifierSante():string {

        foreach($this->services as $service) {
            if (! $service->estDemarre() && $service->estCritique()) {
                return "<span style='color:red'>DANGER </span>";
            }
        }
        return "<span style='color:green'>OK </span>";
    }


    public function afficherStatut(): string
    {
        // 1. On affiche les infos de base du serveur
        $html = parent::afficherStatut() . " | OS : $this->os <br>";

        // 2. On boucle sur les services pour afficher leur état
        if ($this->maintenance) {
            $html.="Le serveur est maintenant en maintenance 🚧";
        }
        if (empty($this->services)) {
            $html .= "<em>Aucun service installé.</em>";
        } else {
            $html .= "<strong>Services : </strong>";
            foreach ($this->services as $service) {
                // On délègue l'affichage à la classe Service (Chacun son métier)
                $html .= $service->getStatut() . " ";
            }
        }

        return $html;
    }

    public function enMaintenance(): bool {
        return $this->maintenance;
    }

    public function activerMaintenance(): void {
        $this->maintenance = true;
    }
}
