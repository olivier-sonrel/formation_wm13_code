<?php

class Archer extends Character
{
    private $quiver =10;
    private $dagger =5;
    private $critic = false;
    private $double = false;

    public function action($target) {
        if ($this->critic) {
            return $this->arrowCrit($target)
        }

        if ($this->quiver > 0) {
            $choice = rand(1, 10);
            if ($choice > 3 && $choice < 6 && $this->quiver >= 2) {
                return $this->doube($target);
            }elseif ($choice <= 3) {
                return $this->critic($target);        
            }else{
            return $this->arrow($target);
            }
        } else {
           return $this->dagger($target);
        }
    }

    private function arrowDouble($target) {
        $target->setHealthPoints($this->atk);
        $target->setHealthPoints($this->atk);
        $this->quiver =- 2;
        $status = "{$this->name} attaque double {$target->name} avec sa arc! Il reste {$target->healthPoints} point a {$target->name}";
        $this->double = false;
        return $status;
    }

    private function double($target) {
        $this->double = true;
        $status = "{$this->name} prepare 2 fleches {$target->name}!";
        return $status;
    }

    private function arrowCrit($target) {
        $rand = rand(15, 30)/10;
        $this->atk *= $rand;
        $this->critic = false; 
        $target->setHealthPoints($this->atk);
        $this->quiver --;
        $status = "{$this->name} attaque precise {$target->name} avec sa arc! Il reste {$target->healthPoints} point a {$target->name}";
        return $status;
    }


    private function arrow($target) {
        $target->setHealthPoints($this->atk);
        $this->quiver --;
        $status = "{$this->name} attaque {$target->name} avec sa arc! Il reste {$target->healthPoints} point a {$target->name}";
        return $status;
    }

    private function critic($target) {
        $this->critic = true;
        $status = "{$this->name} vise {$target->name}";
        return $status;
    }

    private function dagger($target) {
        $target->setHealthPoints($this->dagger);
        $status = "{$this->name} attaque {$target->name} avec sa dague! Il reste {$target->healthPoints} point a {$target->name}";
        return $status;

    }
}