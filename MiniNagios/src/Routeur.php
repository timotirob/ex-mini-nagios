<?php
namespace App;

class Routeur extends EquipementReseau
{
    private int $nbPorts;

    public function __construct(string $hostname, string $ip, int $nbPorts)
    {


        //  Appel du constructeur parent (qui va valider IP et Hostname)
        parent::__construct($hostname, $ip);

        //  Assignation
        $this->nbPorts = $nbPorts;
    }

    public function afficherStatut(): string
    {
        return parent::afficherStatut() . " | Ports : $this->nbPorts";
    }
}