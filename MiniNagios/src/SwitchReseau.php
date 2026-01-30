<?php
namespace App ;

class SwitchReseau extends EquipementReseau {
    private int $nombrePorts = 24 ;

    public function __construct(string $hostname, string $ip, int $nombrePorts) {
        $this->nombrePorts = $nombrePorts ;
        parent::__construct($hostname, $ip);

    }

    public function scannerPorts() : void {
        // Une boucle for, utilisation 10 % du temps, 80 % du temps foreach , 10 % while
        // on a un compteur $compteur
        // un point de départ ici 1
        // un seuil: attribut $nombrePorts
        // un palier: ++ donc 1
        for ($compteur = 1; $compteur <= $this->nombrePorts; $compteur++) {
            $activateur = rand(0, 1) ;
            if ($activateur == 1) {
                echo "<P> Port numéro $compteur :<span style='color:green'>  activé </span></P>" ;
            }
            else
                echo "<P> Port numéro $compteur :<span style='color:red'>  déconnecté </span></P> " ;
        }


    }

}