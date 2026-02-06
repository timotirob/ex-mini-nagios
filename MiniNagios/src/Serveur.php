<?php
namespace App;

class Serveur extends EquipementReseau
{
    private string $os;

    public function __construct(string $hostname, string $ip, string $os)
    {


        parent::__construct($hostname, $ip); //
        if (!Validator::isOsSupported($os)) {
            // Si l'IP est pourrie, on lance une Exception (une erreur fatale contrôlée)
            throw new \Exception("ERREUR DE CONFIGURATION OS : L'os '$os' n'est pas valide !");
        }
        $this->os = $os; //
    }

    public function afficherStatut(): string
    {
        return parent::afficherStatut() . " | OS : $this->os"; //
    }
}