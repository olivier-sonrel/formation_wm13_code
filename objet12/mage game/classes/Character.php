<?php

abstract class Character
{
    public $name;
    protected $isAlive = true;
    protected $healthPoints = 100;
    public $atk = 10;
    public $mana = 50;


    function __construct($name)
    {
        $this->name = $name;
    }

    public function getHealtPoints()
    {
        return $this->healthPoints;
    }

    public function isAlive()
    {
        if ($this->healthPoints <= 0){
            $this->isAlive = false;
        }
        return $this->isAlive;
    }

    public function setHealthPoints($dmg)
    {
        $this->healthPoints -= round($dmg);
        if ($this->healthPoints <= 0){
            $this->healthPoints = 0;
        }
        return;
    }
}