<?php

class Wizard extends Character
{
    private $shield = false;

    function __construct($name)
    {
        parent::__construct($name);
        $this->mana *= 2;
        $this->atk = 2;
    }

    public function action($target)
    {
        $choice = rand(1, 10);
        if ($choice < 3 && !$this->shield && $this->mana >= 10){
            $status = $this->shield();
        }else{
            if($this->shield){
                $this->mana -= 10;
            }
            $status = $this->slap($target);
        }
        return $status;
    }

    public function slap($target)
    {
        $manaCost = rand(7 , 20);
        $magicAtk = $manaCost * 1.3;
        if ($this->mana >= $manaCost){
            $target->setHealthpoints($magicAtk);
            $this->mana -= $manaCost;
            $status = "{$this->name} magicSlap {$magicAtk} dégat a {$target->name}! Il reste {$target->healthPoints} PV a {$target->name}. ";
        }elseif($this->mana > 0){
            $magicAtk = $this->mana * 1.3;
            $target->setHealthpoints($magicAtk);
            $this->mana = 0;
            $status = "{$this->name} magicSlap {$magicAtk} dégat a {$target->name} avec reste de mana! Il reste {$target->healthPoints} PV a {$target->name}. ";
        }else{
            $target->setHealthpoints($this->atk);
            $status = "{$this->name} stickSlap {$target->name}! Il reste {$target->healthPoints} PV a {$target->name}. ";
        }
        return $status;
    }

    public function shield(){
        $this->shield = true;
        $this->mana -= 10;
        $status = "{$this->name} active son bouclier";
        return $status;
    }


    public function setHealthPoints($dmg)
    {
        if($this->shield){          
            $this->shield = false;
        }else{
            $this->healthPoints -= round($dmg);
            if ($this->healthPoints <= 0){
                $this->healthPoints = 0;
            }
        }
    }

}