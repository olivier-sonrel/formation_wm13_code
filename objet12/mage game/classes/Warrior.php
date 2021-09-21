<?php

class Warrior extends Character
{
    function __construct($name)
    {
        parent::__construct($name);
    }

    public function action($target)
    {
        $target->setHealthpoints($this->atk);
        $status = "{$this->name} swordSlap {$target->name}! Il reste {$target->healthPoints} PV a {$target->name}. ";
        return $status;
    }
}