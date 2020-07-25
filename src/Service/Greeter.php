<?php
    namespace App\Service;

    class Greeter{

        public $name;

        public function __construct($name){
            $this->name = $name;
        }

        public function greet(){
            return "Hello ". $this->name . ", I'm on Your Service";
        }
    }