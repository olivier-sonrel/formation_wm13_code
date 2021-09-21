<?php

class Voiture
{
    public $nbr_roues = 4;
    public $couleur;
    private $essence;

    function __construct($color, $fuel)//$voiture3 = new Voiture('violet', 80);
    {
        $this->couleur = $color;
        $this->essence = $fuel;
        $this->reservoir = $fuel;
        
    }

    public function getEssence() //interagir avec private
    {
        return $this->Essence;
    }
    
    public function setEssence($value) //interagir avec private
    {
         $this->Essence = $value;
         return;
    }

    public function avancer()
    {
        if($this->essence >= 19){
            return 'Vrououououm...';
            $this->essence -= 30;
        }else{
            return 'MMM time du coup de la panne...';
        }    
    }

    public function color($color)//$voiture2->color('bleu');
    {
        $this->couleur = $color;
        return;
    }

    public function faireLePlein()
    {
        return "ok, crack ton fric.";
        $this->essence = 100;
    }
    public function donnerEssence($target)
    {
        $this->essence -= 10;
        $target->essence += 10;
    }
}