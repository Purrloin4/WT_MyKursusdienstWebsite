<?php

class Greeter
{


    public function __construct()
    {

    }

    public function getGreeting()
    {
        $greetings = array('Hello', 'Hi', 'Howdy', 'Greetings', 'Boshoer');
        $index = array_rand($greetings);
        return $greetings[$index];
    }
}