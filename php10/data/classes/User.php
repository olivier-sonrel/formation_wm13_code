<?php

class User 
{
    private $_firstName;
    private $_lastName;
    private $_age;

    public function __construct($firstName, $lastName)
    {
        $this->_name = $firstName;
        $this->_lastName = $lastName;
        $this->_age= 666;
    }

    public function sayMyName()
    {
        echo 'My name is : ' . $this->_name;
    }

    public function addUser()
    {
        
    }

    static function older($this->_age)
    {
        $this->_age++;
    }
}

$myUser = new User("god", "hell");
print_r($myUser);